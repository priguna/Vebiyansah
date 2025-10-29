<?php

class Data_pembiayaan_pasien_files_model extends CI_Model {

	private $_error = "";
	private $_table_name = "pembiayaan_pasien_files";
	private $_table_sql = "pembiayaan_pasien_files p_pf";	

	public function tabel_data($context)
	{		
		$this->db->select('p_pf.*');
		$this->db->from($this->_table_sql);
		$this->db->where('pembiayaan_pasien_id', $context['id']);
		$this->db->order_by('p_pf.id', 'ASC');	

		return $this->db->get()->result();
	}
}	