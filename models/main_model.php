<?php

class Main_model extends CI_Model {

    public function count() {
        $query = $this->db->count_all_results('task');
        return $query;
    }

    public function get_data_for_mail() {

        $this->db->select('lead_task.id,lead_task.lead_id,lead_task.task_date,lead_task.reminder_date,lead_task.reminder_time,lead_task.task_owner,lead_task.task,lead_task.priority,staff.email1');
        $this->db->from('lead_task');
        $this->db->join('staff', 'lead_task.task_owner = staff.id');
        $query = $this->db->get()->result_array();
        return $query;
    }

    // Fill Data in Drop down List
    public function fill_value_list($table_name = '', $request = '', $field_name = '', $filters_id_values = '', $selected_id = '', $titlename = '') {// select boxes, $selected_id - to mark selected option in select box, $field_name - for name of selectbox field in table
        $this->db->where('is_deleted', 0);

        $this->db->select("$request, $field_name"); //id primary key is hard coded
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();

        $option_str = '<option value = ""';
        if (!($selected_id)) {
            $option_str .= ' selected="selected"';
        }
        $option_str .= '>' . $titlename . "  </option>";
        foreach ($data as $rec) {
            $option_str .= '<option ';
            $option_str .= 'value = "' . $rec[$request] . '"';
            if ($rec[$request] == $selected_id) {
                $option_str .= ' selected="selected"';
            }
            $option_str .= '>' . $rec[$field_name] . '</option>';
        }
        return $option_str;
    }

    public function get_all_data() {
        $sql = "SELECT lead.lead_name,lead.organisation,lead.lead_qualifying_status,lead.created_date,mobile.mobile,email.email,task.task_date\n"
                . "from lead\n"
                . "inner join mobile\n"
                . "on lead.id = mobile.lead_id\n"
                . "inner join email\n"
                . "on lead.id = email.lead_id\n"
                . "inner join phone\n"
                . "on lead.id = phone.lead_id\n"
                . "inner join task\n"
                . "on lead.id = task.lead_id\n"
                . "where\n"
                . "lead.is_deleted = 0\n"
                . "order by lead.id";
    }

    public function get_lead_search_data($lead_name = '', $organisation = '', $mobile = '', $email = '', $created_date_from = '', $created_date_to = '', $modify_date_from = '', $modify_date_to = '', $due_date_from = '', $due_date_to = '',$lead_owner='',$work_status='') {
         //-----------------for subordinate data -----------------------------//
         $subordinate_data=$this->main_model->get_records('staff','parent_id',$_SESSION['oms_staff_id']);
         //------------------end -----------------------------------------------//
	if(!empty($created_date_from)){
            $created_date_from=date("Y-m-d", strtotime($created_date_from));
            $created_date_to=date("Y-m-d", strtotime($created_date_to));
        }
//        if(!empty($modify_date_from)){
//            $modify_date_from=date("Y-m-d", strtotime($modify_date_from));
//            $modify_date_to=date("Y-m-d", strtotime($modify_date_to));
//        }
        if(!empty($due_date_from)){
            $due_date_from=date("Y-m-d", strtotime($due_date_from));
        }
        if(!empty($due_date_to)){
            $due_date_to=date("Y-m-d", strtotime($due_date_to));
        }
        $this->db->select('lead.id,lead.lead_name,lead.organisation,lead.lead_qualifying_status,lead.created_date,lead.modify_date,lead_mobile.mobile,lead_email.email,lead_task.task_date,lead_task.task,lead_task.priority,lead_task.work_status,lead_task.task_owner');
        $this->db->from('lead');
        if ($lead_name != 0) {
            $this->db->where('lead.id', $lead_name);
        }       
        if ($organisation != '') { 
            $this->db->where('lead.organisation', $organisation);
        }       
//        if ($modify_date_from != '' and $modify_date_to != '') {
//            $this->db->where("`lead.modify_date` BETWEEN '$modify_date_from' AND '$modify_date_to'");
//        }
        $this->db->where('lead.is_deleted', 0);
        $this->db->where('lead.status', 'Active');
        $this->db->join('lead_mobile', 'lead.id = lead_mobile.lead_id');
        $this->db->join('lead_email', 'lead.id = lead_email.lead_id');
        $this->db->join('lead_task', 'lead.id = lead_task.lead_id');
        $this->db->order_by('lead_task.task_date',"desc");
        if ($mobile != '') {
            $this->db->where('lead_mobile.mobile', $mobile);
        }
        if ($email != '') {
            $this->db->where('lead_email.email', $email);
        }
        if ($created_date_from != '' and $created_date_to != '') {
            $this->db->where("`lead_task.created_date` BETWEEN '$created_date_from' AND '$created_date_to'");
        }
        if ($due_date_from != '' and $due_date_to != '') {
            $this->db->where("`lead_task.task_date` BETWEEN '$due_date_from' AND '$due_date_to'");
        }
        if ($due_date_from != '' and $due_date_to == '') {
            $this->db->where("lead_task.task_date >= ", $due_date_from);
        }
        if ($due_date_from == '' and $due_date_to != '') {
            $this->db->where("lead_task.task_date <= ",$due_date_to);
        }
        if ($lead_owner != '') {
            $this->db->where('lead_task.task_owner', $lead_owner);  
        }
        if ($work_status != '') {
            $this->db->where('lead_task.work_status', $work_status);  
        }
        
        //-------------------------for no filter condition (comment-1)----------------------------------//
        if(($lead_name == 0) && ($organisation == '') && ($created_date_from == '' and $created_date_to == '') && ($mobile == '') && ($email == '') && ($due_date_from == '' and $due_date_to == '') && ($lead_owner == ''))
        {
        if (!empty($_SESSION['oms_staff_id'])) {
            $this->db->where('lead_task.task_owner', $_SESSION['oms_staff_id']);      
        }
        //-----------------for subordinate data -----------------------------//     
        if(!empty($subordinate_data)){
            $subordinate=$subordinate_data->result_array();
            foreach ($subordinate as $value)
            {
                $this->db->or_where('lead_task.task_owner', $value['id']);
            }
        }
        }
        //-----------------------end ---------------------------------//
        //-------------------------end (comment-1)----------------------------------------//
        $query = $this->db->get()->result_array();
        return $query;
        
    }



    public function fill_select_new($table_name = '', $field_name = '', $selected_id = 0, $where_id = '', $where_val = 0) {// select boxes, $selected_id - to mark selected option in select box, $field_name - for name of primary id in table
        $this->db->where('is_deleted', 0);
        if ($where_id) {
            $this->db->where($where_id, $where_val);
        }
        $this->db->select("id, $field_name"); //id primary key is hard coded
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();
        $table = $table_name;
        $option_str = '<option value=""';
        if (!($selected_id)) {
            $option_str .= ' selected';
        }
        $option_str .= '> -- Select a ' . $table . " -- </option>";
        if ($table == 'party_detail') {
            if (!($selected_id)) {
                $option_str = '<option value="" selected> All</option>';
            }
        }
        foreach ($data as $rec) {
            $option_str .= '<option ';

            $option_str .= 'value="' . $rec['id'] . '"';
            if ($rec['id'] == $selected_id) {
                $option_str .= ' selected';
            }
            $option_str .= '>' . $rec[$field_name] . '</option>';
        }
        return $option_str;
    }

    public function get_joint_name_from_id($table_name = '', $requested_column1 = '', $requested_column2 = '', $id = 0) {// for grid column, $id to get single record
        $query_str = "SELECT concat( $requested_column1, ' ', $requested_column2 ) AS name FROM $table_name WHERE id = $id;";
        $query = $this->db->query($query_str); //->result_array()
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->name;
        }
    }

    public function get_assets_data_for_manage() {
        $query_str = "SELECT assets.id, assets.p_name, assets.t_number,assets_vendor.c_person,assets.m_number,assets.s_number,assets.quantity,assets.price,assets.dop,assets.doe,assets_category.c_type\n"
                . "FROM assets\n"
                . "INNER JOIN assets_vendor\n"
                . "ON assets.c_pid=assets_vendor.id\n"
                . "INNER JOIN assets_category\n"
                . "ON assets.c_id=assets_category.id\n"
                . "where assets.is_deleted = 0\n"
                . "ORDER BY assets.id";
        $result = $this->db->query($query_str);

        return $result;
    }

    //Roles id and Name For New User Table
//    public function rolesName(){
//        $this->db->where('is_deleted', 0);
//        $this->db->where('status', 'Active');
//        $this->db->select('id , name');
//        $this->db->from('roles');
//        $query=  $this->db->get();
//        return $query->result();
//        $result=$query->result();
//        echo '<pre>';
//        print_r($result); die;}

    public function get_name_from_id1($table_name = '', $requested_column = 'name', $id_name = "id", $value = 0) {// for grid column, $id to get single record
        $this->db->where('is_deleted', 0);
        $this->db->where($id_name, $value);
        $this->db->select("$requested_column as name");
        $this->db->from($table_name);
        $query = $this->db->get(); //->result_array()
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->name;
        }
    }

    public function get_node_level($table, $id = 0, $level = 1) {
        if ($id == 0) {
            return $id;
        }
        $parent = $this->get_name_from_id1($table, "parent_id", "id", $id);
        if ($parent) {
            return $this->get_node_level($table, $parent, ++$level);
        } else {
            return $level;
        }
    }

    public function get_name_from_id($table_name = '', $requested_column = '', $id = 0) {// for grid column, $id to get single record
        $this->db->where('is_deleted', 0);
        $this->db->where('id', $id); //id primary key is hard coded, $field_name is name of requested  column in table
        $this->db->select("$requested_column as name");
        $this->db->from($table_name);
        $query = $this->db->get(); //->result_array()
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->name;
        }
    }

    function add_update_many_records_many_table($tbl, $data = array(), $filters_id_values) {//$filters_id_values as foriegn keys
        //var_dump($tbl);
        //var_dump($data);
        //var_dump($filters_id_values);
        //die;
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }
        $this->db->delete($tbl); //deleting old records for this foriegn keys

        if (count($data)) {//if data present..
            foreach ($data as $rec) {

                if ($filters_id_values) {//setting foriegn keys
                    foreach ($filters_id_values as $filter) {
                        $this->db->set($filter['id'], $filter['value']);
                    }
                }

                foreach ($rec as $key => $value) {//setting other database fields
                    $this->db->set($key, $value);
                }

                $query = $this->db->insert($tbl);
            }
        }
    }

    function add_update_record($tbl, $data = array(), $id_name = '') {//$id_name for update record, id_name field must be present in associative $data array

           
        if (count($data)) {
            unset($data['submit']);
            $this->db->set($data); //passing associative array to values in SET sql query
            if ($id_name) {//updating record on getting id name - id value is sent through form
                $this->db->where($id_name, $data[$id_name]);
                $query = $this->db->update($tbl);
                return $data[$id_name];
            } else {//adding record in table
                $this->db->set($data);

                $query = $this->db->insert($tbl);
                return $this->db->insert_id(); //autoincreament id after insert query
            }
        }
    }

    function add_update_many_records($tbl, $data = array(), $id_name = "", $id_value = 0) {// delete and then add
        //echo '<pre>';var_dump($data);die;
        if ($id_name && $id_value) {//deleting previous records
            $this->db->where($id_name, $id_value);
            $this->db->delete($tbl);
        }
        if (count($data)) {//if data present..
            if (isset($data['submit'])) {//precautionary unset if sent from a form
                unset($data['submit']);
            }
            foreach ($data as $rec) {//entering database records
                $rec[$id_name] = $id_value;
                $this->db->set($rec);
                $query = $this->db->insert($tbl);
            }
        }
    }

    function add_update_many_table_many_record_many_foriegnkeys($tbl, $data = array(), $foreign_keys) {
        if ($foreign_keys) {
            foreach ($foreign_keys as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        $this->db->delete($tbl);

        if (count($data)) {//if data present..
            if (isset($data['submit'])) {//precautionary unset if sent from a form
                unset($data['submit']);
            }

            foreach ($data as $rec) {
                foreach ($rec as $key => $value) {//entering database records
                    $this->db->set($key, $value);
                }
                $query = $this->db->insert($tbl);
            }
        }
    }

    function add_update_one_record_many_table($tbl, $data = array(), $filters_id_values) {// delete and then add
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }
        $this->db->delete($tbl);

        if (count($data)) {//if data present..
            if (isset($data['submit'])) {//precautionary unset if sent from a form
                unset($data['submit']);
            }
            if ($filters_id_values) {
                foreach ($filters_id_values as $filter) {
                    $this->db->where($filter['id'], $filter['value']);
                }
            }
            foreach ($data as $key => $value) {//entering database records
//                $rec[$key] = $id_value;
                $this->db->set($key, $value);
            }
            $query = $this->db->insert($tbl);
        }
    }

    public function fill_work_select($table_name = '', $field_name = '', $filters_id_values, $selected_id = 0) {// select boxes, $selected_id - to mark selected option in select box, $field_name - for name of selectbox field in table
        $this->db->where('is_deleted', 0);
        $this->db->where('status', 'Active');
        $this->db->select("id, $field_name"); //id primary key is hard coded
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();
        $table = $table_name;
        if ($table_name != 'quiz') {
            $table = substr($table_name, 0, -1);
        }
        $option_str = '<option value = "0"';
        if (!($selected_id)) {
            $option_str .= ' selected';
        }
        $option_str .= '> --Select a Subject -- </option>';
        foreach ($data as $rec) {
            $option_str .= '<option ';

            $option_str .= 'value = "' . $rec[$field_name] . '"';
            if ($rec['id'] == $selected_id) {
                $option_str .= ' selected';
            }
            $option_str .= '>' . $rec[$field_name] . '</option>';
        }
        return $option_str;
    }

    public function fill_staff_name_id_select($table_name = '', $first_name, $last_name, $filters_id_values, $selected_id = 0) {// select boxes, $selected_id - to mark selected option in select box, $field_name - for name of selectbox field in table
        $this->db->where('is_deleted', 0);
        $this->db->where('status', 'Active');
        $this->db->select("id, $first_name, $last_name");
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();

        $table = $table_name;
        if ($table_name != 'quiz') {
            $table = substr($table_name, 0, -1);
        }
        $option_str = '<option value=""';
        if (!($selected_id)) {
            $option_str .= ' selected';
        }
        $option_str .= "> ---- choose Name ---- </option>";

        foreach ($data as $rec) {
            $id = $rec['id'];
            $option_str .= '<option ';

            $option_str .= 'value = "' . $rec['id'] . '"';

            if ($rec['id'] == $selected_id) {
                $option_str .= ' selected';
            }
            $option_str .= ">($id) $rec[$first_name] $rec[$last_name]</option>";
        }
        return $option_str;
    }

    public function fill_staff_name_select($table_name = '', $first_name, $last_name, $filters_id_values, $selected_id = 0) {// select boxes, $selected_id - to mark selected option in select box, $field_name - for name of selectbox field in table
        $this->db->where('is_deleted', 0);
        $this->db->where('status', 'Active');
        $this->db->select("id, $first_name, $last_name");
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();
        $table = $table_name;
        if ($table_name != 'quiz') {
            $table = substr($table_name, 0, -1);
        }
        $option_str = '<option value=""';
        if (!($selected_id)) {
            $option_str .= ' selected';
        }
        $option_str .= "> ---- choose Name ---- </option>";
        foreach ($data as $rec) {
            $option_str .= '<option ';

            $option_str .= 'value = "' . $rec['id'] . '"';
            if ($rec['id'] == $selected_id) {
                $option_str .= ' selected';
            }
            $option_str .= ">$rec[$first_name] $rec[$last_name] </option>";
        }
        return $option_str;
    }

    public function fill_select($table_name = '', $field_name = '', $filters_id_values = "", $selected_id = 0) {// select boxes, $selected_id - to mark selected option in select box, $field_name - for name of selectbox field in table
        $this->db->where('is_deleted', 0);
        $this->db->where('status', 'Active');
        $this->db->select("id, $field_name"); //id primary key is hard coded
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        };
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();
        $table = $table_name;
        $option_str = '<option value = "0"';
        if (!($selected_id)) {
            $option_str .= ' selected="selected"';
        }
        $option_str .= '> -- Select  a level--' . " -- </option>";
        foreach ($data as $rec) {
            $option_str .= '<option ';
            $option_str .= 'value = "' . $rec['id'] . '"';
            if ($rec['id'] == $selected_id) {
                $option_str .= ' selected="selected"';
            }
            $option_str .= '>' . $rec[$field_name] . '</option>';
        }
        return $option_str;
    }

    public function fill_lead_name_select($table_name = '', $first_name, $last_name, $filters_id_values, $selected_id = 0) {// select boxes, $selected_id - to mark selected option in select box, $field_name - for name of selectbox field in table
        $this->db->where('is_deleted', 0);
        $this->db->where('status', 'Active');
        $this->db->select("id, $first_name, $last_name");
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();
        $table = $table_name;
        if ($table_name != 'quiz') {
            $table = substr($table_name, 0, -1);
        }
        $option_str = '<option value=""';
        if (!($selected_id)) {
            $option_str .= ' selected';
        }
        $option_str .= "> -- Select a Staff Name -- </option>";
        foreach ($data as $rec) {
            $option_str .= '<option ';

            $option_str .= 'value = "' . $rec['id'] . '"';
            if ($rec['id'] == $selected_id) {
                $option_str .= ' selected';
            }
            $option_str .= ">$rec[$first_name] $rec[$last_name]</option>";
        }
        return $option_str;
    }

    public function fill_select_staff($table_name = '', $field_name = '', $filters_id_values, $selected_id = 0) {// select boxes, $selected_id - to mark selected option in select box, $field_name - for name of selectbox field in table
        $this->db->where('is_deleted', 0);
        $this->db->where('status', 'Active');
        $this->db->select("id, $field_name"); //id primary key is hard coded
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        };
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();
        $table = $table_name;
        $option_str = '<option value = "0"';
        if (!($selected_id)) {
            $option_str .= ' selected="selected"';
        }
        $option_str .= '> -- Select  a staff--' . " -- </option>";
        foreach ($data as $rec) {
            $option_str .= '<option ';
            $option_str .= 'value = "' . $rec['id'] . '"';
            if ($rec['id'] == $selected_id) {
                $option_str .= ' selected="selected"';
            }
            $option_str .= '>' . $rec[$field_name] . '</option>';
        }
        return $option_str;
    }

    public function get_user_name_select($table_name = '', $first_name, $last_name, $filters_id_values, $selected_id = 0) {// select boxes, $selected_id - to mark selected option in select box, $field_name - for name of selectbox field in table
        $this->db->where('is_deleted', 0);
        $this->db->where('status', 'Active');
        $this->db->select("id, $first_name, $last_name");
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();
        $option_str = $data;
        return $option_str;
    }

    public function get_selected_records($table_name = '', $search_column = '', $search_value = 0, $request_fields) {//$request_fields=array(),
        $this->db->where('is_deleted', 0);
        $this->db->where('status', 'Active');
        if ($search_column) {
            $this->db->where($search_column, $search_value);
        };
        $str = '';
        foreach ($request_fields as $column_name) {

            $str.= $column_name . ', ';
        }
        $this->db->select($str); //id primary key is hard coded, $field_name is name of requested  column in table
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();
        return $data;
    }

    public function get_selected_records1($table_name = '', $search_column = '', $search_value = 0, $request_fields) {//$request_fields=array(),
        $this->db->where('is_deleted', 0);
        // $this->db->where('status', 'Active');
        if ($search_column) {
            $this->db->where($search_column, $search_value);
        };
        $str = '';
        foreach ($request_fields as $column_name) {

            $str.= $column_name . ', ';
        }
        $this->db->select($str); //id primary key is hard coded, $field_name is name of requested  column in table
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();
        return $data;
    }

    public function get_many_records($table_name = '', $filters_id_values, $request_fields, $order_by = '') {//to get records from table having many related records --- $request_fields=array(field1,field2)
        $str = '';
        if ($request_fields) {
            foreach ($request_fields as $column_name) {
                $str.= $column_name . ', ';
            }
        }
        $this->db->select($str);

        $this->db->where('is_deleted', 0);
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }

        if ($order_by) {//format : $this->db->order_by('title desc, name asc');
            $this->db->order_by($order_by);
        }
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();
//        echo '<pre>';
//        print_r($data); die;
        return $data;
    }

    function my_delete_record($tbl, $id_name, $id_value) {
        $this->db->set('is_deleted ', 1);
        $this->db->where($id_name, $id_value);
        $this->db->update($tbl);
    }

    function update($table, $col_nm, $id, $data) {
        $this->db->where($col_nm, $id);
        $this->db->set($data);
        $this->db->update($table);
    }

    function delete($table, $col_nm, $id) {
        $this->db->where($col_nm, $id);
        $this->db->delete($table);
    }

    public function fill_selected_state($value = "") {
        $opt_str = "";
        $str[1] = 'Assam';
        $str[2] = 'Bihar';
        $str[3] = 'Chandigarh';
        $str[4] = 'Chhatisgarh';
        $str[5] = 'Delhi';
        $str[6] = 'Gujarat';
        $str[7] = 'Haryana';
        $str[8] = 'Jammu and Kashmir';
        $str[9] = 'Jharkhand';
        $str[10] = 'Karnataka';
        $str[11] = 'Kerala';
        $str[12] = 'Madhya Pradesh';
        $str[13] = 'Maharashtra';
        $str[14] = 'Manipur';
        $str[15] = 'Meghalaya';
        $str[16] = 'Mizoram';
        $str[17] = 'Orissa';
        $str[18] = 'Pondicherry';
        $str[19] = 'Punjab';
        $str[20] = 'Rajasthan';
        $str[21] = 'Tamil Nadu';
        $str[22] = 'Tripura';
        $str[23] = 'Uttar Pradesh';
        $str[24] = 'Uttaranchal';
        $str[25] = 'West Bengal';

        if (!$value) {
            $opt_str.='<option selected="selected" value="">- Select a State -</option>';
        } else {
            $opt_str.='<option value="">- Select a State -</option>';
        }

        foreach ($str as $state) {
            $opt_str.='<option ';
            if (($value) && ($value == $state)) {
                $opt_str.='selected="selected" ';
            }
            $opt_str.='value="' . $state . '">' . $state . '</option>';
        }
        return $opt_str;
    }

    public function fill_selected_blood_group($value = "") {
        $opt_str = "";

        $str[1] = 'A+';
        $str[2] = 'A-';
        $str[3] = 'B+';
        $str[4] = 'B-';
        $str[5] = 'O+';
        $str[6] = 'O-';
        $str[7] = 'AB+';
        $str[8] = 'AB-';


        if (!$value) {
            $opt_str.='<option selected="selected" value="">- Select Blood Group -</option>';
        } else {
            $opt_str.='<option value="">- Select Blood Group -</option>';
        }

        foreach ($str as $blood_group) {
            $opt_str.='<option ';
            if (($value) && ($value == $blood_group)) {
                $opt_str.='selected="selected" ';
            }
            $opt_str.='value="' . $blood_group . '">' . $blood_group . '</option>';
        }

        return $opt_str;
    }

    public function fill_selected_relationship($value = "") {
        $opt_str = "";
        $str[1] = 'Father';
        $str[2] = 'Mother';
        $str[3] = 'Brother';
        $str[4] = 'Sister';
        $str[5] = 'Spouse';
        $str[6] = 'Friend';
        $str[7] = 'Other';

        if (!$value) {
            $opt_str.='<option selected="selected" value="">- Select a Relation -</option>';
        } else {
            $opt_str.='<option value="">- Select a Relation -</option>';
        }

        foreach ($str as $relationship1) {
            $opt_str.='<option ';
            if (($value) && ($value == $relationship1)) {
                $opt_str.='selected="selected" ';
            }
            $opt_str.='value="' . $relationship1 . '">' . $relationship1 . '</option>';
        }

        return $opt_str;
    }

    public function fill_selected_month($value = "") {
        $opt_str = "";
        $str[1] = 'January';
        $str[2] = 'February';
        $str[3] = 'March';
        $str[4] = 'April';
        $str[5] = 'May';
        $str[6] = 'June';
        $str[7] = 'July';
        $str[8] = 'August';
        $str[9] = 'September';
        $str[10] = 'October';
        $str[11] = 'November';
        $str[12] = 'December';



        if (!$value) {
            $opt_str.='<option selected="selected" value="">-Month-</option>';
        } else {
            $opt_str.='<option value="">Month</option>';
        }

        foreach ($str as $relationship1) {
            $opt_str.='<option ';
            if (($value) && ($value == $relationship1)) {
                $opt_str.='selected="selected" ';
            }
            $opt_str.='value="' . $relationship1 . '">' . $relationship1 . '</option>';
        }

        return $opt_str;
    }

    //DEWANGSHU STARTS
    //for select technology(dewangshu's code)
    public function fill_activity_type($value = "") {
        $opt_str = "";

        $str[1] = 'Coding';
        $str[2] = 'Designing';
        $str[3] = 'Testing';
        $str[4] = 'Requirement Analisis';
        $str[5] = 'Coding & Design';
        $str[6] = 'Coding & Testing';
        $str[7] = 'Design,Coding &Testing';
        $str[8] = 'Internet Searching & Understand the concept';
        $str[9] = 'R&D for Solution';
        $str[10] = 'FTP:uploading to dev';
        $str[11] = 'Database Design';
        $str[12] = 'Database Uploading';
        $str[13] = 'Other';



        if (!$value) {
            $opt_str.='<option selected="selected" value="">- Activity Type -</option>';
        } else {
            $opt_str.='<option value="">- Activity Type -</option>';
        }

        foreach ($str as $blood_group) {
            $opt_str.='<option ';
            if (($value) && ($value == $blood_group)) {
                $opt_str.='selected="selected" ';
            }
            $opt_str.='value="' . $blood_group . '">' . $blood_group . '</option>';
        }

        return $opt_str;
    }

    public function fill_selected_technology($value = "") {
        $opt_str = "";

        $str[1] = 'PHP';
        $str[2] = '.NET';
        $str[3] = 'JAVA';
        $str[4] = 'WORDPRESS';
        $str[5] = 'CI';
        $str[6] = 'Android';
        $str[7] = 'JSP';
        $str[8] = 'Hybernate';
        $str[9] = 'Drupal';
        $str[10] = 'Photoshop';
        $str[11] = 'HTML/Bootstrap';
        $str[12] = 'ASP.NET';
        $str[13] = 'PHP & .NET';
        $str[14] = 'Android & PHP';
        
        //$str[8] = 'Other';
        


        if (!$value) {
            $opt_str.='<option selected="selected" value="">- Select Technology -</option>';
        } else {
            $opt_str.='<option value="">- Select Technology -</option>';
        }

        foreach ($str as $blood_group) {
            $opt_str.='<option ';
            if (($value) && ($value == $blood_group)) {
                $opt_str.='selected="selected" ';
            }
            $opt_str.='value="' . $blood_group . '">' . $blood_group . '</option>';
        }

        return $opt_str;
    }

    public function fill_selected_task_status($value = "") {
        $opt_str = "";

        $str[1] = 'Started';
        $str[2] = 'OnHold';
        $str[3] = 'Resume';
        $str[4] = 'Completed';
        $str[5] = 'Cancelled';


        if (!$value) {
            $opt_str.='<option selected="selected" value="">- Select Status -</option>';
        } else {
            $opt_str.='<option value="">- Select Status -</option>';
        }

        foreach ($str as $blood_group) {
            $opt_str.='<option ';
            if (($value) && ($value == $blood_group)) {
                $opt_str.='selected="selected" ';
            }
            $opt_str.='value="' . $blood_group . '">' . $blood_group . '</option>';
        }

        return $opt_str;
    }

    //end for select technology(dewangshu's code)
    //updated 13062016
    public function show_select_project($selected_id = '') {
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->where('status', 'Active');
        $this->db->where('is_deleted', 0);
        $data = $this->db->get()->result_array();

        $option_str = '<option value = "0"';
        if (!($selected_id)) {
            $option_str .= ' selected="selected"';
        }
        $option_str .= '> -- Select  a project--' . " -- </option>";
        foreach ($data as $rec) {
            $option_str .= '<option ';
            $option_str .= 'value = "' . $rec['id'] . '"';
            if ($rec['id'] == $selected_id) {
                $option_str .= ' selected="selected"';
            }
            $option_str .= '>' . $rec['name'] . '</option>';
        }
        return $option_str;
    }

    function get_records($table, $id_name = '', $id_value = 0, $orderby = '') { //for orderby field : 'title desc, name asc'
       // $this->db->where('is_deleted', 0);
        if ($id_name) {
            $this->db->where($id_name, $id_value);
        }
        if ($orderby) {
            $this->db->order_by($orderby);
        }
        $query = $this->db->get($table); // automatically add above conditions if enabled by if statement
//print_r($query->result_array());
        return $query;
    }

    function get_record1($table, $id_name = '', $id_value = 0, $orderby = '') { //for orderby field : 'title desc, name asc'
        $this->db->where('is_deleted', 0);
        if ($id_name) {
            $this->db->where($id_name, $id_value);
            //$this->db->where('parent_id', 0);
        }
        if ($orderby) {
            $this->db->order_by($orderby);
        }
        $query = $this->db->get($table); // automatically add above conditions if enabled by if statement
//print_r($query->result_array());
        return $query->result_array();
    }

    function get_record11($table, $id_name = '', $id_value = 0, $orderby = '') { //for orderby field : 'title desc, name asc'
        $this->db->where('is_deleted', 0);
        if ($id_name) {
            $this->db->where($id_name, $id_value);
            $this->db->where('parent_id', 0);
        }
        if ($orderby) {
            $this->db->order_by($orderby);
        }
        $query = $this->db->get($table); // automatically add above conditions if enabled by if statement
//print_r($query->result_array());
        return $query->result_array();
    }

    function get_record12($table, $id_name = '', $id_value = 0, $id_name1 = '', $id_value1 = 0, $orderby = '') { //for orderby field : 'title desc, name asc'
        $this->db->where('is_deleted', 0);
        if ($id_name) {
            $this->db->where($id_name, $id_value);
            $this->db->where($id_name1, $id_value1);
            // $this->db->where('parent_id', 0);
        }
        if ($orderby) {
            $this->db->order_by($orderby);
        }
        $query = $this->db->get($table); // automatically add above conditions if enabled by if statement
//print_r($query->result_array());
        return $query->result_array();
    }

    function get_record13($table, $id_name = '', $id_value = 0, $id_name1 = '', $id_value1 = 0, $id_name2 = '', $id_value2 = 0, $orderby = '') { //for orderby field : 'title desc, name asc'
        $this->db->where('is_deleted', 0);
        if ($id_name) {
            $this->db->where($id_name, $id_value);
            $this->db->where($id_name1, $id_value1);
            $this->db->where($id_name2, $id_value2);
            // $this->db->where('parent_id', 0);
        }
        if ($orderby) {
            $this->db->order_by($orderby);
        }
        $query = $this->db->get($table); // automatically add above conditions if enabled by if statement
//print_r($query->result_array());
        return $query->result_array();
    }

    function get_records_join_2table($ids) {

        $this->db->select('*');
        $this->db->from('task_assign_staff');
        $this->db->join('task', 'task_assign_staff.task = task.id');
        $this->db->where('task.id', $ids);

        $query = $this->db->get();
        return $query->result_array();
    }

    //DEWANGSHU ENDS
//------------AKHIL FUNCTION -----------------------------//

    public function fill_select_staff_full_name($table_name = '', $field_name, $filters_id_values, $selected_id = '') {// select boxes, $selected_id - to mark selected option in select box, $field_name - for name of selectbox field in table
        $this->db->where('is_deleted', 0);
        $this->db->where('status', 'Active');
        foreach ($field_name as $field) {
            $this->db->select("id, $field");
        } //id primary key is hard coded
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        };
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();
        $table = $table_name;
        $option_str = '<option value = "0"';
        if (!($selected_id)) {
            $option_str .= ' selected="selected"';
        }
        $option_str .= '> -- Select  a staff--' . " -- </option>";
        foreach ($data as $rec) {
            $option_str .= '<option ';
            $option_str .= 'value = "' . $rec['id'] . '"';
            if ($rec['id'] == $selected_id) {
                $option_str .= ' selected="selected"';
            }
            $option_str .= '>' . $rec['first_name'] . ' ' . $rec['last_name'] . '</option>';
        }
        return $option_str;
    }

    
    public function get_records_from_id($table, $id_value = 0, $id_name = 'id', $request_fields = '*') { //for orderby field : 'title desc, name asc'
        $str = '';
        if ($request_fields != '*') {
            foreach ($request_fields as $column_name) {
                $str.= $column_name . ', ';
            }
        } else {
            $str = ' * ';
        }
        $this->db->select($str);
        $this->db->where('is_deleted', 0);
        $this->db->where($id_name, $id_value);
        $query = $this->db->get($table);
        return $query->row_array();
    }

    //------------AKHIL FUNCTION -----------------------------//
    //--------------------------------------------IMS FUNCTIONS FOR HR-LEAVE,PL,CL ETC
     function delete_many_records($tbl = "", $foreign_key = "", $foreign_key_value = "") {
        $this->db->where($foreign_key, $foreign_key_value);
        $this->db->delete($tbl);
    }
     public function get_name_from_id_many_cond($table_name = '', $requested_column = 'name', $filters_id_values){
        $this->db->where('is_deleted', 0);
                if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }

        $this->db->select("$requested_column as name");
        $this->db->from($table_name);
        $query = $this->db->get(); //->result_array()
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->name;
        }
    }
    function delete_many_records_filter($tbl = "", $filters_id_values = "") {
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
            $this->db->delete($tbl);
        }
    }
     public function createDateRangeArray($strDateFrom, $strDateTo) {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.
        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange = array();

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
            while ($iDateFrom < $iDateTo) {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
        }
        return $aryRange;
    }
    public function autofill_select($table_name = '', $field_name = '',$field_value='', $selected_id = 0, $where_id = '', $where_val = 0) {// select boxes, $selected_id - to mark selected option in select box, $field_name - for name of primary id in table
        $this->db->where('is_deleted', 0);
        $this->db->where('status', 'Active');
        if ($where_id) {
            $this->db->where($where_id, $where_val);
        }
        $this->db->select("$field_value , $field_name"); 
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();
        $table = $table_name;
        $option_str = '';
        $option_str .= '<option value=""';
        $option_str .= '> </option>';
        //return $option_str;
        
//        if (!($selected_id)) {
//            $option_str .= ' selected';
//        }
        //$option_str .= '> -- Add new  -- </option>';
       
        foreach ($data as $rec) {
            $option_str .= '<option ';

            $option_str .= 'value="' . $rec[$field_value] . '"';
            if ($rec[$field_value] == $selected_id) {
                $option_str .= ' selected';
            }
            $option_str .= '>' . $rec[$field_name] . '</option>';
        }
        $option_str .= '<option value=""';
        $option_str .= '> Add new  </option>';
        return $option_str;
    }

    //--------------------------------------------IMS FUNCTIONS FOR HR-LEAVE,PL,CL ETC

    public function fill_own_value_list($table_name = '', $request = '', $field_name = '', $filters_id_values = '', $selected_id = '', $name = '') {// select boxes, $selected_id - to mark selected option in select box, $field_name - for name of selectbox field in table
        $this->db->where('is_deleted', 0);

        $this->db->select("$request, $field_name"); //id primary key is hard coded
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }
        $this->db->from($table_name);
        $data = $this->db->get()->result_array();

        $option_str = '<option value = ""';
        if (!($selected_id)) {
            $option_str .= ' selected="selected"';
        }
        $option_str .= '>' . $name . "  </option>";
        foreach ($data as $rec) {
            $option_str .= '<option ';
            $option_str .= 'value = "' . $rec[$request] . '"';
            if ($rec[$request] == $selected_id) {
                $option_str .= ' selected="selected"';
            }
            $option_str .= '>' . $rec[$field_name] . '</option>';
        }
        return $option_str;
    }
    public function get_record_counts($table_name = '', $filter_data = '') {


        if ($filter_data) {
            foreach ($filter_data as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }
        $this->db->where('is_deleted', 0);
        $this->db->from($table_name);

        $query = $this->db->count_all_results();

        return $query;
    }
    public function get_selected_data_in_between($table = '', $filters_id_values, $request_fields, $date_start = '', $end_date = '', $col_name, $order_by = '') {//same to get_many_reords but filter between query.
        $str = '';
        if ($request_fields) {
            foreach ($request_fields as $column_name) {
                $str.= $column_name . ', ';
            }
        }
        $this->db->select($str);
        if ($end_date != '') {
            $this->db->where($col_name . " <=  '$end_date'");
        }
        if ($date_start != '') {
            $this->db->where($col_name . " >=  '$date_start'");
        }
        $this->db->where('is_deleted', 0);
        if ($filters_id_values) {
            foreach ($filters_id_values as $filter) {
                $this->db->where($filter['id'], $filter['value']);
            }
        }

        if ($order_by) {//format : $this->db->order_by('title desc, name asc');
            $this->db->order_by($order_by);
        }
        $this->db->from($table);
        $data = $this->db->get()->result_array();
        return $data;
    }

	public function get_child($table = "", $col_name = "", $id = 0, $list = array()) {
        $result = $this->get_data_self_table($table, $col_name, $id);
                //var_dump($result);die;
        foreach ($result as $data) {
            $list[] = $data->id;
            $child = $this->get_data_self_table($table, $col_name, $data->id);
            if (!is_null($child)) {
                $list = $this->get_child($table, $col_name, $data->id, $list);
            }
        }
        return $list;
    }
    
   public function get_data_self_table($table, $col_name, $req_data) {
       $this->db->select('*');
       $this->db->from($table);
       $this->db->where('is_deleted', '0');
       $this->db->where($col_name, $req_data);
       $query = $this->db->get();
       
       return $query->result();
   }
}

?>
