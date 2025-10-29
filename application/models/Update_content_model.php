<?php

class update_content_model extends CI_Model {

	private $_table_name = "update_content";
	private $_table_sql = "update_content u_c";

	public function tabel_data($context)
	{		
		$this->db->select('*');
		$this->db->from($this->_table_sql);
		$this->db->join('update_list u_l', 'u_l.id=u_c.list', 'left');	
		$this->db->where('u_c.list', $context['list']);

		return $this->db->get()->result();
	}

	public function tabel_data_file($context)
	{		
		$versi = $context['versi'];

		$this->db->select('*');
		$this->db->from($this->_table_sql);
		$this->db->join('update_list u_l', 'u_l.id=u_c.list', 'left');	
		$this->db->where('u_c.list', $context['list']);
		$this->db->where('(u_c.dir = "./application/controllers" OR u_c.dir = "./application/models" OR u_c.dir LIKE "./application/views%")');

		$query_1 = $this->db->get_compiled_select(); 

		$this->db->select('*');
		$this->db->from($this->_table_sql);
		$this->db->join('update_list u_l', 'u_l.id=u_c.list', 'left');	
		$this->db->where("u_l.versi > $versi");
		$this->db->where('(u_c.dir != "./application/controllers" AND u_c.dir != "./application/models" AND u_c.dir NOT LIKE "./application/views%")');

		$query_2 = $this->db->get_compiled_select(); 

		return $this->db->query("$query_1 UNION $query_2")->result();
	}

	public function tabel_data_versi_all($context)
	{				
		$this->db->select('*');
		$this->db->from($this->_table_sql);
		$this->db->join('update_list u_l', 'u_l.id=u_c.list', 'left');	
		$this->db->where('u_l.versi', $context['versi']);

		return $this->db->get()->result();
	}

	public function tabel_data_versi($context)
	{				
		$this->db->select('u_c.id, u_c.filename, u_c.dir, u_c.file_date');
		$this->db->from($this->_table_sql);
		$this->db->join('update_list u_l', 'u_l.id=u_c.list', 'left');	
		$this->db->where('u_l.versi', $context['versi']);

		return $this->db->get()->result();
	}

	public function lihat_data_by_url($context)
	{		
		$this->db->select('*');
		$this->db->from($this->_table_sql);
		$this->db->where('u_c.dir', $context['dir']);
		$this->db->where('u_c.filename', $context['filename']);
		$this->db->where('u_c.list', $context['list']);

		return $this->db->get()->row();
	}

	public function add($context)
	{		
		$this->list = $context['list'];
		$this->filename = $context['filename'];
		$this->dir = $context['dir'];
		$this->content = $context['content'];
		$this->file_date = date('Y-m-d H:i:s');
		$this->created_date = date('Y-m-d H:i:s');

		$query = $this->db->insert($this->_table_name, $this);

		$notif = $this->get_notif_query('Tambah');

		return $notif;
	}

	public function update($context)
	{		
		$this->list = $context['list'];
		$this->filename = $context['filename'];
		$this->dir = $context['dir'];
		$this->content = $context['content'];
		$this->file_date = $context['file_date'];

		$query = $this->db->where('id', $context['id'])->update($this->_table_name, $this);

		$notif = $this->get_notif_query('Update');

		return $notif;
	}

	public function delete($context)
	{
		$query = $this->db->where('id', $context['id'])->delete($this->_table_name);		

		return $this->get_notif_query('Hapus');
	}

	public function delete_list($context)
	{
		$query = $this->db->where('list', $context['list'])->delete($this->_table_name);		

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