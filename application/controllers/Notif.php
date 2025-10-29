<?php

//----------------------------------------------------------> login

	public function proses_login() 
	{ 
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$query = $this->login_model->cek_user($username, $password); 
		echo json_encode($query);
	} 

	public function logout()
	{
		$this->login_model->logout();
		redirect(base_url());
	}

?>