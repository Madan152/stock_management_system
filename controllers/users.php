<?php

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->custom->initialise_session();
        $this->check_permission->load_user_acl($_SESSION['oms_role_id']);
        $this->load->model('main_model');
         date_default_timezone_set('Asia/Kolkata');
    }

    //---------VIEW ADD UNIT PAGE
    public function add() {
        $this->load->view('add_users');
    }

    //---------VIEW ADD UNIT PAGE ENDS
    
    //---------INSERT UNIT
    public function set() {
        if (isset($_POST['id'])) {//----Update Table Data
            $this->main_model->add_update_record('user', $_POST, 'id');
        } else {//----Insert New Data
            $this->main_model->add_update_record('user', $_POST);
        }
        header('Location: ' . base_url() . 'users/manage');
    }
    //---------INSERT UNIT ENDS
    
    //---------MANAGE UNIT
    public function manage() {
                $req_fields = array("id", "staff_id", "email", "mobile", "role", "status");
                $query['data'] = $this->main_model->get_many_records("user", '', $req_fields, "id");
                $this->load->view('manage_user', $query);
    }
    //---------MANAGE UNIT ENDS
    
    //---------EDIT UNIT
     public function edit($id = 0) {//for add/update form
        $row_data = array();
        $query = $this->main_model->get_records('user', 'id', $id);
        $row_data = $query->row();
        $this->load->view('edit_user', $row_data);
    }
    //---------EDIT UNIT ENDS
    
    //---------DELETE UNIT
    public function delete($id = 0, $child_table = "") {//$id is value of primary key "id" to be deleted, - $foreign_key is the foreign key name in the child table
        $this->main_model->my_delete_record('user', 'id', $id);
        header('Location: ' . base_url() . 'users/manage');
    }
    //---------DELETE UNIT ENDS
}

?>
