<?php

class Select_model extends CI_Model {

	public function select_asset($table_name, $order_by)
	{		
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where('status', 'Aktif');
		$this->db->order_by($order_by,'ASC');

		return $this->db->get()->result();
	}

	public function select_asset_2($table_name, $order_by, $keyword)
	{		
		if($keyword)
		{
			$this->db->select('id, concat (id," - ", value) AS text, concat (id," - ", value) AS value');
			$this->db->from($table_name);
			$this->db->where("value LIKE '%$keyword%' OR id LIKE '%$keyword%'");
			$this->db->order_by($order_by, 'ASC');
			
			return $this->db->get()->result();
		}
	}

}	