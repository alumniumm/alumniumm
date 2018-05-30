<?php
  defined('BASEPATH') OR exit('File yang dimaksud tidak ada / tidak dapat diakses');
  ini_set('date.timezone', 'Asia/Jakarta');
  class Agenda extends CI_Controller{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('M_agenda');
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

        // pagination data info agenda
        $halaman = $this->uri->segment(3);
        $limit = 6;
        if(!$halaman){
          $offset = 0;
        }else{
          $offset = $halaman;
        }
        $total_agenda = $this->M_agenda->ambil_data_agenda();

        // konfigurasi pagination
        $konfigurasi['base_url'] = base_url('/index.php/admin/agenda/index');
        $konfigurasi['total_rows'] = $total_agenda->num_rows();
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
        $data['agenda'] = $this->M_agenda->ambil_data_agenda_semua($offset, $limit);
        $data['page'] = $halaman;
        // foreach ($data['agenda'] as $row) :
        // endforeach;
        // for($x=1;$x<=count($data['agenda']);$x++)
        // {
        //   $data['tanggal'][$x] = $row->tanggalPost;  
        // }
        
        // $data['tanggal_indo'] = date('d-m-Y', strtotime($data['tanggal']));
        // $data['tanggal_indo'] = $row->tanggalPost;
        $this->load->view('agenda/view_main', $data);
      }
    }

    public function tambah_data_agenda()
    {
      $data['username']=$this->session->userdata('username');
      //cek username adalah admin
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

        $data = array(
          'judul'   => $this->input->post('judul'),
          'penulis' => $this->input->post('penulis'),
          'isi'     => $this->input->post('isi')
        );
        // cek validasi form
          // cek action tombol post
          if($this->input->post('simpan'))
          {
            // konfigurasi upload image
            $konfigurasi['upload_path']='./assets/img/agenda/';
            $konfigurasi['allowed_types']='gif|jpg|jpeg|png';
            $konfigurasi['remove_spaces']=false;
            $konfigurasi['max_size']=4024;
            $konfigurasi['max_width']=8000;
            $konfigurasi['max_height']=8000;
            $this->upload->initialize($konfigurasi);
            $this->upload->do_upload('upGambar');
            $data_gambar=$this->upload->data();

            // konfigurasi dan upload gambar thumbnails
            $konfigurasi2['source_image']=$data_gambar['full_path'];
            $konfigurasi2['new_image']='./assets/img/agenda/thumbs';
            $konfigurasi2['maintain_ration']=true;
            $konfigurasi2['width']=200;
            $konfigurasi2['height']=200;
            $this->image_lib->initialize($konfigurasi2);
            $this->image_lib->resize();

            $this->M_agenda->masukan_data_agenda($data);
            $this->session->set_flashdata('msg_insert_data_agenda_sukses', '<div class="alert alert-success text-center">Data Agenda berhasil dimasukkan. Terimakasih.</div>');
            redirect('admin/agenda');
          }
          else
          {
            $this->load->view('agenda/view_main', $data);
          }
      }
    }

    public function edit_data_agenda()
    {
      $data['username']=$this->session->userdata('username');
      // cek username sama dengan admin
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
        $this->form_validation->set_rules('judul', 'Judul', 'required', array('required' => 'Maaf Judul Artikel belum terisi'));
        $this->form_validation->set_rules('penulis', 'Penulis', 'required', array('required' => 'Maaf Nama Penulis belum terisi'));
        $this->form_validation->set_rules('isi', 'Isi', 'required', array('required' => 'Maaf Isi Artikel belum terisi'));
        // cek validasi form
        if($this->form_validation->run()==true)
        {
          // cek action tombol edit
          if($this->input->post('edit'))
          {
            $id_agenda = $this->uri->segment(3);
            $this->M_agenda->update_data_agenda($id_agenda);
            $this->session->set_flashdata('msg_update_data_agenda_sukses', '<div class="alert alert-success text-center">Data Agenda berhasil diperbaharui. Terimakasih.</div>');
            redirect('admin/agenda');
          }
        }
        else
        {
          $id_agenda = $this->uri->segment(3);
          $data['data_awal_agenda']=$this->M_agenda->ambil_data_agenda_per_id($id_agenda);
          $this->load->view('view_main_edit', $data);
        }
      }
    }

    public function hapus_data_agenda()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']!=null)
      {
        $id_agenda=$this->uri->segment(3);
        $this->M_agenda->hapus_data_agenda_per_id($id_agenda);
        $this->session->set_flashdata('msg_hapus_data_agenda_sukses', '<div class="alert alert-success text-center">Data Agenda berhasil dihapus. Terimakasih.</div>');
        redirect('admin/agenda');
      }
    }
  }

?>
