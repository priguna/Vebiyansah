<?php

class Update_list_model extends CI_Model {

	private $_table_name = "update_list";
	private $_table_sql = "update_list u_l";

	public function tabel_data($context)
	{		
		$limit = $context['limit'];
		$start = $context['start'];

		$this->db->select('u_l.*');
		$this->db->from($this->_table_sql);
		$this->db->order_by('u_l.versi', 'DESC');		
		$this->db->limit($limit, $start);

		return $this->db->get()->result();
	}

	public function jml_data($context)
	{
		$this->db->select('u_l.*');
		$this->db->from($this->_table_sql);
		
		return $this->db->get()->num_rows();
	}

	public function lihat_data_last($context)
	{		
		$this->db->select('u_l.*');
		$this->db->from($this->_table_sql);
		$this->db->where('u_l.versi >', $context['versi']);
		$this->db->order_by('u_l.id', 'DESC');
		$this->db->limit(1);

		return $this->db->get()->row();
	}

	public function lihat_data($context)
	{
		$id = $context['id'];

		$this->db->select('u_l.*');
		$this->db->from($this->_table_sql);
		$this->db->where('u_l.id', $id);
		
		return $this->db->get()->row();
	}

	public function tambah_data()
	{
		$this->id = '';
		$this->versi = '';
		$this->tgl = '';

		return $this;
	}

	public function add_data($context)
	{
		$this->versi = $context['versi'];
		$this->tgl = $context['tgl'];	
		$this->created_date = date('Y-m-d H:i:s');

		$query = $this->db->insert($this->_table_name, $this);

		return $this->get_notif_query('Tambah');
	}
	
	public function update_data($context)
	{		
		$this->versi = $context['versi'];
		$this->tgl = $context['tgl'];	

		$query = $this->db->where('id', $context['id'])->update($this->_table_name, $this);	

		return $this->get_notif_query('Update');
	}

	public function delete_data($context)
	{
		$id = $context['id'];
		
		$query = $this->db->where('id', $id)->delete($this->_table_name);		

		return $this->get_notif_query('Hapus');
	}
	
	//--------------------------------------------------------------------------------------------

	public function get_notif_query($name_function)
	{
		$eror = $this->db->error();

		if($eror['code'] == 0)
		{
			$notif = array('eror' => 'success', 'pesan'=> $name_function.' data berhasil');
		} 
		else if($eror['code'] == 1062)
		{
			$notif = array('eror' => 'warning', 'pesan' => 'Data sudah terdaftar');
		} 
		else $notif = array('eror' => 'warning', 'pesan' => "Terjadi kesalahan. Mohon hubungi (septiaputra@gmail.com)<br>$eror[code]: $eror[message]");	

		return $notif;		
	}

}	