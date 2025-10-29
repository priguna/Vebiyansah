<?php

class Asset_menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('class_'._PREFIX_) == null){    
			redirect(base_url('login'));
		}

		$this->load->model('asset_menu_model');

		$this->load->model('asset_menu_class_model');
		$this->load->model('paging_model');				
		$this->load->model('select_model');	

		$this->url_view = $this->uri->segment(1);
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
			'url_form' => $this->url_controller.'/save_urutan'
		]; 	
		
		$this->load->view($this->url_view.'/page', $data);
	}	

	public function icon()
	{					
		$this->load->view($this->url_controller.'/icon');
	}	

	public function tabel()
	{
		$data = [
			'data' => $this->asset_menu_model->tabel_data()
		]; 	

		$this->load->view($this->url_view.'/tabel', $data);
	}
	
	public function save_urutan()
	{					
		$query = $this->asset_menu_model->update_data_batch();
		echo json_encode($query);	
	}

	public function tambah()
	{
		$data = [
			'url_form' => $this->url_controller.'/add',
			'data' => $this->asset_menu_model->tambah_data(),
			'select_menu' => $this->asset_menu_model->select_menu()
		]; 		

		$this->load->view($this->url_view.'/form', $data);
	}
	public function add()
	{			
		$context = $this->input->post();
		
		$query = $this->asset_menu_model->add_data($context);
		echo json_encode($query);	
	}

	public function edit()
	{
		$context  = array('id' => $this->input->post('id'));
		
		$data = [
			'url_form' => $this->url_controller.'/update',
			'data' => $this->asset_menu_model->lihat_data($context),
			'select_menu' => $this->asset_menu_model->select_menu()
		]; 		

		$this->load->view($this->url_view.'/form', $data);
	}

	public function salin()
	{
		$context  = array('id' => $this->input->post('id'));

		$data = [
			'url_form' => $this->url_controller.'/add',
			'data' => $this->asset_menu_model->lihat_data($context),
			'select_menu' => $this->asset_menu_model->select_menu()
		]; 		

		$this->load->view($this->url_view.'/form', $data);
	}

	public function update()
	{
		$context = $this->input->post();
		
		$query = $this->asset_menu_model->update_data($context);
		echo json_encode($query);
	}

	public function delete()
	{		
		$context  = array('id' => $this->input->post('id'));

		$query = $this->asset_menu_model->delete_data($context);	
		echo json_encode($query);
	}


}

?>