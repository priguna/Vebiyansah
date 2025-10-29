<?php

class Asset_level_user_model extends CI_Model {

	private $_table_name = "asset_level_user";
	private $_table_sql = "asset_level_user a_lu";

	public function tabel_data()
	{		
		$this->db->select('a_lu.*,');
		$this->db->from($this->_table_sql);		
		$this->db->order_by('a_lu.id', 'ASC');	

		return $this->db->get()->result();
	}

	public function lihat_data($context)
	{
		$id =  $context['id'];
		
		$this->db->select('a_lu.*');
		$this->db->from($this->_table_sql);
		$this->db->where('a_lu.id', $id);
		
		return $this->db->get()->row();
	}

	public function tambah_data()
	{
		$this->id = '';
		$this->value = '';
		$this->class = '';
		$this->nav = '';
		$this->status = '';

		return $this;
	}

	public function add_data($context)
	{
		$this->value = $context['value'];
		$this->class = $context['class'];	
		$this->nav = $context['nav'];
		$this->id = $context['id'];

		$query = $this->db->insert($this->_table_name, $this);

		$notif = $this->get_notif_query('Tambah');

		return $notif;
	}

	public function update_data($context)
	{		
		$this->value = $context['value'];
		$this->class = $context['class'];	
		$this->nav = $context['nav'];
		$this->id = $context['id'];

		$query = $this->db->where('id', $context['id_old'])->update($this->_table_name, $this);

		$notif = $this->get_notif_query('Update');

		return $notif;
	}

	public function delete_data($context)
	{
		$id = $context['id'];

		$query = $this->db->where('id', $id)->delete($this->_table_name);

		$notif = $this->get_notif_query('Hapus');

		return $notif;
	}

	//--------------------------------------------------------------------------------------------

	public function get_notif_query($name_function)
	{
		$eror = $this->db->error();

		if($eror['code'] == 0){
			$notif = array('eror'=>'success', 'pesan'=>$name_function.' data berhasil');
		} else if($eror['code'] == 1062){
			$notif = array('eror'=>'warning', 'pesan'=>'Username sudah terdaftar');
		} else $notif = array('eror'=>'warning', 'pesan'=>"Terjadi kesalahan. Mohon hubungi (septiaputra@gmail.com)<br>$eror[code]: $eror[message]");	

		return $notif;		
	}
}	