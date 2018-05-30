<?php
  class M_admin extends CI_Model{
    function __construct()
    {
      parent::__construct();
    }

    function ambil_data_foto_profil_admin($id_admin)
    {
      $this->db->select('foto_profil');
      $this->db->from('alumni');
      $this->db->where('id_alumni',$id_admin);
      $query=$this->db->get();
      $result=$query->result();
      return $result;
    }

    function ambil_data_admin($id_admin)
    {
    	$this->db->select('*');
      	$this->db->from('alumni');
      	$this->db->where('id_alumni',$id_admin);
      	$query=$this->db->get();
      	$result=$query->result();
      	return $result;
    }

    function update_password_admin($data)
    {
    	$this->db->where('id_alumni',$data['id_alumni']);
    	$this->db->update('alumni',$data);
    }

    function update_data_profil_admin($id_admin)
    {
      $fileFotoProfil=$_FILES['upFotoProfil']['name'];
      if(!empty($fileFotoProfil))
      {
        $konfigurasi['upload_path'] = './resources/assets/img/profil/';
        $konfigurasi['allowed_types'] = 'jpg|jpeg|png';
        $konfigurasi['remove_spaces'] = FALSE;
        $konfigurasi['max_size'] = 8024;
        $konfigurasi['max_width'] = 8000;
        $konfigurasi['max_height'] = 8000;
        $this->upload->initialize($konfigurasi);
        $this->upload->do_upload('upFotoProfil');

        $nama = $this->input->post('nama_admin');
        $alamat = $this->input->post('alamat_asal');
        $tgl = $this->input->post('tanggal_lahir');
        $tanggal_lahir = date('Y-m-d', strtotime($tgl));
        $surel = $this->input->post('surel');
        $facebook = $this->input->post('facebook');
        $twitter = $this->input->post('twitter');
        $instagram = $this->input->post('instagram');
        $foto_profil = $_FILES['upFotoProfil']['name'];
        $data_update_admin = array(
          'foto_profil' => $foto_profil,
          // 'id_alumni' => $id_admin,
          'nama' => $nama,
          'alamat_asal' => $alamat,
          'tanggalLahir' => $tanggal_lahir,
          'email' => $surel,
          'facebook' => $facebook,
          'twitter' => $twitter,
          'instagram' => $instagram 
        );

        $this->db->where('id_alumni', $id_admin);
        $this->db->update('alumni', $data_update_admin);
      }
      else
      {
        $nama = $this->input->post('nama_admin');
        $alamat = $this->input->post('alamat_asal');
        $tgl = $this->input->post('tanggal_lahir');
        $tanggal_lahir = date('Y-m-d', strtotime($tgl));
        $surel = $this->input->post('surel');
        $facebook = $this->input->post('facebook');
        $twitter = $this->input->post('twitter');
        $instagram = $this->input->post('instagram');
        $data_update_admin = array(
          // 'id_alumni' => $id_admin,
          'nama' => $nama,
          'alamat_asal' => $alamat,
          'tanggalLahir' => $tanggal_lahir,
          'email' => $surel,
          'facebook' => $facebook,
          'twitter' => $twitter,
          'instagram' => $instagram 
        );

        $this->db->where('id_alumni', $id_admin);
        $this->db->update('alumni', $data_update_admin);
      }
    }
  }
?>
