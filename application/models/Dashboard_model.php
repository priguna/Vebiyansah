<?php

class Dashboard_model extends CI_Model {

	public function per_jenis_kelamin($context)
	{		
		$this->db->select('d_yp.jenis_kelamin, count(d_yp.jenis_kelamin) AS jml');
		$this->db->from('data_yatim_piatu d_yp');	
		$this->db->where('d_yp.periode', $context['periode']);			
		
		if($context['kabupaten'] != "all") $this->db->where('d_yp.kabupaten_kota_sekarang', $context['kabupaten']);

		$this->db->group_by('d_yp.jenis_kelamin');

		return $this->db->get()->result();
	}

	public function per_status($context)
	{		
		$this->db->select('d_yp.status, count(d_yp.status) AS jml');
		$this->db->from('data_yatim_piatu d_yp');		
		$this->db->where('d_yp.periode', $context['periode']);			
		
		if($context['kabupaten'] != "all") $this->db->where('d_yp.kabupaten_kota_sekarang', $context['kabupaten']);

		$this->db->group_by('d_yp.status');

		return $this->db->get()->result();
	}

	public function per_status_alamat_tinggal($context)
	{		
		$this->db->select('d_yp.status_alamat_tinggal, count(d_yp.status_alamat_tinggal) AS jml');
		$this->db->from('data_yatim_piatu d_yp');				
		$this->db->where('d_yp.periode', $context['periode']);			
		
		if($context['kabupaten'] != "all") $this->db->where('d_yp.kabupaten_kota_sekarang', $context['kabupaten']);

		$this->db->group_by('d_yp.status_alamat_tinggal');

		return $this->db->get()->result();
	}

	public function per_anak_berkebutuhan_khusus($context)
	{		
		$this->db->select('d_yp.anak_berkebutuhan_khusus, count(d_yp.anak_berkebutuhan_khusus) AS jml');
		$this->db->from('data_yatim_piatu d_yp');					
		$this->db->where('d_yp.periode', $context['periode']);			
		
		if($context['kabupaten'] != "all") $this->db->where('d_yp.kabupaten_kota_sekarang', $context['kabupaten']);

		$this->db->group_by('d_yp.anak_berkebutuhan_khusus');

		return $this->db->get()->result();
	}

	public function per_status_pengasuh($context)
	{		
		$this->db->select('d_yp.status_pengasuh, count(d_yp.status_pengasuh) AS jml');
		$this->db->from('data_yatim_piatu d_yp');		
		$this->db->where('d_yp.periode', $context['periode']);			
		
		if($context['kabupaten'] != "all") $this->db->where('d_yp.kabupaten_kota_sekarang', $context['kabupaten']);
					
		$this->db->group_by('d_yp.status_pengasuh');

		return $this->db->get()->result();
	}	

	public function per_kelompok_umur($context)
	{		
		$this->db->select('SUM(if(umur>=0 AND umur<=4,1,0)) AS umur_0_4, 
			SUM(if(umur>=5 AND umur<=9,1,0)) AS umur_5_9,
			SUM(if(umur>=10 AND umur<=14,1,0)) AS umur_10_14,
			SUM(if(umur>=15 AND umur<=17,1,0)) AS umur_15_17,			
			SUM(if(umur>17,1,0)) AS umur_17');
		$this->db->from('data_yatim_piatu d_yp');	
		$this->db->where('d_yp.periode', $context['periode']);			
		
		if($context['kabupaten'] != "all") $this->db->where('d_yp.kabupaten_kota_sekarang', $context['kabupaten']);

		return $this->db->get()->row();
	}	
}	