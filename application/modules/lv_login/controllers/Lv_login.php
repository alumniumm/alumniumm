<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  Class Lv_login extends CI_Controller{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('M_login');
    }

    public function index()
    {
      // session_destroy();
      $this->load->view('view_login');
    }

    public function proses_login(){
      if($this->session->userdata('username')==null)
      {
        $this->form_validation->set_rules("txt_username", "Username", "trim|required");
        $this->form_validation->set_rules("txt_password", "Password", "trim|required");
        if($this->form_validation->run() == TRUE)
        {
          $username = $this->input->post("txt_username");
          $password = $this->input->post("txt_password");
          $deskripsiPassword = md5($password);
          $hasil = $this->M_login->ambil_alumni($username, $deskripsiPassword);
          if($hasil->num_rows()==1)
          {
            foreach($hasil->result() as $sess)
            {
              $sess_data['id_alumni'] = $sess->id_alumni;
              $sess_data['username'] = $sess->username;
              $sess_data['nama'] = $sess->nama;
              $sess_data['tanggalLahir'] = $sess->tanggalPost;
              $sess_data['alamat'] = $sess->alamatAsal;
              $sess_data['facebook'] = $sess->facebook;
              $sess_data['twitter'] = $sess->twitter;
              $sess_data['instagram'] = $sess->instagram;
              $sess_data['status'] = $sess->status;
              $this->session->set_userdata($sess_data);
              session_start();
            }
            if($sess_data['status']=='alumni')
            {
              redirect('alumni');
            }
            else if($sess_data['status']=='admin')
            {
              redirect('admin');
            }
          }
          
          else
          {
            $this->session->set_flashdata('msg', '<p class="text-danger">Gagal login, periksa username atau password Anda.</p>');
            redirect('login');
          }
        }
        else if($this->form_validation->run() == FALSE)
        {
          $this->load->view('view_login');
        }
      }
    }

    public function logout()
    {
      $this->session->unset_userdata('username');
      session_destroy();
      redirect('login');
    }
  }

?>
