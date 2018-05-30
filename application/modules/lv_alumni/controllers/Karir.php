<?php
  defined('BASEPATH') OR exit('File yang dimaksud tidak ada / tidak dapat diakses');
  ini_set('date.timezone', 'Asia/Jakarta');
  Class Karir extends MX_Controller{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('M_karir');
      $this->load->model('M_alumni');
      if($this->session->userdata('username')==null)
      {
        redirect('Login');
      }
    }

    public function index()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']!=null)
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
        $halaman = $this->uri->segment(3);
        $limit = 10;
        if(!$halaman){
          $offset = 0;
        }else{
          $offset = $halaman;
        }
        $total_karir=$this->M_karir->ambil_data_karir();
        // konfigurasi pagination
        $konfigurasi['base_url'] = base_url('/index.php/Kelola_Karir/lihat_informasi_karir_alumni');
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
        $this->load->view('karir/view_main',$data);
      }
    }


    public function lihat_detail_informasi_karir_alumni()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']!=null)
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
        $id_karir=$this->uri->segment(3);
        $data['karir_detail_per_id']=$this->M_karir->ambil_data_karir_per_id($id_karir);
        $this->load->view('karir/view_main_detail',$data);
      }
    }
  }

?>
