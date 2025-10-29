<?php

class Pembiayaan_pasien extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('class_'._PREFIX_) == null){    
			redirect(base_url('login'));
		}

		$this->load->model('data_pembiayaan_pasien_model');
		$this->load->model('data_simrs_model');
		$this->load->model('kirim_wa_model');	
		$this->load->model('data_user_model');

		$this->load->model('asset_menu_class_model');
		$this->load->model('paging_model');				
		$this->load->model('select_model');		

		$this->url_controller = $this->uri->segment(1);
		$this->navigation = $this->session->userdata('nav_'._PREFIX_);

		$this->br = '
';
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

		$get_data = $this->data_simrs_model->tabel_rawat_jalan($context); 
		$get_jml = $this->data_simrs_model->jml_rawat_jalan($context);

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
		$context  = $this->input->post();

		$data = [
			'url_form' => $this->url_controller.'/add',
			'pasien' => $this->data_simrs_model->lihat_registrasi($context),
			'data' => $this->data_pembiayaan_pasien_model->tambah_data()
		];
		
		$this->load->view($this->url_controller.'/form', $data);
	}

	public function add()
	{
		$context  = $this->input->post(); 

		$query = $this->data_pembiayaan_pasien_model->add_data($context); 

		if($query['eror'] == 'success')
		{
			$parameter = array(
				'view' => 'pembiayaan_pasien_verifikasi_1',
				'no_rawat' => $context['no_rawat']
			);

			$pasien = $this->data_pembiayaan_pasien_model->lihat_data_no_rawat($parameter);

			$link = base_url('link/verif/'.str_replace("=","",base64_encode(json_encode($parameter))));

			$user = $this->data_user_model->select_user_by_level_value('Verifikator Tahap 1');

			foreach ($user as $key) 
			{				
				$context = array(
					'no_tlp' => $key->nomor_wa,
					'pesan' => '[Info] Verifikator MPP telah menambahkan data Pengajuan Pembiayaan Pasien dengan nama :'.$this->br.''.$pasien->nm_pasien.'.'.$this->br.'Silahkan klik link dibawah untuk ditindaklajuti.'.$this->br.''.$this->br.''.$link
				);

				$get_data = $this->kirim_wa_model->kirim($context);
			}
		}

		echo json_encode($query);
	}

}

?>