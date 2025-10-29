<?php

class Login_model extends CI_Model {

	public function cek_login()
	{
		if($this->router->class != null){
			if ($this->session->userdata('level_'.$this->session->userdata('nama_apps')) != null){		
				if ($this->session->userdata('class_'.$this->session->userdata('nama_apps')) != $this->router->class) {								
					redirect(base_url($this->session->userdata('class_'.$this->session->userdata('nama_apps'))));
				}
			} else redirect(base_url());
		} else if ($this->session->userdata('class_'.$this->session->userdata('nama_apps')) != null){	
			redirect(base_url($this->session->userdata('class_'.$this->session->userdata('nama_apps'))));
		}
	}

	public function cek_user($username, $password) 
	{	
		$this->db->select('du.*, 
			a_lu.value AS level_value, 
			a_lu.class, 
			a_lu.nav'
		);
		
		$this->db->from('data_user du');
		$this->db->join('asset_level_user a_lu', 'a_lu.id=du.level', 'left');	
		$this->db->where('username', $username);
		$this->db->where('password', $password);

		$query = $this->db->get()->row();
		
		$apps = $this->db->get('pengaturan')->row();

		if(!empty($query)) 
		{
			$data = [
				'prefix' => _PREFIX_,
				'username_'._PREFIX_ => $query->username,
				'nama_'._PREFIX_ => $query->nama,
				'user_id_'._PREFIX_  => $query->id,
				'level_id_'._PREFIX_ => $query->level,
				'level_value_'._PREFIX_ => $query->level_value,
				'class_'._PREFIX_ => $query->class,				
				'nav_'._PREFIX_ => $query->nav,
				'level_id_utama_'._PREFIX_  => $query->level,
				'level_value_utama_'._PREFIX_ => $query->level_value,
				'class_utama_'._PREFIX_  => $query->class,
				'nama_apps_'._PREFIX_ => $apps->nama,
				'singkatan_'._PREFIX_ => $apps->singkatan,
				'perusahaan_'._PREFIX_ => $apps->perusahaan,
				'alamat_'._PREFIX_ => $apps->alamat,
				'no_telp_'._PREFIX_ => $apps->no_telp,
				'footer_'._PREFIX_ => $apps->footer,
				'email_'._PREFIX_ => $apps->email,
				'url_logo_kecil_'._PREFIX_ => $apps->url_logo_kecil,
				'url_logo_besar_'._PREFIX_ => $apps->url_logo_besar
			];

			$this->session->set_userdata($data); 
			
			return 'success';
		} 
		else 
		{
			$query = $this->user_simrs($username, $password);

			$level = $this->cek_level($query->level_value);

			if(!empty($query))
			{
				$data = [
					'prefix' => _PREFIX_,
					'username_'._PREFIX_ => $query->id_user,
					'nama_'._PREFIX_ => $query->nama,
					'user_id_'._PREFIX_  => $query->id,
					'level_id_'._PREFIX_ => $level->id,
					'level_value_'._PREFIX_ => $query->level_value,
					'class_'._PREFIX_ => str_replace('', '_', $query->level_value),				
					'nav_'._PREFIX_ => $level->nav,
					'level_id_utama_'._PREFIX_  => '',
					'level_value_utama_'._PREFIX_ => '',
					'class_utama_'._PREFIX_  => '',
					'nama_apps_'._PREFIX_ => $apps->nama,
					'singkatan_'._PREFIX_ => $apps->singkatan,
					'perusahaan_'._PREFIX_ => $apps->perusahaan,
					'alamat_'._PREFIX_ => $apps->alamat,
					'no_telp_'._PREFIX_ => $apps->no_telp,
					'footer_'._PREFIX_ => $apps->footer,
					'email_'._PREFIX_ => $apps->email,
					'url_logo_kecil_'._PREFIX_ => $apps->url_logo_kecil,
					'url_logo_besar_'._PREFIX_ => $apps->url_logo_besar
				];

				$this->session->set_userdata($data); 


				return 'success';
			}
			else return 'failed';
		} 
	}

	public function ganti_user() 
	{	
		$this->db->select('*');
		$this->db->from('asset_level_user');
		$this->db->where('id', $this->input->post('level_id'));

		$query = $this->db->get()->row();

		if($query) 
		{
			$apps =  $this->db->get('pengaturan')->row();

			$data = [
				'level_id_'._PREFIX_ => $query->id,
				'level_value_'._PREFIX_ => $query->value,
				'class_'._PREFIX_ => $query->class,				
				'nav_'._PREFIX_ => $query->nav
			];

			$this->session->set_userdata($data);
		} 

		return $this->get_notif('Ganti User');
	}

	public function logout()
	{
		$apps =  $this->db->get('pengaturan')->row();
		
		$data = [
			'prefix' => null,
			'username_'._PREFIX_ => null,
			'nama_'._PREFIX_ => null,
			'user_id_'._PREFIX_  => null,
			'level_id_'._PREFIX_ => null,
			'level_value_'._PREFIX_ => null,
			'class_'._PREFIX_ => null,				
			'nav_'._PREFIX_ => null,
			'level_id_utama_'._PREFIX_  => null,
			'level_value_utama_'._PREFIX_ => null,
			'class_utama_'._PREFIX_  => null,
			'nama_apps_'._PREFIX_ => null,
			'singkatan_'._PREFIX_ => null,
			'perusahaan_'._PREFIX_ => null,
			'alamat_'._PREFIX_ => null,
			'no_telp_'._PREFIX_ => null,
			'footer_'._PREFIX_ => null,
			'email_'._PREFIX_ => null,
			'url_logo_kecil_'._PREFIX_ => null,
			'url_logo_besar_'._PREFIX_ => null
		];

		$this->session->unset_userdata($data);
		$this->session->sess_destroy();

		redirect(base_url());
	}

	public function user_simrs($username, $password)
	{		
		$db_sik = $this->load->database('sik', TRUE);

		$db_sik->select('*, aes_decrypt(u.id_user, "nur") AS id');
		$db_sik->from('user u');			
		$db_sik->where('u.id_user = aes_encrypt("'.$username.'","nur")');
		$db_sik->where('u.password = aes_encrypt("'.$password.'","windi")');	

		$query = $db_sik->get_compiled_select(); 

		$db_sik->select('q.*,
		 if(d.kd_dokter!="", "Dokter", j.nm_jbtn) AS level_value,
		 if(d.nm_dokter!="", nm_dokter, nama) AS nama');
		$db_sik->from("($query) AS q");				
		$db_sik->join('dokter d', 'd.kd_dokter=q.id', 'left');	
		$db_sik->join('spesialis s', 's.kd_sps=d.kd_sps', 'left');	
		$db_sik->join('petugas p', 'p.nip=q.id', 'left');	
		$db_sik->join('jabatan j', 'j.kd_jbtn=p.kd_jbtn', 'left');

		return $db_sik->get()->row();
	}	

	public function cek_level($level_value) 
	{	
		$this->db->select('*');
		$this->db->from('asset_level_user a_lu');	
		$this->db->where('a_lu.value', $level_value);

		return $this->db->get()->row();
	}

	//--------------------------------------------------------------------------------------------

	public function get_notif($name_function)
	{
		$eror = $this->db->error();

		if($eror['code'] == 0){
			$notif = array('eror'=>'success', 'pesan'=>$name_function.' berhasil');
		} else $notif = array('eror'=>'warning', 'pesan'=>"Terjadi kesalahan. Mohon hubungi (septiaputra@gmail.com)<br>$eror[code]: $eror[message]");	

		return $notif;		
	}

}