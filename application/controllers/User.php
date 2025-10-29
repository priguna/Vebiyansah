<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
        
        $this->load->model('data_user_model');
        $this->load->model('login_model');
        $this->load->model('select_model');

        $this->url_controller = $this->uri->segment(1);
    }

    public function edit()
    {
        $context  = array('id' => $this->input->post('id'));

        $data['url_form'] = base_url('data_user/update');  
        $data['data'] = $this->data_user_model->lihat_data($context);

        $data['select_level'] = $this->select_model->select_asset('asset_level_user', 'id');    

        $this->load->view($this->url_controller.'/form', $data);
    }
    
    public function ganti() 
    { 
        $query = $this->login_model->ganti_user();

        if($query) {
            $callback = array('eror' => 'success', 'pesan' => "Login berhasil"); 

            echo json_encode($callback);
        }
    } 

}