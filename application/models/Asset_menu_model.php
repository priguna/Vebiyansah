<?php

class Asset_menu_model extends CI_Model {

	private $_table_name = "asset_menu";
	private $_table_sql = "asset_menu a_menu";

	public function tabel_data()
	{		
		$this->db->select('a_menu.*');	
		$this->db->from($this->_table_sql);
		$this->db->order_by('a_menu.aplikasi, urut_menu, a_menu.submenu, a_menu.urut_submenu', 'ASC');	

		return $this->db->get()->result();
	}

	public function lihat_data($context)
	{
		$id =  $context['id'];
		
		$this->db->select('a_menu.*');
		$this->db->from($this->_table_sql);
		$this->db->where('a_menu.id', $id);
		
		return $this->db->get()->row();
	}

	public function tambah_data()
	{
		$this->id = '';
		$this->judul = '';
		$this->url = '';
		$this->icon = '';
		$this->target = '';
		$this->status = '';

		return $this;
	}

	public function add_data()
	{
		$post = $this->input->post();	

		$this->judul = $post['judul'];
		$this->url = $post['url'];	
		$this->icon = $post['icon'];
		$this->urut_menu = 99;	
		$this->target = $post['target'];

		$query = $this->db->insert($this->_table_name, $this);

		$notif = $this->get_notif_query('Tambah');

		return $notif;
	}

	public function update_data_batch()
	{
		$post = $this->input->post();

		$data = json_decode($this->input->post('data'));

		$urut_aplikasi = 0;

		foreach ($data as $key)
		{
			$urut_submenu = 0;
			$urut_menu = 0;
			$urut_aplikasi++;

			$array['aplikasi'] = $urut_aplikasi;
			$array['urut_menu'] = 0;
			$array['urut_submenu'] = 0;
			$array['submenu'] = 0;

			$query = $this->db->where('id', $key->id)->update($this->_table_name, $array);

			if(isset($key->children))
			{
				foreach ($key->children as $key_2)
				{
					$urut_submenu = 0;
					$urut_menu++;

					$array_2['aplikasi'] = $urut_aplikasi;
					$array_2['urut_menu']= $urut_menu;
					$array_2['urut_submenu'] = 0;
					$array_2['submenu'] = 1;

					$query = $this->db->where('id', $key_2->id)->update($this->_table_name, $array_2);

					if(isset($key_2->children))
					{
						foreach ($key_2->children as $key_3)
						{
							$urut_submenu++;

							$array_3['aplikasi'] = $urut_aplikasi;
							$array_3['urut_menu'] = $urut_menu;
							$array_3['urut_submenu'] = $urut_submenu;
							$array_3['submenu'] = 2;

							$query = $this->db->where('id', $key_3->id)->update($this->_table_name, $array_3);
						}

					}
				}
			}
		}

		$notif = $this->get_notif_query('Update');

		return $notif;
	}

	public function update_data()
	{
		$post = $this->input->post();	

		$this->judul = $post['judul'];
		$this->url = $post['url'];		
		$this->icon = $post['icon'];		
		$this->target = $post['target'];
		$this->status = $post['status'];

		$query = $this->db->where('id', $post['id'])->update($this->_table_name, $this);

		if($query) $this->db->query("UPDATE $this->_table_sql SET urut_menu=id WHERE urut_menu=0");

		$notif = $this->get_notif_query('Update');

		return $notif;
	}

	public function delete_data($context)
	{
		$id = $context['id'];

		$query = $this->db->where('id', $id)->delete($this->_table_name);

		if($query) $this->db->query("UPDATE $this->_table_name SET submenu=0 WHERE urut_menu=$id");

		$notif = $this->get_notif_query('Hapus');

		return $notif;
	}

	//--------------------------------------------------------------------------------------------

	public function select_menu()
	{		
		$this->db->select('id, judul AS value');
		$this->db->from($this->_table_sql);	
		$this->db->where('submenu', 0);		
		$this->db->where('status', 'Aktif');			
		$this->db->order_by('judul', 'ASC');	

		return $this->db->get()->result();
	}

	//--------------------------------------------------------------------------------------------

	public function select_menu_not_in($level_id)
	{		
		$this->db->select('urut_menu AS id, judul AS value');
		$this->db->from($this->_table_sql);	
		$this->db->where('submenu', 0);		
		$this->db->where('status', 'Aktif');		
		$this->db->where("id NOT IN (SELECT menu_id FROM asset_menu_class WHERE level_id = $level_id)");	
		$this->db->order_by('judul', 'ASC');	

		return $this->db->get()->result();
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