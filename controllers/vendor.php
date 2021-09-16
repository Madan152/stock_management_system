<?php

class Vendor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->custom->initialise_session();
        $this->check_permission->load_user_acl($_SESSION['oms_role_id']);
        $this->load->model('main_model');
         date_default_timezone_set('Asia/Kolkata');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    //---------VIEW ADD VENDOR PAGE
    public function add() {
        $this->load->view('add_vendor');
    }

    //---------VIEW ADD VENDOR PAGE ENDS
    //---------INSERT UPDATE VENDOR
    public function set() {
        //echo '<pre>';var_dump($_POST);var_dump($_FILES);die;
        if (isset($_POST['id'])) {//sending different parameters for update and insert
            $id = $_POST['id'];
            $this->assets_upload_data('assets_vendor', $_POST, $_FILES, $id);
            $return_id = $this->main_model->add_update_record('assets_vendor', $_POST, 'id');
        } else {
            $return_id = $this->main_model->add_update_record('assets_vendor', $_POST);
            $id = trim($return_id);
            //image code start-----------------
            if ($_FILES['image_file']['size']) {
                $extn = end(explode(".", $_FILES['image_file']['name']));
                $config['upload_path'] = './assets/img/uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size'] = '2000'; //size upto 2MB
                $config['overwrite'] = True;
                $config['file_name'] = 'assets_vendor' . '-' . $id . '-' . 'image' . '.' . $extn;
                $this->load->library('upload');
                $this->upload->initialize($config);
                $file_name = $this->main_model->get_name_from_id('assets_vendor', "image_file", $id);
                $path = $config['upload_path'] . $file_name;
                if (file_exists($path) && $file_name) {
                    unlink($path) or die('failed deleting: ' . $path);
                }
                if (!$this->upload->do_upload('image_file')) {
                    $error = array('error' => $this->upload->display_errors());
                    die(var_dump($error));
                } else {
                    $upload_return = array('upload_data' => $this->upload->data());
                }
                $data['id'] = $id;
                $data['image_file'] = 'assets_vendor' . '-' . $id . '-' . 'image' . '.' . $extn;
                $id = $this->main_model->add_update_record('assets_vendor', $data, 'id');
            }

            if ($_FILES['mc_file']['size']) {
                $extn = end(explode(".", $_FILES['mc_file']['name']));
                $config['upload_path'] = './assets/img/uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size'] = '2000'; //size upto 2MB
                $config['overwrite'] = True;
                $config['file_name'] = 'assets_vendor' . '-' . $id . '-' . 'mc' . '.' . $extn;
                $this->load->library('upload');
                $this->upload->initialize($config);
                $file_name = $this->main_model->get_name_from_id('assets_vendor', "mc_file", $id);
                $path = $config['upload_path'] . $file_name;
                if (file_exists($path) && $file_name) {
                    unlink($path) or die('failed deleting: ' . $path);
                }
                if (!$this->upload->do_upload('mc_file')) {
                    $error = array('error' => $this->upload->display_errors());
                    die(var_dump($error));
                } else {
                    $upload_return = array('upload_data' => $this->upload->data());
                }

                $data['id'] = $id;
                $data['mc_file'] = 'assets_vendor' . '-' . $id . '-' . 'mc' . '.' . $extn;
                $id = $this->main_model->add_update_record('assets_vendor', $data, 'id');
            }
            //image code end-------------------

            $_POST['id'] = $id;
            $this->main_model->add_update_record('assets_vendor', $_POST, 'id');
        }

        header('Location: ' . base_url() . 'vendor/manage');
    }

    //---------INSERT UPDATE VENDOR ENDS
    //---------MANAGE VENDOR
    public function manage($id = '') {
        $req_fields = array("id", "v_name", "c_number", "address", "image_file", "email", "website");
        $query['data'] = $this->main_model->get_many_records('assets_vendor', '', $req_fields, "id");
        $this->load->view('manage_vendor', $query);
    }

    //---------MANAGE VENDOR ENDS
    //---------EDIT VENDOR
    public function edit($id = 0) {//for add/update form
        $row_data = array();
        $query = $this->main_model->get_records('assets_vendor', 'id', $id);
        $row_data = $query->row();
        $vendor_name = $this->main_model->get_name_from_id('assets_vendor', 'v_name', $row_data->id);
        $row_data->vendor_name = (object) $vendor_name;
        $this->load->view('edit_vendor', $row_data);
    }

    //---------EDIT VENDOR ENDS
    //---------DELETE VENDOR
    public function delete($id = 0, $child_table = "") {//$id is value of primary key "id" to be deleted, - $foreign_key is the foreign key name in the child table
        $tbl = $table;
        $this->main_model->my_delete_record('assets_vendor', 'id', $id);
        header('Location: ' . base_url() . 'vendor/manage');
    }

    //---------DELETE VENDOR ENDS
    
    //---------UPLOAD VENDOR DATA
    public function assets_upload_data($table, &$post_data, &$post_file, $id = '') { //$id is particular row id
        //echo $config['upload_path'];           
        foreach ($post_file as $key => $value) {
            if ($post_file[$key]['size']) {
                        $config['upload_path'] = './assets/img/uploads/';
                        $extn = end(explode(".", $post_file['image_file']['name']));
                        $config['file_name'] = $table . '-' . $id . '-' . 'image' . '.' . $extn;
                        $file_name = $table . '-' . $id . '-' . 'image' . '.' . $extn;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf';
                $config['max_size'] = '2000'; //size upto 2MB
                $config['overwrite'] = TRUE;
                if ($key == 'image_file') {
                    $extn = end(explode(".", $post_file['image_file']['name']));
                    $config['image_name'] = $table . '-' . $id . '-' . 'image' . '.' . $extn;
                    $file_name = $table . '-' . $id . '-' . 'image' . '.' . $extn;
                }
                $this->load->library('upload');
                $this->upload->initialize($config);
                $path = $config['upload_path'] . $file_name;
                if (file_exists($path) && $file_name) {
                    unlink($path) or die('failed deleting: ' . $path);
                }
                if (!$this->upload->do_upload($key)) {
                    $error = array('error' => $this->upload->display_errors());
                    die(var_dump($error));
                } else {
                    $upload_return = array('upload_data' => $this->upload->data());
                }
                $post_data[$key] = $file_name;
            }//if condition close
        }//foreach closing  
    }
    //---------UPLOAD VENDOR DATA END
}

?>
