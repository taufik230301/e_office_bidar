<?php

class M_user extends CI_Model
{

    public function cek_login($username)
    {
        $hasil = $this->db->query("SELECT * FROM user WHERE username='$username'");
        return $hasil;

    }
}