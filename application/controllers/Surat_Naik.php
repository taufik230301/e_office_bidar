<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_Naik extends CI_Controller
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

    public function view_surat_naik()
    {
        $data['surat'] = $this->m_surat->get_all_surat_by_id_jenis_surat(1)->result_array();
        $this->load->view('admin/surat_naik', $data);
    }

    public function edit_file_nota_dinas()
    {
        $id_surat = $this->input->post('id_surat');
        $file_name = md5($id_surat . rand(1, 9999));

        $path_file_nota_dinas = './assets/file_nota_dinas/';

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
        } else {
            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Naik/view_surat_naik');
        }

        $hasil = $this->m_surat->update_file_nota_dinas($id_surat, $file_nota_dinas['file_name']);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Naik/view_surat_naik');

        } else {
            @unlink($path_file_nota_dinas . $this->input->post('file_nota_dinas_old'));
            $this->session->set_flashdata('edit', 'edit');
            redirect('Surat_Naik/view_surat_naik');

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
            redirect('Surat_Naik/view_surat_naik');
        }

        $hasil = $this->m_surat->update_file_surat($id_surat, $file_surat['file_name']);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Naik/view_surat_naik');

        } else {
            @unlink($path_file_surat . $this->input->post('file_surat_old'));
            $this->session->set_flashdata('edit', 'edit');
            redirect('Surat_Naik/view_surat_naik');

        }
    }

    public function edit_file_nota_dinas_admin_utama()
    {
        $id_surat = $this->input->post('id_surat');
        $file_name = md5($id_surat . rand(1, 9999));

        $path_file_nota_dinas = './assets/file_nota_dinas/';

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
        } else {
            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Naik/view_admin_utama_surat_naik');
        }

        $hasil = $this->m_surat->update_file_nota_dinas($id_surat, $file_nota_dinas['file_name']);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Naik/view_admin_utama_surat_naik');

        } else {
            @unlink($path_file_nota_dinas . $this->input->post('file_nota_dinas_old'));
            $this->session->set_flashdata('edit', 'edit');
            redirect('Surat_Naik/view_admin_utama_surat_naik');

        }
    }

    public function edit_file_surat_admin_utama()
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
            redirect('Surat_Naik/view_admin_utama_surat_naik');
        }

        $hasil = $this->m_surat->update_file_surat($id_surat, $file_surat['file_name']);

        if ($hasil == false) {

            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Naik/view_admin_utama_surat_naik');

        } else {
            @unlink($path_file_surat . $this->input->post('file_surat_old'));
            $this->session->set_flashdata('edit', 'edit');
            redirect('Surat_Naik/view_admin_utama_surat_naik');

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
            redirect('Surat_Naik/view_surat_naik');

        } else {

            $this->session->set_flashdata('edit', 'edit');
            redirect('Surat_Naik/view_surat_naik');

        }
    }

    public function hapus_surat()
    {
        $id_surat = $this->input->post("id_surat");

        $path_file_surat = './assets/file_surat/';
        $path_file_nota_dinas = './assets/file_nota_dinas/';

        $hasil = $this->m_surat->delete_surat($id_surat);

        if ($hasil == false) {
            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Naik/view_surat_naik');
        } else {
            @unlink($path_file_nota_dinas . $this->input->post('file_nota_dinas_old'));
            @unlink($path_file_surat . $this->input->post('file_surat_old'));
            $this->session->set_flashdata('delete', 'delete');
            redirect('Surat_Naik/view_surat_naik');
        }
    }

    public function view_admin_utama_surat_naik()
    {
        $data['surat'] = $this->m_surat->get_all_surat_by_id_jenis_surat_and_id_status_surat(1, 1)->result_array();
        $this->load->view('admin_utama/surat_naik', $data);
    }

    public function acc_surat_naik()
    {
        $id_surat = $this->input->post("id_surat");

        $hasil = $this->m_surat->update_id_status_surat($id_surat, 3);

        if ($hasil == false) {
            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Naik/view_admin_utama_surat_naik');
        } else {
            $this->session->set_flashdata('edit', 'edit');
            redirect('Surat_Naik/view_admin_utama_surat_naik');
        }
    }

    public function tolak_surat_naik()
    {
        $id_surat = $this->input->post("id_surat");

        $hasil = $this->m_surat->update_id_status_surat($id_surat, 2);

        if ($hasil == false) {
            $this->session->set_flashdata('eror', 'eror');
            redirect('Surat_Naik/view_admin_utama_surat_naik');
        } else {
            $this->session->set_flashdata('edit', 'edit');
            redirect('Surat_Naik/view_admin_utama_surat_naik');
        }
    }

}
