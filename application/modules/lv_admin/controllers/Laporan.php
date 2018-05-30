<?php
  defined('BASEPATH') OR exit('File yang dimaksdu tidak ada / tidak dapat diakses');
  // date_default_timezone_set('Asia/Jakarta');
  ini_set('date.timezone', 'Asia/Jakarta');
  Class Laporan extends CI_Controller
  {
    /*public function __construct()
    {
      parent::__construct();
      $this->load->model('informasigrafik/informasi_grafik_model');
      $this->load->model('M_admin');
      if($this->session->userdata('username')==null)
      {
        redirect('login');
      }
    }*/

    public function index()
    {
      $this->load->view('laporan/view_main');
    }

  }
?>
