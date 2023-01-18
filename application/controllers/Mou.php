<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mou extends CI_Controller
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

    public function view_surat_mou()
    {
        $data['surat'] = $this->m_surat->get_all_surat_by_id_jenis_surat(4)->result_array();
        $this->load->view('admin/mou', $data);
    }

    public function view_admin_utama_surat_mou()
    {
        $this->load->view('admin_utama/mou');
    }

    public function tambah_surat_mou()
    {
        $perihal = $this->input->post('perihal');
        $nomor_surat = $this->input->post('nomor_surat');
        $keterangan = $this->input->post('keterangan');
        $tanggal_surat = $this->input->post('tanggal_surat');
        $file_lembar_disposisi = '-';
        $nomor_agenda = '-';
        $id_status_surat = '1';
        $id_jenis_surat = '4';
        $file_nota_dinas = '-';
        $id_surat = md5($perihal . $tanggal_surat . $id_jenis_surat . rand(1, 9999));
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
        } else {
            @unlink($path_file_surat . $file_surat['file_name']);
            $this->session->set_flashdata('eror', 'eror');
            redirect('Mou/view_surat_mou');
        }

        $hasil = $this->m_surat->insert_surat($id_surat, $perihal, $nomor_surat, $file_lembar_disposisi, $file_surat['file_name'], $file_nota_dinas, $tanggal_surat, $nomor_agenda, $id_jenis_surat, $id_status_surat, $keterangan, $instansi_pengirim);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Mou/view_surat_mou');

        } else {

            $this->session->set_flashdata('input', 'input');
            redirect('Mou/view_surat_mou');

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
            redirect('Mou/view_surat_mou');

        } else {

            $this->session->set_flashdata('edit', 'edit');
            redirect('Mou/view_surat_mou');

        }
    }

    public function hapus_surat()
    {
        $id_surat = $this->input->post("id_surat");

        $path_file_surat = './assets/file_surat/';

        $hasil = $this->m_surat->delete_surat($id_surat);

        if ($hasil == false) {
            $this->session->set_flashdata('eror', 'eror');
            redirect('Mou/view_surat_mou');
        } else {
            @unlink($path_file_surat . $this->input->post('file_surat_old'));
            $this->session->set_flashdata('delete', 'delete');
            redirect('Mou/view_surat_mou');
        }
    }
}
