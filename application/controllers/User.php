<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
	}

    public function index()
    {
        // var_dump($this->session->userdata('id'));die;
        if( $this->session->userdata('id') == null) {
            $this->session->set_flashdata('auth', 'Akses ditolak');
            redirect('auth');
        } else {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            if( $data['user']['role_id'] ==  0 ) {
                $this->session->set_flashdata('auth2', 'Akses ditolak');
                $referredfrom = $this->session->userdata('referredfrom'); 
                redirect($referredfrom, 'refresh');
            } else {
                $data['title'] = 'Dashboard User';
                // $data['user_access'] = $this->db->get_where('user_access', ['user_id' => $data['user']['id']])->result_array();
                $data['menu'] = $this->Menu_model->filterMenu($data['user']);
                // var_dump($data['menu']);die;

                // $data['master'] = $this->Menu_model->getMenuByType('master');
                // $data['submenu'] = $this->Menu_model->getMenuByType('submenu');
                $data['html'] = $this->Menu_model->HTMLMenu($data['menu']);
                // var_dump($data['html']); die;
                // $data['level'] = $this->Menu_model->getTotalLevel()();
                
                $this->load->view('template/header', $data);
                $this->load->view('template/user_left');
                $this->load->view('template/top_nav', $data);
                $this->load->view('login/user', $data);
                $this->load->view('template/user_footer');
                $this->load->view('template/footer');
            }
        }
    }

    public function checkUsername($username)
    {
        echo json_encode($this->User_model->getuserByUsername($username));
    }
}