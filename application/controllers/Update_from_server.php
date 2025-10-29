<?php

class Update_from_server extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('directory');

		$this->load->model('update_list_model');
		$this->load->model('update_content_model');
		$this->load->model('update_database_model');

		$this->url_controller = $this->uri->segment(1);
	}

	public function index()
	{	
		$context = $this->input->post();

		$versi_old = $context['versi'];

		if(!isset($context['mode'])) $context['mode'] = 'all';

		if($context['mode'] == 'all')
		{
			$get_data = (array) $this->update_list_model->lihat_data_last($context);

			if(!empty($get_data))
			{
				$context = array('list' => $get_data['id'], 'versi' => $versi_old); 

				$get_content = $this->update_content_model->tabel_data_file($context);

				$get_database = $this->update_database_model->tabel_data_update($context);

				$data = array(
					'eror' => 'success', 
					'versi' => $get_data['versi'],
					'content' => $get_content,
					'database' => $get_database
				);
			}
			else $data = array(
				'eror' => 'warning', 
				'pesan' => 'Sudah terupdate versi terbaru',
				'content' => 0,
				'database' => 0
			);
		}
		else if($context['mode'] == 'file_all')
		{
			$context = array('versi' => $this->input->post('versi')); 

			$data = array(
				'eror' => 'success', 
				'versi' => $this->input->post('versi'),
				'content' => $this->update_content_model->tabel_data_versi_all($context),
				'database' => array()
			);
		}
		else
		{
			$context = array('versi' => $this->input->post('versi')); 

			$data = array(
				'eror' => 'success', 
				'versi' => $this->input->post('versi'),
				'content' => $this->update_content_model->tabel_data_versi($context),
				'database' => array()
			);
		}

		echo json_encode($data);
	}

	public function content()
	{
		$data = array(
			'eror' => 'success', 
			'versi' => $this->input->post('versi'),
			'content' => $this->update_content_model->lihat_data($context),
			'database' => array()
		);

		echo json_encode($data);
	}
}

?>