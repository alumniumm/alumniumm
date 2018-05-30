<?php
  defined('BASEPATH') OR exit('File yang dimaksud tidak ada / tidak dapat diakses');
  // date_default_timezone_set('Asia/Jakarta');
  ini_set('date.timezone', 'Asia/Jakarta');
  Class Alumni extends CI_Controller
  {
    public function __construct()
    {
      parent::__construct();
      $this->load->model('M_alumni');
      $this->load->model('M_admin');
      if($this->session->userdata('username')==null)
      {
        redirect('login');
      }
    }

    public function index()
    {
      $data['username'] =  $this->session->userdata('username');
      if($data['username'] == 'admin')
      {
        $id_admin = $this->session->userdata('id_alumni');
         $data['foto_profil'] = $this->M_admin->ambil_data_foto_profil_admin($id_admin);
        foreach ($data['foto_profil'] as $row ): 
          $namaFileFoto = $row->foto_profil;
        endforeach;
        if($namaFileFoto == null || $namaFileFoto == "")
        {
          $data['foto'] = 'no_avatar.png';
        }
        else
        {
          $data['foto'] = $namaFileFoto;
        }
        
        // pagination data alumni
        $halaman = $this->uri->segment(3);
        $limit = 10;
        if(!$halaman){
          $offset = 0;
        }else{
          $offset = $halaman;
        }
        $total_alumni = $this->M_alumni->ambil_data_alumni();

        // konfigurasi pagination
        $konfigurasi['base_url'] = base_url('admin/alumni');
        $konfigurasi['total_rows'] = $total_alumni->num_rows();
        $konfigurasi['per_page'] = $limit;
        $konfigurasi['uri_segment'] = 3;

        $konfigurasi['full_tag_open'] = '<ul class="pagination">';
        $konfigurasi['full_tag_close'] = '</ul>';
        $konfigurasi['num_tag_open'] = '<li>';
        $konfigurasi['num_tag_close'] = '</li>';
        $konfigurasi['cur_tag_open'] = '<li class="active"><a href="#">';
        $konfigurasi['cur_tag_close'] = '</a></li>';
        $konfigurasi['prev_tag_open'] = '<li>';
        $konfigurasi['prev_tag_close'] = '</li>';
        $konfigurasi['first_link'] = 'Awal';
        $konfigurasi['first_tag_open'] = '<li>';
        $konfigurasi['first_tag_close'] = '</li>';
        $konfigurasi['last_link'] = 'Akhir';
        $konfigurasi['last_tag_open'] = '<li>';
        $konfigurasi['last_tag_close'] = '</li>';

        $konfigurasi['prev_link'] = '<i class="fa fa-long-arrow-left"></i> Sebelumnya';
        $konfigurasi['prev_tag_open'] = '<li>';
        $konfigurasi['prev_tag_close'] = '</li>';

        $konfigurasi['next_link'] = 'Selanjutnya <i class="fa fa-long-arrow-right"></i>';
        $konfigurasi['next_tag_open'] = '<li>';
        $konfigurasi['next_tag_close'] = '</li>';

        $this->pagination->initialize($konfigurasi);
        $data['paginator'] = $this->pagination->create_links();
        $data['alumni'] = $this->M_alumni->ambil_data_alumni_semua($offset, $limit);
        $data['page'] = $halaman;
        $this->load->view('alumni/view_main', $data);
      }
    }

    public function Tambah_data_alumni()
    {
      $data['username'] = $this->session->userdata('username');
      // cek username adalah admin
      if($data['username'] == 'admin')
      {
        $id_admin = $this->session->userdata('id_alumni');
         $data['foto_profil'] = $this->M_admin->ambil_data_foto_profil_admin($id_admin);
        foreach ($data['foto_profil'] as $row ): 
          $namaFileFoto = $row->foto_profil;
        endforeach;
        if($namaFileFoto == null || $namaFileFoto == "")
        {
          $data['foto'] = 'no_avatar.png';
        }
        else
        {
          $data['foto'] = $namaFileFoto;
        }

        // setup library form_validation
        $data = array(
          'username'              => $this->input->post('username'),
          'password'             => $this->input->post('password'),
          'namaLengkap'              => $this->input->post('namaLengkap'),
          'jenisKelamin'          => $this->input->post('jenisKelamin'),
          'alamatAsal'      => $this->input->post('alamatAsal'),
          'email'        => $this->input->post('email'),
          'tanggalLahir'             => $this->input->post('tanggalLahir')
        );
        $this->M_alumni->masukan_data_alumni($data);
        $this->session->set_flashdata('msg_insert_data_alumni_sukses','<div class="alert alert-success bg-success" role="alert"> Data Berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/alumni', $data);
        //cek validasi inputan
      }
    }

    public function Edit_data_alumni()
    {
      
      $data['username'] = $this->session->userdata('username');
      if($data['username'] == 'admin')
      {
        $id_admin = $this->session->userdata('id_alumni');
        $data['foto_profil'] = $this->M_admin->ambil_data_foto_profil_admin($id_admin);
        foreach ($data['foto_profil'] as $row ): 
          $namaFileFoto = $row->foto_profil;
        endforeach;
        if($namaFileFoto == null || $namaFileFoto == "")
        {
          $data['foto'] = 'no_avatar.png';
        }
        else
        {
          $data['foto'] = $namaFileFoto;
        }

        // setup library form_validation
        $this->form_validation->set_rules('username', 'Username', 'required', array('required' => 'Maaf Username Alumni belum terisi'));
        // $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'Maaf Password Alumni belum terisi'));
        $this->form_validation->set_rules('namaLengkap', 'Nama Lengkap', 'required', array('required' => 'Maaf Nama Lengkap Alumni belum terisi'));
        $this->form_validation->set_rules('jenisKelamin', 'Jenis Kelamin', 'required', array('required' => 'Maaf Jenis Kelamin Alumni belum terisi'));
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', array('required' => 'Maaf Tanggal Lahir Alumni belum terisi'));
        $this->form_validation->set_rules('alamatAsal', 'Alamat asal', 'required', array('required' => 'Maaf Alamat Asal Alumni belum terisi'));
        $this->form_validation->set_rules('email', 'Surel', 'required|valid_email', array('required' => 'Maaf Alamat Surel Alumni belum terisi', 'valid_email' => 'Maaf Alamat Email tidak valid'));
        $id_alumni = $this->uri->segment(3);
        if($this->form_validation->run()==true)
        {
          if($this->input->post('ubah'))
          {
            $this->M_alumni->update_data_alumni($id_alumni);
            $this->session->set_flashdata('msg_update_profil_alumni_sukses', '<div class="alert alert-success text-center">Data Profil Admin Anda berhasil diperbaharui. Terimakasih.</div>');
            redirect('admin/alumni');
          }
        }
        else
        {
          $data['data_awal_alumni'] = $this->M_alumni->ambil_data_alumni_per_id($id_alumni);
          foreach ($data['data_awal_alumni'] as $row):
          endforeach;
          $tang = $row->tanggalLahir;
          $pass = $row->password;
          $dekripPass = md5($pass);
          $data['password'] = $pass;
          $data['tanggal'] = date('d-M-Y', strtotime($tang));
          $this->load->view('alumni/view_main_edit', $data);
        }
      }
    }

    public function edit_password_alumni_per_id()
    {
      $data['username'] = $this->session->userdata('username');
      if($data['username'] ==  'admin')
      {
        $id_alumni = $this->uri->segment(3);
        $password1 = $this->input->post("password_baru1");
        $password2 = $this->input->post("password_baru2");
        if($password1 == null )
        {
          if($password2 == null)
          {
            $this->session->set_flashdata('msg', '<div class="alert alert-info text-center" role="alert">Maaf Password Baru Anda dan Konfirmasi Password masih kosong. Mohon untuk anda periksa, dan coba kembali.</div>');
            redirect('admin/alumni/edit/'.$id_alumni);
          }
          else
          {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning text-center">Maaf Password Baru Anda masih kosong. Mohon untuk anda periksa, dan coba kembali.</div>');
            redirect('admin/alumni/edit/'.$id_alumni);
          }
        }
        else if($password2 == null)
        {
           $this->session->set_flashdata('msg', '<div class="alert alert-warning text-center">Maaf Konfirmasi Password Baru Anda masih kosong. Mohon untuk anda periksa, dan coba kembali.</div>');
          redirect('admin/alumni/edit/'.$id_alumni); 
        }
        else
        {
          if($password1 != $password2)
          {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Maaf Password Baru dan Konfirmasi Password Baru Anda tidak cocok. Mohon untuk anda periksa, dan coba kembali.</div>');
            redirect('admin/alumni/edit/'.$id_alumni); 
          }
          else
          {
            $enkripsiPassword = md5($password1);
            $data = array(
              'id_alumni'=>$id_alumni,
              'password'=>$enkripsiPassword
            );
            $this->M_alumni->update_password_alumni_per_id($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Password Baru untuk Alumni berhasil diperbaharui. Terimakasih.</div>');
            redirect('admin/alumni/edit/'.$id_alumni); 
          }
        }
      } 
    }

    public function Hapus_data_alumni()
    {
      $data['username'] = $this->session->userdata('username');
      if($data['username']!=null)
      {
        $id_alumni = $this->uri->segment(3);
        $this->M_alumni->hapus_data_alumni_per_id($id_alumni);
        $this->M_alumni->hapus_data_tempat_kerja_alumni_per_id($id_alumni);
        $this->session->set_flashdata('msg_hapus_alumni_sukses', '<div class="alert alert-danger bg-success text-center">Data Alumni berhasil dihapus. Terimakasih.</div>');
        redirect('admin/alumni');
      }
    }

  }
?>
