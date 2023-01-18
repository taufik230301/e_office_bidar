<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_Masuk extends CI_Controller {

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

	public function  view_surat_masuk()
	{
		$data['surat'] = $this->m_surat->get_all_surat_by_id_jenis_surat(3)->result_array();
		$this->load->view('admin/surat_masuk', $data);
	}

    public function  view_admin_utama_surat_masuk()
	{
		$this->load->view('admin_utama/surat_masuk');
	}

	public function tambahkan_surat()
    {
        $perihal = $this->input->post('perihal');
		$nomor_surat = $this->input->post('nomor_surat');
		$file_nota_dinas = '-';
		$nomor_agenda = $this->input->post('nomor_agenda');
		$id_status_surat = '1';
        $tanggal_surat = $this->input->post('tanggal_surat');
        $id_jenis_surat = '3';
		$keterangan = $this->input->post('keterangan');
		$instansi_pengirim = $this->input->post('instansi_pengirim');

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
            redirect('Surat_Masuk/view_surat_masuk');
		} 

        $path_lembar_disposisi = './assets/file_lembar_disposisi/';

        $this->load->library('upload');
        $config['upload_path'] = './assets/file_lembar_disposisi';
        $config['allowed_types'] = 'docx|pdf|doc';
        $config['max_size'] = '20480'; //2MB max
        $config['max_width'] = '44800'; // pixel
        $config['max_height'] = '44800'; // pixel
        $config['file_name'] = $file_name . '_file_lembar_disposisi';
        $this->upload->initialize($config);
        $file_lembar_disposisi_upload = $this->upload->do_upload('file_lembar_disposisi');

		if ($file_lembar_disposisi_upload) {
			$file_lembar_disposisi = $this->upload->data();
		}else{
			@unlink($path_file_surat . $file_surat['file_name']);
			$this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Masuk/view_surat_masuk');
		}

        $hasil = $this->m_surat-> insert_surat($id_surat, $perihal, $nomor_surat, $file_lembar_disposisi['file_name'],  $file_surat['file_name'],  $file_nota_dinas , $tanggal_surat, $nomor_agenda, $id_jenis_surat, $id_status_surat, $keterangan, $instansi_pengirim);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Masuk/view_surat_masuk');

        } else {

            $this->session->set_flashdata('input', 'input');
            redirect('Surat_Masuk/view_surat_masuk');

        }
    }

    public function edit_file_surat()
    {
        $id_surat = $this->input->post('id_surat');
        $file_name = md5($id_surat . rand(1, 9999));

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
        } else {
            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Masuk/view_surat_masuk');
        }

        $hasil = $this->m_surat->update_file_surat($id_surat, $file_surat['file_name']);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Masuk/view_surat_masuk');

        } else {
            @unlink($path_file_surat . $this->input->post('file_surat_old'));
            $this->session->set_flashdata('edit', 'edit');
            redirect('Surat_Masuk/view_surat_masuk');

        }
    }

    public function edit_file_lembar_disposisi()
    {
        $id_surat = $this->input->post('id_surat');
        $file_name = md5($id_surat . rand(1, 9999));

        $path_file_lembar_disposisi = './assets/file_lembar_disposisi/';

        $this->load->library('upload');
        $config['upload_path'] = './assets/file_lembar_disposisi';
        $config['allowed_types'] = 'docx|pdf|doc';
        $config['max_size'] = '20480'; //2MB max
        $config['max_width'] = '44800'; // pixel
        $config['max_height'] = '44800'; // pixel
        $config['file_name'] = $file_name . '_file_lembar_disposisi';
        $this->upload->initialize($config);
        $file_lembar_disposisi_upload = $this->upload->do_upload('file_lembar_disposisi');

        if ($file_lembar_disposisi_upload) {
            $file_lembar_disposisi = $this->upload->data();
        } else {
            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Masuk/view_surat_masuk');
        }

        $hasil = $this->m_surat->update_file_lembar_disposisi($id_surat, $file_lembar_disposisi['file_name']);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Masuk/view_surat_masuk');

        } else {
            @unlink($path_file_lembar_disposisi . $this->input->post('file_lembar_disposisi_old'));
            $this->session->set_flashdata('edit', 'edit');
            redirect('Surat_Masuk/view_surat_masuk');

        }
    }

    public function edit_surat()
    {
        $perihal = $this->input->post('perihal');
        $nomor_surat = $this->input->post('nomor_surat');
        $id_surat = $this->input->post('id_surat');
        $tanggal_surat = $this->input->post('tanggal_surat');
        $instansi_pengirim = $this->input->post('instansi_pengirim');
        $keterangan = $this->input->post('keterangan');

        $hasil = $this->m_surat->ubah_surat_masuk($id_surat, $perihal, $nomor_surat, $tanggal_surat, $instansi_pengirim, $keterangan);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Masuk/view_surat_masuk');

        } else {

            $this->session->set_flashdata('edit', 'edit');
            redirect('Surat_Masuk/view_surat_masuk');

        }
    }

    public function hapus_surat()
    {
        $id_surat = $this->input->post("id_surat");

        $path_file_surat = './assets/file_surat/';
        $path_file_lembar_disposisi = './assets/file_lembar_disposisi/';

        $hasil = $this->m_surat->delete_surat($id_surat);

        if ($hasil == false) {
            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Masuk/view_surat_masuk');
        } else {
            @unlink($path_file_lembar_disposisi . $this->input->post('file_lembar_disposisi_old'));
            @unlink($path_file_surat . $this->input->post('file_surat_old'));
            $this->session->set_flashdata('delete', 'delete');
            redirect('Surat_Masuk/view_surat_masuk');
        }
    }
   
}
