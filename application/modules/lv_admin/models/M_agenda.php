<?php
  class M_agenda extends CI_Model{
    public $id = 'id_agenda';
    function __construct()
    {
      parent::__construct();
    }

    function ambil_data_agenda()
    {
      $this->db->select('*');
      $this->db->from('agenda');
      $this->db->order_by('id_agenda','desc');
      $query = $this->db->get();
      return $query;
    }

    function ambil_data_agenda_semua($offset, $limit)
    {
      $query=$this->db->query("SELECT id_agenda, judul,  DATE_FORMAT(tanggalPost, '%d-%m-%Y') as tanggalPost FROM agenda ORDER BY DATE_FORMAT(tanggalPost, '%Y-%m-%d') DESC LIMIT $offset, $limit");
      return $query;
    }

    function ambil_data_agenda_per_id($id_agenda)
    {
      $this->db->select('*');
      $this->db->from('agenda');
      $this->db->where('id_agenda',$id_agenda);
      $query=$this->db->get();
      $result=$query->result();
      return $result;
    }

    function masukan_data_agenda()
    {
      $judul = $this->input->post('judul');
      $penulis = $this->input->post('penulis');
      $isi = $this->input->post('isi');
      $tgl = date('Y-m-d');
      $gambar = $_FILES['upGambar']['name'];
      $data = array(
        'judul' => $judul,
        'penulis' => $penulis,
        'isi' => $isi,
        'tanggalPost' => $tgl,
        'gambar' => $gambar
      );
      $this->db->insert('agenda', $data);
    }

    function update_data_agenda($id_agenda)
    {
      $fileGambar=$_FILES['upGambar']['name'];
      if(!empty($fileGambar))
      {
        //konfigurasi library upload
        $konfigurasi['upload_path']='./assets/img/agenda/';
        $konfigurasi['allowed_types']='jpg|jpeg|png';
        $konfigurasi['remove_spaces']=false;
        $konfigurasi['max_size']=4024;
        $konfigurasi['max_width']=8000;
        $konfigurasi['max_height']=8000;
        $this->upload->initialize($konfigurasi);
        $this->upload->do_upload('upGambar');
        $data_file=$this->upload->data();

        // konfigurasi gambar thumbnails
        $konfigurasi2['source_image'] = $data_file['full_path'];
        $konfigurasi2['new_image'] = './assets/img/agenda/thumbs';
        $konfigurasi2['create_tumb'] = TRUE;
        $konfigurasi2['maintain_ration'] = TRUE;
        $konfigurasi2['width'] = 200;
        $konfigurasi2['height'] = 200;
        $this->image_lib->initialize($konfigurasi2);
        $this->image_lib->resize();

        $judul = $this->input->post('judul');
        $penulis = $this->input->post('penulis');
        $isi = $this->input->post('isi');
        $tgl = date('Y-m-d');
        $gambar = $_FILES['upGambar']['name'];
        $data=array(
          'judul'=>$judul,
          'penulis'=>$penulis,
          'isi'=>$isi,
          'tanggalPost'=>$tgl,
          'gambar'=>$gambar
        );
        $this->db->where('id_agenda',$id_agenda);
        $this->db->update('agenda',$data);
      }
      else
      {
        $judul = $this->input->post('judul');
        $penulis = $this->input->post('penulis');
        $isi = $this->input->post('isi');
        $tgl = date('Y-m-d');

        $data = array(
          'judul'=>$judul,
          'penulis'=>$penulis,
          'isi'=>$isi,
          'tanggalPost'=>$tgl
        );

        $this->db->where('id_agenda', $id_agenda);
        $this->db->update('agenda',$data);
      }
    }

    function hapus_data_agenda_per_id($id_agenda)
    {
      $this->db->where('id_agenda', $id_agenda);
      $this->db->delete('agenda');
    }
  }
?>
