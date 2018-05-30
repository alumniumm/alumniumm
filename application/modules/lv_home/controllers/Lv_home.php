<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	Class Lv_home extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('M_agenda');
		}

		public function index()
		{
			if($this->session->userdata('username')!=null)
	       	{
	            $this->session->unset_userdata('username');
	            session_destroy();
	            $data['agenda_terbaru'] = $this->M_agenda->agenda_terbaru(9);
				$this->load->view('view_home',$data); 
	        }
	        else
	        {
	        	$data['agenda_terbaru'] = $this->M_agenda->agenda_terbaru(9);
				$this->load->view('view_home',$data);
	        }
		}

		public function baca_agenda_lengkap()
		{
			$id_agenda=$this->uri->segment(3);
			$data['agenda_per_id']=$this->M_agenda->ambil_data_agenda_per_id($id_agenda);
			$this->load->view('view_detail_home',$data);
		}
	}
?>
