<?php

class Data_simrs_model extends CI_Model {

	public function tabel($context)
	{		
		$db_sik = $this->load->database('sik', TRUE);

		$db_sik->select('*');
		$db_sik->from($context['table_name']);
		$db_sik->order_by($context['order']);

		return $db_sik->get()->result();
	}

	public function tabel_rawat_jalan($context)
	{		
		$keyword = $context['keyword'];
		$limit = $context['limit'];
		$start = $context['start'];

		$tgl = $this->convert_range_tgl($context['range_tgl']);
 
		$db_sik = $this->load->database('sik', TRUE);

		$db_sik->select('rp.*, 
			p.nm_pasien, 
			d.nm_dokter, 
			p.no_tlp, 
			p.no_peserta,
			po.nm_poli,
			GROUP_CONCAT(CONCAT(b.nm_bangsal, " ", k.kd_kamar) SEPARATOR "<br>") AS kamar,
			GROUP_CONCAT(CONCAT("[",pen.kd_penyakit, "] ", pen.nm_penyakit) SEPARATOR "<br>") AS diagnosa');
		$db_sik->from('reg_periksa rp');
		$db_sik->join('pasien p', 'p.no_rkm_medis=rp.no_rkm_medis', 'left');		
		$db_sik->join('dokter d', 'd.kd_dokter=rp.kd_dokter', 'left');	
		$db_sik->join('poliklinik po', 'po.kd_poli=rp.kd_poli', 'left');
		$db_sik->join('kamar_inap ki', 'ki.no_rawat=rp.no_rawat', 'left');
		$db_sik->join('kamar k', 'k.kd_kamar=ki.kd_kamar', 'left');
		$db_sik->join('bangsal b', 'b.kd_bangsal=k.kd_bangsal', 'left');
		$db_sik->join('diagnosa_pasien dp', 'dp.no_rawat=rp.no_rawat', 'left');
		$db_sik->join('penyakit pen', 'pen.kd_penyakit=dp.kd_penyakit', 'left');


		if(isset($tgl['awal']) && isset($tgl['akhir'])) $db_sik->where("rp.tgl_registrasi BETWEEN '".$tgl['awal']."' AND '".$tgl['akhir']."'");

		if($keyword != "") $db_sik->where("(p.nm_pasien LIKE '%$keyword%' OR rp.no_rkm_medis LIKE '%$keyword%' OR rp.no_rawat LIKE '%$keyword%')");

		$db_sik->order_by('p.nm_pasien', 'ASC');
		$db_sik->group_by('rp.no_rawat');
		
		$db_sik->limit($limit, $start);

		return $db_sik->get()->result();
	}

	public function jml_rawat_jalan($context)
	{		
		$keyword = $context['keyword'];

		$tgl = $this->convert_range_tgl($context['range_tgl']);

		$db_sik = $this->load->database('sik', TRUE);

		$db_sik->select('rp.*');
		$db_sik->from('reg_periksa rp');
		$db_sik->join('pasien p', 'p.no_rkm_medis=rp.no_rkm_medis', 'left');
		
		if($keyword != "") $db_sik->where("(p.nm_pasien LIKE '%$keyword%' OR rp.no_rkm_medis LIKE '%$keyword%' OR rp.no_rawat LIKE '%$keyword%')");

		if(isset($tgl['awal']) && isset($tgl['akhir'])) $db_sik->where("rp.tgl_registrasi BETWEEN '".$tgl['awal']."' AND '".$tgl['akhir']."'");

		return $db_sik->get()->num_rows();
	}
	
	public function tabel_diagnosa($context)
	{		
		$db_sik = $this->load->database('sik', TRUE);

		$db_sik->select('*');
		$db_sik->from('diagnosa_pasien dp');		
		$db_sik->join('penyakit p', 'p.kd_penyakit=dp.kd_penyakit', 'left');	
		$db_sik->where('dp.no_rawat', $context['no_rawat']);

		return $db_sik->get()->result();
	}

	public function lihat_registrasi($context)
	{
		$db_sik = $this->load->database('sik', TRUE);

		$db_sik->select('rp.*, p.*, 
			d.nm_dokter, 
			p.no_tlp, 
			po.nm_poli,
			GROUP_CONCAT(CONCAT("[",pen.kd_penyakit, "] ", pen.nm_penyakit) SEPARATOR ", ") AS diagnosa');
		$db_sik->from('reg_periksa rp');
		$db_sik->join('pasien p', 'p.no_rkm_medis=rp.no_rkm_medis', 'left');		
		$db_sik->join('dokter d', 'd.kd_dokter=rp.kd_dokter', 'left');
		$db_sik->join('poliklinik po', 'po.kd_poli=rp.kd_poli', 'left');
		$db_sik->join('diagnosa_pasien dp', 'dp.no_rawat=rp.no_rawat', 'left');
		$db_sik->join('penyakit pen', 'pen.kd_penyakit=dp.kd_penyakit', 'left');
		$db_sik->where('rp.no_rawat', $context['no_rawat']);
		
		return $db_sik->get()->row();
	}

	//--------------------------------------------------------------------------------------------

	public function select_diagnosa($keyword)
	{		
		$db_sik = $this->load->database('sik', TRUE);

		if($keyword)
		{
			$db_sik->select('kd_penyakit AS id, concat (kd_penyakit," - ", nm_penyakit) AS text, concat (kd_penyakit," - ", nm_penyakit) AS value');
			$db_sik->from('penyakit');
			$db_sik->where("nm_penyakit LIKE '%$keyword%' OR kd_penyakit LIKE '%$keyword%'");
			$db_sik->order_by('kd_penyakit', 'ASC');
			
			return $db_sik->get()->result();
		}
	}

	public function select_obat($keyword)
	{		
		$db_sik = $this->load->database('sik', TRUE);

		if($keyword)
		{
			$db_sik->select('kode_brng AS id, nama_brng AS text, nama_brng AS value');
			$db_sik->from('databarang');
			$db_sik->where("nama_brng LIKE '%$keyword%'");
			$db_sik->where('status', 1);
			$db_sik->order_by('nama_brng', 'ASC');
			
			return $db_sik->get()->result();
		}
	}

	//--------------------------------------------------------------------------------------------

	public function convert_range_tgl($range)
	{
		$split = explode(' - ', $range);

		if(isset($split[0]))
		{
			$tgl['awal'] = substr($split[0],6,4).'-'.substr($split[0],3,2).'-'.substr($split[0],0,2);
		}
		else $tgl['awal'] = date('Y-m-d');

		if(isset($split[1]))
		{
			$tgl['akhir'] = substr($split[1],6,4).'-'.substr($split[1],3,2).'-'.substr($split[1],0,2);
		}
		else $tgl['akhir'] = date('Y-m-d');

		return $tgl;
	}

	//--------------------------------------------------------------------------------------------

	public function get_notif($name_function)
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