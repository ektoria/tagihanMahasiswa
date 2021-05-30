<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('user_agent');
    // $this->load->model('Menu_model');
    $this->load->model('Admin_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    if ($this->session->userdata('id') == null) {
      $this->session->set_flashdata('auth', 'Akses ditolak');
      redirect('auth');
    } else {
      $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
      if ($data['user']['flag_aktif'] ==  0) {
        /*
            $data['title'] = 'Dashboard Admin';
            $data['user_access'] = $this->db->get_where('user_access', ['user_id' => $data['user']['id']])->row_array();
            // $data['menu'] = $this->Menu_model->filterMenu($data['user']);
            // $data['menu'] = $this->Menu_model->getAllMenu();
            // $data['html'] = $this->Menu_model->HTMLMenu($data['menu']);
            // $data['checkbox'] = $this->Menu_model->TVCheckbox($data['menu']);
            // $data['tree'] = $this->Menu_model->HTMLMenu($data['menu'], 0, 1);
            
            $this->load->view('template/header', $data);
            $this->load->view('template/user_left');
            $this->load->view('template/top_nav');
            $this->load->view('login/admin', $data);
            $this->load->view('template/user_footer');
            $this->load->view('template/footer');*/
        if ($data['user']['tipeUser'] == 2) {
          redirect('Tagihan');
        } elseif ($data['user']['tipeUser'] == 3) {
          redirect('Diagram');
        } elseif ($data['user']['tipeUser'] == 4) {
          redirect('Tagihan_mahasiswa');
        }
      } else {
        $this->session->set_flashdata('auth2', 'Akses ditolak, anda bukan admin');
        $referred_from = $this->session->userdata('referred_from');
        redirect($referred_from, 'refresh');
      }
    }
  }


  public function addUser()
  {

    $sha1password = $this->input->post('password');
    $status = '1';
    $data = [
      'name' => $this->input->post('name'),
      'username' => $this->input->post('username'),
      'password' => sha1($sha1password),
      'tipeUser' => $this->input->post('radio'),
      'role_id' => $this->input->post('role'),
      'status_user' => $status
    ];
    $this->db->insert('user', $data);
    $lastId = $this->db->insert_id();
    $data2 = $this->input->post('menu_id');


    foreach ($data2 as $datamenu) {
      $dataAkhir = [
        'user_id' => $lastId,
        'menu_id' => $datamenu
      ];
      $this->db->insert('user_access', $dataAkhir);
    }

    $this->session->set_flashdata('flash', 'menambah user baru');
    redirect('admin/userAccess');
  }

  public function editUser()
  {
    // $data = [
    //   'user_id' => $this->input->post('id'),
    //   'menu_id' => $this->input->post('menu')
    // ];
    // $this->db->insert('user_access', $data);

    $data2 = $this->input->post('menu_id');
    $dataId = $this->input->post('id');
    $this->db->where('user_id', $dataId);
    $sql = $this->db->get('user_access')->result_array();
    $menuID = [];
    foreach ($sql as $row) {
      array_push($menuID, $row['menu_id']);
    }

    // foreach($data2 as $row){
    //   if (!in_array($row, $menuID)) {

    //   }
    // }
    if (!empty($sql)) {
      foreach ($data2 as $datamenu) {
        $dataAkhir = [
          'user_id' => $dataId,
          'menu_id' => $datamenu
        ];
        $this->db->insert('user_access', $dataAkhir);
        $this->session->set_flashdata('flash', 'menambah hak akses');
      }
      redirect('admin/userAccess');
    } else {
      $this->session->set_flashdata('flashE', 'Akses yang diberikan sama');
      redirect('admin/userAccess');
    }
  }

  public function deleteUser($id)
  {
    $status = '0';
    $this->db->set('status_user', $status);
    $this->db->where('id', $id);
    $this->db->update('user');
    $this->session->set_flashdata('flash', 'Dinon-aktifkan');
    redirect('admin/userAccess');
  }

  public function restoreUser($id)
  {
    $status = '1';
    $this->db->set('status_user', $status);
    $this->db->where('id', $id);
    $this->db->update('user');
    $this->session->set_flashdata('flash', 'Diaktifkan');
    redirect('admin/userAccess');
  }

  public function userAccess()
  {
    if ($this->session->userdata('id') == null) {
      $this->session->set_flashdata('auth', 'Akses ditolak');
      redirect('auth');
    } else {
      $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
      if ($data['user']['role_id'] ==  0) {
        $data['title'] = 'Access User Control';
        $data['induk'] = $this->Menu_model->getMenuByTypes(["master", "submenu"]);
        $data['menu'] = $this->Menu_model->getAllMenu();
        $data['html'] = $this->Menu_model->HTMLMenu($data['menu']);
        $data['userd'] = $this->Admin_model->get_userAccess();
        // var_dump($data['userd']);die;
        $data['role'] = $this->Admin_model->getRoleUser();

        $data['menudrop'] = $this->Menu_model->getMenuByType('master');
        $data['pohon'] = $this->Menu_model->HTMLMenu($data['menu'], 0, 1, 1);

        $this->load->view('template/header', $data);
        $this->load->view('template/user_left');
        $this->load->view('template/top_nav', $data);
        $this->load->view('admin/user_access', $data);
        $this->load->view('template/user_footer');
        $this->load->view('template/footer');
      } else {
        $this->session->set_flashdata('auth2', 'Akses ditolak, anda bukan admin');
        $referred_from = $this->session->userdata('referred_from');
        redirect($referred_from, 'refresh');
      }
    }
  }


  public function getUserId($id)
  {
    echo json_encode($this->Admin_model->getUserAccesId($id));
  }

  public function tarif()
  {
    $data['menu'] = $this->Menu_model->getAllMenu();
    $data['html'] = $this->Menu_model->HTMLMenu($data['menu']);
    $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
    $data['title'] = 'Daftar Tarif';

    $data['daftar_tarif'] = $this->Tarif_model->getAllTarif();
    $data['daftar_komoditi'] = $this->Komoditi_model->getAll();

    $data['parameter'] = $this->Parameter_model->getParamByTipe('1');
    $data['checkbox'] = '';
    foreach ($data['parameter'] as $key => $checkbox) {
      $data['checkbox'] .= "<div class='custom-control custom-checkbox'>
            <input type='checkbox' class='custom-control-input parameter2' id='kodeParameter' name='kodeParameter[]' value='" . $checkbox['kode_parameter'] . "'>
            <label class='custom-control-label dropdown-item' for='" . $checkbox['kode_parameter'] . "'>" . $checkbox['nama_parameter'] . " - " . $checkbox['keterangan'] . "</label>
            </div>";
    }
    // var_dump($data['daftar_tarif']);die;
    $this->load->view('template/header', $data);
    $this->load->view('template/user_left');
    $this->load->view('template/top_nav');
    $this->load->view('admin/tarif', $data);
    $this->load->view('template/user_footer');
    $this->load->view('template/footer');
  }
}
