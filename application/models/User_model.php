<?php

class User_model extends CI_model{
    public function getUserById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->result_array();
    }
    
    public function editUserById($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }
    
    public function getuserByUsername($usernmae)
    {
        return $this->db->get_where('user', ['username' => $usernmae])->result_array();
    }
    public function getNameSession(){
        return $this->db->query("SELECT username, name from user where id = ".$this->session->userdata('id'))->result_array();
    }
}