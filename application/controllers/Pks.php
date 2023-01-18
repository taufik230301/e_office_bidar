<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pks extends CI_Controller {

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

	public function  view_surat_pks()
	{
		$data['surat'] = $this->m_surat->get_all_surat_by_id_jenis_surat(5)->result_array();
		$this->load->view('admin/pks', $data);
	}

   
    public function view_admin_utama_surat_pks()
	{
		$this->load->view('admin_utama/pks');
	}

	public function tambah_surat_pks()
	{
		$perihal = $this->input->post('perihal');
		$nomor_surat = $this->input->post('nomor_surat');
		$keterangan = $this->input->post('keterangan');
        $tanggal_surat = $this->input->post('tanggal_surat');
		$file_lembar_disposisi = '-';
		$nomor_agenda = '-';
		$id_status_surat = '1';
        $id_jenis_surat = '5';
		$file_nota_dinas = '-';
		$id_surat = md5($perihal . $tanggal_surat . $id_jenis_surat. rand(1, 9999));
        $file_name = md5($perihal . $tanggal_surat . rand(1, 9999));
        $instansi_pengirim = '-';

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
			@unlink($path_file_surat . $file_surat['file_name']);
			$this->session->set_flashdata('eror', 'eror');
            redirect('Pks/view_surat_pks');
		}

        $hasil = $this->m_surat-> insert_surat($id_surat, $perihal, $nomor_surat, $file_lembar_disposisi,  $file_surat['file_name'], $file_nota_dinas, $tanggal_surat, $nomor_agenda, $id_jenis_surat, $id_status_surat, $keterangan, $instansi_pengirim);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Pks/view_surat_pks');

        } else {

            $this->session->set_flashdata('input', 'input');
            redirect('Pks/view_surat_pks');

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
            redirect('Pks/view_surat_pks');
        }

        $hasil = $this->m_surat->update_file_surat($id_surat, $file_surat['file_name']);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Pks/view_surat_pks');

        } else {
            @unlink($path_file_surat . $this->input->post('file_surat_old'));
            $this->session->set_flashdata('edit', 'edit');
            redirect('Pks/view_surat_pks');

        }
    }

	public function edit_surat()
    {
        $perihal = $this->input->post('perihal');
        $nomor_surat = $this->input->post('nomor_surat');
        $id_surat = $this->input->post('id_surat');
        $tanggal_surat = $this->input->post('tanggal_surat');
        $keterangan = $this->input->post('keterangan');

        $hasil = $this->m_surat->ubah_surat_all($id_surat, $perihal, $nomor_surat, $tanggal_surat, $keterangan);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Pks/view_surat_pks');

        } else {

            $this->session->set_flashdata('edit', 'edit');
            redirect('Pks/view_surat_pks');

        }
    }

	public function hapus_surat()
    {
        $id_surat = $this->input->post("id_surat");

        $path_file_surat = './assets/file_surat/';

        $hasil = $this->m_surat->delete_surat($id_surat);

        if ($hasil == false) {
            $this->session->set_flashdata('eror', 'eror');
            redirect('Pks/view_surat_pks');
        } else {
            @unlink($path_file_surat . $this->input->post('file_surat_old'));
            $this->session->set_flashdata('delete', 'delete');
            redirect('Pks/view_surat_pks');
        }
    }
}
