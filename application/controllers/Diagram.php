<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Diagram extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Tagihan_model', 'tagihan');
    }
    
    function index()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        if ($data['user']['tipeUser'] == 3 || $data['user']['tipeUser'] == 1) {
            $tagihan_lunas = $this->tagihan->get_by_where($where = 'status = 1');
            $tagihan_lunas_count = count($tagihan_lunas);
            $data['tagihan_lunas'] = $tagihan_lunas_count;
            $tagihan = $this->tagihan->get_by_where($where = 'status = 0');
            $tagihan_count = count($tagihan);
            $data['tagihan'] = $tagihan_count;
            $data['total'] = $tagihan_count + $tagihan_lunas_count;
            if ($data['user'] == null) {
                redirect('auth');
            }
            $data['judul'] = 'Tagihan';
            $data['title'] = 'Tagihan';
            $this->load->view('template/header', $data);
            $this->load->view('template/user_left');
            $this->load->view('template/top_nav');
            $this->load->view('diagram/index', $data);
            $this->load->view('template/user_footer');
            $this->load->view('template/footer');
        }else{
            redirect('Auth/logout');
        }
    }
}
