<?php
	class M_laporan_stakeholder extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function ambil_data_jumlah_total_ts_stakeholder()
		{
			$this->db->select("*");
			$this->db->from("tracer_study_stakeholders");
			$this->db->order_by("id_tss","desc");
			$query = $this->db->get();
			return $query;
		}

		function ambil_data_ts_stakeholder_semua($offset, $limit)
		{
			$this->db->select("id_tss, nama, perusahaan, namaAlumni, DATE_FORMAT(tanggalIsi, '%e-%m-%Y') as tanggalIsi");
			$this->db->from("tracer_study_stakeholders");
			$this->db->limit($offset,$limit);
			$this->db->order_by("id_tss", "desc");
			$query = $this->db->get();
			return $query;
		}

		function ambil_data_ts_stakeholder_per_id($id_tss)
		{
			$this->db->select("*");
			$this->db->from("tracer_study_stakeholders");
			$this->db->where("id_tss", $id_tss);
			$query = $this->db->get();
			$result = $query->row();
			return $result;
		}
	}
?>