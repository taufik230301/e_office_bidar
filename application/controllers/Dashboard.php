<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
		parent::__construct();

		if($this->session->userdata('logged_in') == true){
			$this->load->model('m_user');
			$this->load->model('m_surat');
		}else{
			$this->session->set_flashdata('loggin_err_no_session', 'Sesi Anda Habis !');
			redirect('Login/login_view');
		} 
    }

	public function dashboard_admin()
	{
		$data['surat_naik'] = $this->m_surat->count_all_surat_by_id_jenis_surat(1)->row_array();
		$data['surat_keluar'] = $this->m_surat->count_all_surat_by_id_jenis_surat(2)->row_array();
		$data['surat_masuk'] = $this->m_surat->count_all_surat_by_id_jenis_surat(3)->row_array();
		$data['surat_mou'] = $this->m_surat->count_all_surat_by_id_jenis_surat(4)->row_array();
		$data['surat_pks'] = $this->m_surat->count_all_surat_by_id_jenis_surat(5)->row_array();
		$this->load->view('admin/dashboard', $data);
	}

    public function dashboard_admin_utama()
	{
		$data['surat_naik'] = $this->m_surat->count_all_surat_by_id_jenis_surat_and_id_status_surat(1, 1)->row_array();
		$data['surat_keluar'] = $this->m_surat->count_all_surat_by_id_jenis_surat_and_id_status_surat(2, 1)->row_array();
		$this->load->view('admin_utama/dashboard', $data);
	}
}
