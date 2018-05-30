<?php
  defined('BASEPATH') OR exit('File yang dimaksdu tidak ada / tidak dapat diakses');
  // date_default_timezone_set('Asia/Jakarta');
  ini_set('date.timezone', 'Asia/Jakarta');
  Class Dashboard extends CI_Controller
  {
    public function __construct()
    {
      parent::__construct();
      $this->load->model('informasigrafik/informasi_grafik_model');
      $this->load->model('M_admin');
      if($this->session->userdata('username')==null)
      {
        redirect('login');
      }
    }

    public function index()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']=='admin')
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
        // ambil data grafik jumlah alumni
        $data['hasilLaki'] = $this->informasi_grafik_model->ambil_alumni_laki();
        $data['hasilPerempuan'] = $this->informasi_grafik_model->ambil_alumni_perempuan();
        //ambil data grafik perkembangan alumni yang bekerja
        $data['hasilSudahBekerja'] = $this->informasi_grafik_model->ambil_alumni_sudah_bekerja();
        $data['hasilBelumBekerja'] = $this->informasi_grafik_model->ambil_alumni_belum_bekerja();
        // ambil data grafik waktu tunggu pekerjaan pertama Alumni
        $data['hasilLamaWaktuTungguPekerjaanPertama'] = $this->informasi_grafik_model->ambil_alumni_waktu_tunggu_kerja_pertama();
        // ambil data grafik hubungan pekerjaan dg perkuliahan
        $data['hasilSangatErat'] = $this->informasi_grafik_model->ambil_alumni_kuliah_kerja_sangat_erat();
        $data['hasilErat'] = $this->informasi_grafik_model->ambil_alumni_kuliah_kerja_erat();
        $data['hasilCukupErat'] = $this->informasi_grafik_model->ambil_alumni_kuliah_kerja_cukup_erat();
        $data['hasilKurangErat'] = $this->informasi_grafik_model->ambil_alumni_kuliah_kerja_kurang_erat();
        $data['hasilTidakSamaSekali'] = $this->informasi_grafik_model->ambil_alumni_kuliah_kerja_tidak_sama_sekali();
        $this->load->view('dashboard/view_main', $data);
      }
    }

    public function profil()
    {
      $data['username'] = $this->session->userdata('username');
      if($data['username']=='admin')
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
        $data['admin'] = $this->M_admin->ambil_data_admin($id_admin);
        foreach ($data['admin'] as $row):
        endforeach;
        $tang = $row->tanggalLahir;
        $data['tanggal'] = date('d-M-Y', strtotime($tang));
        $this->load->view('profil/view_main', $data);
      }
    }

    public function simpan_password_baru()
    {
      $data['username'] = $this->session->userdata('username');
      if($data['username'] ==  'admin')
      {
        $passwordBaruError = $this->input->post('passwordBaruError');
        if($passwordBaruError == true )
        {
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Maaf Password baru yang Anda masukkan tidak sesuai. Mohon untuk Anda periksa, dan coba memasukkan kembali.</div>');
            redirect('admin/profil');
        }
        else
        {
          $passwordBaru = $this->input->post('passwordBaru');
          $enkripsiPassword = md5($passwordBaru);
          $data = array(
            'id_alumni'=>1,
            'password'=>$enkripsiPassword
          );
          $this->M_admin->update_password_admin($data);
        }
      }
    }

    public function edit_password_admin()
    {
      $data['username'] = $this->session->userdata('username');
      if($data['username'] ==  'admin')
      {
        $password1 = $this->input->post("password_baru1");
        $password2 = $this->input->post("password_baru2");
        if($password1 == null )
        {
          if($password2 == null)
          {
            $this->session->set_flashdata('msg', '<div class="alert alert-info text-center" role="alert">Maaf Password Baru Anda dan Konfirmasi Password masih kosong. Mohon untuk anda periksa, dan coba kembali.</div>');
            redirect('admin/profil');
          }
          else
          {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning text-center">Maaf Password Baru Anda masih kosong. Mohon untuk anda periksa, dan coba kembali.</div>');
            redirect('admin/profil');
          }
        }
        else if($password2 == null)
        {
           $this->session->set_flashdata('msg', '<div class="alert alert-warning text-center">Maaf Konfirmasi Password Baru Anda masih kosong. Mohon untuk anda periksa, dan coba kembali.</div>');
          redirect('admin/profil'); 
        }
        else
        {
          if($password1 != $password2)
          {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Maaf Password Baru dan Konfirmasi Password Baru Anda tidak cocok. Mohon untuk anda periksa, dan coba kembali.</div>');
            redirect('admin/profil'); 
          }
          else
          {
            $enkripsiPassword = md5($password1);
            $data = array(
              'id_alumni'=>1,
              'password'=>$enkripsiPassword
            );
            $this->M_admin->update_password_admin($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-primary text-center"><i class="fa fa-check"></i> Password Baru untuk Admin berhasil diperbaharui. Terimakasih.</div>');
            redirect('admin/profil'); 
          }
        }
      } 
    }

    public function edit_profil_admin()
    {
      $data['username'] = $this->session->userdata('username');
      if($data['username'] ==  'admin')
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

        $this->form_validation->set_rules('nama_admin', 'Nama Admin','required', array('required' => 'Maaf Nama Admin  Anda masih belum terisi.'));
        $this->form_validation->set_rules('alamat_asal', 'Alamat','required', array('required' => 'Maaf Alamat Anda masih belum terisi.'));
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir','required', array('required' => 'Maaf Tanggal Lahir Admin  Anda masih belum terisi.'));
        $this->form_validation->set_rules('surel', 'Surel','required|valid_email', array('required' => 'Maaf Alamat Surel Anda masih belum terisi.', 'valid_email' => 'Maaf Alamat Email Anda tidak valid.'));
        if($this->form_validation->run()==true)
        {
          if($this->input->post('submit_edit_data_profil_admin'))
          {
            $this->M_admin->update_data_profil_admin($id_admin);
            $this->session->set_flashdata('msg_update_profil_admin_sukses', '<div class="alert alert-success text-center"><i class="fa fa-check"></i> Data Profil Admin Anda berhasil diperbaharui. Terimakasih.</div>');
            redirect('admin/profil');
          }
        }
        else
        {
          $data['admin'] = $this->M_admin->ambil_data_admin($id_admin);
          foreach ($data['admin'] as $row):
          endforeach;
          $tang = $row->tanggalLahir;
          $data['tanggal'] = date('d-M-Y', strtotime($tang));
          $this->load->view('profil/view_main_edit',$data);
        }
      }
    }
  }
?>
