<?php

class Data_user_model extends CI_Model {

	private $_table_name = "data_user";
	private $_table_sql = "data_user d_u";

	public function tabel_data($context)
	{		
		$keyword = $context['keyword'];
		$level_id = $context['level_id'];
		$limit = $context['limit'];
		$start = $context['start'];
		$class = $context['class'];

		$this->db->select('d_u.*, a_lu.value AS level_value');
		$this->db->from($this->_table_sql);
		$this->db->join('asset_level_user a_lu', 'a_lu.id=d_u.level', 'left');	

		if($keyword != "")	$this->db->where("d_u.nama LIKE '%$keyword%' OR d_u.username LIKE '%$keyword%'");

		if($level_id == 'all')
		{ 
			$this->db->where('d_u.level >=', $this->session->userdata('level_id_'._PREFIX_)); 
		} 
		else  $this->db->where('d_u.level', $level_id);

		$this->db->where('d_u.level >=', $this->session->userdata('level_id_'._PREFIX_));	
		$this->db->order_by('d_u.level, d_u.nama', 'ASC');		
		$this->db->limit($limit, $start);

		return $this->db->get()->result();
	}

	public function jml_data($context)
	{
		$keyword = $context['keyword'];
		$level_id = $context['level_id'];
		$class = $context['class'];

		$this->db->select('d_u.*');
		$this->db->from($this->_table_sql);
		
		$this->db->where('d_u.level >=', $this->session->userdata('level_id_'._PREFIX_));		

		if($keyword != "")	$this->db->where("d_u.nama LIKE '%$keyword%' OR d_u.username LIKE '%$keyword%'");

		if($level_id == 'all')
		{ 
			$this->db->where('d_u.level >=', $this->session->userdata('level_id_'._PREFIX_)); 
		} 
		else  $this->db->where('d_u.level', $level_id);

		return $this->db->get()->num_rows();
	}

	public function cek_user_by_id_password($context) 
	{	
		$this->db->select('d_u.*');		
		$this->db->from('data_user d_u');
		$this->db->where('d_u.id', $context['id']);
		$this->db->where('d_u.password', $context['password']);

		$query = $this->db->get()->row();

		return $query;
	}

	public function lihat_data($context)
	{
		$id = $context['id'];

		$this->db->select('d_u.*, a_lu.class, a_lu.nav, a_lu.value AS level_value');
		$this->db->from($this->_table_sql);
		$this->db->join('asset_level_user a_lu', 'a_lu.id=d_u.level', 'left');
		$this->db->where('d_u.id', $id);
		
		return $this->db->get()->row();
	}

	public function tambah_data()
	{
		$this->id = '';
		$this->nama = '';
		$this->username = '';
		$this->password = '';
		$this->email = '';
		$this->level = '';
		$this->nomor_wa = '';
		$this->status = '';

		return $this;
	}

	public function add_data($context)
	{
		$this->nama = $context['nama'];
		$this->username = $context['username'];
		$this->password = $context['password'];
		$this->email = $context['email'];
		$this->level = $context['level'];
		$this->nomor_wa = $context['nomor_wa'];
		$this->created_date = date('Y-m-d H:i:s');

		$query = $this->db->insert($this->_table_name, $this);

		return $this->get_query_notif('Tambah');
	}
	
	public function update_data($context)
	{
		$this->nama = $context['nama'];
		$this->username = $context['username'];
		$this->password = $context['password'];
		$this->email = $context['email'];
		$this->level = $context['level'];
		$this->nomor_wa = $context['nomor_wa'];		

		$query = $this->db->where('id', $context['id'])->update($this->_table_name, $this);	

		if($this->session->userdata('user_id_'._PREFIX_) == $context['id'])
		{
			$context = array('id' => $context['id']);

			$query = $this->lihat_data($context);

			$data = [
				'username_'._PREFIX_ => $query->username,
				'nama_'._PREFIX_ => $query->nama,
				'user_id_'._PREFIX_  => $query->id,
				'level_id_'._PREFIX_ => $query->level,
				'level_value_'._PREFIX_ => $query->level_value,
				'class_'._PREFIX_ => $query->class,				
				'nav_'._PREFIX_ => $query->nav,
				'user_id_utama_'._PREFIX_  => $query->level
			];
			
			$this->session->set_userdata($data);
		}

		return $this->get_query_notif('Update');
	}

	public function delete_data($context)
	{
		$id = $context['id'];
		
		$query = $this->db->where('id', $id)->delete($this->_table_name);		

		return $this->get_query_notif('Hapus');
	}

	//--------------------------------------------------------------------------------------------

	public function select_user($level)
	{	
		$this->db->select('d_u.id, d_u.nama AS value');
		$this->db->from($this->_table_sql);
		$this->db->where('d_u.level', $level);
		$this->db->where('d_u.status', 'Aktif');
		$this->db->order_by('d_u.nama');
		
		return $this->db->get()->result();
	}

	public function select_user_by_level_value($value)
	{		
		$this->db->select('d_u.username,  d_u.nomor_wa, d_u.id, d_u.nama AS value');
		$this->db->from($this->_table_sql);		
		$this->db->join('asset_level_user a_lu', 'a_lu.id=d_u.level', 'left');	
		$this->db->where('a_lu.value', $value);
		$this->db->where('d_u.status', 'Aktif');
		$this->db->order_by('d_u.nama');
		
		return $this->db->get()->result();		
	}

	//--------------------------------------------------------------------------------------------

	public function get_query_notif($name_function)
	{
		$eror = $this->db->error();

		if($eror['code'] == 0)
		{
			$notif = array('eror' => 'success', 'pesan' => $name_function.' data berhasil');
		} 
		else $notif = array('eror' => 'warning', 'pesan' => "Terjadi kesalahan. Mohon hubungi (septiaputra@gmail.com)<br>$eror[code]: $eror[message]");	

		return $notif;		
	}

}	