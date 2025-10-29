<?php

class Penilaian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('data_simrs_model');
		$this->load->model('data_penilaian_model');
		$this->load->model('data_pengiriman_wa_model');
		$this->load->model('pengaturan_model');

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
			'range_tgl' => $this->input->post('range_tgl'),
			'keyword' => $this->input->post('keyword'),
			'limit' => $limit,
			'start' => $page
		);

		$get_data = $this->data_penilaian_model->tabel_data($context); 
		$get_jml = $this->data_penilaian_model->jml_data($context);

		$data = [
			'data' => $get_data,
			'jml_data' => $get_jml,
			'page' => $page,
			'pagination' => $this->paging_model->get($get_jml, $limit, $url_page, 'tabel_1'),
			'page_curr' => $url_page.'/'.$page
		];

		$this->load->view($this->url_controller.'/tabel', $data);
	}

	public function kirim_wa()
	{
		$context['no_rawat'] = base64_decode($this->uri->segment(3));

		$data = (array) $this->data_simrs_model->lihat_data($context);

		if(substr($data['no_tlp'], 0, 2) == '08')
		{
			$no_tlp = '628'.substr($data['no_tlp'], 2, (strlen($data['no_tlp'])-2));

			$curl = curl_init();

			$br = '
';
			$br2 = '

';

			$send =
			[
				'phone' => $no_tlp.'@s.whatsapp.net',
				'message' => 'Terimakasih telah mempercayakan pelayanan kesehatan di '.$data['nm_poli'].' RSUD Bumiayu.'.$br.'Mohon Bapak/Ibu bekenan melakukan penilaian pelayanan dengan klik tautan di bawah.'.$br2.'Balas "YA" untuk mengaktifkan tautan.'.$br2.''.str_replace('http','https',base_url()).'penilaian/kirim/'.str_replace('=','',base64_encode($data['no_rawat'])),
			];


			curl_setopt($curl, CURLOPT_HTTPHEADER,
				array(
					"Content-Type: application/json"
				)
			);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($send));
			curl_setopt($curl, CURLOPT_URL,  "http://192.168.2.62:3000/send/message");
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

			$result = json_decode(curl_exec($curl), true);
			curl_close($curl);
		}

		if(!isset($result))
		{
			$data['status_kirim'] = 'FAILED - Format Nomor telpon tidak sesuai'; 
		} 
		else $data['status_kirim'] = $result['code'].' - '.$result['message']; 

		$this->data_pengiriman_wa_model->add_data($data);

		echo json_encode($data);
	}

	public function kirim()
	{			
		$context['no_rawat'] = base64_decode($this->uri->segment(3));

		$data = [
			'url_form' => $this->url_controller.'/add',
			'pengaturan' => $this->pengaturan_model->tabel_data(),
			'data' => $this->data_simrs_model->lihat_data($context),
		];

		$this->load->view($this->url_controller.'/form', $data);
	}	

	public function add()
	{
		$context = $this->input->post();

		if(!empty($context['rating']))
		{
			$query = $this->data_penilaian_model->add_data($context);
		}
		else $query = array('eror' => 'warning', 'pesan' => 'Mohon maaf. Rating tidak boleh kosong');

		echo json_encode($query);
	}

	public function download()
	{
		$context = array(
			'range_tgl' => $this->input->get('range_tgl'),
			'keyword' => $this->input->get('keyword')
		);

		$data['data'] = $this->data_penilaian_model->tabel_data_all($context);

		$this->load->view($this->url_controller.'/excel', $data);
	}

}

?>