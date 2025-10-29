<?php

class Link extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('data_pembiayaan_pasien_model');
		$this->load->model('data_pembiayaan_pasien_files_model');
		$this->load->model('data_user_model');
		$this->load->model('kirim_wa_model');	

		$this->url_controller = $this->uri->segment(1);
		$this->br = '
';
	}

	public function lihat()
	{	
		$json = json_decode(base64_decode($this->uri->segment(3)));

		$pembiayaan_pasien = $this->data_pembiayaan_pasien_model->lihat_data_no_rawat((array) $json);

		$data = [
			'url_form' => $this->url_controller.'/'.$json->view,
			'data' => $this->data_pembiayaan_pasien_model->lihat_data_no_rawat((array) $json),	
			'files' => $this->data_pembiayaan_pasien_files_model->tabel_data((array) $pembiayaan_pasien)
		];

		$this->load->view($json->view.'/page', $data);
	}

	public function verif()
	{	
		$json = json_decode(base64_decode($this->uri->segment(3)));

		$pembiayaan_pasien = $this->data_pembiayaan_pasien_model->lihat_data_no_rawat((array) $json);

		switch($json->view) 
		{
			case 'pembiayaan_pasien_verifikasi_1':
			$data = [
				'url_form' => $this->url_controller.'/'.$json->view,
				'data' => $this->data_pembiayaan_pasien_model->lihat_data_no_rawat((array) $json),
				'files' => $this->data_pembiayaan_pasien_files_model->tabel_data((array) $pembiayaan_pasien),
				'select_user' => $this->data_user_model->select_user_by_level_value('Verifikator Tahap 1')
			];
			break;

			case 'pembiayaan_pasien_verifikasi_2':
			$data = [
				'url_form' => $this->url_controller.'/'.$json->view,
				'data' => $this->data_pembiayaan_pasien_model->lihat_data_no_rawat((array) $json),	
				'files' => $this->data_pembiayaan_pasien_files_model->tabel_data((array) $pembiayaan_pasien),			
				'select_user' => $this->data_user_model->select_user_by_level_value('Verifikator Tahap 2')
			];
			break;

			case 'pembiayaan_pasien_verifikasi_direktur':
			$data = [
				'url_form' => $this->url_controller.'/'.$json->view,
				'data' => $this->data_pembiayaan_pasien_model->lihat_data_no_rawat((array) $json),	
				'files' => $this->data_pembiayaan_pasien_files_model->tabel_data((array) $pembiayaan_pasien),			
				'select_user' => $this->data_user_model->select_user_by_level_value('Direktur')
			];
			break;

			case 'pembiayaan_pasien_verifikasi_kasir':
			$data = [
				'url_form' => $this->url_controller.'/'.$json->view,
				'data' => $this->data_pembiayaan_pasien_model->lihat_data_no_rawat((array) $json),	
				'files' => $this->data_pembiayaan_pasien_files_model->tabel_data((array) $pembiayaan_pasien),			
				'select_user' => $this->data_user_model->select_user_by_level_value('Kasir')
			];
			break;
		}

		$this->load->view($json->view.'/page', $data);
	}

	public function kirim_ulang()
	{		
		$context = $this->input->post();

		$parameter = array('tahap' => $context['tahap'], 'no_rawat' => $context['no_rawat']);

		$this->kirim($parameter);

		$query = array('eror' => 'success', 'pesan' => "Kirim ulang berhasil");

		echo json_encode($query);
	}

	public function kirim($parameter)
	{
		$tahap = $parameter['tahap'];
		$no_rawat = $parameter['no_rawat'];

		$pasien = $this->data_pembiayaan_pasien_model->lihat_data_no_rawat($parameter);

		switch ($tahap) 
		{
			case 'Verifikator Tahap 1':				
			$parameter = array(
				'view' => 'pembiayaan_pasien_verifikasi_1',
				'no_rawat' => $no_rawat
			);

			$link = base_url('link/verif/'.str_replace("=","",base64_encode(json_encode($parameter))));

			$pesan = '[Info] Verifikator MPP telah menambahkan data Pengajuan Pembiayaan Pasien dengan nama :'.$this->br.''.$pasien->nm_pasien.'.'.$this->br.'Silahkan klik link dibawah untuk ditindaklajuti.'.$this->br.''.$this->br.''.$link;
			break;

			case 'Verifikator Tahap 2':				
			$parameter = array(
				'view' => 'pembiayaan_pasien_verifikasi_2',
				'no_rawat' => $no_rawat
			);

			$link = base_url('link/verif/'.str_replace("=","",base64_encode(json_encode($parameter))));

			$pesan = '[Info] Verifikator Tahap 1 telah memverifikasi Pembiayaan Pasien dengan nama :'.$this->br.''.$pasien->nm_pasien.'.'.$this->br.'Silahkan klik link dibawah untuk ditindaklajuti.'.$this->br.''.$this->br.''.$link;
			break;

			case 'Direktur':				
			$parameter = array(
				'view' => 'pembiayaan_pasien_verifikasi_direktur',
				'no_rawat' => $no_rawat
			);

			$link = base_url('link/verif/'.str_replace("=","",base64_encode(json_encode($parameter))));

			$pesan = '[Info] Verifikator Tahap 2 telah memverifikasi Pembiayaan Pasien dengan nama :'.$this->br.''.$pasien->nm_pasien.'.'.$this->br.'Silahkan klik link dibawah untuk ditindaklajuti.'.$this->br.''.$this->br.''.$link;
			break;

			case 'Verifikator MPP':				
			$parameter = array(
				'view' => 'pembiayaan_pasien_keuangan',
				'no_rawat' => $no_rawat
			);

			$link = base_url('link/lihat/'.str_replace("=","",base64_encode(json_encode($parameter))));

			$pesan = '[Info] Pembiayaan Pasien dengan nama '.$pasien->nm_pasien.' sudah diverifikasi oleh direktur.'.$this->br.'Silakan klik link dibawah untuk melihat rincian.'.$this->br.''.$this->br.''.$link;
			break;

			case 'Keuangan':				
			$parameter = array(
				'view' => 'pembiayaan_pasien_keuangan',
				'no_rawat' => $no_rawat
			);

			$link = base_url('link/lihat/'.str_replace("=","",base64_encode(json_encode($parameter))));

			$pesan = '[Info] Pembiayaan Pasien dengan nama '.$pasien->nm_pasien.' sudah diverifikasi oleh direktur.'.$this->br.'Silakan klik link dibawah untuk melihat rincian.'.$this->br.''.$this->br.''.$link;
			break;

			case 'Kasir':				
			$parameter = array(
				'view' => 'pembiayaan_pasien_verifikasi_kasir',
				'no_rawat' => $no_rawat
			);

			$link = base_url('link/verif/'.str_replace("=","",base64_encode(json_encode($parameter))));

			$pesan = '[Info] Pembiayaan Pasien dengan nama '.$pasien->nm_pasien.' sudah diverifikasi oleh direktur.'.$this->br.'Silakan klik link dibawah untuk ditindaklajuti.'.$this->br.''.$this->br.''.$link;
			break;
		}

		$user = $this->data_user_model->select_user_by_level_value($tahap);

		foreach ($user as $key) 
		{				
			$context = array(
				'no_tlp' => $key->nomor_wa,
				'pesan' => $pesan
			);

			$get_data = $this->kirim_wa_model->kirim($context);
		}
	}

	public function pembiayaan_pasien_verifikasi_1()
	{
		$context  = $this->input->post();

		$cek_user = $this->data_user_model->cek_user_by_id_password($context); 

		if(!empty($cek_user))
		{
			$query = $this->data_pembiayaan_pasien_model->update_data($context);

			$parameter = array('tahap' => 'Verifikator Tahap 2', 'no_rawat' => $context['no_rawat']);

			$this->kirim($parameter);	
		}
		else $query = array('eror' => 'warning', 'pesan' => "Password salah");

		echo json_encode($query);
	}

	public function pembiayaan_pasien_verifikasi_2()
	{
		$context  = $this->input->post();

		$cek_user = $this->data_user_model->cek_user_by_id_password($context); 

		if(!empty($cek_user))
		{
			$query = $this->data_pembiayaan_pasien_model->update_data($context);

			$parameter = array('tahap' => 'Direktur', 'no_rawat' => $context['no_rawat']);

			$this->kirim($parameter);	
		}
		else $query = array('eror' => 'warning', 'pesan' => "Password salah");

		echo json_encode($query);
	}

	public function pembiayaan_pasien_verifikasi_direktur()
	{ 
		$context  = $this->input->post();

		$cek_user = $this->data_user_model->cek_user_by_id_password($context); 

		if(!empty($cek_user))
		{
			$query = $this->data_pembiayaan_pasien_model->update_data($context);

			$parameter = array('tahap' => 'Verifikator MPP', 'no_rawat' => $context['no_rawat']);

			$this->kirim($parameter);	

			$parameter = array('tahap' => 'Keuangan', 'no_rawat' => $context['no_rawat']);

			$this->kirim($parameter);	

			$parameter = array('tahap' => 'Kasir', 'no_rawat' => $context['no_rawat']);

			$this->kirim($parameter);	
		}
		else $query = array('eror' => 'warning', 'pesan' => "Password salah");

		echo json_encode($query);
	}

	public function pembiayaan_pasien_verifikasi_kasir()
	{ 
		$context  = $this->input->post();

		$query = $this->data_pembiayaan_pasien_model->update_data($context);

		$parameter = array('tahap' => 'Verifikator MPP', 'no_rawat' => $context['no_rawat']);

		$this->kirim($parameter);	

		$parameter = array('tahap' => 'Keuangan', 'no_rawat' => $context['no_rawat']);

		$this->kirim($parameter);

		echo json_encode($query);
	}
}

?>