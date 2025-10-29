<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() 
    {
        parent::__construct();

        if($this->session->userdata('class_'._PREFIX_) != null){    
            redirect(base_url('dashboard'));
        }
        
        $this->load->model('login_model');
        $this->load->model('pengaturan_model');
    }

    function index()
    { 
        $data['pengaturan'] = $this->pengaturan_model->tabel_data();
        
        $this->load->view('login', $data);
    }

    public function proses_login() 
    { 
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $login = $this->login_model->cek_user($username, $password); 

        if($login == 'failed')
        {
            $callback = array('eror' => 'warning', 'pesan' => "username atau password salah");
        } 
        else if($login == 'success') 
        { 
            $callback = array('eror' => 'success', 'pesan' => "Update berhasil"); 
        };

        echo json_encode($callback);
    } 

    public function logout()
    {
        $this->login_model->logout();
        redirect(base_url());
    }

}