<?php
  defined('BASEPATH') OR exit('File yang dimaksud tidak ada / tidak dapat diakses.');
  ini_set('date.timezone', 'Asia/Jakarta');
  Class Alumni extends MX_Controller{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('M_alumni');
      //ambil data tracer study sementara
      if($this->session->userdata('username')==null)
      {
        redirect('login');
      }

    }

    public function index()
    {
      $data['username'] = $this->session->userdata('username');
      if ($data['username']!=null)
      {
        $id_alumni=$this->session->userdata('id_alumni');
        $data['foto_profil']=$this->M_alumni->ambil_data_foto_profil_per_id($id_alumni);
        foreach($data['foto_profil'] as $roww):
          $namaFileFoto=$roww->foto_profil;
        endforeach;
        if($namaFileFoto==null||$namaFileFoto==''||$namaFileFoto=="0")
        {
          $data['foto']='no_avatar.png';
        }
        else
        {
          $data['foto']=$namaFileFoto;
        }
        $data['nama']=$this->session->userdata('nama');
        $data['lini_masa_terbaru']=$this->M_alumni->ambil_data_lini_masa_terbaru(10);
        $this->load->view('dashboard/view_main', $data);
      }
    }

    public function lihat_profil_alumni()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']!=null)
      {
        $id_alumni=$this->session->userdata('id_alumni');
        $data['nama']=$this->session->userdata('nama');
        $data['alumni']=$this->M_alumni->ambil_data_alumni_per_id($id_alumni);
        $data['tempat_kerja']=$this->M_alumni->ambil_data_tempat_bekerja_alumni_per_id($id_alumni);
        $data['foto_profil']=$this->M_alumni->ambil_data_foto_profil_per_id($id_alumni);
        foreach($data['foto_profil'] as $roww):
          $namaFileFoto=$roww->foto_profil;
        endforeach;
        if($namaFileFoto==null||$namaFileFoto==''||$namaFileFoto=="0")
        {
          $data['foto']='no_avatar.png';
        }
        else
        {
          $data['foto']=$namaFileFoto;
        }
        if($data['tempat_kerja']==null)
        {
          $data['kerja']=0;
        }
        else
        {
          $data['kerja']=1;
        }
        $this->load->view('profil/view_main',$data);
      }
    }

    public function edit_profil_alumni()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']!=null)
      {
        $id_alumni=$this->session->userdata('id_alumni');
        $data['nama']=$this->session->userdata('nama');
        $data['foto_profil']=$this->M_alumni->ambil_data_foto_profil_per_id($id_alumni);
        foreach($data['foto_profil'] as $roww):
          $namaFileFoto=$roww->foto_profil;
        endforeach;
        if($namaFileFoto==null||$namaFileFoto==''||$namaFileFoto=="0")
        {
          $data['foto']='no_avatar.png';
        }
        else
        {
          $data['foto']=$namaFileFoto;
        }
        $this->form_validation->set_rules('namaLengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('jenisKelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'required');
        if($this->form_validation->run()==true)
        {
          if($this->input->post('edit'))
          {
            $id_alumni=$this->uri->segment(3);
            $this->M_alumni->update_data_alumni($id_alumni);
            redirect('alumni/profil');
          }
        }
        else
        {
            $id_alumni=$this->uri->segment(3);
            $data['awal_alumni']=$this->M_alumni->ambil_data_alumni_per_id($id_alumni);
            $this->load->view('profil/view_main_edit',$data);
        }
      }
    }

    public function edit_password_alumni()
    {
      $data['username'] = $this->session->userdata('username');
      if($data['username'] != null)
      {
        $password1 = $this->input->post("password_baru1");
        $password2 = $this->input->post("password_baru2");
        if($password1 == null)
        {
          if($password2 == null)
          {
            $this->session->set_flashdata('pesan', '<div class="alert alert-info text-center" role="alert">Maaf Password Baru Anda dan Konfirmasi Password masih kosong. Mohon untuk anda periksa, dan coba kembali.</div>');
            redirect('alumni/profil');
          }
          else
          {
            $this->session->set_flashdata('pesan', '<div class="alert alert-info text-center" role="alert">Maaf Password Baru Anda masih kosong. Mohon untuk anda periksa, dan coba kembali.</div>');
            redirect('alumni/profil');
          }
        }
        else if($password2 == null)
        {
           $this->session->set_flashdata('pesan', '<div class="alert alert-warning text-center">Maaf Konfirmasi Password Baru Anda masih kosong. Mohon untuk anda periksa, dan coba kembali.</div>');
          redirect('alumni/profil'); 
        }
        else
        {
          if($password1 != $password2)
          {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center">Maaf Password Baru dan Konfirmasi Password Baru Anda tidak cocok. Mohon untuk anda periksa, dan coba kembali.</div>');
            redirect('alumni/profil'); 
          }
          else
          {
            $enkripsiPassword = md5($password1);
            $data = array(
              'id_alumni' => $this->session->userdata('id_alumni'),
              'password' => $enkripsiPassword
            );
            $this->M_alumni->update_password_alumni($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center">Password Baru Anda berhasil diperbaharui. Terimakasih.</div>');
            redirect('alumni/profil');
          }
        }
      }
    }

    public function edit_tempat_kerja_alumni()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']!=null)
      {
        $id_alumni=$this->session->userdata('id_alumni');
        $data['nama']=$this->session->userdata('nama');
        $data['foto_profil']=$this->M_alumni->ambil_data_foto_profil_per_id($id_alumni);
        foreach($data['foto_profil'] as $roww):
          $namaFileFoto=$roww->foto_profil;
        endforeach;
        
        if($namaFileFoto==null||$namaFileFoto==''||$namaFileFoto=="0")
        {
          $data['foto']='no_avatar.png';
        }
        else
        {
          $data['foto']=$namaFileFoto;
        }
        $this->form_validation->set_rules('nama_instansi', 'Nama Instansi tempat Anda bekerja', 'required');
        $this->form_validation->set_rules('kota_kerja', 'Kota tempat Anda bekerja', 'required');
        $this->form_validation->set_rules('tahun_masuk', 'Tahun masuk Anda bekerja', 'required');
        $this->form_validation->set_rules('latitude', 'Lokasi bekerja Anda (Latitude)', 'required');
        $this->form_validation->set_rules('longitude', 'Lokasi bekerja Anda (Longitude)', 'required');
        // ambil action submit
        $t_submit = $this->input->post('submit');

        // $this->load->model('M_alumni');
        
        // cek action untuk tombol submit
        if($t_submit == null){
          $id_alumni = $this->session->userdata('id_alumni');
          $data['ambil_data_kerja'] = $this->M_alumni->ambil_data_tempat_bekerja_alumni_per_id($id_alumni);
          $data['nama'] = $this->session->userdata('nama');
          $this->load->view('view_tempat_kerja', $data);
        }else{
          if($this->form_validation->run()==true){
            $id_alumni = $this->session->userdata('id_alumni');
            $this->M_alumni->update_data_tempat_bekerja_per_id($id_alumni);
            redirect('alumni/lihat_profil_alumni');
          }else{
            $id_alumni = $this->session->userdata('id_alumni');
            $data['ambil_data_kerja'] = $this->M_alumni->ambil_data_tempat_bekerja_alumni_per_id($id_alumni);
            $data['nama'] = $this->session->userdata('nama');
            $this->load->view('vEditDataTempatBekerjaAlumni.html', $data);
          }
        }
        // $this->load->view('vEditDataTempatBekerjaAlumni.html',$data);
      }
    }

    public function tambah_tempat_kerja_alumni()
    {
      $data['username'] = $this->session->userdata('username');
      if($data['username'] != null)
      {
         $id_alumni=$this->session->userdata('id_alumni');
        $data['foto_profil']=$this->M_alumni->ambil_data_foto_profil_per_id($id_alumni);
        foreach($data['foto_profil'] as $roww):
          $namaFileFoto=$roww->foto_profil;
        endforeach;
        if($namaFileFoto==null||$namaFileFoto==''||$namaFileFoto=="0")
        {
          $data['foto']='no_avatar.png';
        }
        else
        {
          $data['foto']=$namaFileFoto;
        }

        $this->form_validation->set_rules('nama_instansi', 'Nama Instansi', 'required', array('required' => 'Maaf, nama instansi tempat Anda bekerja belum diisi.' ));
        $this->form_validation->set_rules('kota_kerja', 'Kota Kerja', 'required', array('required' => 'Maaf, lokasi kota tempat Anda bekerja belum diisi.' ));
        $this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'required', array('required' => 'Maaf, tahun masuk mulai bekerja belum diisi.' ));
        $this->form_validation->set_rules('latitude', 'Latitude', 'required', array('required' => 'Maaf, koordinat lokasi (latitude) tempat Anda bekerja belum diisi.' ));
        $this->form_validation->set_rules('longitude', 'Longitude', 'required', array('required' => 'Maaf, koordinat lokasi (longitude) tempat Anda bekerja belum diisi.' ));
        $tombol_simpan = $this->input->post('submit');
        if($tombol_simpan == null)
        {
          $data['nama'] = $this->session->userdata('nama');
          $this->load->view('vTambahTempatBekerja.html', $data);  
        }
        else
        {
          if($this->form_validation->run()==true)
          {
            $this->M_alumni->simpan_data_tempat_bekerja();
            $this->session->set_flashdata('msg_insert_data_kerja_sukses', '<div class="alert alert-success text-center">Informasi tempat Anda bekerja berhasil disimpan. Terimakasih.</div>');
            redirect('alumni/lihat_profil_alumni');
          }
          else
          {
            $data['nama'] = $this->session->userdata('nama');
            $this->load->view('vTambahTempatBekerja.html', $data);   
          }
        }
      }
    }

    public function logout()
    {
      $this->session->unset_userdata('username');
      session_destroy();
      redirect('Homepage');
    }

    public function tambah_status_alumni()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']!=null)
      {
        $this->form_validation->set_rules('txtArea_status_alumni', 'Status Alumni', 'required');
        if($this->form_validation->run()==true)
        {
          $data=array(
            'isi'=>$this->input->post('txtArea_status_alumni'),
            'id_alumni_fk'=>$this->session->userdata('id_alumni'),
            'tanggal_kirim'=>date('Y-m-d h:i:s')
          );
          $this->M_alumni->simpan_status_alumni($data);
          redirect('alumni');
        }else
        {
          redirect('alumni');
        }
      }
    }
  }
?>
