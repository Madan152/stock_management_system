<?php

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->custom->initialise_session();
        //$this->check_permission->load_user_acl($_SESSION['oms_role_id']);
        $this->load->model('main_model');
         date_default_timezone_set('Asia/Kolkata');
    }

    public function index() {
        if ($_SESSION['oms_role_name'] == "Guest") {
            $this->load->view('signin');
        } else {
            $this->load->view('home');
        }
    }

    public function login() {
        $this->load->view("signin");
    }
    
    public function assign_permission_groups() {
        $this->load->view("assign_permission_groups-roles");
    }

    public function logout() {
        session_unset();

        $_SESSION['oms_msg_hdr'] = "Information !";
        $_SESSION['oms_msg_str'] = "You have been Sucessfully Logged Out.";
        header('Location: ' . base_url());
    }

   public function login_handler() {
        if (isset($_POST['email']) && isset($_POST['pwd'])) {
            $this->form_validation->set_rules('email', 'Email', 'required|email');
            $this->form_validation->set_rules('pwd', 'Password', 'required|length[32]');

            if ($this->form_validation->run() == FALSE) {
                $_SESSION['oms_msg_str'].= 'Please Check Javascript on your Browser is enabled and updated. Please try again.';
                $_SESSION['oms_msg_hdr'] = "Alert !";
                header('Location: ' . base_url());
            } else {
                $req_fields = array("id", "email", "password", "role");
                $result = $this->main_model->get_selected_records('user', 'email', $_POST['email'], $req_fields);
//                print_r($result);die;
                if ($result[0]['password'] ==(md5($_POST['pwd']))) {
                    $_SESSION['password'] = $result[0]['password'];
                    $_SESSION['oms_user_id'] = $result[0]['id'];
                    $_SESSION['oms_role_id'] = $result[0]['role'];
                    
                     //-------------ACCESSING ROLE NAME FROM ROLES TABLE by role id
                    $_SESSION['oms_role_name']=$this->main_model->get_name_from_id1('roles','name','id',$_SESSION['oms_role_id']);


                    //----ACCESSING USER NAME FROM STAFF TABLE(except superadmin & admin)
                    switch ($_SESSION['oms_role_name']) {
                        case 'Super Admin':
                                $_SESSION['oms_user_name']="Super Admin";
                                $_SESSION['oms_staff_id']=0;//fix value 0 hard coded for superadmin & admin

                            break;
                        case 'Admin':
                                $_SESSION['oms_user_name']="Admin";
                                $_SESSION['oms_staff_id']=0;//fix value 0 hard coded for superadmin & admin

                            break;

                        default:
                                $_SESSION['oms_staff_id'] = $this->main_model->get_name_from_id1('staff','id','user_id',$result[0]['id']);
                                $userid = $_SESSION['oms_staff_id'];
                                $name = $this->main_model->get_records('staff', 'id', $userid, 'id');
                                $logged_user_name = $name->row();  
                                $_SESSION['oms_user_name'] =$logged_user_name->first_name.' '.$logged_user_name->last_name;  
                            break;
                    }

                    
//                    echo '<pre>';
//                    print_r($_SESSION); die;
                    $this->check_permission->load_user_acl($_SESSION['oms_role_id']);
                    
                    header('Location: ' . base_url() . 'main/home');
                } else {
                    $_SESSION['oms_msg_str'].= 'Wrong Credentials. Please Check for Valid Email and Password.';
                    $_SESSION['oms_msg_hdr'] = 'Alert !';
                    header('Location: ' . base_url());
                }
            }
        }
    }

//    view page start
    public function home() {
         if ($_SESSION['oms_role_name'] == "Guest") {
            $this->load->view('signin');
        } else {
            $this->load->view('home');
        }
    }

    public function contact() {
        $this->load->view('contact');
    }

    public function delete($table = '', $id = 0, $child_table = "") {//$id is value of primary key "id" to be deleted, - $foreign_key is the foreign key name in the child table
        $tbl = $table;

        $this->main_model->my_delete_record($tbl, 'id', $id);
        header('Location: ' . base_url() . 'main/manage/' . $table);
    }

    public function manage_staff() {
        $result['data'] = $this->main_model->select('staff');
        $this->load->view('manage_staff', $result);
    }

    public function salary_staff() {
        $this->load->view('salary_staff');
    }

    public function getstaffdept() {
        $this->load->view('get_staff_dept');
    }

    public function set_many_many_filters($table = '', $redirect_page = "") {

        $data = $_POST[$table]['data'];
        unset($_POST[$table]['data']);
        $this->main_model->add_update_many_table_many_record_many_foriegnkeys($table, $data, $_POST[$table]);
        header('Location: ' . base_url() . 'main/getlog/' . $redirect_page);
    }

    public function set_onerec_manytable($table = '', $redirect_page = "") {
        $data = $_POST[$table]['data'];
        unset($_POST[$table]['data']);
        $i = 0;
        foreach ($_POST[$table] as $key => $value) {
            $filter[$i]['id'] = $key;
            $filter[$i]['value'] = $value;
            $i++;
        }
        $this->main_model->add_update_one_record_many_table($table, $data, $filter);
        header('Location: ' . base_url() . 'main/getlog/' . $redirect_page);
    }


    public function check_date_for_mail() {

        $query = $this->main_model->get_data_for_mail();
        foreach ($query as $data) {

            if (date("Y-m-d") >= $data['reminder_date']) {
                if ($data['task_date'] >= date("Y-m-d")) {
                    $now = time();
                    $one_minutes = $now + (1 * 60);

                    if ((strtotime($data['reminder_time']) > $now) && ($one_minutes > strtotime($data['reminder_time']))) {

                        $to_email = $data['email1'];
                        $this->mail($to_email);
                    }
                }
            }
        }
    }

    public function sendmail($to = '') {

        $from = "shyamd148@gmail.com";
        //$to = "shyam@lexiconcpl.com";
        $subject = "reminder massage";
        $body = "testing ";

        $config = array($from, $to, $subject, $body);
        //print_r($config);
        //die;

        $CI = & get_instance();
        $CI->load->library('smtpclient', $config);

        if ($this->smtpclient->send_mail()) {
            echo 'mail sent';
        }
    }

    public function mail($to = '') {


        $email_from = $to;
        $email_subject = base64_encode("testing message ");
        $email_body = base64_encode("You have received a new testing message \t\n");


        $email_to = $to; //<== update the email address
        $headers = base64_encode("From:" . $email_from . "\n\r" . "Reply-To:" . $email_from . " ");
        //Send the email!
        $mail = file_get_contents('http://118.139.181.131/smtp_mailer/x.php?to=' . $email_to . "&message='$email_body'&subject=$email_subject&from=$email_from");
        //$x = file_get_contents('http://118.139.181.131/smtp_mailer/x.php?to=' . $to . "&message='$message'&subject=$subject&from=$from&name=$name");
        if ($mail == '402') {
            echo 'Message have been sent';
        } else {
            echo 'Failed: We are sorry ';
        }
    }

//------------------end lead controller----------------------------------------------------
//---------------------add user start---------------------------------------------------

    public function add_user() {
        $this->load->view('add_user');
    }

    public function manage_account() {
        $req_fields = array("id", "role", "email", "password", "user_name", "status");
        $query['data'] = $this->main_model->get_many_records("users", '', $req_fields, "id");
        $this->load->view('manage_account', $query);
    }

    public function edit_account($table = '', $id = '') {
        $row_data = array();
        $query = $this->main_model->get_records($table, 'id', $id);
        $row_data = $query->row();

        $this->load->view('edit_account', $row_data);
    }

    public function delete_account($table = '', $id = 0, $child_table = "") {//$id is value of primary key "id" to be deleted, - $foreign_key is the foreign key name in the child table
        $tbl = $table;
        $this->main_model->my_delete_record($tbl, 'id', $id);
        header('Location: ' . base_url() . 'main/manage_account/' . $table);
    }

    public function show_password() {
        $filters[0]['id'] = "user_type";
        $filters[0]['value'] = 1;
        $data = $this->main_model->get_user_name_select('staff', 'last_name', 'first_name', $filters, "");
        $data_length = count($data);
        $result = array();
        for ($i = 0; $i < $data_length; $i++) {
            if ($data[$i]['first_name'] == $_POST['first_name']) {
                $id = $data[$i]['id'];
                $result['id'] = $id;
                $result['first_name'] = $data[$i]['first_name'];
                $result['last_name'] = $data[$i]['last_name'];
            }
        }
        $user_email = $this->main_model->get_name_from_id('staff', 'email1', $result['id']);
        if ($user_email == $_POST['email1']) {
            $result['email'] = $user_email;
            $chars = "0123456789";
            $result['password'] = substr(str_shuffle($chars), 0, 5);
            echo '<pre>';var_dump($result);die;
            $this->load->view('show_password', $result);
        } else {
            echo "<script>alert('Invalid Name or Email');</script>";

            $this->load->view('add_user');
        }
    }

    public function user_set($table = '') { //echo '<pre>';var_dump($_POST);die;
        if (isset($_POST['id'])) {//sending different parameters for update and insert
            $return_id = $this->main_model->add_update_record($table, $_POST, 'id');
        } else {

            $return_id = $this->main_model->add_update_record($table, $_POST);
        } $this->load->view('add_user');
    }

    public function change_password() {
        $this->load->view('change_password');
    }

    public function check_old_password() {
        if ($_SESSION['password'] == md5($_POST['old_password'])) {
            if ($_POST['password'] == $_POST['password1']) {
                $id = $_SESSION['oms_user_id'];
                $data['password'] = md5($_POST['password']);
                $data['id'] = $_SESSION['oms_user_id'];
                $return_id = $this->main_model->add_update_record('user', $data, 'id');
                $_SESSION['password'] = $this->main_model->get_name_from_id("user", "password", $return_id);
                $this->home();
            } else {
                echo '<script> window.alert("your NEW and Re-enter password not match");</script>';
                $this->change_password();
            }
        } else {
            echo '<script> window.alert("please enter correct old password");</script>';
            $this->change_password();
        }
    }

//---------------------end add user-----------------------------------------------------        

	public function insert_data() {

        $requested_text = file_get_contents("php://input");
        $requested_obj = json_decode($requested_text, TRUE);
        $table = $requested_obj['table'];
        $data = $requested_obj['data'];
//          var_dump($data);die;
//        $insert_data['examination_type'] = $data[0];
        $insert_data['name'] = $data[0];
//        $insert_data['dept_id'] = $data[2];
        //var_dump($insert_data);die;

        $request_id = $this->main_model->add_update_record($table, $insert_data);
        $encoded = json_encode($request_id, JSON_FORCE_OBJECT);

        die($encoded);
    }

}

?>