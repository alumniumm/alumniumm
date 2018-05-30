<?php
  defined('BASEPATH') OR exit('File yang dimaksdu tidak ada / tidak dapat diakses');
  // date_default_timezone_set('Asia/Jakarta');
  ini_set('date.timezone', 'Asia/Jakarta');
  Class Alumni extends CI_Controller
  {
    public function __construct()
    {
      parent::__construct();
      $this->load->model('M_alumni_ts');
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

        // pagination data perttanyaan ts alumni
        $halaman = $this->uri->segment(3);
        $limit = 10;
        if(!$halaman){
          $offset = 0;
        }else{
          $offset = $halaman;
        }
        $total_pertanyaan = $this->M_alumni_ts->ambil_data_pertanyaan_ts_alumni();

        // konfigurasi pagination
        $konfigurasi['base_url'] = base_url('/admin/pertanyaan/alumni');
        $konfigurasi['total_rows'] = $total_pertanyaan->num_rows();
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
        $data['pertanyaan_ts_alumni'] = $this->M_alumni_ts->ambil_data_pertanyaan_ts_alumni_semua($offset, $limit);
        $data['page'] = $halaman;
        $this->load->view('pertanyaan/view_main_alumni',$data);
      }
    }

      public function tambah_data_pertanyaan_ts_alumni()
      {
      $data['username']=$this->session->userdata('username');
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

        $hasil_pertanyaan = $this->M_alumni_ts->ambil_data_jumlah_pertanyaan() ;
        if($this->input->post('simpan_uraian'))
        {
          if($hasil_pertanyaan->num_rows()==10)
          {
            $this->session->set_flashdata('msg_tambah_data_pertanyaan_failed', '<div class="alert alert-danger text-center">Maaf data pertanyaan tidak dapat disimpan, karena sudah mencapai batas (Maksimal 10 Pertanyaan). Terimakasih.</div>');
            redirect('admin/pertanyaan/alumni');
          }
          else if($hasil_pertanyaan->num_rows()<=9)
          {
            $this->M_alumni_ts->masukan_data_pertanyaan_uraian_ts_alumni();
            redirect('admin/pertanyaan/alumni');  
          }
        }
        else if($this->input->post('simpan_opsional'))
        {
          if($hasil_pertanyaan->num_rows()==10)
          {
            $this->session->set_flashdata('msg_tambah_data_pertanyaan_failed', '<div class="alert alert-danger text-center">Maaf data pertanyaan tidak dapat disimpan, karena sudah mencapai batas (Maksimal 15 Pertanyaan). Terimakasih.</div>');
            redirect('admin/pertanyaan/alumni');
          }
          else if($hasil_pertanyaan->num_rows()<=9)
          {
            $this->M_alumni_ts->masukan_data_pertanyaan_opsional_ts_alumni();
            redirect('admin/pertanyaan/alumni');
          }
        }
        else
        {
            $this->load->view('view_main_add',$data);
        }
      }
    }

    public function edit_data_pertanyaan_ts_alumni()
    {
      $data['username']=$this->session->userdata('username');
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

        if($this->input->post('edit_uraian'))
        {
          $id_tanya_ts_alumni=$this->uri->segment(3);
          $data['status_tanya'] = $this->M_alumni_ts->ambil_data_status_tanya_per_id($id_tanya_ts_alumni);
          foreach ($data['status_tanya'] as $row ): 
            $status = $row->status_tanya_ts_alumni;
          endforeach;
          $hasil_urai = $this->M_alumni_ts->ambil_data_jumlah_tanya_urai();
          if($hasil_urai->num_rows()==5)
          {
            if($this->input->post("status_pertanyaan")=="aktif")
            {
              if($status == "aktif")
              {
                $this->M_alumni_ts->update_data_pertanyaan_uraian_ts_alumni($id_tanya_ts_alumni);
                $this->session->set_flashdata('msg_update_urai_sukses', '<div class="alert alert-success text-center">Data Pertanyaan Tracer Study Alumni, berhasil diperbarui. Terimakasih</div>');
                redirect('admin/pertanyaan/alumni');
              }
              else
              {
                $this->session->set_flashdata('msg_update_urai_failed', '<div class="alert alert-danger text-center">Maaf data pertanyaan opsional yang aktif sudah mencapai batas (Maksimal 5). Mohon untuk anda periksa, dan coba kembali.</div>');
                redirect('admin/pertanyaan/alumni');
              }
            }
            else if($this->input->post("status_pertanyaan")=="non-aktif")
            {
              $id_tanya_ts_alumni=$this->uri->segment(3);
              $this->M_alumni_ts->update_data_pertanyaan_uraian_ts_alumni($id_tanya_ts_alumni);
              $this->session->set_flashdata('msg_update_urai_sukses', '<div class="alert alert-success text-center">Data Pertanyaan Tracer Study Alumni, berhasil diperbarui. Terimakasih</div>');
              redirect('admin/pertanyaan/alumni');
            }
          }
          else if($hasil_urai->num_rows()<=4)
          {
            $id_tanya_ts_alumni=$this->uri->segment(3);
            $this->M_alumni_ts->update_data_pertanyaan_uraian_ts_alumni($id_tanya_ts_alumni);
            $this->session->set_flashdata('msg_update_urai_sukses', '<div class="alert alert-success text-center">Data Pertanyaan Tracer Study Alumni, berhasil diperbarui. Terimakasih</div>');
            redirect('admin/pertanyaan/alumni');  
          }
        }
        
        else if($this->input->post('edit_opsional'))
        {
          $id_tanya_ts_alumni=$this->uri->segment(3);
          $data['status_tanya'] = $this->M_alumni_ts->ambil_data_status_tanya_per_id($id_tanya_ts_alumni);
          foreach ($data['status_tanya'] as $row ): 
            $status = $row->status_tanya_ts_alumni;
          endforeach;
          $hasil_opsi = $this->M_alumni_ts->ambil_data_jumlah_tanya_opsi() ;
          if($hasil_opsi->num_rows()==5)
          {
            if($this->input->post("status_pertanyaan")=="aktif")
            {
              if($status == "aktif")
              {
                $this->M_alumni_ts->update_data_pertanyaan_opsional_ts_alumni($id_tanya_ts_alumni);
                $this->session->set_flashdata('msg_update_opsi_sukses', '<div class="alert alert-success text-center">Data Pertanyaan Tracer Study Alumni, berhasil diperbarui. Terimakasih</div>');
                redirect('admin/pertanyaan/alumni');
              }
              else
              {
                $this->session->set_flashdata('msg_update_pilih_failed', '<div class="alert alert-danger text-center">Maaf data pertanyaan opsional yang aktif sudah mencapai batas (Maksimal 5). Mohon untuk anda periksa, dan coba kembali.</div>');
                redirect('admin/pertanyaan/alumni');
              }
            }
            else if($this->input->post("status_pertanyaan")=="non-aktif")
            {
              $id_tanya_ts_alumni=$this->uri->segment(3);
              $this->M_alumni_ts->update_data_pertanyaan_opsional_ts_alumni($id_tanya_ts_alumni);
              $this->session->set_flashdata('msg_update_opsi_sukses', '<div class="alert alert-success text-center">Data Pertanyaan Tracer Study Alumni, berhasil diperbarui. Terimakasih</div>');
              redirect('admin/pertanyaan/alumni');
            }
          }
          else if($hasil_opsi->num_rows()<=4)
          {
            $id_tanya_ts_alumni=$this->uri->segment(3);
            $this->M_alumni_ts->update_data_pertanyaan_opsional_ts_alumni($id_tanya_ts_alumni);
            $this->session->set_flashdata('msg_update_opsi_sukses', '<div class="alert alert-success text-center">Data Pertanyaan Tracer Study Alumni, berhasil diperbarui. Terimakasih</div>');
            redirect('admin/pertanyaan/alumni');  
          }
        }
        
        else
        {
          $id_tanya_ts_alumni=$this->uri->segment(3);
          $urai=$this->M_alumni_ts->ambil_data_jenis_pertanyaan_uraian_per_id($id_tanya_ts_alumni);
          $opsi=$this->M_alumni_ts->ambil_data_jenis_pertanyaan_opsional_per_id($id_tanya_ts_alumni);
          if($urai=='1')
          {
            $data['data_awal_pertanyaan']=$this->M_alumni_ts->ambil_data_pertanyaan_uraian_ts_alumni_per_id($id_tanya_ts_alumni);
            $this->load->view('view_main_edit_uraian',$data);
          }
          else if($opsi=='1')
          {
            $data['data_awal_pertanyaan']=$this->M_alumni_ts->ambil_data_pertanyaan_opsional_ts_alumni_per_id($id_tanya_ts_alumni);
            $this->load->view('opsional',$data);
          }
        }
      }
    }

    public function hapus_data_pertanyaan_ts_alumni()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']!=null)
      {
        $id_tanya_ts_alumni=$this->uri->segment(3);
        $this->M_alumni_ts->hapus_data_pertanyaan_ts_alumni_per_id($id_tanya_ts_alumni);
        $this->session->set_flashdata('msg_hapus_pertanyaan_sukses', '<div class="alert alert-success text-center">Data Pertanyaan Tracer Study berhasil dihapus. Terimakasih.</div>');
        redirect('admin/pertanyaan/alumni');
      }
    }

  }
?>
