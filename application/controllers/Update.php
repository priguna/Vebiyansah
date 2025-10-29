<?php

class Update extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('directory');

		if($this->session->userdata('class_'._PREFIX_) == null){    
			redirect(base_url('login'));
		}

		$this->load->model('update_list_model');
		$this->load->model('update_content_model');

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
		$this->load->view($this->url_controller.'/page');
	}

	public function tabel()
	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
		$url_page = $this->url_controller.'/tabel';	
		$limit = 10;

		$context  = array(
			'limit' => $limit,
			'start' => $page
		);

		$get_data = $this->update_list_model->tabel_data($context); 
		$get_jml = $this->update_list_model->jml_data($context);

		$data = [
			'data' => $get_data,
			'jml_data' => $get_jml,
			'page' => $page,
			'pagination' => $this->paging_model->get($get_jml, $limit, $url_page, 'tabel_1'),
			'page_curr' => $url_page.'/'.$page
		];

		$this->load->view($this->url_controller.'/tabel', $data);
	}

	public function tambah()
	{		
		$data = [
			'url_form' => $this->url_controller.'/add',
			'data' => $this->update_list_model->tambah_data()
		];
		
		$this->load->view($this->url_controller.'/form', $data);
	}

	public function add()
	{
		$context = $this->input->post();

		$query = $this->update_list_model->add_data($context);
		echo json_encode($query);
	}

	public function edit()
	{
		$context  = array('id' => $this->input->post('id'));

		$get_data = $this->update_list_model->lihat_data($context);

		$data = [
			'url_form' => $this->url_controller.'/update',
			'data' => $get_data
		];	

		$this->load->view($this->url_controller.'/form', $data);
	}

	public function salin()
	{
		$context  = array('id' => $this->input->post('id'));
		
		$data = [
			'url_form' => $this->url_controller.'/add',
			'data' => $this->update_list_model->lihat_data($context)
		];

		$this->load->view($this->url_controller.'/form', $data);
	}

	public function update()
	{		
		$context = $this->input->post();

		$query = $this->update_list_model->update_data($context);
		echo json_encode($query);
	}

	public function delete()
	{		
		$context  = array('id' => $this->input->post('id'));
		
		$query = $this->update_list_model->delete_data($context);
		echo json_encode($query);
	}

}

?>