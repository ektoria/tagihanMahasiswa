<?php

class UserLevel_model extends CI_model{
    public function getById($id)
    {
        return $this->db->get_where('user_level', ['id' => $id])->row_array();
    }
}