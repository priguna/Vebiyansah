<?php

class Pengaturan_model extends CI_Model {

	private $_table_name = "pengaturan";
	private $_table_sql = "pengaturan p";

	public function tabel_data()
	{		
		$this->db->select('p.*');
		$this->db->from($this->_table_sql);

		return $this->db->get()->row();
	}
	
	public function update_data($context)
	{
		$this->nama = $context['nama'];
		$this->singkatan = $context['singkatan'];
		$this->no_telp = $context['no_telp'];
		$this->alamat = $context['alamat'];
		$this->perusahaan = $context['perusahaan'];
		$this->email = $context['email'];
		$this->footer = $context['footer'];

		$this->prefix = strtolower(str_replace(" ","_",$context['singkatan']));
		
		if(!empty($_FILES['logo_kecil']['name'])) 
		{
			if($context['url_logo_kecil'] != '') unlink($context['url_logo_kecil']);

			$file_name = 'kecil-'.date('Ymd-His');

			$this->url_logo_kecil = $this->_uploadFile('logo_kecil', $file_name);
		}

		if(!empty($_FILES['logo_besar']['name'])) 
		{
			if($context['url_logo_besar'] != '') unlink($context['url_logo_besar']);

			$file_name = 'besar-'.date('Ymd-His');

			$this->url_logo_besar = $this->_uploadFile('logo_besar', $file_name);
		}

		$query = $this->db->update($this->_table_name, $this);			

		return $this->get_notif('Update');
	}

	public function update_versi($context)
	{		
		$this->versi = $context['versi'];

		$query = $this->db->update($this->_table_name, $this);	

		return $this->get_notif('Update');
	}

	private function _uploadFile($input, $filename)
	{
		$upload_path = '_asset/img/';

		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['file_name'] = $filename;
		$config['overwrite'] = true;
		$config['max_size'] = 2024; // 10MB

		$this->upload->initialize($config);
		$this->load->library('upload', $config);

		if($this->upload->do_upload($input)) {
			return $upload_path.''.$this->upload->data('file_name');
		} else print_r($this->upload->display_errors());
	}

	//--------------------------------------------------------------------------------------------

	public function get_notif($name_function)
	{
		$eror = $this->db->error();

		if($eror['code'] == 0){
			$notif = array('eror'=>'success', 'pesan'=>$name_function.' data berhasil');
		} else if($eror['code'] == 1062){
			$notif = array('eror'=>'warning', 'pesan'=>'singkatan sudah terdaftar');
		} else $notif = array('eror'=>'warning', 'pesan'=>"Terjadi kesalahan. Mohon hubungi (septiaputra@gmail.com)<br>$eror[code]: $eror[message]");	

		return $notif;		
	}

}	