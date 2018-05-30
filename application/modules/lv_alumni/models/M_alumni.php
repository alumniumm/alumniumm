<?php
  class M_alumni extends CI_Model{
    function __construct()
    {
      parent::__construct();
    }

    function ambil_data_alumni_per_id($id_alumni)
    {
      $this->db->select('*');
      $this->db->from('alumni');
      $this->db->where('id_alumni',$id_alumni);
      $query=$this->db->get();
      $result=$query->result();
      return $result;
    }

    function ambil_data_foto_profil_per_id($id_alumni)
    {
      $this->db->select('foto_profil');
      $this->db->from('alumni');
      $this->db->where('id_alumni',$id_alumni);
      $query=$this->db->get();
      $result=$query->result();
      return $result;
    }

    function ambil_data_tempat_bekerja_alumni_per_id($id_alumni)
    {
      $this->db->select('*');
      $this->db->from('kerja');
      $this->db->where('id_alumni_fk',$id_alumni);
      $query=$this->db->get();
      $result=$query->result();
      return $result;
    }

    function simpan_data_tempat_bekerja()
    {
      $id_alumni = $this->session->userdata('id_alumni');
      $namaInstansi = $this->input->post('nama_instansi');
      $kotaBekerja = $this->input->post('kota_kerja');
      $tahunMasuk = $this->input->post('tahun_masuk');
      $latitude = $this->input->post('latitude');
      $longitude = $this->input->post('longitude');
      $data = array( 'nama_instansi' => $namaInstansi ,'id_alumni_fk' => $id_alumni , 'kota_kerja' => $kotaBekerja, 'tahun_masuk' => $tahunMasuk, 'latitude' => $latitude, 'longitude' => $longitude);
      $this->db->insert('kerja', $data);
    }

    function update_data_tempat_bekerja_per_id($id_alumni)
    {
      $id_alumni = $this->session->userdata('id_alumni');
      $namaInstansi = $this->input->post('nama_instansi');
      $kotaBekerja = $this->input->post('kota_kerja');
      $tahunMasuk = $this->input->post('tahun_masuk');
      $latitude = $this->input->post('latitude');
      $longitude = $this->input->post('longitude');

      $data = array( 'nama_instansi' => $namaInstansi ,'id_alumni_fk' => $id_alumni , 'kota_kerja' => $kotaBekerja, 'tahun_masuk' => $tahunMasuk, 'latitude' => $latitude, 'longitude' => $longitude);
      $this->db->where('id_alumni_fk', $id_alumni);
      $this->db->update('kerja', $data);
    }

    function update_data_alumni($id_alumni)
    {
      $fileFotoProfil=$_FILES['upFotoProfil']['name'];
      if(!empty($fileFotoProfil))
      {
        // ambil data nama file foto lawas
        $data_foto_lawas = $this->ambil_data_foto_profil_lawas_per_id($id_alumni);

        $konfigurasi['upload_path'] = './resources/assets/img/profil/';
        $konfigurasi['allowed_types'] = 'jpg|jpeg|png';
        $konfigurasi['remove_spaces'] = FALSE;
        $konfigurasi['max_size'] = 8024;
        $konfigurasi['max_width'] = 8000;
        $konfigurasi['max_height'] = 8000;
        $konfigurasi['encrypt_name'] = TRUE;
        $this->upload->initialize($konfigurasi);
        
        if(!$this->upload->do_upload('upFotoProfil'))
        {
          $data['error'] - $this->upload->display_errors();
          $this->load->view('vErrorUploadGambar.html', $data);
        }
        else
        {
          $uploadFoto = $this->upload->data();
          $this->resizeImage($uploadFoto['file_name']);
        }

        $namaLengkap = $this->input->post('namaLengkap');
        $alamatAsal = $this->input->post('alamatAsal');
        $jenisKelamin = $this->input->post('jenisKelamin');
        $email = $this->input->post('email');
        $facebook = $this->input->post('facebook');
        $twitter = $this->input->post('twitter');
        $instagram = $this->input->post('instagram');
        $tanggalLahir = date('Y-m-d', strtotime($this->input->post('tanggalLahir')));
        // $foto_profil = $_FILES['upFotoProfil']['name'];
        $dataFoto = $this->upload->data();
        $foto_profil = $dataFoto['file_name'];
        $data = array(
          'foto_profil' => $foto_profil,
          'nama' => $namaLengkap,
          'jenisKelamin' => $jenisKelamin,
          'alamat_asal' => $alamatAsal,
          'jenisKelamin' => $jenisKelamin,
          'email' => $email,
          'facebook' => $facebook,
          'twitter' => $twitter,
          'instagram' => $instagram,
          'tanggalLahir' => $tanggalLahir,
          'status' => 'alumni'
        );
        $this->db->where('id_alumni', $id_alumni);
        $this->db->update('alumni', $data);

        // hapus foto lawas
        unlink("assets/img/profil/".$data_foto_lawas);
        unlink("assets/img/profil/thumb/".$data_foto_lawas);
      }
      else
      {
        $namaLengkap = $this->input->post('namaLengkap');
        $alamatAsal = $this->input->post('alamatAsal');
        $jenisKelamin = $this->input->post('jenisKelamin');
        $email = $this->input->post('email');
        $facebook = $this->input->post('facebook');
        $twitter = $this->input->post('twitter');
        $instagram = $this->input->post('instagram');
        $tanggalLahir = date('Y-m-d', strtotime($this->input->post('tanggalLahir')));
        $data = array(
          'nama' => $namaLengkap,
          'jenisKelamin' => $jenisKelamin,
          'alamat_asal' => $alamatAsal,
          'jenisKelamin' => $jenisKelamin,
          'email' => $email,
          'facebook' => $facebook,
          'twitter' => $twitter,
          'instagram' => $instagram,
          'tanggalLahir' => $tanggalLahir,
          'status' => 'alumni'
        );
        $this->db->where('id_alumni', $id_alumni);
        $this->db->update('alumni', $data);
      }
    }

   function ambil_data_foto_profil_lawas_per_id($id_alumni)
    {
      $this->db->select('foto_profil');
      $this->db->from('alumni');
      $this->db->where('id_alumni', $id_alumni);
      $query = $this->db->get();
      $result = $query->row()->foto_profil;
      return $result;
    }

    function resizeImage($filename)
    {
      $path_sumber = './resources/assets/img/profil/' . $filename;
      $path_tujuan = './resources/assets/img/profil/thumb/';
      $konfig = array(
        'image_library' => 'gd2',
        'source_image' => $path_sumber,
        'new_image' => $path_tujuan,
        'maintain_ratio' => TRUE,
        'create_thumb' => FALSE,
        'thumb_maker' => '_thumb',
        'width' => 150,
        'height' =>150
      );
      $this->image_lib->initialize($konfig);
      if(!$this->image_lib->resize())
      {
        $data['error'] = $this->image_lib->display_errors();
        $this->load->view('vResizeError.html', $data);
        $this->image_lib->clear();
      }
    }

    function update_password_alumni($data)
    {
      $this->db->where('id_alumni', $data['id_alumni']);
      $this->db->update('alumni', $data);
    }

    function simpan_status_alumni($data)
    {
      $this->db->insert('lini_masa',$data);
    }

    function ambil_data_lini_masa_terbaru($batas)
    {
      $query = $this->db->query('SELECT lini_masa.id_lini_masa, lini_masa.isi, lini_masa.tanggal_kirim, lini_masa.id_alumni_fk, alumni.foto_profil, alumni.nama, alumni.facebook, alumni.instagram, alumni.twitter FROM lini_masa, alumni WHERE lini_masa.id_alumni_fk = alumni.id_alumni ORDER BY lini_masa.id_lini_masa DESC LIMIT 10 ');
      return $query;
      // $this->db->select('lini_masa.id_lini_masa', 'lini_masa.isi', 'lini_masa.id_alumni_fk', 'alumni.foto_profil');
      // $this->db->from('lini_masa','alumni');
      // $this->db->where('lini_masa.id_alumni_fk','alumni.id_alumni');
      // $this->db->order_by('id_lini_masa','desc');
      // $this->db->limit($batas);
      // $query=$this->db->get();
      // return $query;
    }

    function tampil_nama($nama)
    {
      $this->db->select('nama');
      $this->db->from('alumni');
      $this->db->where('nama',$nama);
      $query = $this->db->get();
      $result = $query->result();
      return $result;
    }

    function tampil_email($email)
    {
      $this->db->select('email');
      $this->db->from('alumni');
      $this->db->where('email',$email);
      $query = $this->db->get();
      $result = $query->result();
      return $result;
    }

    function tampil_fb($fb)
    {
      $this->db->select('facebook');
      $this->db->from('alumni');
      $this->db->where('facebook', $fb);
      $query = $this->db->get();
      $result = $query->result();
      return $result;
    }

    function tampil_twitter($twitter)
    {
      $this->db->select('twitter');
      $this->db->from('alumni');
      $this->db->where('twitter', $twitter);
      $query = $this->db->get();
      $result = $query->result();
      return $result;
    }

    function tampil_instagram($instagram)
    {
      $this->db->select('instagram');
      $this->db->from('alumni');
      $this->db->where('instagram', $instagram);
      $query = $this->db->get();
      $result = $query->result();
      return $result;
    }
  }
?>
