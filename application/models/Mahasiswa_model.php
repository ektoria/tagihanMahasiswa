<?php

class Mahasiswa_model extends CI_model
{
    function get_mahasiswa_by_nim($nim){
        return $this->db->where('nim', $nim)->get('tbl_mahasiswa')->row_array();
    }
}