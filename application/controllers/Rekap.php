<?php

class Rekap extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('data_pembiayaan_pasien_model');

		$this->url_controller = $this->uri->segment(1);
	}

	public function index()
	{	
		$data['select_tahun'] = $this->data_pembiayaan_pasien_model->select_tahun();

		$this->load->view($this->url_controller.'/page', $data);
	}

	public function page()
	{		
		$context  = array(
			'tahun' => $this->input->post('tahun'),
			'bulan' => $this->input->post('bulan')
		);

		$data['data'] = $this->data_pembiayaan_pasien_model->tabel_rekap($context);

		$this->load->view($this->url_controller.'/tabel', $data);
	}			
}

?>