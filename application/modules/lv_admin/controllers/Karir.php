<?php
  defined('BASEPATH') OR exit('File yang dimaksud tidak ada / tidak dapat diakses');
  ini_set('date.timezone', 'Asia/Jakarta');
  Class Karir extends CI_Controller{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('M_karir');
      $this->load->model('M_alumni');
      $this->load->model('M_admin');
      if($this->session->userdata('username')==null)
      {
        redirect('login');
      }
    }

    public function index()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']=="admin")
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

        // pagination data info karir
        $halaman = $this->uri->segment(3);
        $limit = 10;
        if(!$halaman){
          $offset = 0;
        }else{
          $offset = $halaman;
        }
        $total_karir = $this->M_karir->ambil_data_karir();

        // konfigurasi pagination
        $konfigurasi['base_url'] = base_url('/admin/karir/index');
        $konfigurasi['total_rows'] = $total_karir->num_rows();
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
        $data['karir'] = $this->M_karir->ambil_data_karir_semua($offset, $limit);
        $data['page'] = $halaman;
        $this->load->view('karir/view_main', $data);
      }
    }

    public function tambah_data_karir_admin()
    {
      $data['username']=$this->session->userdata('username');
      // cek username adalah admin
      if($data['username']=="admin")
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

        // konfigurasi library form_validation
        $this->form_validation->set_rules('namaPerusahaan', 'Nama Perusahaan', 'required', array('required' => 'Maaf Nama Perusahaan belum terisi'));
        $this->form_validation->set_rules('posisi', 'Posisi yang dibutuhkan', 'required', array('required' => 'Maaf Posisi yang dibutuhkan belum terisi'));
        $this->form_validation->set_rules('kriteria', 'Syarat atau Kriteria', 'required', array('required' => 'Maaf Kriteria / Syarat belum terisi'));
        $this->form_validation->set_rules('batasWaktu', 'Batas Waktu', 'required', array('required' => 'Maaf batas waktu belum terisi'));
        $this->form_validation->set_rules('kontak', 'Kontak', 'required', array('required' => 'Maaf Password Kontak yang bisa dihubungi belum terisi'));
        // cek validasai form
        if($this->form_validation->run()==true)
        {
          // cek action tombol post
          if($this->input->post('simpan'))
          {
            // konfigurasi upload image
            $konfigurasi['upload_path']='./assets/img/karir/';
            $konfigurasi['allowed_types']='jpg|jpeg|png';
            $konfigurasi['remove_spaces']=false;
            $konfigurasi['max_size']=4024;
            $konfigurasi['max_width']=8000;
            $konfigurasi['max_height']=8000;
            $this->upload->initialize($konfigurasi);
            $this->upload->do_upload('upGambar');
            $this->M_karir->masukan_data_karir_admin();
            $this->session->set_flashdata('msg_insert_data_karir_sukses', '<div class="alert alert-success text-center">Data Informasi Karir berhasil dimasukkan. Terimakasih.</div>');
            redirect('admin/karir');
          }
        }
        else
        {
          $this->load->view('karir/view_main_add', $data);
        }
      }
    }

    public function edit_data_karir_admin()
    {
      $data['username']=$this->session->userdata('username');
      // cek username adalah admin
      if($data['username']=="admin")
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

        $this->form_validation->set_rules('namaPerusahaan', 'Nama Perusahaan', 'required', array('required' => 'Maaf Nama Perusahaan belum terisi'));
        $this->form_validation->set_rules('posisi', 'Posisi', 'required', array('required' => 'Maaf Posisi yang dibutuhkan belum terisi'));
        $this->form_validation->set_rules('kriteria', 'Kriteria', 'required', array('required' => 'Maaf Kriteria / Syarat belum terisi'));
        $this->form_validation->set_rules('batasWaktu', 'Batas Waktu', 'required', array('required' => 'Maaf batas waktu belum terisi'));
        $this->form_validation->set_rules('kontak', 'Kontak', 'required', array('required' => 'Maaf Password Kontak yang bisa dihubungi belum terisi'));
        if($this->form_validation->run()==true)
        {
          if($this->input->post('edit'))
          {
            $id_karir = $this->uri->segment(3);
            $this->M_karir->update_data_karir($id_karir);
            $this->session->set_flashdata('msg_update_data_karir_sukses', '<div class="alert alert-success text-center">Data Informasi Karir berhasil diperbaharui. Terimakasih.</div>');
            redirect('admin/karir');
          }
        }
        else
        {
          $id_karir = $this->uri->segment(3);
          $data['data_awal_karir']=$this->M_karir->ambil_data_karir_per_id($id_karir);
          foreach($data['data_awal_karir'] as $row):
          endforeach;
          $tang = $row->batasWaktu;
          $data['batasWaktu'] = date('d-M-Y', strtotime($tang));
          $this->load->view('karir/view_main_edit', $data);
        }
      }
    }

    public function hapus_data_karir_admin()
    {
      $data['username'] = $this->session->userdata('username');
      if($data['username']!=null)
      {
        $id_karir = $this->uri->segment(3);
        $this->M_karir->hapus_data_karir_per_id($id_karir);
        $this->session->set_flashdata('msg_hapus_data_karir_sukses', '<div class="alert alert-success text-center">Data Informasi Karir berhasil dihapus. Terimakasih.</div>');
        redirect('admin/karir');
      }
    }

    public function lihat_informasi_karir_alumni()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']!=null)
      {
        $id_alumni=$this->session->userdata('id_alumni');
        $data['foto_profil']=$this->Alumni_model->ambil_data_foto_profil_per_id($id_alumni);
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
        $halaman = $this->uri->segment(3);
        $limit = 10;
        if(!$halaman){
          $offset = 0;
        }else{
          $offset = $halaman;
        }
        $total_karir=$this->M_karir->ambil_data_karir();
        // konfigurasi pagination
        $konfigurasi['base_url'] = base_url('/admin/karir/lihat_informasi_karir_alumni');
        $konfigurasi['total_rows'] = $total_karir->num_rows();
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
        $data['karir'] = $this->M_karir->ambil_data_karir_semua($offset, $limit);
        $data['page'] = $halaman;
        $this->load->view('karir/view_main_info',$data);
      }
    }

    public function lihat_detail_informasi_karir_alumni()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']!=null)
      {
        $id_alumni=$this->session->userdata('id_alumni');
        $data['foto_profil']=$this->Alumni_model->ambil_data_foto_profil_per_id($id_alumni);
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
        $id_karir=$this->uri->segment(3);
        $data['karir_detail_per_id']=$this->M_karir->ambil_data_karir_per_id($id_karir);
        $this->load->view('karir/view_main_detail',$data);
      }
    }
  }

?>
