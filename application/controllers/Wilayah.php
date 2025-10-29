<?php

class Wilayah extends CI_Controller {
	
	public function __construct(){
		parent::__construct();

		$this->load->model('wilayah_model');

		$this->url_controller = $this->uri->segment(1);
	}

	public function select_propinsi(){
		$data['select'] = $this->wilayah_model->select_propinsi();

		$this->load->view($this->url_controller.'/select', $data);
	}

	public function select_kabupaten($provinsi_id){
		$data['select'] = $this->wilayah_model->select_kabupaten($provinsi_id);

		$this->load->view($this->url_controller.'/select', $data);
	}

	public function select_kecamatan($kabupaten_id){
		$data['select'] = $this->wilayah_model->select_kecamatan($kabupaten_id);

		$this->load->view($this->url_controller.'/select', $data);
	}

	public function select_kelurahan($kecamatan_id){
		$data['select'] = $this->wilayah_model->select_kelurahan($kecamatan_id);
		
		$this->load->view($this->url_controller.'/select', $data);
	}

}

?>