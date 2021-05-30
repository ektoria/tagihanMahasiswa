<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tagihan_mahasiswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Tagihan_model', 'tagihan');
        $this->load->model('Mahasiswa_model', 'mahasiswa');
    }
    
    function index()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        if ($data['user']['tipeUser'] == 4 || $data['user']['tipeUser'] == 1) {
            $id_mahasiswa = $this->mahasiswa->get_mahasiswa_by_nim($data['user']['username']);
            $data['tagihan'] = $this->tagihan->get_tagihan_mahasiswa($id_mahasiswa['id']);
            $data['jumlah_tagihan'] = count($data['tagihan']);
            if ($data['user'] == null) {
                redirect('auth');
            }
            $data['judul'] = 'Tagihan';
            $data['title'] = 'Tagihan';
            $this->load->view('template/header', $data);
            $this->load->view('template/user_left');
            $this->load->view('template/top_nav');
            $this->load->view('tagihan_mahasiswa/index', $data);
            $this->load->view('template/user_footer');
            $this->load->view('template/footer');
        } else {
            redirect('Auth/logout');
        }
    }

    function bayar($id)
    {
        $data = ['status' => 1];
        $this->tagihan->update($id, $data);
        $this->session->set_flashdata("flash", "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Sukses!</strong> tagihan Berhasil Dibayar.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        redirect('Tagihan_mahasiswa');
    }
}
