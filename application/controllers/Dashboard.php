<?php

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('class_'._PREFIX_) == null){    
			redirect(base_url('login'));
		}		

		$this->load->model('dashboard_model');

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
		$this->load->view('home/page');
	}	

	public function tabel()
	{	
		$context = $this->input->post();	
 
		$data['per_jenis_kelamin'] = $this->dashboard_model->per_jenis_kelamin($context);
		$data['per_status'] = $this->dashboard_model->per_status($context);
		$data['per_status_alamat_tinggal'] = $this->dashboard_model->per_status_alamat_tinggal($context);
		$data['per_anak_berkebutuhan_khusus'] = $this->dashboard_model->per_anak_berkebutuhan_khusus($context);
		$data['per_status_pengasuh'] = $this->dashboard_model->per_status_pengasuh($context);
		$data['per_kelompok_umur'] = $this->dashboard_model->per_kelompok_umur($context);

		$this->load->view('home/tabel', $data);
	}

}

?>