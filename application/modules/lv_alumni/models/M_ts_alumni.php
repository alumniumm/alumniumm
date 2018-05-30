<?php
  class M_ts_alumni extends CI_Model
  {
    function __construct()
    {
      parent::__construct();
    }

    function ambil_id_tracer_study($id_alumni)
    {
    	$this->db->select('id_tracer_study');
    	$this->db->from('tracer_study');
    	$this->db->where('id_alumni_fk',$id_alumni);
    	$query=$this->db->get();
    	$result=$query->row()->id_tracer_study;
    	return $result;
    }

    function ambil_id_tracer_study_alumni($id_alumni)
    {
        $this->db->select('id_tracer_study');
        $this->db->from('tracer_study');
        $this->db->where('id_alumni_fk',$id_alumni);
        $query = $this->db->get();
        $result=$query->row()->id_tracer_study;
        return $result;
    }

    function ambil_data_status_pengisian_tracer_study($id_alumni)
    {
    	$this->db->select('status');
    	$this->db->from('tracer_study');
    	$this->db->where('id_alumni_fk',$id_alumni);
    	$query=$this->db->get();
    	$result=$query->row();
    	return $result;
    }

    function ambil_data_ts_per_id_alumni($id_alumni)
    {
    	$this->db->select('*');
    	$this->db->from('tracer_study');
    	$this->db->where('id_alumni_fk',$id_alumni);
    	$query=$this->db->get();
    	$result=$query->row();
    	return $result;
    }

    function simpan_data_ts($data)
    {
        $this->db->insert("tracer_study",$data);
    }

    function update_data_ts($data)
    {
        $this->db->where('id_alumni_fk',$data['id_alumni_fk']);
        $this->db->update('tracer_study',$data);   
    }

    function update_data_status_alumni($data2)
    {
        $this->db->where('id_tracer_study', $data2['id_tracer_study']);
        $this->db->update('tracer_study',$data2);
    }

    function simpan_data_ts_pt($data)
    {
        $this->db->insert('tracer_study_pertanyaan_tambahan', $data);
    }

    function update_data_ts_pt($data)
    {
        $this->db->where('fk_id_ts', $data['fk_id_ts']);
        $this->db->update('tracer_study_pertanyaan_tambahan', $data);
    }

    function simpan_data_ts_sdm_alumni($data)
    {
        $this->db->insert('tracer_study_sdma',$data);   
    }

    function update_data_ts_sdm_alumni($data)
    {
        $this->db->where('fk_id_ts',$data['fk_id_ts']);
        $this->db->update('tracer_study_sdma',$data);
    }

    function simpan_data_ts_sdm_prodi($data)
    {
        $this->db->insert('tracer_study_sdmp',$data);   
    }

    function update_data_ts_sdm_prodi($data)
    {
        $this->db->where('fk_id_ts',$data['fk_id_ts']);
        $this->db->update('tracer_study_sdmp',$data);
    }

    function ambil_data_soal_ts_alumni_tambahan_urai_id_tanya_1(){
        $this->db->select('*');
        $this->db->from('pertanyaan_ts_alumni');
        $this->db->where('status_tanya_ts_alumni','aktif');
        $this->db->where('id_tanya_ts_alumni', 1);
        $this->db->where('jenis_pertanyaan_ts_alumni','urai');
        $query=$this->db->get();
        return $query->result();
    }

    function ambil_data_soal_ts_alumni_tambahan_urai_id_tanya_2(){
        $this->db->select('*');
        $this->db->from('pertanyaan_ts_alumni');
        $this->db->where('status_tanya_ts_alumni','aktif');
        $this->db->where('id_tanya_ts_alumni', 2);
        $this->db->where('jenis_pertanyaan_ts_alumni','urai');
        $query=$this->db->get();
        return $query->result();
    }

    function ambil_data_soal_ts_alumni_tambahan_urai_id_tanya_3(){
        $this->db->select('*');
        $this->db->from('pertanyaan_ts_alumni');
        $this->db->where('status_tanya_ts_alumni','aktif');
        $this->db->where('id_tanya_ts_alumni', 3);
        $this->db->where('jenis_pertanyaan_ts_alumni','urai');
        $query=$this->db->get();
        return $query->result();
    }

    function ambil_data_soal_ts_alumni_tambahan_urai_id_tanya_4(){
        $this->db->select('*');
        $this->db->from('pertanyaan_ts_alumni');
        $this->db->where('status_tanya_ts_alumni','aktif');
        $this->db->where('id_tanya_ts_alumni', 4);
        $this->db->where('jenis_pertanyaan_ts_alumni','urai');
        $query=$this->db->get();
        return $query->result();
    }

    function ambil_data_soal_ts_alumni_tambahan_urai_id_tanya_5(){
        $this->db->select('*');
        $this->db->from('pertanyaan_ts_alumni');
        $this->db->where('status_tanya_ts_alumni','aktif');
        $this->db->where('id_tanya_ts_alumni', 5);
        $this->db->where('jenis_pertanyaan_ts_alumni','urai');
        $query=$this->db->get();
        return $query->result();
    }

    function ambil_data_soal_ts_alumni_tambahan_pilih_id_tanya_1(){
        $this->db->select('*');
        $this->db->from('pertanyaan_ts_alumni');
        $this->db->where('status_tanya_ts_alumni','aktif');
        $this->db->where('id_tanya_ts_alumni', 6);
        $this->db->where('jenis_pertanyaan_ts_alumni','pilih');
        $query=$this->db->get();
        return $query->result();
    }

    function ambil_data_soal_ts_alumni_tambahan_pilih_id_tanya_2(){
        $this->db->select('*');
        $this->db->from('pertanyaan_ts_alumni');
        $this->db->where('status_tanya_ts_alumni','aktif');
        $this->db->where('id_tanya_ts_alumni', 7);
        $this->db->where('jenis_pertanyaan_ts_alumni','pilih');
        $query=$this->db->get();
        return $query->result();
    }

    function ambil_data_soal_ts_alumni_tambahan_pilih_id_tanya_3(){
        $this->db->select('*');
        $this->db->from('pertanyaan_ts_alumni');
        $this->db->where('status_tanya_ts_alumni','aktif');
        $this->db->where('id_tanya_ts_alumni', 8);
        $this->db->where('jenis_pertanyaan_ts_alumni','pilih');
        $query=$this->db->get();
        return $query->result();
    }

    function ambil_data_soal_ts_alumni_tambahan_pilih_id_tanya_4(){
        $this->db->select('*');
        $this->db->from('pertanyaan_ts_alumni');
        $this->db->where('status_tanya_ts_alumni','aktif');
        $this->db->where('id_tanya_ts_alumni', 9);
        $this->db->where('jenis_pertanyaan_ts_alumni','pilih');
        $query=$this->db->get();
        return $query->result();
    }

    function ambil_data_soal_ts_alumni_tambahan_pilih_id_tanya_5(){
        $this->db->select('*');
        $this->db->from('pertanyaan_ts_alumni');
        $this->db->where('status_tanya_ts_alumni','aktif');
        $this->db->where('id_tanya_ts_alumni', 10);
        $this->db->where('jenis_pertanyaan_ts_alumni','pilih');
        $query=$this->db->get();
        return $query->result();
    }

    function ambil_data_soal_ts_alumni_tambahan_pilih(){
        $this->db->select('*');
        $this->db->from('pertanyaan_ts_alumni');
        $this->db->where('status_tanya_ts_alumni','aktif');
        $this->db->where('jenis_pertanyaan_ts_alumni','pilih');
        $query=$this->db->get();
        return $query->result();
    }

    function ambil_data_jumlah_pertanyaan_ts_alumni_tambahan_urai()
    {
        $this->db->select('*');
        $this->db->from('pertanyaan_ts_alumni');
        $this->db->where('status_tanya_ts_alumni','aktif');
        $this->db->where('jenis_pertanyaan_ts_alumni','urai');
        $result=$this->db->get();
        return $result->num_rows();
    }

    function cek_id_ts_pt_alumni($fk_id_ts_alumni)
    {
        $this->db->select('*');
        $this->db->from('tracer_study_pertanyaan_tambahan');
        $this->db->where('fk_id_ts',$fk_id_ts_alumni);
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }

    function cek_id_ts_sdm_alumni($data_id_ts_alumni)
    {
        $this->db->select('*');
        $this->db->from('tracer_study_sdma');
        $this->db->where('fk_id_ts',$data_id_ts_alumni);
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }

    function cek_id_ts_sdm_prodi($data_id_ts_alumni)
    {
        $this->db->select('*');
        $this->db->from('tracer_study_sdmp');
        $this->db->where('fk_id_ts',$data_id_ts_alumni);
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }

    function ambil_data_ts_sdm_alumni_per_id_ts($id_ts)
    {
        $this->db->select('*');
        $this->db->from('tracer_study_sdma');
        $this->db->where('fk_id_ts',$id_ts);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function ambil_data_ts_sdm_prodi_per_id_ts($id_ts)
    {
        $this->db->select('*');
        $this->db->from('tracer_study_sdmp');
        $this->db->where('fk_id_ts',$id_ts);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function ambil_data_ts_pt_per_id_ts($id_ts)
    {
        $this->db->select('*');
        $this->db->from('tracer_study_pertanyaan_tambahan');
        $this->db->where('fk_id_ts',$id_ts);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
  }

?>
