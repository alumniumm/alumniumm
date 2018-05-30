<?php
  defined('BASEPATH') OR exit('File yang dimaksud tidak ada / tidak dapat diakses.');
  ini_set('date.timezone', 'Asia/Jakarta');
  Class Ts_alumni extends MX_Controller{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('M_ts_alumni');
      $this->load->model('M_alumni');
      if($this->session->userdata('username')==null)
      {
        redirect('login');
      }
    }

    public function index()
    {
      $data['username']=$this->session->userdata('username');
      if($data['username']!=null)
      {
        $id_alumni=$this->session->userdata('id_alumni');
        $data['foto_profil']=$this->M_alumni->ambil_data_foto_profil_per_id($id_alumni);
        foreach ($data['foto_profil'] as $row1):
          $namaFileFoto=$row1->foto_profil;
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
        $data['id_alumni']=$this->session->userdata('id_alumni');
        $data['alumni_sudah_isi']=$this->M_ts_alumni->ambil_id_tracer_study($data['id_alumni']);

        // ambil nilai status pengisian tracer study alumni
        $status['row']=$this->M_ts_alumni->ambil_data_status_pengisian_tracer_study($data['id_alumni']);
        if($status['row']==null)
        {
          $data['status_tracer_study']=0;
        }
        else
        {
          $st=$status['row']->status;
          $data['status_tracer_study']=$st;
        }

        // ambil data tracer study per id alumni
        $dataTs['row'] = $this->M_ts_alumni->ambil_data_ts_per_id_alumni($id_alumni);
        // jika belum mengisi ts, set data 0 untuk tampilan default 
        if($dataTs['row']==null)
        {
          $data['f21'] = 0;
          $data['f22'] = 0;
          $data['f23'] = 0;
          $data['f24'] = 0;
          $data['f25'] = 0;
          $data['f26'] = 0;
          $data['f27'] = 0;
          $data['f3'] = 0;
          $data['f4'] = 0;
          $data['f5'] = 0;
          $data['f6'] = 0;
          $data['f7'] = 0;
          $data['f7a'] = 0;
          $data['f8'] = 0;
          $data['f9'] = 0;
          $data['f10'] = 0;
          $data['f11'] = 0;
          $data['f12'] = 0;
          $data['f13'] = 0;
          $data['f14'] = 0;
          $data['f15'] = 0;
          $data['f16'] = 0;
          $data['pt1'] = "";
          $data['pt2'] = "";
          $data['pt3'] = "";
          $data['pt4'] = "";
          $data['pt5'] = "";
          $data['pt6'] = 0;
          $data['pt7'] = 0;
          $data['pt8'] = 0;
          $data['pt9'] = 0;
          $data['pt10'] = 0;
        }
        // jika sudah ada data ts yang disimpan 
        else
        {
          $data['f21'] = $dataTs['row']->f21;
          $data['f22'] = $dataTs['row']->f22;
          $data['f23'] = $dataTs['row']->f23;
          $data['f24'] = $dataTs['row']->f24;
          $data['f25'] = $dataTs['row']->f25;
          $data['f26'] = $dataTs['row']->f26;
          $data['f27'] = $dataTs['row']->f27;
          $data['f3'] = $dataTs['row']->f3;
          $data['f4'] = $dataTs['row']->f4;
          $data['f5'] = $dataTs['row']->f5;
          $data['f6'] = $dataTs['row']->f6;
          $data['f7'] = $dataTs['row']->f7;
          $data['f7a'] = $dataTs['row']->f7a;
          $data['f8'] = $dataTs['row']->f8;
          $data['f9'] = $dataTs['row']->f9;
          $data['f10'] = $dataTs['row']->f10;
          $data['f11'] = $dataTs['row']->f11;
          $data['f12'] = $dataTs['row']->f12;
          $data['f13'] = $dataTs['row']->f13;
          $data['f14'] = $dataTs['row']->f14;
          $data['f15'] = $dataTs['row']->f15;
          $data['f16'] = $dataTs['row']->f16;

          // set id ts 
          $id_ts = $dataTs['row']->id_tracer_study;
          if($id_ts != null)
          {
              //ambil data ts sdma
            $data_TS_SDM_Alumni['row'] = $this->M_ts_alumni->ambil_data_ts_sdm_alumni_per_id_ts($id_ts);
            if($data_TS_SDM_Alumni['row']!=null)
            {
              $data['f17a1'] = $data_TS_SDM_Alumni['row']->f171;
              $data['f17a2'] = $data_TS_SDM_Alumni['row']->f172;
              $data['f17a3'] = $data_TS_SDM_Alumni['row']->f173;
              $data['f17a4'] = $data_TS_SDM_Alumni['row']->f174;
              $data['f17a5'] = $data_TS_SDM_Alumni['row']->f175;
              $data['f17a6'] = $data_TS_SDM_Alumni['row']->f176;
              $data['f17a7'] = $data_TS_SDM_Alumni['row']->f177;
              $data['f17a8'] = $data_TS_SDM_Alumni['row']->f178;
              $data['f17a9'] = $data_TS_SDM_Alumni['row']->f179;
              $data['f17a10'] = $data_TS_SDM_Alumni['row']->f1710;
              $data['f17a11'] = $data_TS_SDM_Alumni['row']->f1711;
              $data['f17a12'] = $data_TS_SDM_Alumni['row']->f1712;
              $data['f17a13'] = $data_TS_SDM_Alumni['row']->f1713;
              $data['f17a14'] = $data_TS_SDM_Alumni['row']->f1714;
              $data['f17a15'] = $data_TS_SDM_Alumni['row']->f1715;
              $data['f17a16'] = $data_TS_SDM_Alumni['row']->f1716;
              $data['f17a17'] = $data_TS_SDM_Alumni['row']->f1717;
              $data['f17a18'] = $data_TS_SDM_Alumni['row']->f1718;
              $data['f17a19'] = $data_TS_SDM_Alumni['row']->f1719;
              $data['f17a20'] = $data_TS_SDM_Alumni['row']->f1720;
              $data['f17a21'] = $data_TS_SDM_Alumni['row']->f1721;
              $data['f17a22'] = $data_TS_SDM_Alumni['row']->f1722;
              $data['f17a23'] = $data_TS_SDM_Alumni['row']->f1723;
              $data['f17a24'] = $data_TS_SDM_Alumni['row']->f1724;
              $data['f17a25'] = $data_TS_SDM_Alumni['row']->f1725;
              $data['f17a26'] = $data_TS_SDM_Alumni['row']->f1726;
              $data['f17a27'] = $data_TS_SDM_Alumni['row']->f1727;
              $data['f17a28'] = $data_TS_SDM_Alumni['row']->f1728;
              $data['f17a29'] = $data_TS_SDM_Alumni['row']->f1729;
            }
            else{
              $data['f17a1'] = 0;
              $data['f17a2'] = 0;
              $data['f17a3'] = 0;
              $data['f17a4'] = 0;
              $data['f17a5'] = 0;
              $data['f17a6'] = 0;
              $data['f17a7'] = 0;
              $data['f17a8'] = 0;
              $data['f17a9'] = 0;
              $data['f17a10'] = 0;
              $data['f17a11'] = 0;
              $data['f17a12'] = 0;
              $data['f17a13'] = 0;
              $data['f17a14'] = 0;
              $data['f17a15'] = 0;
              $data['f17a16'] = 0;
              $data['f17a17'] = 0;
              $data['f17a18'] = 0;
              $data['f17a19'] = 0;
              $data['f17a20'] = 0;
              $data['f17a21'] = 0;
              $data['f17a22'] = 0;
              $data['f17a23'] = 0;
              $data['f17a24'] = 0;
              $data['f17a25'] = 0;
              $data['f17a26'] = 0;
              $data['f17a27'] = 0;
              $data['f17a28'] = 0;
              $data['f17a29'] = 0; 
            }

            // ambil data ts sdmp 
            $data_TS_SDM_Prodi['row'] = $this->M_ts_alumni->ambil_data_ts_sdm_prodi_per_id_ts($id_ts);
            if($data_TS_SDM_Prodi['row']!=null)
            {
              $data['f17b1'] = $data_TS_SDM_Prodi['row']->f171;
              $data['f17b2'] = $data_TS_SDM_Prodi['row']->f172;
              $data['f17b3'] = $data_TS_SDM_Prodi['row']->f173;
              $data['f17b4'] = $data_TS_SDM_Prodi['row']->f174;
              $data['f17b5'] = $data_TS_SDM_Prodi['row']->f175;
              $data['f17b6'] = $data_TS_SDM_Prodi['row']->f176;
              $data['f17b7'] = $data_TS_SDM_Prodi['row']->f177;
              $data['f17b8'] = $data_TS_SDM_Prodi['row']->f178;
              $data['f17b9'] = $data_TS_SDM_Prodi['row']->f179;
              $data['f17b10'] = $data_TS_SDM_Prodi['row']->f1710;
              $data['f17b11'] = $data_TS_SDM_Prodi['row']->f1711;
              $data['f17b12'] = $data_TS_SDM_Prodi['row']->f1712;
              $data['f17b13'] = $data_TS_SDM_Prodi['row']->f1713;
              $data['f17b14'] = $data_TS_SDM_Prodi['row']->f1714;
              $data['f17b15'] = $data_TS_SDM_Prodi['row']->f1715;
              $data['f17b16'] = $data_TS_SDM_Prodi['row']->f1716;
              $data['f17b17'] = $data_TS_SDM_Prodi['row']->f1717;
              $data['f17b18'] = $data_TS_SDM_Prodi['row']->f1718;
              $data['f17b19'] = $data_TS_SDM_Prodi['row']->f1719;
              $data['f17b20'] = $data_TS_SDM_Prodi['row']->f1720;
              $data['f17b21'] = $data_TS_SDM_Prodi['row']->f1721;
              $data['f17b22'] = $data_TS_SDM_Prodi['row']->f1722;
              $data['f17b23'] = $data_TS_SDM_Prodi['row']->f1723;
              $data['f17b24'] = $data_TS_SDM_Prodi['row']->f1724;
              $data['f17b25'] = $data_TS_SDM_Prodi['row']->f1725;
              $data['f17b26'] = $data_TS_SDM_Prodi['row']->f1726;
              $data['f17b27'] = $data_TS_SDM_Prodi['row']->f1727;
              $data['f17b28'] = $data_TS_SDM_Prodi['row']->f1728;
              $data['f17b29'] = $data_TS_SDM_Prodi['row']->f1729;
            }
            else
            {
              $data['f17b1'] = 0;
              $data['f17b2'] = 0;
              $data['f17b3'] = 0;
              $data['f17b4'] = 0;
              $data['f17b5'] = 0;
              $data['f17b6'] = 0;
              $data['f17b7'] = 0;
              $data['f17b8'] = 0;
              $data['f17b9'] = 0;
              $data['f17b10'] = 0;
              $data['f17b11'] = 0;
              $data['f17b12'] = 0;
              $data['f17b13'] = 0;
              $data['f17b14'] = 0;
              $data['f17b15'] = 0;
              $data['f17b16'] = 0;
              $data['f17b17'] = 0;
              $data['f17b18'] = 0;
              $data['f17b19'] = 0;
              $data['f17b20'] = 0;
              $data['f17b21'] = 0;
              $data['f17b22'] = 0;
              $data['f17b23'] = 0;
              $data['f17b24'] = 0;
              $data['f17b25'] = 0;
              $data['f17b26'] = 0;
              $data['f17b27'] = 0;
              $data['f17b28'] = 0;
              $data['f17b29'] = 0;
            }

            // ambil data ts pertanyaan tambahan
            $dataTSPertanyaanTambahanAlumni['row'] = $this->M_ts_alumni->ambil_data_ts_pt_per_id_ts($id_ts);
            if($dataTSPertanyaanTambahanAlumni['row'] != null)
            {
              $data['pt1'] = $dataTSPertanyaanTambahanAlumni['row']->pt1;
              $data['pt2'] = $dataTSPertanyaanTambahanAlumni['row']->pt2;
              $data['pt3'] = $dataTSPertanyaanTambahanAlumni['row']->pt3;
              $data['pt4'] = $dataTSPertanyaanTambahanAlumni['row']->pt4;
              $data['pt5'] = $dataTSPertanyaanTambahanAlumni['row']->pt5;
              $data['pt6'] = $dataTSPertanyaanTambahanAlumni['row']->pt6;
              $data['pt7'] = $dataTSPertanyaanTambahanAlumni['row']->pt7;
              $data['pt8'] = $dataTSPertanyaanTambahanAlumni['row']->pt8;
              $data['pt9'] = $dataTSPertanyaanTambahanAlumni['row']->pt9;
              $data['pt10'] = $dataTSPertanyaanTambahanAlumni['row']->pt10;
            }
            else
            {
              $data['pt1'] = "";
              $data['pt2'] = "";
              $data['pt3'] = "";
              $data['pt4'] = "";
              $data['pt5'] = "";
              $data['pt6'] = 0;
              $data['pt7'] = 0;
              $data['pt8'] = 0;
              $data['pt9'] = 0;
              $data['pt10'] = 0;
            }
          }
        }
        
        // $data['soal_ts_alumni_tambahan_urai'] = $this->M_ts_alumni->ambil_data_soal_ts_alumni_tambahan_urai();
        $data['soal_ts_alumni_tambahan_urai_1'] = $this->M_ts_alumni->ambil_data_soal_ts_alumni_tambahan_urai_id_tanya_1();
        $data['soal_ts_alumni_tambahan_urai_2'] = $this->M_ts_alumni->ambil_data_soal_ts_alumni_tambahan_urai_id_tanya_2();
        $data['soal_ts_alumni_tambahan_urai_3'] = $this->M_ts_alumni->ambil_data_soal_ts_alumni_tambahan_urai_id_tanya_3();
        $data['soal_ts_alumni_tambahan_urai_4'] = $this->M_ts_alumni->ambil_data_soal_ts_alumni_tambahan_urai_id_tanya_4();
        $data['soal_ts_alumni_tambahan_urai_5'] = $this->M_ts_alumni->ambil_data_soal_ts_alumni_tambahan_urai_id_tanya_5();
        $data['soal_ts_alumni_tambahan_pilih_1'] = $this->M_ts_alumni->ambil_data_soal_ts_alumni_tambahan_pilih_id_tanya_1();
        $data['soal_ts_alumni_tambahan_pilih_2'] = $this->M_ts_alumni->ambil_data_soal_ts_alumni_tambahan_pilih_id_tanya_2();
        $data['soal_ts_alumni_tambahan_pilih_3'] = $this->M_ts_alumni->ambil_data_soal_ts_alumni_tambahan_pilih_id_tanya_3();
        $data['soal_ts_alumni_tambahan_pilih_4'] = $this->M_ts_alumni->ambil_data_soal_ts_alumni_tambahan_pilih_id_tanya_4();
        $data['soal_ts_alumni_tambahan_pilih_5'] = $this->M_ts_alumni->ambil_data_soal_ts_alumni_tambahan_pilih_id_tanya_5();
        $data['jumlah_pertanyaan_tambahan_ts_alumni_urai'] = $this->M_ts_alumni->ambil_data_jumlah_pertanyaan_ts_alumni_tambahan_urai();
        $data['soal_ts_alumni_tambahan_pilih'] = $this->M_ts_alumni->ambil_data_soal_ts_alumni_tambahan_pilih();
        $this->load->view('tracerstudy/alumni/view_main',$data);
      }
    }

    public function masuk_data_ts_pf1()
    {
      $f21 = $this->input->post('f21');
      $f22 = $this->input->post('f22');
      $f23 = $this->input->post('f23');
      $f24 = $this->input->post('f24');
      $f25 = $this->input->post('f25');
      $f26 = $this->input->post('f26');
      $f27 = $this->input->post('f27');
      $tanggalIsi = $this->input->post('tanggalIsi');
      $statusTracerStudy = $this->input->post('statusTracerStudy');
    
      $data=array(
        'id_alumni_fk'=>$this->session->userdata('id_alumni'),
        'f21'=>$f21,
        'f22'=>$f22,
        'f23'=>$f23,
        'f24'=>$f24,
        'f25'=>$f25,
        'f26'=>$f26,
        'f27'=>$f27,
        'waktu_isi'=>$tanggalIsi,
        'status'=>1
      );

      if($statusTracerStudy == 0){
        $this->M_ts_alumni->simpan_data_ts($data);  
      }else{
        $this->M_ts_alumni->update_data_ts($data);
      }
              
    }

    public function masuk_data_ts_pf2()
    {
      $tanggalIsi = $this->input->post('tanggalIsi');
      $f3 = $this->input->post('f3');

      $data=array(
        'id_alumni_fk'=>$this->session->userdata('id_alumni'),
        'f3'=>$f3,
        'waktu_isi'=>$tanggalIsi,
        'status'=>2
      );
      $this->M_ts_alumni->update_data_ts($data);
    }

    public function masuk_data_ts_pf3()
    {
      $tanggalIsi = $this->input->post('tanggalIsi');
      $f4=$this->input->post('f4');
      $f5=$this->input->post('f5');
      $f6=$this->input->post('f6');
      $f7=$this->input->post('f7');
      $f7a=$this->input->post('f7a');
      $data=array(
        'id_alumni_fk'=>$this->session->userdata('id_alumni'),
        'f4' => $f4,
        'f5' => $f5,
        'f6' => $f6,
        'f7' => $f7,
        'f7a' => $f7a,
        'waktu_isi'=>$tanggalIsi,
        'status'=>3
      );
      $this->M_ts_alumni->update_data_ts($data);
    }

    public function masuk_data_ts_pf4()
    {
      $tanggalIsi = $this->input->post('tanggalIsi');
      $f8=$this->input->post('f8');
      $data=array(
        'id_alumni_fk' => $this->session->userdata('id_alumni'),
        'f8' => $f8,
        'waktu_isi'=>$tanggalIsi,
        'status'=>4
      );
      $this->M_ts_alumni->update_data_ts($data);
    }

    public function masuk_data_ts_pf5()
    {
      $tanggalIsi = $this->input->post('tanggalIsi');
      $f9=$this->input->post('f9');
      $f10=$this->input->post('f10');
      $data=array(
        'id_alumni_fk' => $this->session->userdata('id_alumni'),
        'f9' => $f9,
        'f10' => $f10,
        'waktu_isi'=>$tanggalIsi,
        'status'=>5
      );
      $this->M_ts_alumni->update_data_ts($data);
    }

    public function masuk_data_ts_pf6()
    {
      $tanggalIsi = $this->input->post('tanggalIsi');
      $f11=$this->input->post('f11');
      $f12=$this->input->post('f12');
      $f13=$this->input->post('f13');
      $f14=$this->input->post('f14');
      $f15=$this->input->post('f15');
      $f16=$this->input->post('f16');
      $data=array(
        'id_alumni_fk' => $this->session->userdata('id_alumni'),
        'f11' => $f11,
        'f12' => $f12,
        'f13' => $f13,
        'f14' => $f14,
        'f15' => $f15,
        'f16' => $f16,
        'waktu_isi'=> $tanggalIsi,
        'status'=>6
      );
      $this->M_ts_alumni->update_data_ts($data);
    }

    public function masuk_data_ts_pt()
    {
      $tanggalIsi = $this->input->post('tanggalIsi');
      $pt1 = $this->input->post('pt1');
      $pt2 = $this->input->post('pt2');
      $pt3 = $this->input->post('pt3');
      $pt4 = $this->input->post('pt4');
      $pt5 = $this->input->post('pt5');
      $pt6 = $this->input->post('pt6');
      $pt7 = $this->input->post('pt7');
      $pt8 = $this->input->post('pt8');
      $pt9 = $this->input->post('pt9');
      $pt10 = $this->input->post('pt10');

      $id_alumni = $this->session->userdata('id_alumni');
      $data_id_ts_alumni['row'] = $this->M_ts_alumni->ambil_id_tracer_study_alumni($id_alumni);
      $fk_id_ts_alumni = $data_id_ts_alumni['row']->id_tracer_study;
      $id_ts_pt = $this->M_ts_alumni->cek_id_ts_pt_alumni($fk_id_ts_alumni);
      $data = array (
        'fk_id_ts' => $fk_id_ts_alumni,
        'pt1' => $pt1,
        'pt2' => $pt2,
        'pt3' => $pt3,
        'pt4' => $pt4,
        'pt5' => $pt5,
        'pt6' => $pt6,
        'pt7' => $pt7,
        'pt8' => $pt8,
        'pt9' => $pt9,
        'pt10' => $pt10,
        'tanggal_isi' => $tanggalIsi,
        'status' => 'pt'
      );

      // $this->M_ts_alumni->simpan_data_ts_pt($data);
      if($id_ts_pt >= 1)
      {
        $this->M_ts_alumni->update_data_ts_pt($data);  
      }
      else
      {
        $this->M_ts_alumni->simpan_data_ts_pt($data);
      }
    }

    public function masuk_data_ts_sdma_1()
    {
      $id_alumni=$this->session->userdata('id_alumni');

      // code lawas
      // ambil id ts alumni
      // $data_id_ts_alumni['row'] = $this->M_ts_alumni->ambil_id_tracer_study_alumni($id_alumni);
      
      // memasukkan data id ts ke variabel
      // $fk_id_ts_alumni = $data_id_ts_alumni['row']->id_tracer_study;
  
      //cek / menghitung id ts alumni fk apakah ada 
      // $id_ts_sdm_alumni = $this->M_ts_alumni->cek_id_ts_sdm_alumni($fk_id_ts_alumni);
  
      // code baru : sukses
      // ambil id ts alumni
      $data_id_ts_alumni = $this->M_ts_alumni->ambil_id_tracer_study_alumni($id_alumni);
  
      //cek / menghitung id ts alumni fk apakah ada 
      $id_ts_sdm_alumni = $this->M_ts_alumni->cek_id_ts_sdm_alumni($data_id_ts_alumni);

      $tanggal = $this->input->post('tanggalIsi');
      $f171=$this->input->post('f171');
      $f172=$this->input->post('f172');
      $f173=$this->input->post('f173');
      $f174=$this->input->post('f174');
      $f175=$this->input->post('f175');
      $f176=$this->input->post('f176');
      $f177=$this->input->post('f177');
      $f178=$this->input->post('f178');
      $f179=$this->input->post('f179');
      $f1710=$this->input->post('f1710');
      $f1711=$this->input->post('f1711');
      $f1712=$this->input->post('f1712');
      $f1713=$this->input->post('f1713');
      $f1714=$this->input->post('f1714');
      $f1715=$this->input->post('f1715');

      $data=array(
        'fk_id_ts' => $data_id_ts_alumni,
        'f171' => $f171,
        'f172' => $f172,
        'f173' => $f173,
        'f174' => $f174,
        'f175' => $f175,
        'f176' => $f176,
        'f177' => $f177,
        'f178' => $f178,
        'f179' => $f179,
        'f1710' => $f1710,
        'f1711' => $f1711,
        'f1712' => $f1712,
        'f1713' => $f1713,
        'f1714' => $f1714,
        'f1715' => $f1715
      );

      $data2 = array(
        'id_tracer_study' => $data_id_ts_alumni,
        'waktu_isi' => $tanggal,
        'status' => 71
      );

      if($id_ts_sdm_alumni==1)
      {
        $this->M_ts_alumni->update_data_ts_sdm_alumni($data);
        $this->M_ts_alumni->update_data_status_alumni($data2);  
      }
      else
      {
        $this->M_ts_alumni->simpan_data_ts_sdm_alumni($data);
        $this->M_ts_alumni->update_data_status_alumni($data2);
      }
      
    }

    public function masuk_data_ts_sdma_2()
    {
      $id_alumni=$this->session->userdata('id_alumni');
      // $data_id_ts_alumni['row']=$this->M_ts_alumni->ambil_id_ts_alumni($id_alumni);
      // $fk_id_ts_alumni = $data_id_ts_alumni['row']->id_tracer_study;

      // ambil id ts alumni
      // $data_id_ts_alumni['row'] = $this->M_ts_alumni->ambil_id_tracer_study_alumni($id_alumni);
      
      // memasukkan data id ts ke variabel
      // $fk_id_ts_alumni = $data_id_ts_alumni['row']->id_tracer_study;
  
      //cek / menghitung id ts alumni fk apakah ada 
      // $id_ts_sdm_alumni = $this->M_ts_alumni->cek_id_ts_sdm_alumni($fk_id_ts_alumni);

      // code baru : sukses
      // ambil id ts alumni
      $data_id_ts_alumni = $this->M_ts_alumni->ambil_id_tracer_study_alumni($id_alumni);
  
      //cek / menghitung id ts alumni fk apakah ada 
      $id_ts_sdm_alumni = $this->M_ts_alumni->cek_id_ts_sdm_alumni($data_id_ts_alumni);

      $tanggal = $this->input->post('tanggalIsi');
      $f1716=$this->input->post('f1716');
      $f1717=$this->input->post('f1717');
      $f1718=$this->input->post('f1718');
      $f1719=$this->input->post('f1719');
      $f1720=$this->input->post('f1720');
      $f1721=$this->input->post('f1721');
      $f1722=$this->input->post('f1722');
      $f1723=$this->input->post('f1723');
      $f1724=$this->input->post('f1724');
      $f1725=$this->input->post('f1725');
      $f1726=$this->input->post('f1726');
      $f1727=$this->input->post('f1727');
      $f1728=$this->input->post('f1728');
      $f1729=$this->input->post('f1729');
      
      $data=array(
        'fk_id_ts' => $data_id_ts_alumni,
        'f1716' => $f1716,
        'f1717' => $f1717,
        'f1718' => $f1718,
        'f1719' => $f1719,
        'f1720' => $f1720,
        'f1721' => $f1721,
        'f1722' => $f1722,
        'f1723' => $f1723,
        'f1724' => $f1724,
        'f1725' => $f1725,
        'f1726' => $f1726,
        'f1727' => $f1727,
        'f1728' => $f1728,
        'f1729' => $f1729
      );

      $data2 = array(
        'id_tracer_study' => $data_id_ts_alumni,
        'waktu_isi' => $tanggal,
        'status' => 72
      );

      // $this->M_ts_alumni->simpan_data_ts_sdm_alumni($data);
      if($id_ts_sdm_alumni>=1)
      {
        $this->M_ts_alumni->update_data_ts_sdm_alumni($data);  
        $this->M_ts_alumni->update_data_status_alumni($data2);
      }
      else
      {
        $this->M_ts_alumni->simpan_data_ts_sdm_alumni($data);
        $this->M_ts_alumni->update_data_status_alumni($data2);
      }
    }

    public function masuk_data_ts_sdmp_1()
    {
      $id_alumni=$this->session->userdata('id_alumni');
      // $data_id_ts_alumni['row']=$this->M_ts_alumni->ambil_id_ts_alumni($id_alumni);
      // $fk_id_ts_alumni = $data_id_ts_alumni['row']->id_tracer_study;

      // ambil id ts alumni
      // $data_id_ts_alumni['row'] = $this->M_ts_alumni->ambil_id_tracer_study_alumni($id_alumni);
      
      // memasukkan data id ts ke variabel
      // $fk_id_ts_alumni = $data_id_ts_alumni['row']->id_tracer_study;
  
      //cek / menghitung id ts alumni fk apakah ada 
      // $id_ts_sdm_prodi = $this->M_ts_alumni->cek_id_ts_sdm_prodi($fk_id_ts_alumni);

       // code baru : sukses
      // ambil id ts alumni
      $data_id_ts_alumni = $this->M_ts_alumni->ambil_id_tracer_study_alumni($id_alumni);
  
      //cek / menghitung id ts alumni fk apakah ada 
      $id_ts_sdm_prodi = $this->M_ts_alumni->cek_id_ts_sdm_prodi($data_id_ts_alumni);

      $tanggal = $this->input->post('tanggalIsi');
      $f171=$this->input->post('f171');
      $f172=$this->input->post('f172');
      $f173=$this->input->post('f173');
      $f174=$this->input->post('f174');
      $f175=$this->input->post('f175');
      $f176=$this->input->post('f176');
      $f177=$this->input->post('f177');
      $f178=$this->input->post('f178');
      $f179=$this->input->post('f179');
      $f1710=$this->input->post('f1710');
      $f1711=$this->input->post('f1711');
      $f1712=$this->input->post('f1712');
      $f1713=$this->input->post('f1713');
      $f1714=$this->input->post('f1714');
      $f1715=$this->input->post('f1715');

      $data=array(
        'fk_id_ts' => $data_id_ts_alumni,
        'f171' => $f171,
        'f172' => $f172,
        'f173' => $f173,
        'f174' => $f174,
        'f175' => $f175,
        'f176' => $f176,
        'f177' => $f177,
        'f178' => $f178,
        'f179' => $f179,
        'f1710' => $f1710,
        'f1711' => $f1711,
        'f1712' => $f1712,
        'f1713' => $f1713,
        'f1714' => $f1714,
        'f1715' => $f1715
      );

      $data2 = array(
        'id_tracer_study' => $data_id_ts_alumni,
        'waktu_isi' => $tanggal,
        'status' => 81
      );

      // $this->M_ts_alumni->simpan_data_ts_sdm_prodi($data);

      if($id_ts_sdm_prodi>=1)
      {
        $this->M_ts_alumni->update_data_ts_sdm_prodi($data);  
        $this->M_ts_alumni->update_data_status_alumni($data2);
      }
      else
      {
        $this->M_ts_alumni->simpan_data_ts_sdm_prodi($data);
        $this->M_ts_alumni->update_data_status_alumni($data2);
      }
    }

    public function masuk_data_ts_sdmp_2()
    {
      $id_alumni=$this->session->userdata('id_alumni');
      // $data_id_ts_alumni['row']=$this->M_ts_alumni->ambil_id_ts_alumni($id_alumni);
      // $fk_id_ts_alumni = $data_id_ts_alumni['row']->id_tracer_study;
      
      // ambil id ts alumni
      // $data_id_ts_alumni['row'] = $this->M_ts_alumni->ambil_id_tracer_study_alumni($id_alumni);
      
      // memasukkan data id ts ke variabel
      // $fk_id_ts_alumni = $data_id_ts_alumni['row']->id_tracer_study;
  
      //cek / menghitung id ts alumni fk apakah ada 
      // $id_ts_sdm_prodi = $this->M_ts_alumni->cek_id_ts_sdm_prodi($fk_id_ts_alumni);

       // code baru : sukses
      // ambil id ts alumni
      $data_id_ts_alumni = $this->M_ts_alumni->ambil_id_tracer_study_alumni($id_alumni);
  
      //cek / menghitung id ts alumni fk apakah ada 
      $id_ts_sdm_prodi = $this->M_ts_alumni->cek_id_ts_sdm_prodi($data_id_ts_alumni);

      $tanggal = $this->input->post('tanggalIsi');
      $f1716=$this->input->post('f1716');
      $f1717=$this->input->post('f1717');
      $f1718=$this->input->post('f1718');
      $f1719=$this->input->post('f1719');
      $f1720=$this->input->post('f1720');
      $f1721=$this->input->post('f1721');
      $f1722=$this->input->post('f1722');
      $f1723=$this->input->post('f1723');
      $f1724=$this->input->post('f1724');
      $f1725=$this->input->post('f1725');
      $f1726=$this->input->post('f1726');
      $f1727=$this->input->post('f1727');
      $f1728=$this->input->post('f1728');
      $f1729=$this->input->post('f1729');
      
      $data=array(
        'fk_id_ts' => $data_id_ts_alumni,
        'f1716' => $f1716,
        'f1717' => $f1717,
        'f1718' => $f1718,
        'f1719' => $f1719,
        'f1720' => $f1720,
        'f1721' => $f1721,
        'f1722' => $f1722,
        'f1723' => $f1723,
        'f1724' => $f1724,
        'f1725' => $f1725,
        'f1726' => $f1726,
        'f1727' => $f1727,
        'f1728' => $f1728,
        'f1729' => $f1729
      );

      $data2 = array(
        'id_tracer_study' => $data_id_ts_alumni,
        'waktu_isi' => $tanggal,
        'status' => 82
      );

      // $this->M_ts_alumni->simpan_data_ts_sdm_prodi($data);

      if($id_ts_sdm_prodi>=1)
      {
        $this->M_ts_alumni->update_data_ts_sdm_prodi($data);  
        $this->M_ts_alumni->update_data_status_alumni($data2);
      }
      else
      {
        $this->M_ts_alumni->simpan_data_ts_sdm_prodi($data);
        $this->M_ts_alumni->update_data_status_alumni($data2);
      }
    }
  }
?>
