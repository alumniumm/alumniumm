<?php
  class Informasi_grafik_model extends CI_Model{
    function __construct()
    {
      parent::__construct();
    }

    function ambil_alumni_laki()
    {
      $this->db->where("jenisKelamin",1);
      return $this->db->count_all_results("alumni");
    }

    function ambil_alumni_perempuan()
    {
      $this->db->where("jenisKelamin",2);
      return $this->db->count_all_results("alumni");
    }

    function ambil_alumni_sudah_bekerja()
    {
      $this->db->where("f8",1);
      return $this->db->count_all_results("tracer_study");
    }

    function ambil_alumni_belum_bekerja()
    {
      $this->db->where("f8",2);
      return $this->db->count_all_results("tracer_study");
    }

    function ambil_alumni_waktu_tunggu_kerja_pertama()
    {
      $this->db->select("f5 as 'Bulan', count(id_tracer_study) as 'Jumlah'");
      $this->db->from('tracer_study');
      $this->db->where('f5>', '0');
      $this->db->group_by('f5');
      $result = $this->db->get()->result();
      return $result;
    }

    function ambil_alumni_kuliah_kerja_sangat_erat()
    {
      $this->db->where("f14",1);
      return $this->db->count_all_results("tracer_study");
    }

    function ambil_alumni_kuliah_kerja_erat()
    {
      $this->db->where("f14",2);
      return $this->db->count_all_results("tracer_study");
    }

    function ambil_alumni_kuliah_kerja_cukup_erat()
    {
      $this->db->where("f14",3);
      return $this->db->count_all_results("tracer_study");
    }

    function ambil_alumni_kuliah_kerja_kurang_erat()
    {
      $this->db->where("f14",4);
      return $this->db->count_all_results("tracer_study");
    }

    function ambil_alumni_kuliah_kerja_tidak_sama_sekali()
    {
      $this->db->where("f14",5);
      return $this->db->count_all_results("tracer_study");
    }
  }

?>
