<?php

class Whatsapp extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('data_simrs_model');
		$this->load->model('data_pengiriman_wa_model');
		$this->load->model('data_penilaian_model');

		$this->load->model('asset_menu_class_model');
		$this->load->model('paging_model');				
		$this->load->model('select_model');		

		$this->url_controller = $this->uri->segment(1);
		$this->navigation = $this->session->userdata('nav_'._PREFIX_);
	}

	public function kirim_semua()
	{
		$context  = $this->input->post();

		$query = $this->data_simrs_model->tabel_rawat_jalan_all($context); 
		echo json_encode($query);
	}

	public function kirim_data()
	{
		$data = $this->input->post();

		$cek_data = $this->data_pengiriman_wa_model->cek_data($data);

		// $cek_data = $this->data_penilaian_model->cek_data($data);

		if(intval($cek_data) == 0)
		{
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
					'message' => 'Terimakasih telah mempercayakan pelayanan kesehatan di '.$data['nm_poli'].' RSUD Bumiayu.'.$br.'Mohon Bapak/Ibu berkenan melakukan penilaian pelayanan dengan klik tautan di bawah.'.$br2.'Balas "YA" untuk mengaktifkan tautan.'.$br2.''.str_replace('http','https',base_url()).'penilaian/kirim/'.str_replace('=','',base64_encode($data['no_rawat'])),
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
				$data['status_kirim'] = 'FAILED - Format Nomor telpon tidak sesuai / tidak aktif'; 
			} 
			else $data['status_kirim'] = $result['code'].' - '.$result['message']; 

			$this->data_pengiriman_wa_model->add_data($data);
		}
		else $data['status_kirim'] = 'Nomor sudah pernah dikirim';

		echo json_encode($data);
	}

	public function kirim_ulang()
	{
		$data = $this->input->post();

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
				'message' => 'Terimakasih telah mempercayakan pelayanan kesehatan di RSUD Bumiayu pada tanggal '.$data['tgl_registrasi'].'.'.$br.'Mohon Bapak/Ibu berkenan melakukan penilaian pelayanan dengan klik tautan di bawah.'.$br2.'Balas "YA" untuk mengaktifkan tautan.'.$br2.''.str_replace('http','https',base_url()).'penilaian/kirim/'.str_replace('=','',base64_encode($data['no_rawat'])),
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
			$data['status_kirim'] = 'FAILED - Format Nomor telpon tidak sesuai / tidak aktif'; 
		} 
		else $data['status_kirim'] = $result['code'].' - '.$result['message']; 

		$this->data_pengiriman_wa_model->update_data($data);

		echo json_encode($data);
	}

}

?>