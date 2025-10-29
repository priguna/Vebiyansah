<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    function index()
    {
      $this->login_model->logout();
      redirect(base_url());
  }

}