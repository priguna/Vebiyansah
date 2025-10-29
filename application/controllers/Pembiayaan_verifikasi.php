<?php

class Pembiayaan_verifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('class_'._PREFIX_) == null){    
			redirect(base_url('login'));
		}

		$this->load->model('data_pembiayaan_pasien_model');
		$this->load->model('data_pembiayaan_pasien_files_model');

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

		$dokter = '';

		if($this->session->userdata('level_value_'._PREFIX_) == "Dokter") $dokter = $this->session->userdata('user_id_'._PREFIX_);

		$context  = array(
			'keyword' => $this->input->post('keyword'),
			'limit' => $limit,
			'start' => $page
		);

		$get_data = $this->data_pembiayaan_pasien_model->tabel_data($context);
		$get_jml = $this->data_pembiayaan_pasien_model->jml_data($context);

		$data = [
			'data' => $get_data,
			'jml_data' => $get_jml,
			'page' => $page,
			'pagination' => $this->paging_model->get($get_jml, $limit, $url_page, 'tabel_1'),
			'page_curr' => $url_page.'/'.$page
		];

		$this->load->view($this->url_controller.'/tabel', $data);
	}

	public function edit()
	{		
		$context  = $this->input->post();

		$data = [
			'url_form' => $this->url_controller.'/update',
			'data' => $this->data_pembiayaan_pasien_model->lihat_data($context),
			'files' => $this->data_pembiayaan_pasien_files_model->tabel_data($context)
		];
		
		$this->load->view($this->url_controller.'/form', $data);
	}

	public function update()
	{
		$context  = $this->input->post();

		$query = $this->data_pembiayaan_pasien_model->update_data($context); 

		echo json_encode($query);
	}

	public function delete()
	{		
		$context  = array('id' => $this->input->post('id'));
		
		$query = $this->data_pembiayaan_pasien_model->delete_data($context);
		echo json_encode($query);
	}
}

?>