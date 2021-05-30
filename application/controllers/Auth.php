<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
	public function index()
	{
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            if ($this->session->userdata('username')) {
                if ($this->session->userdata('role_id') == 0) {
                    if ($this->session->flashdata('makespjl')) {
                        $this->session->set_flashdata('makespjl', 'This menu just for Admin Kantor');
                    }
                    redirect('admin');
                }
                else {
                    if ($this->session->flashdata('makespjl')) {
                        $this->session->set_flashdata('makespjl', 'This menu just for Admin Kantor');
                    }
                    redirect('user');
                }
            }
            else{
                $data['title'] = 'Login Lims';
                $this->load->view('login/index', $data);
            }
        }else{
            //validasinya suksess
            $this->_login();
        }
    }
    
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        $id_user = $user['id'];
        
        // exits
        if ($user) {
            // if user active
            if ($user['status_user'] == 1) {
                // check password
                if (sha1($password) == $user['password']) {
                    $data = [
                        "id" => $user['id'],
                        "username" => $user['username'],
                        "role_id" => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if( $user['role_id'] == 0 ) {
                        // var_dump($user['role_id']);die;
                        redirect('admin');
                    } else{
                        redirect('user');
                    }
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Username or password is wrong!
                    </div>');
                    redirect('auth');

                }
            }
            else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                user is not active!
                </div>');
                redirect('auth');
            }
        }
        else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Username or password is wrong!
            </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            you have been logged out!
        </div>');
        redirect('auth');
    }
}
