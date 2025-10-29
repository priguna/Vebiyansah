<?php

class Update_database_model extends CI_Model {

	private $_table_name = "update_database";
	private $_table_sql = "update_database u_d";

	public function tabel_data($context)
	{		
		$list = $context['list'];

		$this->db->select('*');
		$this->db->from($this->_table_sql);
		$this->db->where('list', $list);

		return $this->db->get()->result();
	}

	public function tabel_data_update($context)
	{		
		$versi = $context['versi'];

		$this->db->select('*');
		$this->db->from($this->_table_sql);
		$this->db->join('update_list u_l', 'u_l.id=u_d.list', 'left');	
		$this->db->where('versi >= '.$versi);
		$this->db->order_by('u_d.created_date', 'ASC');

		return $this->db->get()->result();
	}

	public function add($context)
	{		
		$this->list = $context['list'];
		$this->query = $context['query'];
		$this->created_date = date('Y-m-d H:i:s');

		$query = $this->db->insert($this->_table_name, $this);

		$notif = $this->get_notif_query('Tambah');

		return $notif;
	}

	public function exe_query($context)
	{		
		$query = $this->db->query($context['query']);

		$notif = $this->get_notif_query('Update');

		return $notif;
	}

	public function delete($context)
	{
		$query = $this->db->where('id', $context['id'])->delete($this->_table_name);		

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