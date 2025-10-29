<?php

class Wilayah_model extends CI_Model {

	public function select_propinsi()
	{
		$this->db->select('id, value');
		$this->db->order_by('value','ASC');

		return $this->db->get('asset_propinsi')->result();
	}

	public function select_kabupaten($propinsi_id)
	{
		$this->db->select('id, value');
		$this->db->where('propinsi_id', $propinsi_id);
		$this->db->order_by('value','ASC');

		return $this->db->get('asset_kabupaten')->result();
	}

	public function select_kecamatan($kabupaten_id)
	{
		$this->db->select('id, value');
		$this->db->where('kabupaten_id', $kabupaten_id);
		$this->db->order_by('value','ASC');

		return $this->db->get('asset_kecamatan')->result();
	}

	public function select_kelurahan($kecamatan_id)
	{
		$this->db->select('id, value');
		$this->db->where('kecamatan_id', $kecamatan_id);
		$this->db->order_by('value','ASC');

		return $this->db->get('asset_kelurahan')->result();
	}	

	public function select_kode_propinsi()
	{
		$this->db->select('kode AS id, value');
		$this->db->order_by('value','ASC');

		return $this->db->get('asset_propinsi')->result();
	}

	public function select_kode_kabupaten($propinsi_kode)
	{
		$this->db->select('kode AS id, value');
		$this->db->where("kode LIKE '$propinsi_kode%'");
		$this->db->order_by('value','ASC');

		return $this->db->get('asset_kabupaten')->result();
	}

	public function select_kode_kecamatan($kabupaten_kode)
	{
		$this->db->select('kode AS id, value');
		$this->db->where("kode LIKE '$kabupaten_kode%'");
		$this->db->order_by('value','ASC');

		return $this->db->get('asset_kecamatan')->result();
	}

	public function select_kode_kelurahan($kecamatan_kode)
	{
		$this->db->select('kode AS id, value');
		$this->db->where("kode LIKE '$kecamatan_kode%'");
		$this->db->order_by('value','ASC');

		return $this->db->get('asset_kelurahan')->result();
	}

}	