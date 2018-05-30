<?php
	class Alumni_terdekat_haversine_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function haversine($latitude, $longitude)
		{
			// proses perhitungan jarak 2 lokasi dengan haversine formula
			// $this->db->select("*, round(2 * asin( sqrt( cos(radians('$latitude')) * cos(radians(latitude)) * pow(sin(radians(('$longitude' - longitude)/2 )),2) + pow(sin(radians(('$latitude' - latitude)/2)), 2)))* 6371) as jarak_km", false);
			//batas jarak dalam radius 8 km
			// $this->db->having('jarak_km < 8');
			//mengurutkan jarak terdekat smpai terjauh
			// $this->db->order_by('jarak_km','asc');
			//ekseskusi query
			$query = $this->db->query("SELECT * , round(2 * asin( sqrt( cos(radians('$latitude')) * cos(radians(latitude)) * pow(sin(radians(('$longitude' - longitude)/2 )),2) + pow(sin(radians(('$latitude' - latitude)/2)), 2)))* 6371) AS jarak_km FROM kerja HAVING jarak_km < 8 ORDER BY jarak_km ASC");
			$result = $query->result();
			return $result;
		}

		function ambil_lat_long_semua()
		{
			$return = array();
			$this->db->select('*');
			$this->db->from('kerja');
			$query = $this->db->get();

			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row) 
				{
					array_push($return,$row);
				}
			}
			return $return;
		}
	}
?>