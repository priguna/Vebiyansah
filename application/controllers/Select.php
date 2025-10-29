<?php

class Select extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('data_simrs_model');
		$this->load->model('select_model');
	}

	public function select_icd10()
	{
		$query = $this->data_simrs_model->select_diagnosa($this->uri->segment(3));

		echo json_encode($query);
	}

	public function select_obat()
	{
		$query = $this->data_simrs_model->select_obat($this->uri->segment(3));

		echo json_encode($query);
	}

	public function select_tindakan()
	{
		$context  = array(
            'order_by' => 'value',
            'keyword' => $this->uri->segment(3)
        );

		$query = $this->data_tindakan_model->select_data_keyword($context);

		echo json_encode($query);
	}
}

?>