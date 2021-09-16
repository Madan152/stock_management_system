<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class stock_model extends CI_Model
    {
        function save_stock_category($formArray)
        {
             $this->db->insert('stock_category',$formArray);  //this means INSERT INTO stocks() VALUES(?,?) ;
            //here 'stocks' is table name and '$formArray' is a variable which contains all data
            //given by form.

        }
        public function fetch_all_stock_category()
        {
            $this->db->get('stock_category',)->result_array();//this means SELECT * FROM stocks;

            $users=$this->db->get('stock_category',)->result_array();//all data will be store in $users variable
            return $users;
        }
        public function get_stock_record($userId)   //$userId is the varible which receives user_id
        {
            $this->db->where('id',$userId);//SELECT * FROM stocks WHERE id=$userId;
            //$this->db->get('users')->row_array();//fetch only one row

            $user=$this->db->get('stock_category')->row_array();//fetched data stored in the '$user' variable
            return $user;

        }
        //get one particular column from 'stock_category' table
        public function get_selected_column_from_stock_category_table()
       {
                $this->db->select('category_name'); 
                $this->db->from('stock_category');   
               // $this->db->where('res_id', $res_id);
               return $this->db->get()->result_array();
                 
       }
       
   

       public  function update_stock_category($userId,$formArray)
        {
            //UPDATE stocks SET ???? WHERE id=$userId;
            $this->db->where('id',$userId);
            $this->db->update('stock_category',$formArray);  //1st arameter is 'table name'
           
        }

        
       public function delete_stock_category($userId)
        {
            $this->db->where('id',$userId);//DELETE FROM stocks where
            $this->db->delete('stock_category');         //id=$userId;
        }
        public function fill_stock_category($value = "") {
            $opt_str = "";
            $str[1] = 'Software';
            $str[2] = 'Hardware';
            $str[3] = 'Networking';
            $str[4] = 'Accessories';
            $str[5] = 'Furniture';
            $str[6] = 'Stationary';
            $str[7] = 'Electronics and Communication';
            $str[8] = 'Electricals';
            $str[9] = 'Other';
    
            if (!$value) {
                $opt_str.='<option selected="selected" value="">- Select Stock Category -</option>';
            } else {
                $opt_str.='<option value="">- select a category-</option>';
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
        public function fill_product_category($value = "") {
            $opt_str = "";
            $str[1] = 'Software';
            $str[2] = 'Hardware';
            $str[3] = 'Networking';
            $str[4] = 'Accessories';
            $str[5] = 'Furniture';
            $str[6] = 'Stationary';
            $str[7] = 'Electronics and Communication';
            $str[8] = 'Electricals';
            $str[9] = 'Other';
    
            if (!$value) {
                $opt_str.='<option selected="selected" value="">- Select Product Category -</option>';
            } else {
                $opt_str.='<option value="">- select a category-</option>';
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

        //PRODUCT Deatils
        public function fetch_all_product()
        {
            $this->db->get('product_table',)->result_array();//this means SELECT * FROM stocks;

            $users=$this->db->get('product_table',)->result_array();//all data will be store in $users variable
            return $users;
        }
        public function get_product_record($userId)   //$userId is the varible which receives user_id
        {
            $this->db->where('id',$userId);//SELECT * FROM stocks WHERE id=$userId;
            //$this->db->get('users')->row_array();//fetch only one row

            $user=$this->db->get('product_table')->row_array();//fetched data stored in the '$user' variable
            return $user;

        }
        public  function update_product($userId,$formArray)
        {
            //UPDATE stocks SET ???? WHERE id=$userId;
            $this->db->where('category_id',$userId);
            $this->db->update('product_table',$formArray);  //1st arameter is 'table name'
           
        }
        public function delete_product($userId)
        {
            $this->db->where('id',$userId);//DELETE FROM stocks where
            $this->db->delete('product_table');         //id=$userId;
        }
       
        function get_category(){
            $query = $this->db->get('stock_category');           
            return $query;
        }
     


        //very important function it is....
        //fetching any particular column from any table
        public function get_name_from_id($table_name = '', $requested_column = '', $id = 0) 
        {// for grid column, $id to get single record
            //$this->db->where('is_deleted', 0);
            $this->db->where('id', $id); //id primary key is hard coded, $field_name is name of requested  column in table
            $this->db->select("$requested_column as name");
            $this->db->from($table_name);
            $query = $this->db->get(); //->result_array()
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->name;
            }
        }

        //this function is used to save and edit 
        function add_update_record($tbl, $data = array(), $id_name = '') {//$id_name for update record, id_name field must be present in associative $data array
            
            // echo '<pre>';
            // print_r($data['product_unit']);die;

            if (count($data)) {
                unset($data['submit']);
                $this->db->set($data); //passing associative array to values in SET sql query
                if ($id_name) {//updating record on getting id name - id value is sent through form
                    $this->db->where($id_name, $data[$id_name]);
                    $query = $this->db->update($tbl);
                    return $data[$id_name];
                } else {//adding record in table
                    $this->db->set($data);  
                    // echo "<pre>";
                    // print_r($data);die;  
                    $query = $this->db->insert($tbl);                    
                    return $this->db->insert_id(); //auto increament id after insert query
                }
            }
        }
        
        public function get_many_records($table_name = '', $filters_id_values, $request_fields, $order_by = '') {//to get records from table having many related records --- $request_fields=array(field1,field2)
            $str = '';
            if ($request_fields) {
                foreach ($request_fields as $column_name) {
                    $str.= $column_name . ', ';
                }
            }
            $this->db->select($str);
    
           // $this->db->where('is_deleted', 0);
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
        //VENDOR
        public function get_vendor_record($userId)   //$userId is the varible which receives user_id
        {
            $this->db->where('id',$userId);//SELECT * FROM stocks WHERE id=$userId;
            //$this->db->get('users')->row_array();//fetch only one row

            $user=$this->db->get('stock_vendor')->row_array();//fetched data stored in the '$user' variable
            return $user;

        }
        public function fetch_all_purchase_product()
        {
            $this->db->get('stock',)->result_array();//this means SELECT * FROM stocks;

            $users=$this->db->get('stock',)->result_array();//all data will be store in $users variable
            return $users;
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
            //$this->db->where('is_deleted', 0);
            $this->db->where($id_name, $id_value);
            $query = $this->db->get($table);
            return $query->row_array();
        }  
        
        
    }
?>