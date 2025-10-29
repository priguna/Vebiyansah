<?php

class Asset_menu_class extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('class_'._PREFIX_) == null){    
			redirect(base_url('login'));
		}
		
		$this->load->model('asset_level_user_model');
		$this->load->model('asset_menu_model');

		$this->load->model('asset_menu_class_model');
		$this->load->model('paging_model');				
		$this->load->model('select_model');

		$this->url_controller = $this->uri->segment(1);
		$this->navigation = $this->session->userdata('nav_'._PREFIX_);
	}

	public function index()
	{	
		$data = [
			'menu' => [
				'data' => $this->asset_menu_class_model->tabel_data($this->session->userdata('level_id_'._PREFIX_)),
				'select_level' => $this->select_model->select_asset('asset_level_user', 'id')
			]			
		];

		$this->load->view($this->navigation.'/body', $data);
	}

	public function page()
	{			
		$data = [
			'data' => $this->asset_menu_class_model->tambah_data(), 
			'select_level_user' => $this->asset_level_user_model->tabel_data()
		]; 

		$this->load->view($this->url_controller.'/page', $data);
	}	

	public function tabel()
	{
		$level_id = $this->input->post('level_id');

		$data = [
			'url_form' => $this->url_controller.'/add',
			'level_id' => $level_id,
			'data' => $this->asset_menu_class_model->tabel_data_menu($level_id)
		];

		$this->load->view($this->url_controller.'/tabel', $data);
	}

	public function add()
	{			
		$context = $this->input->post();
		
		$query = $this->asset_menu_class_model->add_update($context);
		echo json_encode($query);	
	}

	public function delete($id)
	{		
		$query = $this->asset_menu_class_model->delete_data($id);	
		echo json_encode($query);
	}
}

?>