<?php

class Update_model extends CI_Model {

	private $_table_name = "update";
	private $_table_sql = "update u";

	public function tabel_data()
	{		
		$this->db->select('u.*');
		$this->db->from($this->_table_sql);

		return $this->db->get()->result();
	}

}	