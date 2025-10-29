<?php

class Asset_menu_class_model extends CI_Model {

	private $_error = "";
	private $_table_name = "asset_menu_class";
	private $_table_sql = "asset_menu_class a_mc";

	public function tabel_data($level_id)
	{		
		$this->db->select('a_mc.id, a_menu.id AS menu_id, a_menu.judul, a_menu.target, a_menu.url, a_menu.icon, a_menu.urut_menu, a_menu.submenu');	
		$this->db->from('asset_menu a_menu');
		$this->db->join($this->_table_sql, 'a_mc.menu_id=a_menu.id', 'left');	
		$this->db->where('a_menu.status', 'Aktif');		
		$this->db->where('a_mc.level_id', $level_id);
		$this->db->order_by('a_menu.aplikasi, a_menu.urut_menu, a_menu.submenu, a_menu.urut_submenu', 'ASC');
		
		return $this->db->get()->result();
	}

	public function tabel_data_menu($level_id)
	{		
		$this->db->select('*');
		$this->db->from($this->_table_sql);
		$this->db->where('a_mc.level_id', $level_id);

		$query = $this->db->get_compiled_select(); 

		$this->db->select('a_mc.id, a_menu.id AS menu_id, a_menu.judul, a_menu.target, a_menu.url, a_menu.icon, a_menu.urut_menu, a_menu.submenu');	
		$this->db->from('asset_menu a_menu');
		$this->db->join("($query) AS a_mc", 'a_mc.menu_id=a_menu.id', 'left');	
		$this->db->where('a_menu.status', 'Aktif');		
		$this->db->order_by('a_menu.aplikasi, a_menu.urut_menu, a_menu.submenu, a_menu.urut_submenu', 'ASC');	
		
		return $this->db->get()->result();
	}

	public function lihat_data($id)
	{
		$this->db->select('a_mc.*');
		$this->db->from($this->_table_sql);
		$this->db->where('a_mc.id', $id);
		
		return $this->db->get()->row();
	}

	public function tambah_data()
	{
		$this->id = '';
		$this->level_id = '';
		$this->menu_id = '';

		return $this;
	}

	public function add_update($context)
	{
		foreach ($context['menu_id'] as $key)
		{
			if(isset($context['id_'.$key]))
			{			
				if($context['status_'.$key] != '1')
				{	
					$data = array('menu_id' => $key, 'level_id' => $context['level_id']);

					$query = $this->db->insert($this->_table_name, $data);
				}
			}
			else
			{
				if($context['status_'.$key] == '1')
				{	
					$query = $this->db->where('level_id', $context['level_id'])->where('menu_id', $key)->delete($this->_table_name);
				}
			}
		}

		$notif = $this->get_notif_query('Update');

		return $notif;
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