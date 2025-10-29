<?php

class Data_pembiayaan_pasien_model extends CI_Model {

	private $_error = "";
	private $_table_name = "pembiayaan_pasien";
	private $_table_sql = "pembiayaan_pasien p_p";	

	public function tabel_data($context)
	{		
		$keyword = $context['keyword'];
		$limit = $context['limit'];
		$start = $context['start'];

		$this->db->select('p_p.*');
		$this->db->from($this->_table_sql);

		if($keyword != "") $this->db->where("(p_p.nm_pasien LIKE '%$keyword%' OR p_p.no_rkm_medis LIKE '%$keyword%' OR p_p.no_rawat LIKE '%$keyword%')");

		$this->db->order_by('p_p.tgl_pengajuan', 'ASC');		
		$this->db->limit($limit, $start);

		return $this->db->get()->result();
	}

	public function jml_data($context)
	{
		$keyword = $context['keyword'];

		$this->db->select('p_p.*');
		$this->db->from($this->_table_sql);

		if($keyword != "") $this->db->where("(p_p.nm_pasien LIKE '%$keyword%' OR p_p.no_rkm_medis LIKE '%$keyword%' OR p_p.no_rawat LIKE '%$keyword%')");

		return $this->db->get()->num_rows();
	}

	public function tabel_rekap_internal($context)
	{		
		$bulan = $context['bulan'];
		$tahun = $context['tahun'];

		$this->db->select('p_p.*');
		$this->db->from($this->_table_sql);
		$this->db->where('YEAR(p_p.tgl_pengajuan)', $tahun);
		$this->db->where('p_p.user_verifikasi_direktur IS NOT NULL');

		if($bulan != 'all') $this->db->where('MONTH(p_p.tgl_pengajuan)', $bulan);

		$this->db->order_by('p_p.tgl_pengajuan', 'ASC');	

		return $this->db->get()->result();
	}

	public function tabel_rekap($context)
	{		
		$bulan = $context['bulan'];
		$tahun = $context['tahun'];

		$this->db->select('p_p.*');
		$this->db->from($this->_table_sql);
		$this->db->where('YEAR(p_p.tgl_pengajuan)', $tahun);
		$this->db->where('p_p.user_verifikasi_direktur IS NOT NULL');
		$this->db->where('p_p.pembiayaan_kasir != ""');

		if($bulan != 'all') $this->db->where('MONTH(p_p.tgl_pengajuan)', $bulan);

		$this->db->order_by('p_p.tgl_pengajuan', 'ASC');	

		return $this->db->get()->result();
	}

	public function jml_rekap($context)
	{
		$bulan = $context['bulan'];
		$tahun = $context['tahun'];

		$this->db->select('p_p.*');
		$this->db->from($this->_table_sql);
		$this->db->where('YEAR(p_p.tgl_pengajuan)', $tahun);
		$this->db->where('p_p.user_verifikasi_direktur IS NOT NULL');
		$this->db->where('p_p.pembiayaan_kasir != ""');

		if($bulan != 'all') $this->db->where('MONTH(p_p.tgl_pengajuan)', $bulan);

		return $this->db->get()->num_rows();
	}

	public function lihat_data($context)
	{
		$id =  $context['id'];
		
		$this->db->select('p_p.*');
		$this->db->from($this->_table_sql);	

		$this->db->where('p_p.id', $id);
		
		return $this->db->get()->row();
	}

	public function lihat_data_no_rawat($context)
	{
		$no_rawat =  $context['no_rawat'];

		$this->db->select('
			p_p.*, 
			d_u_1.nama AS user_verifikasi_1_value,
			d_u_2.nama AS user_verifikasi_2_value,
			d_u_4.nama AS user_verifikasi_direktur_value
			');
		$this->db->from($this->_table_sql);		
		$this->db->join('data_user d_u_1', 'd_u_1.id=p_p.user_verifikasi_1', 'left');
		$this->db->join('data_user d_u_2', 'd_u_2.id=p_p.user_verifikasi_2', 'left');
		$this->db->join('data_user d_u_4', 'd_u_4.id=p_p.user_verifikasi_direktur', 'left');
		
		$this->db->where('p_p.no_rawat', $no_rawat);
		
		return $this->db->get()->row();
	}

	public function tambah_data()
	{	
		$this->id = '';	
		$this->kelayakan = '';	
		$this->identifikasi = '';
		$this->diagnosa = '';	
		$this->asal_rujukan = '';
		$this->tgl_pengajuan = date('Y-m-d');

		return $this;
	}

	public function add_data($context)
	{
		$this->no_rawat = $context['no_rawat'];
		$this->asal_rujukan = $context['asal_rujukan'];
		$this->tgl_pengajuan = $context['tgl_pengajuan'];
		$this->no_rkm_medis = $context['no_rkm_medis'];
		$this->nm_pasien = $context['nm_pasien'];
		$this->no_ktp = $context['no_ktp'];
		$this->jk = $context['jk'];
		$this->tmp_lahir = $context['tmp_lahir'];
		$this->tgl_lahir = $context['tgl_lahir'];
		$this->alamat = $context['alamat'];
		$this->pekerjaan = $context['pekerjaan'];
		$this->no_tlp = $context['no_tlp'];
		$this->umur = $context['umur'];
		$this->pnd = $context['pnd'];
		$this->no_peserta = $context['no_peserta'];
		$this->kelayakan = $context['kelayakan'];
		$this->identifikasi = $context['identifikasi'];	
		$this->diagnosa = $context['diagnosa'];		

		if(isset($context['tidak_mampu'])){ $this->tidak_mampu = "1"; } else $this->tidak_mampu = "0"; 

		if(isset($context['tidak_punya_bpjs'])){ $this->tidak_punya_bpjs = "1"; } else $this->tidak_punya_bpjs = "0"; 

		if(isset($context['bpjs_mandiri_off'])){ $this->bpjs_mandiri_off = "1"; } else $this->bpjs_mandiri_off = "0"; 

		if(isset($context['bpjs_pbi_off'])){ $this->bpjs_pbi_off = "1"; } else $this->bpjs_pbi_off = "0"; 

		$this->user_mpp = $this->session->userdata('user_id_'._PREFIX_);
		$this->created_date = date('Y-m-d H:i:s');

		$query = $this->db->insert($this->_table_name, $this);

		if($query)
		{
			$id = $this->db->insert_id();

			if(isset($context['files_id']))
			{
				for ($i=0; $i < sizeof($context['files_id']); $i++) 
				{ 
					if($context['act_files'][$i] == 'baru')
					{
						$file_name = 'dokumen-'.$context['files_id'][$i];
						$input = 'files_'.$context['files_id'][$i]; 

						$url = $this->_uploadFile($input, $file_name);

						$array_insert = array(
							'keterangan' => $context['keterangan'][$i],
							'url' => $url,
							'pembiayaan_pasien_id' => $id,
							'created_date' => date('Y-m-d H:i:s')
						); 

						$query = $this->db->insert('pembiayaan_pasien_files', $array_insert);
					}				
				}
			}
		}

		if(!$query) $this->_error .= '<br> '.$this->mysql_get_error(); 

		if($this->_error == '')
		{
			$notif = array('eror' => 'success', 'pesan' => 'Tambah data berhasil');
		}
		else 
		{	
			$notif = array('eror' => 'warning', 'pesan' => $this->_error);
		}

		return $notif;
	}

	public function update_data($context)
	{		
		if($context['update'] == 'verifikasi_mpp')
		{	
			$this->kelayakan = $context['kelayakan'];
			$this->identifikasi = $context['identifikasi'];

			if(isset($context['tidak_mampu'])){ $this->tidak_mampu = "1"; } else $this->tidak_mampu = "0"; 

			if(isset($context['tidak_punya_bpjs'])){ $this->tidak_punya_bpjs = "1"; } else $this->tidak_punya_bpjs = "0"; 

			if(isset($context['bpjs_mandiri_off'])){ $this->bpjs_mandiri_off = "1"; } else $this->bpjs_mandiri_off = "0"; 

			if(isset($context['bpjs_pbi_off'])){ $this->bpjs_pbi_off = "1"; } else $this->bpjs_pbi_off = "0"; 

			$id = $context['id'];

			if(isset($context['files_id']))
			{
				for ($i=0; $i < sizeof($context['files_id']); $i++) 
				{ 
					if($context['act_files'][$i] == 'baru')
					{
						$file_name = 'dokumen-'.$context['files_id'][$i];
						$input = 'files_'.$context['files_id'][$i]; 

						$url = $this->_uploadFile($input, $file_name);

						$array_insert = array(
							'keterangan' => $context['keterangan'][$i],
							'url' => $url,
							'pembiayaan_pasien_id' => $id,
							'created_date' => date('Y-m-d H:i:s')
						); 

						$query = $this->db->insert('pembiayaan_pasien_files', $array_insert);
					}

					if($context['act_files'][$i] == 'update')
					{
						$array_update = array(
							'keterangan' => $context['keterangan'][$i]
						); 

						$query = $this->db->where('id',$context['files_id'][$i])->update('pembiayaan_pasien_files', $array_update);
					}		

					if($context['act_files'][$i] == 'hapus')
					{
						if(file_exists($context['files_url'][$i])) unlink($context['files_url'][$i]);

						$query = $this->db->where('id',$context['files_id'][$i])->delete('pembiayaan_pasien_files');
					}				
				}				
			}
		}

		if($context['update'] == 'verifikasi_tahap_1')
		{			
			$this->estimasi_beban_biaya = $context['estimasi_beban_biaya'];	
			
			$this->tgl_verifikasi_1 = date('Y-m-d H:i:s');
			$this->user_verifikasi_1 = $context['id'];	
		}

		if($context['update'] == 'verifikasi_tahap_2')
		{			
			$this->jenis_pembiayaan = implode(';', $context['jenis_pembiayaan']);

			$this->tgl_verifikasi_2 = date('Y-m-d H:i:s');
			$this->user_verifikasi_2 = $context['id'];	
		}

		if($context['update'] == 'verifikasi_tahap_direktur')
		{			
			$this->jenis_pembiayaan = implode(';', $context['jenis_pembiayaan']);

			$this->tgl_verifikasi_direktur = date('Y-m-d H:i:s');
			$this->user_verifikasi_direktur = $context['id'];	
		}

		if($context['update'] == 'verifikasi_tahap_kasir')
		{			
			$this->pembiayaan_kasir = $context['pembiayaan_kasir'];

			if($context['url_nota_old'] != '' && file_exists($context['url_nota_old'])) unlink($context['url_nota_old']);

			$this->url_nota = $this->_uploadFile('url_nota', 'nota_'.date('YmdHis'));
		}

		$query = $this->db->where('no_rawat', $context['no_rawat'])->update($this->_table_name, $this);

		if(!$query) $this->_error .= '<br> '.$this->mysql_get_error(); 

		if($this->_error == '')
		{
			$notif = array('eror' => 'success', 'pesan' => 'Update data berhasil');
		}
		else $notif = array('eror' => 'warning', 'pesan' => $this->_error);

		return $notif;
	}

	public function delete_data($context)
	{
		$id = $context['id'];

		$files = $this->db->where('pembiayaan_pasien_id', $id)->get('pembiayaan_pasien_files')->result();

		foreach ($files as $key) 
		{
			unlink($key->url);
		}

		$query = $this->db->where('id', $id)->delete($this->_table_name);

		if(!$query) $this->_error .= '<br> '.$this->mysql_get_error();

		if($this->_error == '')
		{
			$notif = array('eror' => 'success', 'pesan' => 'Delete data berhasil');
		}
		else $notif = array('eror' => 'warning', 'pesan' => $this->_error);

		return $notif;
	}

	//--------------------------------------------------------------------------------------------

	public function select_tahun()
	{	
		$this->db->select('YEAR(p_p.tgl_pengajuan) AS id, YEAR(p_p.tgl_pengajuan) AS value');
		$this->db->from($this->_table_sql);
		$this->db->group_by('YEAR(p_p.tgl_pengajuan)');
		
		return $this->db->get()->result();
	}

	//--------------------------------------------------------------------------------------------

	private function _uploadFile($input, $filename)
	{
		$upload_path = './_pembiayaan_pasien/';

		if(!file_exists($upload_path)) mkdir($upload_path, 0777, true);

		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['file_name'] = $filename;
		$config['overwrite'] = true;
		$config['max_size'] = 5024;

		$this->upload->initialize($config);
		$this->load->library('upload', $config);

		if($this->upload->do_upload($input)) {
			return $upload_path.''.$this->upload->data('file_name');
		} else print_r($this->upload->display_errors());
	}

	//--------------------------------------------------------------------------------------------

	public function mysql_get_error()
	{
		$error = $this->db->error();

		switch ($error['code']) 
		{
			case '1062':
			$error_detail = 'Data sudah ada';
			break;

			default:
			$error_detail = "$error[code]: $error[message]";
			break;
		}

		return $error_detail;		
	}
}	