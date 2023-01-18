<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
    }
	
	public function login_view()
	{
		$this->load->view('login');
	}

  
	public function login_process()
	{
		$username = $this->input->post('username');
        $password = $this->input->post('password');

		$user = $this->m_user->cek_login($username);

        $get_user = $user->num_rows();

        if ($get_user > 0) {

            $user = $user->row_array();

            if ($user['password'] == $password) {

                if ($user['id_user_level'] == 1) {

                    $this->session->set_userdata('logged_in', true);
                    $this->session->set_userdata('id_user', $user['id_user']);
                    $this->session->set_userdata('username', $user['username']);

                    $this->session->set_flashdata('success_login', 'Login Berhasil !');
                    redirect('Dashboard/dashboard_admin');

                } elseif ($user['id_user_level'] == 2) {

                    $this->session->set_userdata('logged_in', true);
                    $this->session->set_userdata('id_user', $user['id_user']);
                    $this->session->set_userdata('username', $user['username']);

                    $this->session->set_flashdata('success_login', 'Login Berhasil !');
                    redirect('Dashboard/dashboard_admin_utama');

                } else {
                    $this->session->set_flashdata('loggin_err_no_access', 'Anda Tidak Memiliki Hak Akses !');
                    redirect('Login/login_view');
                }

            } else {

                $this->session->set_flashdata('loggin_err_no_pass', 'Password Anda Salah !');
                redirect('Login/login_view');

            }

        } else {

            $this->session->set_flashdata('loggin_err_no_user', 'Anda Belum Terdaftar, Silahkan Register !');
            redirect('Login/login_view');

        }

	}
    public function log_out_process()
    {
        $this->session->sess_destroy();
        redirect('Login/login_view');
    }
}
