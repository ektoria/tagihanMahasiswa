<?php

class Admin_model extends CI_model{

  public function getAllUser()
  {
    return $this->db->order_by('username', 'ASC')->get('user')->result_array();
  }
  public function get_userAccess()
  {
    $this->db->select('*');
    $this->db->from('user_access');
    $this->db->join('user', 'user.id=user_access.user_id', 'left');
    $this->db->join('menu', 'menu.id=user_access.menu_id', 'left');
    $this->db->order_by('username', 'ASC');
    $query = $this->db->get()->result_array();
    $userId = [];
    foreach($query as $value) {
      $userId[$value['user_id']][] = $value;
    }
    return $userId;
  }

  public function get_menu()
  {
    $users = $this->get_userAccess();
    $tes = [];
    $s = [];
    
    foreach ($users as $key => $user) {
      foreach ($user as $key1 => $menu) {
        unset($users[$menu['user_id']][$key1]['user_id']);
        unset($users[$menu['user_id']][$key1]['id']);
        unset($users[$menu['user_id']][$key1]['username']);
        unset($users[$menu['user_id']][$key1]['password']);
        unset($users[$menu['user_id']][$key1]['role_id']);
        unset($users[$menu['user_id']][$key1]['tipeUser']);
        unset($users[$menu['user_id']][$key1]['status_user']);
        $users[$menu['user_id']][$key1]['id'] = $users[$menu['user_id']][$key1]['menu_id'];
        unset($users[$menu['user_id']][$key1]['menu_id']);
        // $tes[$menu['user_id']][] = $menu['menu_id'];
        
      }
      
    }
    // var_dump($users);die;
    return $users;
  }
  
  public function menuDrop()
  {
    $this->db->get_where('menu', "tipe = 'master'")->result_array();
  }

  public function getMenuById($id)
  {
    return $this->db->get_where('user', ['id' => $id])->result_array();
  }

  public function getUserAccesId($id)
  {
    return $this->db->get_where('user_access', ['user_id' => $id])->result_array();
  }

  public function getRoleUser()
  {
    return $this->db->order_by('id', 'DESC')->get('user_level')->result_array();
  }
}