<?php

class M_surat extends CI_Model
{

    public function insert_surat($id_surat, $perihal, $nomor_surat, $file_lembar_disposisi, $file_surat, $file_nota_dinas, $tanggal_surat, $nomor_agenda, $id_jenis_surat, $id_status_surat, $keterangan, $instansi_pengirim)
    {
        $this->db->trans_start();

        $this->db->query("INSERT INTO surat(id_surat, perihal, nomor_surat, file_lembar_disposisi ,file_surat, file_nota_dinas, tanggal_surat, created_at, nomor_agenda, id_jenis_surat, id_status_surat, keterangan,  instansi_pengirim)
       VALUES ('$id_surat','$perihal','$nomor_surat','$file_lembar_disposisi','$file_surat','$file_nota_dinas','$tanggal_surat',NOW(),'$nomor_agenda','$id_jenis_surat','$id_status_surat', '$keterangan', '$instansi_pengirim')");

        $this->db->trans_complete();
        if ($this->db->trans_status() == true) {
            return true;
        } else {
            return false;
        }

    }

    public function ubah_surat_all($id_surat, $perihal, $nomor_surat, $tanggal_surat, $keterangan)
    {
        $this->db->trans_start();

        $this->db->query("UPDATE surat SET perihal ='$perihal', nomor_surat='$nomor_surat', tanggal_surat='$tanggal_surat', keterangan='$keterangan' WHERE id_surat='$id_surat'");

        $this->db->trans_complete();
        if ($this->db->trans_status() == true) {
            return true;
        } else {
            return false;
        }

    }

    public function ubah_surat_masuk($id_surat, $perihal, $nomor_surat, $tanggal_surat, $instansi_pengirim, $keterangan)
    {
        $this->db->trans_start();

        $this->db->query("UPDATE surat SET perihal ='$perihal', nomor_surat='$nomor_surat', tanggal_surat='$tanggal_surat', instansi_pengirim='$instansi_pengirim', keterangan='$keterangan' WHERE id_surat='$id_surat'");

        $this->db->trans_complete();
        if ($this->db->trans_status() == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_surat($id_surat)
    {
        $this->db->trans_start();

        $this->db->query("DELETE FROM surat WHERE id_surat='$id_surat'");

        $this->db->trans_complete();
        if ($this->db->trans_status() == true) {
            return true;
        } else {
            return false;
        }
    }

    public function update_file_nota_dinas($id_surat, $file_nota_dinas)
    {
        $this->db->trans_start();

        $this->db->query("UPDATE surat SET file_nota_dinas ='$file_nota_dinas' WHERE id_surat='$id_surat'");

        $this->db->trans_complete();
        if ($this->db->trans_status() == true) {
            return true;
        } else {
            return false;
        }
    }

    public function update_file_lembar_disposisi($id_surat, $file_lembar_disposisi)
    {
        $this->db->trans_start();

        $this->db->query("UPDATE surat SET file_lembar_disposisi ='$file_lembar_disposisi' WHERE id_surat='$id_surat'");

        $this->db->trans_complete();
        if ($this->db->trans_status() == true) {
            return true;
        } else {
            return false;
        }
    }

    public function update_file_surat($id_surat, $file_surat)
    {
        $this->db->trans_start();

        $this->db->query("UPDATE surat SET file_surat ='$file_surat' WHERE id_surat='$id_surat'");

        $this->db->trans_complete();
        if ($this->db->trans_status() == true) {
            return true;
        } else {
            return false;
        }

    }

    public function update_id_status_surat($id_surat, $id_status_surat)
    {
        $this->db->trans_start();

        $this->db->query("UPDATE surat SET id_status_surat ='$id_status_surat' WHERE id_surat='$id_surat'");

        $this->db->trans_complete();
        if ($this->db->trans_status() == true) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all_surat_by_id_jenis_surat($id_jenis_surat)
    {
        $hasil = $this->db->query("SELECT * FROM surat JOIN jenis_surat ON surat.id_jenis_surat = jenis_surat.id_jenis_surat JOIN status_surat ON surat.id_status_surat = status_surat.id_status_surat
         WHERE surat.id_jenis_surat = '$id_jenis_surat' ORDER BY surat.created_at DESC");
        return $hasil;
    }

    public function get_all_surat_by_id_jenis_surat_and_id_status_surat($id_jenis_surat, $id_status_surat)
    {
        $hasil = $this->db->query("SELECT * FROM surat JOIN jenis_surat ON surat.id_jenis_surat = jenis_surat.id_jenis_surat JOIN status_surat ON surat.id_status_surat = status_surat.id_status_surat
         WHERE surat.id_jenis_surat = '$id_jenis_surat' AND surat.id_status_surat = '$id_status_surat' ORDER BY surat.created_at DESC");
        return $hasil;
    }

    public function count_all_surat_by_id_jenis_surat($id_jenis_surat)
    {
        $hasil = $this->db->query("SELECT count(id_surat) as total_surat FROM surat JOIN jenis_surat ON surat.id_jenis_surat = jenis_surat.id_jenis_surat JOIN status_surat ON surat.id_status_surat = status_surat.id_status_surat
        WHERE surat.id_jenis_surat = '$id_jenis_surat'");
        return $hasil;
    }

    public function count_all_surat_by_id_jenis_surat_and_id_status_surat($id_jenis_surat, $id_status_surat)
    {
        $hasil = $this->db->query("SELECT count(id_surat) as total_surat FROM surat JOIN jenis_surat ON surat.id_jenis_surat = jenis_surat.id_jenis_surat JOIN status_surat ON surat.id_status_surat = status_surat.id_status_surat
        WHERE surat.id_jenis_surat = '$id_jenis_surat' AND surat.id_status_surat = '$id_status_surat'");
        return $hasil;
    }
}
