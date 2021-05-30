<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Tarif_model');
        $this->load->model('User_model', 'User');
        $this->load->model('UserLevel_model', 'UserLevel');
        $this->load->library('form_validation');
    }
    
    public function index()
    {
        $data['user'] = $this->User->getUserById($this->session->userdata('id'))[0];
        
        $data['title'] = 'Profile';
        $data['user_level'] = $this->UserLevel->getById($data['user']['role_id']);
        if ($data['user_level'] == null) {
            $data['user_level'] = 'Admin';
            $data['menu'] = $this->Menu_model->getAllMenu();
        }else{
            // var_dump($data['user_level']);die;
            $data['user_level'] = $data['user_level']['role_user'];
            $data['menu'] = $this->Menu_model->filterMenu($data['user']);
        }
        // var_dump($data['user']);die;   
        $data['html'] = $this->Menu_model->HTMLMenu($data['menu']);
        
        $this->load->view('template/header', $data);
        $this->load->view('template/user_left');
        $this->load->view('template/top_nav');
        $this->load->view('profile/index', $data);
        $this->load->view('template/user_footer');
        $this->load->view('template/footer');
    }
    
    public function changepassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->User->getUserById($this->session->userdata('id'))[0];
        $data['user_level'] = $this->UserLevel->getById($data['user']['role_id']);
        // var_dump($data['user']);die;
        if ($data['user_level'] == null) {
            $data['user_level'] = 'Admin';
            $data['menu'] = $this->Menu_model->getAllMenu();
        }
        else{
            $data['menu'] = $this->Menu_model->filterMenu($data['user']);
        }
        $data['html'] = $this->Menu_model->HTMLMenu($data['menu']);
        
        $this->form_validation->set_rules('currentpassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newpassword1', 'New Password', 'required|trim|min_length[3]|matches[newpassword2]');
        $this->form_validation->set_rules('newpassword2', 'New Password', 'required|trim|min_length[3]|matches[newpassword1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/user_left');
            $this->load->view('template/top_nav');
            $this->load->view('profile/changepassword', $data);
            $this->load->view('template/user_footer');
            $this->load->view('template/footer');
        }else{
            $currentPassword = strval($this->input->post('currentpassword'));
            $newPassword = strval($this->input->post('newpassword1'));
            if ($data['user']['password'] == sha1($currentPassword)) {
                if ($currentPassword == $newPassword) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    New Password cannot be the same as current password!      
                    </div>');
                    redirect('profile/changepassword');
                }else{
                    $password_hash = sha1($newPassword);
                    $this->db->set('password', $password_hash);
                    $this->db->where('id', $data['user']['id']);
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Password Changed!      
                    </div>');
                    redirect('profile/changepassword');
                }
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Wrong Current Password!      
                </div>');
                redirect('profile/changepassword');
            }
        }
        
    }

    public function edit()
    {
        $data['user'] = $this->User->getUserById($this->session->userdata('id'))[0];
        
        $data['title'] = 'Profile';
        $data['user_level'] = $this->UserLevel->getById($data['user']['role_id']);
        if ($data['user_level'] == null) {
            $data['user_level'] = 'Admin';
            $data['menu'] = $this->Menu_model->getAllMenu();
        }else{
            $data['menu'] = $this->Menu_model->filterMenu($data['user']);
        }
        // var_dump($data['user']);die;   
        $data['html'] = $this->Menu_model->HTMLMenu($data['menu']);
        
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/user_left');
            $this->load->view('template/top_nav');
            $this->load->view('profile/edit', $data);
            $this->load->view('template/user_footer');
            $this->load->view('template/footer');
        }else{
            $name = $this->input->post('name');
            // $username = $this->input->post('username');
            
            $upload_image = $_FILES['img']['name'];
            $newData = [
                'name' => $name,
            ];
            if ($upload_image) {
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = '3048';
                $config['upload_path'] = './assets/img/user/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('img')) {
                    $old_image = $data['user']['img'];
                    if ($old_image !== 'default.png') {
                        unlink(FCPATH . 'assets/img/user/'. $old_image);
                        // die;
                    }
                    
                    //Compress Image
                    $config['image_library']='gd2';
                    $config['source_image']='./assets/img/user/'. $this->upload->data('file_name');
                    
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= FALSE;
                    $config['quality']= '50%';
                    $config['width']= 400;
                    $config['height']= 500;
                    $config['new_image']= './assets/img/user/'. $this->upload->data('file_name');
                    $this->load->library('image_lib', $config);
                    // var_dump($config['source_image']);die;
                    $this->image_lib->resize();

                    // var_dump($old_image);die;
                    $new_image = $this->upload->data('file_name');
                    $newData['img'] = $new_image;
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    failed to updated your profile something wrong with you image!    
                    </div>');
                    redirect('profile/');
                }
            }

            $this->User->editUserById($data['user']['id'], $newData);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Your Profile has been updated!     
            </div>');
            redirect('profile/');
        }
    }
}