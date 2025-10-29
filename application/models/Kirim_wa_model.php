<?php

class Kirim_wa_model extends CI_Model {

	public function kirim($context)
	{
		if(substr($context['no_tlp'], 0, 2) == '08')
		{			
			$no_tlp = '628'.substr($context['no_tlp'], 2, (strlen($context['no_tlp'])-2));

			$send =	[
				'phone' => $no_tlp.'@s.whatsapp.net',				
				'message' => $context['pesan']
			];

			$curl = curl_init();

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

		return $data;
	}	
}	