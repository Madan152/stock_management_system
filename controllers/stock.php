<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class stock extends CI_Controller
    {
        public function __construct() {
            parent::__construct();
            $this->custom->initialise_session();
            // $this->check_permission->load_user_acl($_SESSION['oms_role_id']);
            $this->load->model('stock_model');
            $this->load->model('main_model');
             date_default_timezone_set('Asia/Kolkata');
            $this->load->helper('form');
            $this->load->helper('url');
        }
           
       

        public function add_stock_category() {
            $this->load->view('sms_views/add_stock_category');
        }
         //-------END--ADD STOCK PAGE CALLING
               
        //---------INSERT STOCK CATEGORY, & UPADATE
        public function save_stock_category() {
        //    echo '<pre>';
        //    print_r($_POST);die;
    //         $technology_table_data=$_POST['technology'];
    //         unset($_POST['technology']);
        //    echo '<pre>';
        //    print_r($_POST);die;
            

            if (isset($_POST['id'])) {//----Update Table Data
                // $_POST['modify_by'] = $_SESSION['oms_user_id'];
                // $_POST['modify_date'] = date("Y-m-d H:i:s");
                //echo "here";die;
                $this->main_model->add_update_record('stock_category', $_POST, 'id');
                
              }
            else {//----Insert New Data
                // $_POST['created_by'] = $_SESSION['oms_user_id'];
                // $_POST['created_date'] = date("Y-m-d H:i:s");
               // echo " do here";
                $project_id=$this->main_model->add_update_record('stock_category', $_POST);
                
                
            }
            header('Location: ' . base_url() . 'stock/manage' );
        }
        //---------INSERT ,UPDATE  ENDS
        
         
        
        //---------MANAGE STOCK CATEGORY PAGE CALLING
        public function manage() {
                    $req_fields = array("id", "category_name","category_type","category_desc", "status");
                    
                    $query['data'] = $this->stock_model->fetch_all_stock_category("stock_category", '', $req_fields, "id");
                //echo "here";
                    $this->load->view('sms_views/manage_stock_category', $query);
        }
        //---------MANAGE  STOCK CATEGORY ENDS
        
      public  function edit_stock_category($userId)//$userId is a parameter of edit() function which receives 'user_id'
        {
           
           
            $this->load->model('stock_model');
           // $this->Use_model->getUser($userId);//calling 'getUser()' function of User_model for
                                               //fetching one row of user.And passed '$userId' variable 

            $user=$this->stock_model->get_stock_record($userId); //here one record stored in '$user' variable.
            // echo "<pre>";
            // print_r($user);die;  
            

            $data=array();
            $data['user']=$user;//here 'user' is array index of '$data' which can be used in 'edit view' 

            $this->load->view('sms_views/edit_stock_category',$data);
             
            
        }
        
        function delete_stock_category($userId)
        {
            $this->load->model('stock_model');
            $users=$this->stock_model->get_stock_record($userId);

            //check whether data found in database or not
            if(empty($users))
            {
               // $this->session->set_flashdata('failure','Record Not Found');//here we are
                 //addind session variable and set_flashdata() and assing here ' session index' 
                 //and 'index value' 
                 redirect(base_url().'index.php/stock/manage');
            }
            $this->stock_model->delete_stock_category($userId);
                 //$this->session->set_flashdata('success','Record is deleted successfully');//here we are
                 //addind session variable and set_flashdata() and assing here ' session index' 
                 //and 'index value' 
                redirect(base_url().'index.php/stock/manage');

        }


        //ADD PRODUCT CALLING HERE
        public function add_product()
        {
            $records['rec']=$this->main_model->get_records('stock_category')->result_array();
            
            $this->load->view('sms_views/add_product',$records);
        }

        //SAVE PRODUCT CALLING HERE
        public function save_product()
        {
            // echo "<pre>";
            // print_r($_POST);
            $_POST['product_mfd']= date("Y-m-d", strtotime($_POST['product_mfd']));
            $_POST['product_exp']= date("Y-m-d", strtotime($_POST['product_exp']));
            // echo "<pre>";
            // print_r($_POST);die;
            
            if (isset($_POST['id'])) {//----Update Table Data
                // $_POST['modify_by'] = $_SESSION['oms_user_id'];
                // $_POST['modify_date'] = date("Y-m-d H:i:s");
                //echo "here";die;
                $this->main_model->add_update_record('product_table', $_POST, 'id');
                
              }
            else {//----Insert New Data
                // $_POST['created_by'] = $_SESSION['oms_user_id'];
                // $_POST['created_date'] = date("Y-m-d H:i:s");
               // echo " do here";
                $project_id=$this->main_model->add_update_record('product_table', $_POST);
                
                
            }
            header('Location: ' . base_url() . 'stock/manage_product' );
        }

        public function manage_product()
        {
            $req_fields = array("id","category_id",'product_id',"product_name","product_mrp", "product_cp","product_sp","product_desc","product_mfd","product_exp","product_gst","product_gst_per");
                    
            $query['data'] = $this->stock_model->fetch_all_product("product_table", '', $req_fields, "product_id");

        // echo "<pre>";
        // print_r($query);die;

            $this->load->view('sms_views/manage_product',$query);
        }

        public  function edit_product($userId)//$userId is a parameter of edit() function which receives 'user_id'
        {
          $records=$this->main_model->get_records('stock_category')->result_array(); // not working
                
            $user=$this->stock_model->get_product_record($userId); //here one record stored in '$user' variable.
                                       
            $data=array();
            $data['user']=$user;//here 'user' is array index of '$data' which can be used in 'edit view' 
            $data['rec']=$records;
            
            // echo "<pre>";
            // print_r($user);die;
            //$this->load->view('sms_views/edit_product',$data, $records);//not working

            $this->load->view('sms_views/edit_product',$data);
             
            
        }
       
        function delete_product($userId)
        {
            $this->load->model('stock_model');
            $users=$this->stock_model->get_product_record($userId);

            //check whether data found in database or not
            if(empty($users))
            {
               // $this->session->set_flashdata('failure','Record Not Found');//here we are
                 //addind session variable and set_flashdata() and assing here ' session index' 
                 //and 'index value' 
                 redirect(base_url().'index.php/stock/manage_product');
            }
            $this->stock_model->delete_product($userId);
                 //$this->session->set_flashdata('success','Record is deleted successfully');//here we are
                 //addind session variable and set_flashdata() and assing here ' session index' 
                 //and 'index value' 
                redirect(base_url().'index.php/stock/manage_product');

        }

        //VENDOR's Related Functions 
        public function add_vendor()
        {
            $this->load->view('sms_views/add_vendor');
        }
        public function set_vendor() {
            
            //these two values are given manually to store in the database. 
            $_POST['created_date']=date('Y-m-d');
            $_POST['modify_date']=date('Y-m-d H:i:s');
            // echo "<pre>";
            // print_r($_POST);die;
            //echo '<pre>';var_dump($_POST);var_dump($_FILES);die;
            if (isset($_POST['id'])) {//sending different parameters for update and insert
                $id = $_POST['id'];
                $this->assets_upload_data('stock_vendor', $_POST, $_FILES, $id);
                $return_id = $this->stock_model->add_update_record('stock_vendor', $_POST, 'id');
            } else {
                $return_id = $this->stock_model->add_update_record('stock_vendor', $_POST);
                $id = trim($return_id);
                //image code start-----------------
                if ($_FILES['image_file']['size']) {
                    $extn = end(explode(".", $_FILES['image_file']['name']));
                    $config['upload_path'] = './assets/img/uploads/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                    $config['max_size'] = '2000'; //size upto 2MB
                    $config['overwrite'] = True;
                    $config['file_name'] = 'stock_vendor' . '-' . $id . '-' . 'image' . '.' . $extn;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    $file_name = $this->stock_model->get_name_from_id('stock_vendor', "image_file", $id);
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
                    $data['image_file'] = 'stock_vendor' . '-' . $id . '-' . 'image' . '.' . $extn;
                    $id = $this->stock_model->add_update_record('stock_vendor', $data, 'id');
                }
    
                if ($_FILES['mc_file']['size']) {
                    $extn = end(explode(".", $_FILES['mc_file']['name']));
                    $config['upload_path'] = './assets/img/uploads/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                    $config['max_size'] = '2000'; //size upto 2MB
                    $config['overwrite'] = True;
                    $config['file_name'] = 'stock_vendor' . '-' . $id . '-' . 'mc' . '.' . $extn;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    $file_name = $this->stock_model->get_name_from_id('stock_vendor', "mc_file", $id);
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
                    $data['mc_file'] = 'stock_vendor' . '-' . $id . '-' . 'mc' . '.' . $extn;
                    $id = $this->stock_model->add_update_record('stock_vendor', $data, 'id');
                }
                //image code end-------------------
    
                $_POST['id'] = $id;
                $this->stock_model->add_update_record('stock_vendor', $_POST, 'id');
            }
    
            header('Location: ' . base_url() . 'stock/manage_vendor');
        }
         //---------INSERT UPDATE VENDOR ENDS


    //---------MANAGE VENDOR
    public function manage_vendor($id = '') {
        $req_fields = array("id", "vendor_name",'contact_number', "contact_number", "address", "image_file", "email", "website","is_deleted");
        $query['data'] = $this->stock_model->get_many_records('stock_vendor', '', $req_fields, "id");
        $this->load->view('sms_views/manage_vendor', $query);
    }
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


    //Edit Vendor function
    public function edit_vendor($userId) {//for add/update form 
                
        $user=$this->stock_model->get_vendor_record($userId); //here one record stored in '$user' variable.
        $data=array();
        $data['user']=$user;//here 'user' is array index of '$data' which can be used in 'edit view' 
        // echo "<pre>";
        // print_r($data);die;
        $this->load->view('sms_views/edit_vendor',$data);
    }

    //---------EDIT VENDOR ENDS


    //---------DELETE VENDOR
    public function delete_vendor($id = 0, $child_table = "") {//$id is value of primary key "id" to be deleted, - $foreign_key is the foreign key name in the child table
        $tbl = $table;
        $this->main_model->my_delete_record('stock_vendor', 'id', $id);
        header('Location: ' . base_url() . 'stock/manage_vendor');
    }

    //---------DELETE VENDOR ENDS


    //For Purchase Inventory
    public function purchase_product()
    {
        //we are fetching all records from 'product_table' and put it into '$records' variable.
        $records['rec']=$this->main_model->get_records('product_table')->result_array();

        $records['stockvendor']=$this->main_model->get_records('stock_vendor')->result_array();

        // echo "<pre>";
        // print_r($records);die;

        $this->load->view('sms_views/purchase_product',$records);
    }

    public function fill_product_details()
    {
        $table_records = $this->main_model->get_records('product_table', "id", $_POST['product_id'])->result_array();;

        echo json_encode($table_records);       

    }
     //SAVE PURCHASE PRODUCT CALLING HERE
     public function save_purchase_product()
     {
            //    echo "<pre>";
            //    print_r($_POST);die;
               if($_POST['p_id']=='NULL' || $_POST['v_id']=='NULL'){
                   echo 'pls select product_name and vendor_name' ;
                   header('Location: ' . base_url() . 'stock/purchase_product' );
                }
                   else{
                    if (isset($_POST['id'])) {//----Update Table Data
                        // $_POST['modify_by'] = $_SESSION['oms_user_id'];
                        // $_POST['modify_date'] = date("Y-m-d H:i:s");
                        //echo "here";die;
                        $this->stock_model->add_update_record('stock', $_POST, 'id');
                        
                    }
                    else {//----Insert New Data
                        // $_POST['created_by'] = $_SESSION['oms_user_id'];
                        // $_POST['created_date'] = date("Y-m-d H:i:s");
                        // echo " do here";
                        $project_id=$this->stock_model->add_update_record('stock', $_POST);            
                        
                    }        
                    header('Location: ' . base_url() . 'stock/manage_purchase_product' );
                }
     }
    
    public function manage_purchase_product()
    {
        $req_fields = array("id","p_id","v_id","product_mrp", "product_sp","product_cp","product_unit","product_total");
          
        // echo "<pre>";
        //  print_r($req_fields);die;
       
        $stock_purchase_product=array();
        $stock_purchase_product['data'] = $this->stock_model->fetch_all_purchase_product("stock", '', $req_fields, "id");

        foreach($stock_purchase_product['data'] as $key=>$data){
        $product_name=$this->stock_model->get_name_from_id('product_table','product_name',$data['p_id']);

        $vendor_name=$this->stock_model->get_name_from_id('stock_vendor','vendor_name',$data['v_id']);

        $stock_purchase_product['data'][$key]['product_name']=$product_name;
        $stock_purchase_product['data'][$key]['vendor_name']=$vendor_name;
        
        }            
        $this->load->view('sms_views/manage_purchase_product',$stock_purchase_product);
    }
    public function edit_purchase_product(){
        $this->load->view('sms_views/edit_purchase_product');
    }
    public function delete_purchase_product(){
        $this->load->view('sms_views/delete_purchase_product');
    }
}
?>