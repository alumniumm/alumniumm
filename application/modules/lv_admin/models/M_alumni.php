<?php
  class M_alumni extends CI_Model{
    public $id = 'id_alumni';
    function __construct()
    {
      parent::__construct();
    }

    function ambil_data_alumni()
    {
      $this->db->select('*');
      $this->db->from('alumni');
      $this->db->order_by('id_alumni', 'desc');
      $query = $this->db->get();
      return $query;
    }

    function ambil_data_alumni_semua($offset, $limit)
    {
      $query = $this->db->query("SELECT * FROM alumni ORDER BY id_alumni DESC LIMIT $offset, $limit");
      return $query;
    }

    function ambil_data_alumni_per_id($id_alumni)
    {
      $this->db->select('*');
      $this->db->from('alumni');
      $this->db->where('id_alumni', $id_alumni);
      $query = $this->db->get();
      $result = $query->result();
      return $result;
    }

    function masukan_data_alumni()
    {
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $enkripsiPassword = md5($password);
      $namaLengkap = $this->input->post('namaLengkap');
      $jenisKelamin = $this->input->post('jenisKelamin');
      $alamatAsal = $this->input->post('alamatAsal');
      $email = $this->input->post('email');
      // $facebook = $this->input->post('facebook');
      // $twitter = $this->input->post('twitter');
      // $instagram = $this->input->post('instagram');
      $tanggalLahir = date('Y-m-d', strtotime($this->input->post('tanggalLahir')));
      $data = array(
        'username' => $username, 
        'password' => $enkripsiPassword, 
        'nama' => $namaLengkap, 
        'jenisKelamin' => $jenisKelamin, 
        'alamat_asal' => $alamatAsal, 
        'email' => $email, 
        // 'facebook' => $facebook, 
        // 'twitter' => $twitter, 
        // 'instagram' => $instagram, 
        'tanggalLahir' => $tanggalLahir, 
        'status' => 'alumni');
      $this->db->insert('alumni', $data);
    }

    function update_data_alumni($id_alumni)
    {
      // $password = $this->input->post('password');
      // $enkripsiPassword = md5($password);
      $namaLengkap = $this->input->post('namaLengkap');
      $alamatAsal = $this->input->post('alamatAsal');
      $jenisKelamin = $this->input->post('jenisKelamin');
      $email = $this->input->post('email');
      $tgl = $this->input->post('tanggal_lahir');
      $tanggalLahir = date('Y-m-d', strtotime($tgl));
      $data = array(
        'nama' => $namaLengkap,
        'jenisKelamin' => $jenisKelamin, 
        'alamat_asal' => $alamatAsal, 
        'email' => $email, 
        'tanggalLahir' => $tanggalLahir, 
        'status' => 'alumni');
      $this->db->where('id_alumni', $id_alumni);
      $this->db->update('alumni', $data);
    }

    function update_password_alumni_per_id($data)
    {
      $this->db->where('id_alumni',$data['id_alumni']);
      $this->db->update('alumni',$data);
    }

    function hapus_data_alumni_per_id($id_alumni)
    {
      $this->db->where('id_alumni', $id_alumni);
      $this->db->delete('alumni');
    }

    function hapus_data_tempat_kerja_alumni_per_id($id_alumni)
    {
      $this->db->where('id_alumni_fk', $id_alumni);
      $this->db->delete('kerja');
    }

  }
?>
