<?php
  class M_alumni_ts extends CI_Model{
    function __construct()
    {
      parent::__construct();
    }

    function ambil_data_status_tanya_per_id($id_tanya_ts_alumni)
    {
      $this->db->select('status_tanya_ts_alumni');
      $this->db->from('pertanyaan_ts_alumni');
      $this->db->where('id_tanya_ts_alumni',$id_tanya_ts_alumni);
      $query=$this->db->get();
      $result=$query->result();
      return $result;
    }

    function ambil_data_awal_status_pertanyaan_per_id($id_tanya_ts_alumni)
    {
      $this->db->select('status_tanya_ts_alumni');
      $this->db->from('pertanyaan_ts_alumni');
      $this->db->where('id_tanya_ts_alumni',$id_tanya_ts_alumni);
      $query = $this->db->get();
      return $query;
    }

    function ambil_data_jumlah_pertanyaan()
    {
      $this->db->select('*');
      $this->db->from('pertanyaan_ts_alumni');
      $query = $this->db->get();
      return $query;
    }

    function ambil_data_jumlah_tanya_urai()
    {
      $this->db->select('*');
      $this->db->from('pertanyaan_ts_alumni');
      $kondisi = array('jenis_pertanyaan_ts_alumni' => 'urai', 'status_tanya_ts_alumni' => 'aktif');
      $this->db->where($kondisi);
      $query = $this->db->get();
      return $query;
    }

    function ambil_data_jumlah_tanya_opsi()
    {
      $this->db->select('*');
      $this->db->from('pertanyaan_ts_alumni');
      $kondisi = array('jenis_pertanyaan_ts_alumni' => 'opsi', 'status_tanya_ts_alumni' => 'aktif');
      $this->db->where($kondisi);
      $query = $this->db->get();
      return $query;
    }

    function ambil_data_pertanyaan_ts_alumni()
    {
      $this->db->select('*');
      $this->db->from('pertanyaan_ts_alumni');
      $this->db->order_by('id_tanya_ts_alumni','asc');
      $query=$this->db->get();
      return $query;
    }

    function ambil_data_pertanyaan_ts_alumni_semua($offset, $limit)
    {
      $query = $this->db->query("SELECT * FROM pertanyaan_ts_alumni ORDER BY id_tanya_ts_alumni ASC LIMIT $offset, $limit");
      return $query;
    }

    function ambil_data_jenis_pertanyaan_uraian_per_id($id_tanya_ts_alumni)
    {
      $this->db->select('jenis_pertanyaan_ts_alumni');
      $this->db->from('pertanyaan_ts_alumni');
      $kondisi=array('id_tanya_ts_alumni'=>$id_tanya_ts_alumni,'jenis_pertanyaan_ts_alumni'=>'urai');
      $this->db->where($kondisi);
      $query=$this->db->get();
      $result=$query->num_rows();
      return $result;
    }

    function ambil_data_jenis_pertanyaan_opsional_per_id($id_tanya_ts_alumni)
    {
      $this->db->select('jenis_pertanyaan_ts_alumni');
      $this->db->from('pertanyaan_ts_alumni');
      $kondisi=array('id_tanya_ts_alumni'=>$id_tanya_ts_alumni,'jenis_pertanyaan_ts_alumni'=>'opsi');
      $this->db->where($kondisi);
      $query=$this->db->get();
      $result=$query->num_rows();
      return $result;
    }

    function ambil_data_pertanyaan_uraian_ts_alumni_per_id($id_tanya_ts_alumni)
    {
      $this->db->select('*');
      $this->db->from('pertanyaan_ts_alumni');
      $kondisi=array('id_tanya_ts_alumni'=>$id_tanya_ts_alumni,'jenis_pertanyaan_ts_alumni'=>'urai');
      $this->db->where($kondisi);
      $query=$this->db->get();
      $result=$query->result();
      return $result;
    }

    function ambil_data_pertanyaan_opsional_ts_alumni_per_id($id_tanya_ts_alumni)
    {
      $this->db->select('*');
      $this->db->from('pertanyaan_ts_alumni');
      $kondisi=array('id_tanya_ts_alumni'=>$id_tanya_ts_alumni,'jenis_pertanyaan_ts_alumni'=>'opsi');
      $this->db->where($kondisi);
      $query=$this->db->get();
      $result=$query->result();
      return $result;
    }

    function masukan_data_pertanyaan_uraian_ts_alumni()
    {
      $pertanyaan=$this->input->post('pertanyaan_uraian');
      $data=array('pertanyaan_ts_alumni'=>$pertanyaan,'status_tanya_ts_alumni'=>'non-aktif', 'jenis_pertanyaan_ts_alumni'=>'urai');
      $this->db->insert('pertanyaan_ts_alumni',$data);
    }

    function masukan_data_pertanyaan_opsional_ts_alumni()
    {
      $pertanyaan=$this->input->post('pertanyaan_opsional');
      $opsiJawaban1=$this->input->post('opsiJawaban1');
      $opsiJawaban2=$this->input->post('opsiJawaban2');
      $opsiJawaban3=$this->input->post('opsiJawaban3');
      $opsiJawaban4=$this->input->post('opsiJawaban4');
      $opsiJawaban5=$this->input->post('opsiJawaban5');
      $data=array('pertanyaan_ts_alumni'=>$pertanyaan,'pilihan_jawaban_1_ts_alumni'=>$opsiJawaban1,'pilihan_jawaban_2_ts_alumni'=>$opsiJawaban2,'pilihan_jawaban_3_ts_alumni'=>$opsiJawaban3,'pilihan_jawaban_4_ts_alumni'=>$opsiJawaban4,'pilihan_jawaban_5_ts_alumni'=>$opsiJawaban5,'status_tanya_ts_alumni'=>'non-aktif', 'jenis_pertanyaan_ts_alumni'=>'opsi');
      $this->db->insert('pertanyaan_ts_alumni',$data);
    }

    function hapus_data_pertanyaan_ts_alumni_per_id($id_tanya_ts_alumni)
    {
      $this->db->where('id_tanya_ts_alumni',$id_tanya_ts_alumni);
      $this->db->delete('pertanyaan_ts_alumni');
    }

    function update_data_pertanyaan_uraian_ts_alumni($id_tanya_ts_alumni)
    {
      $pertanyaan=$this->input->post('pertanyaan_uraian');
      $status=$this->input->post('status_pertanyaan');
      $data=array('pertanyaan_ts_alumni'=>$pertanyaan,'status_tanya_ts_alumni'=>$status);
      $this->db->where('id_tanya_ts_alumni',$id_tanya_ts_alumni);
      $this->db->update('pertanyaan_ts_alumni',$data);
    }

    function update_data_pertanyaan_opsional_ts_alumni($id_tanya_ts_alumni)
    {
      $pertanyaan=$this->input->post('pertanyaan_opsional');
      $opsiJawaban1=$this->input->post('opsiJawaban1');
      $opsiJawaban2=$this->input->post('opsiJawaban2');
      $opsiJawaban3=$this->input->post('opsiJawaban3');
      $opsiJawaban4=$this->input->post('opsiJawaban4');
      $opsiJawaban5=$this->input->post('opsiJawaban5');
      $status=$this->input->post('status_pertanyaan');
      $data=array('pertanyaan_ts_alumni'=>$pertanyaan,'pilihan_jawaban_1_ts_alumni'=>$opsiJawaban1,'pilihan_jawaban_2_ts_alumni'=>$opsiJawaban2,'pilihan_jawaban_3_ts_alumni'=>$opsiJawaban3,'pilihan_jawaban_4_ts_alumni'=>$opsiJawaban4,'pilihan_jawaban_5_ts_alumni'=>$opsiJawaban5,'status_tanya_ts_alumni'=>$status);
      $this->db->where('id_tanya_ts_alumni',$id_tanya_ts_alumni);
      $this->db->update('pertanyaan_ts_alumni',$data);
    }
  }

 ?>
