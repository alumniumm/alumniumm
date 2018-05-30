<?php
  class M_agenda extends CI_Model{
    function __construct()
    {
      parent::__construct();
    }
    
    public function agenda_terbaru($batas)
    {
      $this->db->select('*');
      $this->db->from('agenda');
      $this->db->order_by('id_agenda', 'desc');
      $this->db->limit($batas);
      $query = $this->db->get();
      return $query;
    }

    public function ambil_data_agenda_per_id($id_agenda)
    {
      $this->db->select('*');
      $this->db->from('agenda');
      $this->db->where('id_agenda',$id_agenda);
      $query=$this->db->get();
      return $query;
    }
  }
?>
