<?php

class Pembiayaan_rekap extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('class_'._PREFIX_) == null){    
			redirect(base_url('login'));
		}

		$this->load->model('data_pembiayaan_pasien_model');

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
		$data['select_tahun'] = $this->data_pembiayaan_pasien_model->select_tahun();

		$this->load->view($this->url_controller.'/page', $data);
	}			

	public function tabel()
	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
		$url_page = $this->url_controller.'/tabel';	
		$limit = 10;

		$context  = array(
			'tahun' => $this->input->post('tahun'),
			'bulan' => $this->input->post('bulan')
		);

		$data['data'] = $this->data_pembiayaan_pasien_model->tabel_rekap_internal($context);
		
		$this->load->view($this->url_controller.'/tabel', $data);
	}
}

?>