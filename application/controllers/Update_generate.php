<?php

class Update_generate extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('directory');

		if($this->session->userdata('class_'._PREFIX_) == null){    
			redirect(base_url('login'));
		}

		$this->load->model('update_list_model');
		$this->load->model('update_content_model');

		$this->load->model('asset_menu_class_model');
		$this->load->model('paging_model');				
		$this->load->model('select_model');		

		$this->url_controller = $this->uri->segment(1);
		$this->navigation = $this->session->userdata('nav_'._PREFIX_);
	}

	public function index()
	{	
		$context = $this->input->post();

		$i = 0;			
		$data = array();

		$get_data = (array) $this->update_list_model->lihat_data($context);

		$dir_update = ['controllers', 'models', 'views'];

		foreach ($dir_update as $key) 
		{
			$map = directory_map('./application/'.$key, FALSE, TRUE);

			foreach ($map as $key2 => $value) 
			{
				if(!is_array($value))
				{
					$url = './application/'.$key.'/'.$value;

					if($url != './application/controllers/Update.php' 
						&& $url != './application/controllers/Update.php' 
						&& $url != './application/controllers/Update_generate.php' 
						&& $url != './application/controllers/Update_from_server.php'
						&& $url != './application/models/Update_content_model.php' 
						&& $url != './application/models/Update_list_model.php'
					)
					{					
						$data[$i]['list'] = $context['id'];
						$data[$i]['versi'] = $get_data['versi'];
						$data[$i]['tgl'] = $get_data['tgl'];
						$data[$i]['dir'] = './application/'.$key;
						$data[$i]['filename'] = $value;
						$data[$i]['file_date'] = date("Y-m-d H:i:s", filemtime($url));

						$i++;					
					}
				}	
				else
				{ 
					foreach ($value as $key3) 
					{
						$key2 = $key2.'-';

						if(!is_array($key3)) 
						{
							$dir = './application/'.$key.'/'.str_replace('-', '', str_replace('\-', '', $key2));

							$url = $dir.'/'.$key3;

							if($dir != './application/views/update')
							{
								$data[$i]['list'] = $context['id'];
								$data[$i]['versi'] = $get_data['versi'];
								$data[$i]['tgl'] = $get_data['tgl'];
								$data[$i]['dir'] = $dir;
								$data[$i]['filename'] = $key3;
								$data[$i]['file_date'] = date("Y-m-d H:i:s", filemtime($url));

								$i++;
							}
						}
					}
				}
			}
		}

		$context = ['list' => $this->input->post('id')];

		// $delete_list = $this->update_content_model->delete_list($context);

		echo json_encode($data);
	}

	public function form()
	{	
		$this->load->view($this->url_controller.'/form');
	}

	public function execute_update_generate()
	{
		$context = $this->input->post();

		$cek_file = $this->update_content_model->lihat_data_by_url($context);

		if(empty($cek_file))
		{							
			$this->add($context['list'], $context['dir'], $context['filename']);

			echo '<td>'.$context['filename'].'</td><td>'.$context['dir'].'</td><td>'.$context['versi'].'</td><td>'.$context['file_date'].'</td><td>ADD</td>';
		}
		else
		{
			$url = $context['dir'].'/'.$context['filename'];

			$file_date = date("Y-m-d H:i:s", filemtime($url));

			if(strtotime($file_date) > strtotime($cek_file->file_date))
			{
				$this->update($cek_file->id, $context['list'], $context['dir'], $context['filename']);

				echo '<td>'.$context['filename'].'</td><td>'.$context['dir'].'</td><td>'.$context['versi'].'</td><td>'.$context['file_date'].'</td><td>UPDATE</td>';
			}
			else echo '<td>'.$context['filename'].'</td><td>'.$context['dir'].'</td><td>'.$context['versi'].'</td><td>'.$context['file_date'].'</td><td>ALREADY</td>';
		}

	}

	public function add($list, $dir, $filename)
	{
		$url = $dir.'/'.$filename;

		$get_content = file_get_contents($url);

		if($url == './application/views/data_pendaftaran/form.php' || $url == './application/views/data_pemeriksaan/form.php')
		{
			$empty = '';

			$enkripsi = base64_encode(gzdeflate(substr($get_content,5)));

			$desripsi = gzinflate(base64_decode($enkripsi));

			$get_content = '<'.$empty.'?php $prog="'.$enkripsi.'"; $rand=base64_decode("'.base64_encode('$descript = gzinflate(base64_decode($prog)); eval($descript);').'"); eval($rand); $stop="'.base64_encode(date('Y-m-d H:i:s')).'"; ?'.$empty.'>';
		}

		$context = array(
			'list' => $list,
			'filename' => $filename,
			'dir' => $dir,
			'file_date' => date("Y-m-d H:i:s", filemtime($url)),
			'content' => base64_encode($get_content)
		);

		$query = $this->update_content_model->add($context);
	}	

	public function update($id, $list, $dir, $filename)
	{
		$url = $dir.'/'.$filename;

		$get_content = file_get_contents($url);

		if($url == './application/views/data_pendaftaran/form.php' || $url == './application/views/data_pemeriksaan/form.php')
		{
			$empty = '';

			$enkripsi = base64_encode(gzdeflate(substr($get_content,5)));

			$desripsi = gzinflate(base64_decode($enkripsi));

			$get_content = '<'.$empty.'?php $prog="'.$enkripsi.'"; $rand=base64_decode("'.base64_encode('$descript = gzinflate(base64_decode($prog)); eval($descript);').'"); eval($rand); $stop="'.base64_encode(date('Y-m-d H:i:s')).'"; ?'.$empty.'>';
		}

		$context = array(
			'id' => $id,
			'list' => $list,
			'filename' => $filename,
			'dir' => $dir,
			'file_date' => date("Y-m-d H:i:s", filemtime($url)),
			'content' => base64_encode($get_content)
		);

		$query = $this->update_content_model->update($context);
	}	
}

?>