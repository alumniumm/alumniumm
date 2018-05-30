<?php
  defined('BASEPATH') OR exit('File yang dimaksud tidak ada / tidak dapat diakses');
  class Informasi_grafik extends MX_Controller{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('Alumni/mAlumni');
      $this->load->model('mInformasiGrafik');
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
        $data['foto_profil']=$this->mAlumni->ambil_data_foto_profil_per_id($id_alumni);
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
        // ambil data grafik jumlah alumni
        $data['hasilLaki'] = $this->mInformasiGrafik->ambil_alumni_laki();
        $data['hasilPerempuan'] = $this->mInformasiGrafik->ambil_alumni_perempuan();
        //ambil data grafik perkembangan alumni yang bekerja
        $data['hasilSudahBekerja'] = $this->mInformasiGrafik->ambil_alumni_sudah_bekerja();
        $data['hasilBelumBekerja'] = $this->mInformasiGrafik->ambil_alumni_belum_bekerja();
        // ambil data grafik waktu tunggu pekerjaan pertama Alumni
        $data['hasilLamaWaktuTungguPekerjaanPertama'] = $this->mInformasiGrafik->ambil_alumni_waktu_tunggu_kerja_pertama();
        // ambil data grafik hubungan pekerjaan dg perkuliahan
        $data['hasilSangatErat'] = $this->mInformasiGrafik->ambil_alumni_kuliah_kerja_sangat_erat();
        $data['hasilErat'] = $this->mInformasiGrafik->ambil_alumni_kuliah_kerja_erat();
        $data['hasilCukupErat'] = $this->mInformasiGrafik->ambil_alumni_kuliah_kerja_cukup_erat();
        $data['hasilKurangErat'] = $this->mInformasiGrafik->ambil_alumni_kuliah_kerja_kurang_erat();
        $data['hasilTidakSamaSekali'] = $this->mInformasiGrafik->ambil_alumni_kuliah_kerja_tidak_sama_sekali();
        $this->load->view('vInformasiGrafik.html', $data);
      }
    }
  }
?>
