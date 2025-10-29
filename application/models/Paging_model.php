<?php

class Paging_model extends CI_Model {

	public function get($jml_data, $limit, $url, $id)
	{
		$config['base_url'] 	= site_url($url);
		$config['total_rows'] 	= $jml_data;
		$config['per_page'] 	= $limit;
		$config['uri_segment'] 	= 3;
		$config['num_links'] 	= 2;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = '»';
		$config['prev_link']        = '«';

		$config['full_tag_open']    = '<nav style="float: right" id="'.$id.'"><ul class="pagination pagination-md no-margin">';
		$config['full_tag_close']   = '</ul></nav>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);   
		return $this->pagination->create_links();
	}

}	