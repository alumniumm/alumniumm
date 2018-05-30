<?php
  defined('BASEPATH') OR exit('File yang dimaksud tidak ada / tidak dapat diakses.');
  class M_login extends CI_Model{
    public function __construct()
    {
      parent::__construct();
    }

    public function ambil_alumni($username, $password)
    {
      $this->db->select('*');
      $this->db->from('alumni');
      $kondisi = array('username' => $username, 'password' => $password);
      $this->db->where($kondisi);
      $query = $this->db->get();
      return $query;
    }
  }
?>
