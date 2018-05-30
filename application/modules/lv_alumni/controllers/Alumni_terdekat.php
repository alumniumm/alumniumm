<?php 
defined('BASEPATH') OR exit('File yang dimaksud tidak ada / tidak dapat diakses'); 
// ini_set('date.timezone', 'Asia/Jakarta');
Class Alumni_terdekat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//meload library googlemaaps map_model
		$this->load->library('Googlemaps');
		$this->load->model('M_alumni_terdekat');
		$this->load->model('M_alumni');
		if($this->session->userdata('username')==null)
		{
			redirect('login');
		}
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');

		if($data['username']!=null)
		{
			//cek nilai id alumni fk
			$data['id_alumnifk'] = 0;
			$config['center'] = '-3.677076, 119.647694';
          	$config['zoom'] = 5;
          	$config['height'] = 2000;
          	$this->googlemaps->initialize($config);
          		
          	// ambil koordinat semua data
          	$koordinatSemua = $this->M_alumni_terdekat->ambil_lat_long_semua();	
          	foreach ($koordinatSemua as $koordinat) 
          	{
          		$id_alumni_fk = $koordinat->id_alumni_fk;
          		$tempatKerja = $koordinat->nama_instansi;
          		$dataInfo = $this->M_alumni->ambil_data_alumni_per_id($id_alumni_fk);
          		foreach ($dataInfo as $row2) 
          		{
          			$nama = $row2->nama;
          			$email = $row2->email;
              		$facebook = $row2->facebook;
              		$twitter = $row2->twitter;
              		$instagram = $row2->instagram;

              		$resNama[] = $this->M_alumni->tampil_nama($nama);
              		$resEmail[] = $this->M_alumni->tampil_email($email);
              		$resFb[] = $this->M_alumni->tampil_fb($facebook);
              		$resTwitter[] = $this->M_alumni->tampil_twitter($twitter);
             	 	$resInstagram[] = $this->M_alumni->tampil_instagram($instagram);
          		}
          		
          		$dat['nama'] = $resNama;
            	$dat['email'] = $resEmail;
            	$dat['facebook'] = $resFb;
            	$dat['twitter'] = $resTwitter;
            	$dat['instagram'] = $resInstagram;
            	if($facebook == "" && $email == "" && $twitter == "" && $instagram == "")
            	{
              		$marker['infowindow_content'] = "Aluminium : $nama<br>Bekerja di $tempatKerja<br><br>Facebook : <a href=http://www.facebook.com/>-</a><br>Twitter : <a href=http://www.twitter.com/>-</a><br>Instagram : <a href=http://www.instagram.com/>-</a><br>Email : - ";
            	}
            	else
            	{
            		$marker['infowindow_content'] = "Aluminium : $nama<br>Bekerja di $tempatKerja<br>Facebook : <a href=http://www.facebook.com/>-</a><br>Twitter : <a href=http://www.twitter.com/>-</a><br>Instagram : <a href=http://www.instagram.com/>-</a><br>Email : - ";
            	}
            		
            	$marker['position'] =  $koordinat->latitude.','.$koordinat->longitude;
            	$this->googlemaps->add_marker($marker);
          	}

          	// setup foto profil
          	$id_alumni=$this->session->userdata('id_alumni');
	        $data['foto_profil']=$this->M_alumni->ambil_data_foto_profil_per_id($id_alumni);
	        foreach($data['foto_profil'] as $roww):
	          	$namaFileFoto=$roww->foto_profil;
	        endforeach;
	        if($namaFileFoto==null||$namaFileFoto==''||$namaFileFoto=="0")
	        {
	          	$data['foto']='no_avatar.png';
	        }
	        else
	        {
	          	$data['foto']=$namaFileFoto;
	        }
	        	
          	$data['id_alumni'] = 0;

          	$data['map'] = $this->googlemaps->create_map();
          	$data['nama'] = $this->session->userdata('nama');
          	$data['nilai_form_lat_long'] = 0;
          	$data['status_cari'] = 0;
          	$this->load->view('carialumni/view_main',$data);
			
		}
	}

	public function proses_haversine()
	{
		$data['username'] = $this->session->userdata('username');

		if($data['username']!=null)
		{
			//inisialisasi array untuk konfigurasi biostall dan data
			// $config = array();
			// $marker = array();
			// $data = array();

			//menangkap action tombol submit
			$tSubmit = $this->input->post('submit');

			//proses cek jika tombol submit ditekan
			if($tSubmit == 'Cari Alumni Terdekat')
			{
				//mengambil nilai latitude dan longitude posisi alumni saat ini
				$latitude = $this->input->post('lat');
				$longitude = $this->input->post('long');
				
				// jika lokasi null
				if($latitude == null || $longitude == null)
				{
					redirect('/alumniterdekathaversine/Lokasi_null');
				}
				
				// jika lokasi sudah diperoleh
				else
				{
					//setting center pada lokasi alumni saat itu 
					$config['center'] = 'auto';
					//konfigurasi marker posisi alumni saat itu
					

		            //setup nilai zoom pada peta
		            $config['zoom'] = 12;

		            //setup konfigurasi pada library googlemaps
		            $this->googlemaps->initialize($config);
		            
		            //proses haversine
		            $data['hasil_haversine'] = $this->M_alumni_terdekat->haversine($latitude, $longitude);
		            
		            // membuat marker dari hasil proses perhitungan haversine formula
		            foreach ($data['hasil_haversine'] as $row) 
		            {
		            	$id_alumni_fk = $row->id_alumni_fk;
		            	$hLatitude = $row->latitude;
		            	$hLongitude = $row->longitude;
		            	$tempatKerja = $row->nama_instansi;
		            	$data['id_alumnifk'] = $id_alumni_fk;
		            	$dataInfo = $this->M_alumni->ambil_data_alumni_per_id($id_alumni_fk);
		            	foreach ($dataInfo as $row2 ) 
		            	{
		            		$nama = $row2->nama;
		            		$email = $row2->email;
		            		$facebook = $row2->facebook;
		            		$twitter = $row2->twitter;
		            		$instagram = $row2->instagram;

		            		$resNama[] = $this->M_alumni->tampil_nama($nama);
		            		$resEmail[] = $this->M_alumni->tampil_email($email);
		            		$resFb[] = $this->M_alumni->tampil_fb($facebook);
			                $resTwitter[] = $this->M_alumni->tampil_twitter($twitter);
			                $resInstagram[] = $this->M_alumni->tampil_instagram($instagram);
		            	}
		            	
		            	$dat['nama'] = $resNama;
                		$dat['email'] = $resEmail;
              			$dat['facebook'] = $resFb;
              			$dat['twitter'] = $resTwitter;
              			$dat['instagram'] = $resInstagram;
              			$marker['position'] =  $hLatitude.','.$hLongitude;
              			
              			if($facebook == "" && $email == "" && $twitter == "" && $instagram == "")
              			{
                			$marker['infowindow_content'] = "Aluminium : $nama, bekerja di $tempatKerja. Kontak Facebook : <a href=http://www.facebook.com/>-</a> , Twitter : <a href=http://www.twitter.com/>-</a>, Instagram : <a href=http://www.instagram.com/>-</a>, Email : - ";
              			}
              			
              			else
              			{
              				$marker['infowindow_content'] = "Aluminium : $nama, bekerja di $tempatKerja. Kontak Facebook : <a href=$facebook>$nama</a> , Twitter : <a href=http://www.twitter.com/$twitter>@$twitter</a>, Instagram : <a href=http://www.instagram.com/$instagram>@$instagram</a>, Email : $email ";
              			}
              			
              			$this->googlemaps->add_marker($marker);
              		}

              		// setup foto profil
	          		$id_alumni=$this->session->userdata('id_alumni');
				   	$data['foto_profil']=$this->M_alumni->ambil_data_foto_profil_per_id($id_alumni);
				   	foreach($data['foto_profil'] as $roww):
				    	$namaFileFoto=$roww->foto_profil;
				  	endforeach;
				   	
				   	if($namaFileFoto==null||$namaFileFoto==''||$namaFileFoto=="0")
				  	{
				      	$data['foto']='no_avatar.png';
				  	}
				   	
				   	else
				  	{
				   		$data['foto']=$namaFileFoto;
				   	}
				   	$circle['center'] = $latitude . ',' . $longitude;
				   	$circle['radius'] = 8000;
		          	$this->googlemaps->add_circle($circle);
              		$data['map'] = $this->googlemaps->create_map();
              		$data['nama'] = $this->session->userdata('nama');
              		$data['nilai_form_lat_long'] = 1;
              		$data['status_cari'] = 1;
              		$this->load->view('vPersebaranAlumni.html',$data);
				}
			}
		}	
	}

	public function Lokasi_null()
	{
		$data['username'] = $this->session->userdata('username');
		if($data['username'] != null)
		{
			$this->load->view('vPopupNull.html');
		}
	}
}
?>