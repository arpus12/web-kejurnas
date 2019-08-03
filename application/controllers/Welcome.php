<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		$data['title'] = "Dashboard";
		$this->load->view('templates/dashboard_header', $data);
		$this->load->view('dashboard/dashboard');
		$this->load->view('templates/dashboard_footer');
	}
}
