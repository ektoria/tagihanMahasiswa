<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tagihan extends CI_Controller
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
        if ($data['user']['tipeUser'] == 2 || $data['user']['tipeUser'] == 1) {
            $data['tagihan'] = $this->tagihan->getAll();
            if ($data['user'] == null) {
                redirect('auth');
            }
            $data['judul'] = 'Tagihan';
            $data['title'] = 'Tagihan';
            $this->load->view('template/header', $data);
            $this->load->view('template/user_left');
            $this->load->view('template/top_nav');
            $this->load->view('tagihan/index', $data);
            $this->load->view('template/user_footer');
            $this->load->view('template/footer');
        } else {
            redirect('Auth/logout');
        }
    }

    function tambah_page()
    {
        // $data['menu'] = $this->Menu_model->getAllMenu();
        // $data['html'] = $this->Menu_model->HTMLMenu($data['menu']);
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        if ($data['user']['tipeUser'] == 2 || $data['user']['tipeUser'] == 1) {
            // $data['jenis_tagihan'] = $this->jenis_tagihan->getAll();
            if ($data['user'] == null) {
                redirect('auth');
            }
            $data['nama_mahasiswa'] = $this->tagihan->get_mahasiswa();
            $data['judul'] = 'Tambah Tagihan';
            $data['title'] = 'Tambah Tagihan';
            $this->load->view('template/header', $data);
            $this->load->view('template/user_left');
            $this->load->view('template/top_nav');
            $this->load->view('tagihan/tambah', $data);
            $this->load->view('template/user_footer');
            $this->load->view('template/footer');
        } else {
            redirect('Auth/logout');
        }
    }

    function tambah()
    {
        $id_transaksi = date('Ymdhis');
        $nama_mahasiswa = $this->input->post('nama_mahasiswa');
        $nama_tagihan = $this->input->post('nama_tagihan');
        $keterangan = $this->input->post('keterangan');
        $nominal = $this->input->post('nominal');

        if ($nama_mahasiswa == 'seluruhnya') {
            $nama_mahasiswa = $this->tagihan->get_mahasiswa();
            $dataArr = array();
            foreach ($nama_mahasiswa as $nm) {
                $data = [
                    'id_transaksi' => $id_transaksi,
                    'id_mahasiswa' => $nm->id,
                    'nama_tagihan' => $nama_tagihan,
                    'keterangan' => $keterangan,
                    'nominal' => $nominal,
                    'flag' => 1
                ];
                array_push($dataArr, $data);
            }
            $this->tagihan->tambah_batch($dataArr);
        } else {
            $data = array(
                'id_transaksi' => $id_transaksi,
                'id_mahasiswa' => $nama_mahasiswa,
                'nama_tagihan' => $nama_tagihan,
                'keterangan' => $keterangan,
                'nominal' => $nominal,
                'flag' => 1
            );
            $this->tagihan->tambah($data);
        }
        $this->session->set_flashdata("flash", "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Sukses!</strong> Data Berhasil Ditambah.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        redirect('Tagihan');
    }
    
    function edit($id_tagihan)
    {
        $data = array(
            'id_mahasiswa' => $this->input->post('nama_mahasiswa'),
            'nama_tagihan' => $this->input->post('nama_tagihan'),
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => $this->input->post('nominal')
        );
        $this->tagihan->update($id_tagihan, $data);
        $this->session->set_flashdata("flash", "<div class='alert alert-info alert-dismissible fade show' role='alert'><strong>Sukses!</strong> Data Berhasil Diubah.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        redirect('Tagihan');
    }

    function edit_page($id_tagihan)
    {
        // $data['menu'] = $this->Menu_model->getAllMenu();
        // $data['html'] = $this->Menu_model->HTMLMenu($data['menu']);
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        if ($data['user']['tipeUser'] == 2 || $data['user']['tipeUser'] == 1) {
            $data['tagihan'] = $this->tagihan->getDataById($id_tagihan);
            $data['nama_mahasiswa'] = $this->tagihan->get_mahasiswa();
            if ($data['user'] == null) {
                redirect('auth');
            }
            $data['judul'] = 'Edit Tagihan';
            $data['title'] = 'Edit Tagihan';
            $this->load->view('template/header', $data);
            $this->load->view('template/user_left');
            $this->load->view('template/top_nav');
            $this->load->view('tagihan/edit', $data);
            $this->load->view('template/user_footer');
            $this->load->view('template/footer');
        } else {
            redirect('Auth/logout');
        }
    }

    function delete($id_tagihan)
    {
        $data = ['flag' => 0];
        $this->tagihan->delete($id_tagihan, $data);
        $this->session->set_flashdata("flash", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Sukses!</strong> Data Berhasil Dihapus.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        redirect('Tagihan');
    }
}
