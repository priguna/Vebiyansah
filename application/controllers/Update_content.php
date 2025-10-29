<?php

class Update_content extends CI_Controller {

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
		$context  = array('versi' => $this->input->post('versi'));
		
		$data = [
			'list' => $this->input->post('id'),
			'versi' => $this->input->post('versi'),
			'data' => $this->update_content_model->tabel_data_versi($context)
		];

		$this->load->view($this->url_controller.'/form', $data);
	}

	public function form()
	{	
		$this->load->view($this->url_controller.'/form');
	}

	public function add()
	{
		$list = $this->input->post('list');
		$dir = $this->input->post('dir');
		$filename = $this->input->post('filename');

		$url = $dir.'/'.$filename;

		$get_content = file_get_contents($url);

		$context = array(
			'list' => $list,
			'filename' => $filename,
			'dir' => $dir,
			'file_date' => date("Y-m-d H:i:s", filemtime($url)),
			'content' => base64_encode($get_content)
		); 

		$query = $this->update_content_model->add($context);

		echo json_encode($query);
	}	

	public function delete()
	{		
		$context  = array('id' => $this->input->post('id'));
		
		$query = $this->update_content_model->delete($context);

		echo json_encode($query);
	}
}

?>