<?php
  class M_karir extends CI_Model{
    function __construct()
    {
      parent::__construct();
    }

    function ambil_data_karir()
    {
      $this->db->select('*');
      $this->db->from('karir');
      $this->db->order_by('id_karir', 'desc');
      $query = $this->db->get();
      return $query;
    }

    function ambil_data_karir_semua($offset, $limit)
    {
      $query = $this->db->query("SELECT id_karir, id_alumni_fk, namaPerusahaan, posisi, DATE_FORMAT(batasWaktu, '%d-%m-%Y') as batasWaktu FROM karir ORDER BY DATE_FORMAT(batasWaktu, '%Y-%m-%d') DESC LIMIT $offset, $limit");
      // $this->db->select("*");
      // $this->db->select("id_karir, id_alumni_fk, namaPerusahaan, posisi, DATE_FORMAT(batasWaktu, '%e-%m-%Y') as batasWaktu");
      // $this->db->from('karir');
      // $this->db->limit($offset, $limit);
      // $this->db->order_by("batasWaktu", "DESC");
      // $query = $this->db->get();
      return $query;
    }

    function ambil_data_karir_per_id($id_karir)
    {
      $this->db->select('*');
      $this->db->from('karir');
      $this->db->where('id_karir',$id_karir);
      $query=$this->db->get();
      $result=$query->result();
      return $result;
    }

    function masukan_data_karir_admin()
    {
      $idAdmin = "admin";
      $namaPerusahaan = $this->input->post('namaPerusahaan');
      $posisi = $this->input->post('posisi');
      $kriteria = $this->input->post('kriteria');
      $batasWaktu = date('Y-m-d', strtotime($this->input->post('batasWaktu')));
      $kontak = $this->input->post('kontak');
      $gambar = $_FILES['upGambar']['name'];
      $data = array(
        'id_alumni_fk' => $idAdmin,
        'namaPerusahaan' => $namaPerusahaan,
        'posisi' => $posisi,
        'kriteria' => $kriteria,
        'batasWaktu' => $batasWaktu,
        'kontak' => $kontak,
         'gambar' => $gambar
      );
      $this->db->insert('karir', $data);
    }

    function update_data_karir($id_karir)
    {
      $fileGambar = $_FILES['upGambar']['name'];
      if(!empty($fileGambar))
      {
        // konfigurasi library upload
        $konfigurasi['upload_path']='.resources/assets/img/karir/';
        $konfigurasi['allowed_types']='jpg|jpeg|png';
        $konfigurasi['remove_spaces']=false;
        $konfigurasi['max_size']=4024;
        $konfigurasi['max_width']=8000;
        $konfigurasi['max_height']=8000;
        $this->upload->initialize($konfigurasi);
        $this->upload->do_upload('upGambar');

        $id_poster = $this->input->post('idAlumni');
        $namaPerusahaan = $this->input->post('namaPerusahaan');
        $posisi = $this->input->post('posisi');
        $kriteria = $this->input->post('kriteria');
        $batasWaktu = $this->input->post('batasWaktu');
        $tgl = date('Y-m-d', strtotime($batasWaktu));
        $kontak = $this->input->post('kontak');
        $gambar = $_FILES['upGambar']['name'];

        $data = array(
          'id_alumni_fk'=>$id_poster,
          'namaPerusahaan'=>$namaPerusahaan,
          'posisi'=>$posisi,
          'kriteria'=>$kriteria,
          'batasWaktu'=>$tgl,
          'kontak'=>$kontak,
          'gambar'=>$gambar
        );

        $this->db->where('id_karir',$id_karir);
        $this->db->update('karir',$data);
      }
      else
      {
        $id_poster = $this->input->post('idAlumni');
        $namaPerusahaan = $this->input->post('namaPerusahaan');
        $posisi = $this->input->post('posisi');
        $kriteria = $this->input->post('kriteria');
        $batasWaktu = $this->input->post('batasWaktu');
        $tgl = date('Y-m-d', strtotime($batasWaktu));
        $kontak = $this->input->post('kontak');

        $data = array(
          'id_alumni_fk'=>$id_poster,
          'namaPerusahaan'=>$namaPerusahaan,
          'posisi'=>$posisi,
          'kriteria'=>$kriteria,
          'batasWaktu'=>$tgl,
          'kontak'=>$kontak
        );

        $this->db->where('id_karir', $id_karir);
        $this->db->update('karir', $data);
      }
    }

    function hapus_data_karir_per_id($id_karir)
    {
      $this->db->where('id_karir', $id_karir);
      $this->db->delete('karir');
    }
  }

?>
