<?php

class Pengaturan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('class_'._PREFIX_) == null){    
			redirect(base_url('login'));
		}

		$this->load->model('pengaturan_model');

		$this->load->model('asset_menu_class_model');
		$this->load->model('paging_model');				
		$this->load->model('select_model');				
		$this->load->model('wilayah_model');	

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
		$get_data = $this->pengaturan_model->tabel_data();

		$data = [
			'url_form_1' => $this->url_controller.'/update',
			'data' => $get_data
		];

		$this->load->view($this->url_controller.'/tabel', $data);
	}

	public function lihat()
	{		
		$query = $this->pengaturan_model->tabel_data();
		echo json_encode($query);
	}

	public function update()
	{		
		$context = $this->input->post();

		$query = $this->pengaturan_model->update_data($context);
		echo json_encode($query);
	}

	public function form_update_get()
	{
		$this->load->view($this->url_controller.'/form_update_get');
	}
	
	public function update_get_from_server()
	{
		$pengaturan = (array) $this->db->select('*')->from('pengaturan')->get()->row();

		$headers = array(
			"Accept: application/json"
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $pengaturan['url_update']);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->input->post());

		$content = curl_exec($ch);
		$err = curl_error($ch);

		curl_close($ch);   

		echo $content;
	}

	public function execute_update_content()
	{
		$context = $this->input->post();

		$pengaturan = (array) $this->db->select('*')->from('pengaturan')->get()->row();

		$url = $context['dir'].'/'.$context['filename'];

		if(!file_exists($context['dir'])) mkdir($context['dir'], 0777, true);

		if($context['content'] != '' && $url != '')
		{
			unlink($url);

			if($pengaturan->mode == 'Client')
			{
				$query = file_put_contents($url, base64_decode($context['content']), LOCK_EX);				
			}
			else if($url != './application/views/data_pemeriksaan/form.php' && $url != './application/views/data_pendaftaran/form.php')
			{
				$query = file_put_contents($url, base64_decode($context['content']), LOCK_EX);
			}			
		} 		

		echo '<td>'.$context['filename'].'</td><td>'.$context['dir'].'</td><td>'.$context['versi'].'</td><td>'.$context['tgl'].'</td><td>OK</td>';
	}

	public function execute_update_database()
	{
		$context = $this->input->post();

		$query = $this->update_database_model->exe_query($context);

		echo '<td>'.$context['query'].'</td><td>'.$query['pesan'].'</td>';
	}

	public function update_versi()
	{
		$context = $this->input->post();

		$query = $this->pengaturan_model->update_versi($context);

		echo json_encode($query);
	}
}

?>