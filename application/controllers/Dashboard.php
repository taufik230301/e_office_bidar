<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public function dashboard_admin()
	{
		$this->load->view('admin/dashboard');
	}

    public function dashboard_admin_utama()
	{
		$this->load->view('admin_utama/dashboard');
	}
}
