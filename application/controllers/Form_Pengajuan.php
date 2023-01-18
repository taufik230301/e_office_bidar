<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_Pengajuan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in') == true) {
            $this->load->model('m_user');
			$this->load->model('m_surat');
        } else {
            $this->session->set_flashdata('loggin_err_no_session', 'Sesi Anda Habis !');
            redirect('Login/login_view');
        }
    }

    public function view_pengajuan_surat()
    {
        $this->load->view('admin/pengajuan_surat');
    }

    public function tambahkan_surat()
    {
        $perihal = $this->input->post('perihal');
		$nomor_surat = '-';
		$file_lembar_disposisi = '-';
		$nomor_agenda = '-';
		$id_status_surat = '1';
        $tanggal_surat = $this->input->post('tanggal_surat');
        $id_jenis_surat = $this->input->post('id_jenis_surat');
		$keterangan = $this->input->post('keterangan');
        $instansi_pengirim = '-';

        // echo var_dump($perihal);
        // echo var_dump($tanggal_surat);
        // echo var_dump($id_jenis_surat);
        // die();
		$id_surat = md5($perihal . $tanggal_surat . $id_jenis_surat. rand(1, 9999));
        $file_name = md5($perihal . $tanggal_surat . rand(1, 9999));

        $path_file_surat = './assets/file_surat/';

        $this->load->library('upload');
        $config['upload_path'] = './assets/file_surat';
        $config['allowed_types'] = 'docx|pdf|doc';
        $config['max_size'] = '20480'; //2MB max
        $config['max_width'] = '44800'; // pixel
        $config['max_height'] = '44800'; // pixel
        $config['file_name'] = $file_name . '_file_surat';
        $this->upload->initialize($config);
        $file_surat_upload = $this->upload->do_upload('file_surat');

		if ($file_surat_upload) {
			$file_surat = $this->upload->data();
		}else{
			$this->session->set_flashdata('eror', 'eror');
            redirect('Form_Pengajuan/view_pengajuan_surat');
		} 

        $path_nota_dinas = './assets/file_nota_dinas/';

        $this->load->library('upload');
        $config['upload_path'] = './assets/file_nota_dinas';
        $config['allowed_types'] = 'docx|pdf|doc';
        $config['max_size'] = '20480'; //2MB max
        $config['max_width'] = '44800'; // pixel
        $config['max_height'] = '44800'; // pixel
        $config['file_name'] = $file_name . '_file_nota_dinas';
        $this->upload->initialize($config);
        $file_nota_dinas_upload = $this->upload->do_upload('file_nota_dinas');

		if ($file_nota_dinas_upload) {
			$file_nota_dinas = $this->upload->data();
		}else{
			@unlink($path_file_surat . $file_surat['file_name']);
			$this->session->set_flashdata('eror', 'eror');
            redirect('Form_Pengajuan/view_pengajuan_surat');
		}

        $hasil = $this->m_surat-> insert_surat($id_surat, $perihal, $nomor_surat, $file_lembar_disposisi,  $file_surat['file_name'], $file_nota_dinas['file_name'], $tanggal_surat, $nomor_agenda, $id_jenis_surat, $id_status_surat, $keterangan, $instansi_pengirim);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Form_Pengajuan/view_pengajuan_surat');

        } else {

            $this->session->set_flashdata('input', 'input');
            redirect('Form_Pengajuan/view_pengajuan_surat');

        }
    }

}
