<?php

class Tagihan_model extends CI_model
{
    function getAll()
    {
        return $this->db->query("SELECT a.*, b.nama_mahasiswa from tbl_tagihan a, tbl_mahasiswa b where a.id_mahasiswa = b.id and a.flag = 1")->result();
    }
    function get_by_where($where){
        return $this->db->query("SELECT * from tbl_tagihan where $where")->result_array();
    }
    function get_tagihan_mahasiswa($id_mahasiswa){
        return $this->db->query("SELECT * from tbl_tagihan where id_mahasiswa = $id_mahasiswa and status = 0 and flag = 1")->result_array();
    }

    function get_mahasiswa(){
        return $this->db->get('tbl_mahasiswa')->result();
    }

    function tambah($data)
    {
        $this->db->insert('tbl_tagihan', $data);
    }

    function tambah_batch($data){
        $this->db->insert_batch('tbl_tagihan', $data);
    }
    
    function update($id_tagihan, $data)
    {
        $this->db->where('id', $id_tagihan);
        return $this->db->update('tbl_tagihan', $data);
    }
    
    function getDataById($id_tagihan)
    {
        return $this->db->where('id', $id_tagihan)->get('tbl_tagihan')->result_array();
    }
    
    function delete($id_tagihan, $data)
    {
        $this->db->where('id', $id_tagihan)->update('tbl_tagihan', $data);
    }
}