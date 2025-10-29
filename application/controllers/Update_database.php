<?php

class Update_database extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('directory');

		if($this->session->userdata('class_'._PREFIX_) == null){    
			redirect(base_url('login'));
		}

		$this->load->model('update_list_model');
		$this->load->model('update_database_model');

		$this->load->model('asset_menu_class_model');
		$this->load->model('paging_model');				
		$this->load->model('select_model');		

		$this->url_controller = $this->uri->segment(1);
		$this->navigation = $this->session->userdata('nav_'._PREFIX_);
	}

	public function index()
	{	
		$context = array('list' => $this->input->post('id'));

		$data =	[
			'list' => $this->input->post('id'),
			'data' => (array) $this->update_database_model->tabel_data($context)
		];

		$this->load->view($this->url_controller.'/form', $data);
	}

	public function execute_update_generate()
	{
		$context = $this->input->post();

		$this->add($context['list'], $context['dir'], $context['filename']);

		echo '<td>'.$context['filename'].'</td><td>'.$context['dir'].'</td><td>'.$context['versi'].'</td><td>'.$context['tgl'].'</td><td>OK</td>';
	}

	public function add()
	{		
		$context = $this->input->post();

		$query = $this->update_database_model->add($context);
		echo json_encode($query);
	}	

	public function delete()
	{		
		$context  = array('id' => $this->input->post('id'));
		
		$query = $this->update_database_model->delete($context);
		echo json_encode($query);
	}
}

?>