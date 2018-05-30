<?php
    defined('BASEPATH') OR exit('File yang dimaksud tidak ada / tidak dapat diakses');

    ini_set('date.timezone', 'Asia/Jakarta');
    use mikehaertl\wkhtmlto\Pdf;

  Class Stakeholder extends CI_Controller
  {
    
      public function __construct()
      {
        parent::__construct();
        $this->load->model('M_laporan_stakeholder');
        $this->load->model('M_admin');
        $this->load->helper('text');
        if($this->session->userdata('username')==null)
        {
          redirect('login');
        }
      }

      public function index()
      {
        $data['username'] = $this->session->userdata('username');
        if($data['username'] == 'admin')
        {
          $id_admin = $this->session->userdata('id_alumni');
          
          $data['foto_profil'] = $this->M_admin->ambil_data_foto_profil_admin($id_admin);
          
          foreach ($data['foto_profil'] as $row):
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

          $halaman = $this->uri->segment(3);
          $limit = 10;
          if(!$halaman)
          {
            $offset =  0;
          }
          else
          {
            $offset = $halaman;
          }
          $total_ts_stakeholder = $this->M_laporan_stakeholder->ambil_data_jumlah_total_ts_stakeholder();

          $konfig['base_url'] = base_url('/index.php/kelolalaporantsstakeholder/index');
          $konfig['total_rows'] = $total_ts_stakeholder->num_rows();
          $konfig['per_page'] = $limit;
          $konfig['uri_segment'] = 3;

          $konfig['full_tag_open'] = '<ul class="pagination">';
            $konfig['full_tag_close'] = '</ul>';
            $konfig['num_tag_open'] = '<li>';
            $konfig['num_tag_close'] = '</li>';
            $konfig['cur_tag_open'] = '<li class="active"><a href="#">';
            $konfig['cur_tag_close'] = '</a></li>';
            $konfig['prev_tag_open'] = '<li>';
            $konfig['prev_tag_close'] = '</li>';
            $konfig['first_link'] = 'Awal';
            $konfig['first_tag_open'] = '<li>';
            $konfig['first_tag_close'] = '</li>';
            $konfig['last_link'] = 'Akhir';
            $konfig['last_tag_open'] = '<li>';
            $konfig['last_tag_close'] = '</li>';

            $konfig['prev_link'] = '<i class="fa fa-long-arrow-left"></i> Sebelumnya';
            $konfig['prev_tag_open'] = '<li>';
            $konfig['prev_tag_close'] = '</li>';

            $konfig['next_link'] = 'Selanjutnya <i class="fa fa-long-arrow-right"></i>';
            $konfig['next_tag_open'] = '<li>';
            $konfig['next_tag_close'] = '</li>';

            $this->pagination->initialize($konfig);
            $data['paginator'] = $this->pagination->create_links();
            $data['TS_Stakeholder'] = $this->M_laporan_stakeholder->ambil_data_ts_stakeholder_semua($limit, $offset);
            $data['page'] = $halaman;

            $this->load->view('laporan/stakeholder/view_main', $data);
        }
      }

        public function Detail_ts_stakeholder_per_id()
        {
            $data['username'] = $this->session->userdata('username');
            if($data['username'] == 'admin')
            {
                $id_admin = $this->session->userdata('id_alumni');
                
                $data['foto_profil'] = $this->M_admin->ambil_data_foto_profil_admin($id_admin);
                
                foreach ($data['foto_profil'] as $row):
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

                $id_tss = $this->uri->segment(3);
                $hasil['row'] = $this->M_laporan_stakeholder->ambil_data_ts_stakeholder_per_id($id_tss);
                $data['nama'] = $hasil['row']->nama;
                $data['perusahaan'] = $hasil['row']->perusahaan;
                $data['jabatan'] = $hasil['row']->jabatan;
                $data['namaAlumni'] = $hasil['row']->namaAlumni;
                $data['p1'] = $hasil['row']->p1;
                $data['p2'] = $hasil['row']->p2;
                $data['p3'] = $hasil['row']->p3;
                $data['p4'] = $hasil['row']->p4;
                $data['p5'] = $hasil['row']->p5;
                $data['p6'] = $hasil['row']->p6;
                $data['p7'] = $hasil['row']->p7;
                $data['p8'] = $hasil['row']->p8;
                $data['p9'] = $hasil['row']->p9;
                $data['p10'] = $hasil['row']->p10;
                $data['p11'] = $hasil['row']->p11;
                $data['p12'] = $hasil['row']->p12;
                $data['p13'] = $hasil['row']->p13;
                $data['p14'] = $hasil['row']->p14;
                $data['p15'] = $hasil['row']->p15;
                $data['p16'] = $hasil['row']->p16;
                $data['p17'] = $hasil['row']->p17;
                $data['p18'] = $hasil['row']->p18;
                $data['p19'] = $hasil['row']->p19;
                $data['p20'] = $hasil['row']->p20;
                $data['p21'] = $hasil['row']->p21;
                $data['p22'] = $hasil['row']->p22;
                $data['p23'] = $hasil['row']->p23;
                $data['p24'] = $hasil['row']->p24;
                $data['p25'] = $hasil['row']->p25;
                $data['id_tss'] = $id_tss;
                
                // view detail tss
                $this->load->view('laporan/stakeholder/view_main_detail', $data);

                //laporand pdf tss
                // $this->load->view('vLaporanTSStakeholder.html', $data);
            }
        }

        public function Konversi_ts_stakeholder_pdf_wk()
        {
            $id_tss = $this->uri->segment(3);

            $hasil['row'] = $this->M_laporan_stakeholder->ambil_data_ts_stakeholder_per_id($id_tss);
            $data['nama'] = $hasil['row']->nama;
            $data['perusahaan'] = $hasil['row']->perusahaan;
            $data['jabatan'] = $hasil['row']->jabatan;
            $data['namaAlumni'] = $hasil['row']->namaAlumni;
            $data['p1'] = $hasil['row']->p1;
            $data['p2'] = $hasil['row']->p2;
            $data['p3'] = $hasil['row']->p3;
            $data['p4'] = $hasil['row']->p4;
            $data['p5'] = $hasil['row']->p5;
            $data['p6'] = $hasil['row']->p6;
            $data['p7'] = $hasil['row']->p7;
            $data['p8'] = $hasil['row']->p8;
            $data['p9'] = $hasil['row']->p9;
            $data['p10'] = $hasil['row']->p10;
            $data['p11'] = $hasil['row']->p11;
            $data['p12'] = $hasil['row']->p12;
            $data['p13'] = $hasil['row']->p13;
            $data['p14'] = $hasil['row']->p14;
            $data['p15'] = $hasil['row']->p15;
            $data['p16'] = $hasil['row']->p16;
            $data['p17'] = $hasil['row']->p17;
            $data['p18'] = $hasil['row']->p18;
            $data['p19'] = $hasil['row']->p19;
            $data['p20'] = $hasil['row']->p20;
            $data['p21'] = $hasil['row']->p21;
            $data['p22'] = $hasil['row']->p22;
            $data['p23'] = $hasil['row']->p23;
            $data['p24'] = $hasil['row']->p24;
            $data['p25'] = $hasil['row']->p25;

            $nama_perusahaan = $data['perusahaan'];
            $nama_alumni = $data['namaAlumni'];
            $nama_pengisi = $data['nama'];
            // $path_lap_ts_stakeholder_pdf = "C:\Users\andy\Downloads\wkpdf\ltss-$nama_perusahaan-$nama_pengisi-$nama_alumni.pdf";
            // if(file_exists($path_lap_ts_stakeholder_pdf) ==  true)
            // {
            //     $data['id_tss'] = $id_tss;
            //     $this->load->view('vKonfirmasiUpdateLaporanStakeholder.html', $data);
            // }
            // else
            // {
            // require __DIR__ . '/../../../../vendor/autoload.php';
            require __DIR__ . '/../../../../../tmp/vendor/autoload.php';               
            $pdf = new Pdf([
                'binary' => './wkhtmltopdf/wkhtmltox/bin/wkhtmltopdf',
                'commandOptions' => [
                    'useExec' => true,
                ],
            ]);

            $content = $this->load->view('laporan/stakeholder/view_main', $data, true);
            $pdf->addPage($content);

                // $pdf->saveAs("C:\Users\andy\Downloads\wkpdf\ltss-$nama_perusahaan-$nama_pengisi-$nama_alumni.pdf");
            if($pdf->send('laporan ts stakeholder '.$nama_perusahaan.' '.$nama_pengisi.' '.$nama_alumni.'.pdf'))
            {
                $this->session->set_flashdata('msg_simpan_laporan_sukses', '<div class="alert alert-success text-center">Laporan Tracer Study Stakeholder '.$nama_perusahaan.' '.$nama_pengisi.' berhasil disimpan. Terimakasih.</div>');
                redirect('admin/laporan/stakeholder');
            }
            else if($pdf->send('laporan ts stakeholder '.$nama_perusahaan.' '.$nama_pengisi.' '.$nama_alumni.'.pdf'))
            {
                echo $pdf->getError();
            }
                // else
                // {
                    // $this->session->set_flashdata('msg_simpan_laporan_sukses', '<div class="alert alert-success text-center">Laporan Tracer Study Stakeholder '.$nama_perusahaan.' '.$nama_pengisi.' berhasil disimpan. Terimakasih.</div>');
                    // redirect('Kelola_laporan_ts_stakeholder');   
                // }
        
       }

       public function Update_konversi_laporan_ts_stakeholder_pdf()
       {
           $id_tss = $this->uri->segment(3);

            $hasil['row'] = $this->M_laporan_stakeholder->ambil_data_ts_stakeholder_per_id($id_tss);
            $data['nama'] = $hasil['row']->nama;
            $data['perusahaan'] = $hasil['row']->perusahaan;
            $data['jabatan'] = $hasil['row']->jabatan;
            $data['namaAlumni'] = $hasil['row']->namaAlumni;
            $data['p1'] = $hasil['row']->p1;
            $data['p2'] = $hasil['row']->p2;
            $data['p3'] = $hasil['row']->p3;
            $data['p4'] = $hasil['row']->p4;
            $data['p5'] = $hasil['row']->p5;
            $data['p6'] = $hasil['row']->p6;
            $data['p7'] = $hasil['row']->p7;
            $data['p8'] = $hasil['row']->p8;
            $data['p9'] = $hasil['row']->p9;
            $data['p10'] = $hasil['row']->p10;
            $data['p11'] = $hasil['row']->p11;
            $data['p12'] = $hasil['row']->p12;
            $data['p13'] = $hasil['row']->p13;
            $data['p14'] = $hasil['row']->p14;
            $data['p15'] = $hasil['row']->p15;
            $data['p16'] = $hasil['row']->p16;
            $data['p17'] = $hasil['row']->p17;
            $data['p18'] = $hasil['row']->p18;
            $data['p19'] = $hasil['row']->p19;
            $data['p20'] = $hasil['row']->p20;
            $data['p21'] = $hasil['row']->p21;
            $data['p22'] = $hasil['row']->p22;
            $data['p23'] = $hasil['row']->p23;
            $data['p24'] = $hasil['row']->p24;
            $data['p25'] = $hasil['row']->p25;

            $nama_perusahaan = $data['perusahaan'];
            $nama_alumni = $data['namaAlumni'];
            $nama_pengisi = $data['nama'];

            require __DIR__ . '/../../../../vendor/autoload.php';               
            $pdf = new Pdf([
                'commandOptions' => [
                    'useExec' => true,
                ],
            ]);

            $content = $this->load->view('laporan/stakeholder/view_main', $data, true);
            $pdf->addPage($content);

            $pdf->saveAs("C:\Users\andy\Downloads\wkpdf\ltss-$nama_perusahaan-$nama_pengisi-$nama_alumni.pdf");
            if(!$pdf->saveAs("C:\Users\andy\Downloads\wkpdf\ltss-$nama_perusahaan-$nama_pengisi-$nama_alumni.pdf"))
            {
                echo $pdf->getError();
            }
            else
            {
                $this->session->set_flashdata('msg_simpan_laporan_sukses', '<div class="alert alert-success text-center">Laporan Tracer Study Stakeholder '.$nama_perusahaan.' '.$nama_pengisi.' berhasil diperbarui. Terimakasih.</div>');
                    redirect('admin/laporan/stakeholder');   
            }
       }
  }
?>