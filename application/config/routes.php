<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'lv_home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
$route['blog/(:any)'] 									= 'lv_home/baca_agenda_lengkap/$1';
/* re-route */

#############################################################################
################################### AUTH ####################################
#############################################################################

$route['login'] 											= 'lv_login/lv_login';
$route['login/auth'] 									= 'lv_login/lv_login/proses_login';
$route['logout'] 										= 'lv_login/lv_login/logout';

#############################################################################
################################## ADMIN ###################################
#############################################################################

$route['admin'] 											= 'lv_admin/dashboard';
$route['admin/dashboard'] 								= 'lv_admin/dashboard';
$route['admin/profil'] 									= 'lv_admin/dashboard/profil';
$route['admin/ganti-password'] 							= 'lv_admin/dashboard/edit_password_admin';
$route['admin/profil/edit'] 								= 'lv_admin/dashboard/edit_profil_admin';
$route['admin/profil/edit/(:any)'] 						= 'lv_admin/dashboard/edit_profil_admin/$1';

$route['admin/alumni'] 									= 'lv_admin/alumni';
$route['admin/alumni/add'] 								= 'lv_admin/alumni/tambah_data_alumni';
$route['admin/alumni/delete'] 							= 'lv_admin/alumni/hapus_data_alumni';
$route['admin/alumni/delete/(:any)'] 					= 'lv_admin/alumni/hapus_data_alumni/$1';
$route['admin/alumni/edit'] 								= 'lv_admin/alumni/edit_data_alumni';
$route['admin/alumni/edit/(:any)'] 						= 'lv_admin/alumni/edit_data_alumni/$1';
$route['admin/alumni/ganti-password'] 					= 'lv_admin/alumni/edit_password_alumni_per_id';
$route['admin/alumni/ganti-password/(:any)'] 			= 'lv_admin/alumni/edit_password_alumni_per_id/$1';

$route['admin/pertanyaan/alumni'] 						= 'lv_admin/pertanyaan/alumni';
$route['admin/pertanyaan/alumni/add'] 					= 'lv_admin/pertanyaan/alumni/tambah_data_pertanyaan_ts_alumni';
$route['admin/pertanyaan/alumni/edit'] 					= 'lv_admin/pertanyaan/alumni/edit_data_pertanyaan_ts_alumni';
$route['admin/pertanyaan/alumni/edit/(:any)'] 			= 'lv_admin/pertanyaan/alumni/edit_data_pertanyaan_ts_alumni/$1';
$route['admin/pertanyaan/alumni/delete'] 				= 'lv_admin/pertanyaan/alumni/hapus_data_pertanyaan_ts_alumni';
$route['admin/pertanyaan/alumni/delete/(:any)'] 			= 'lv_admin/pertanyaan/alumni/hapus_data_pertanyaan_ts_alumni/$1';

$route['admin/laporan/stakeholder'] 						= 'lv_admin/laporan/stakeholder';
$route['admin/laporan/stakeholder/add'] 					= 'lv_admin/laporan/stakeholder/tambah_data_alumni';
$route['admin/laporan/stakeholder/detail/(:any)'] 		= 'lv_admin/laporan/stakeholder/Detail_ts_stakeholder_per_id/$1';
$route['admin/laporan/stakeholder/konversi'] 			= 'lv_admin/laporan/stakeholder/Konversi_ts_stakeholder_pdf_wk';
$route['admin/laporan/stakeholder/konversi_pdf'] 		= 'lv_admin/laporan/stakeholder/Update_konversi_laporan_ts_stakeholder_pdf';

$route['admin/karir'] 									= 'lv_admin/karir';
$route['admin/karir/add'] 								= 'lv_admin/karir/tambah_data_karir';
$route['admin/karir/edit'] 								= 'lv_admin/karir/edit_data_karir_admin';
$route['admin/karir/edit/(:any)'] 						= 'lv_admin/karir/edit_data_karir_admin/$1';
$route['admin/karir/delete'] 							= 'lv_admin/karir/hapus_data_karir';
$route['admin/karir/delete/(:any)'] 						= 'lv_admin/karir/hapus_data_karir/$1';

$route['admin/agenda'] 									= 'lv_admin/agenda';
$route['admin/agenda/add'] 								= 'lv_admin/agenda/tambah_data_agenda';
$route['admin/agenda/edit'] 								= 'lv_admin/agenda/edit_data_agenda';
$route['admin/agenda/edit/(:any)'] 						= 'lv_admin/agenda/edit_data_agenda/$1';
$route['admin/agenda/delete'] 							= 'lv_admin/agenda/hapus_data_agenda';
$route['admin/agenda/delete/(:any)'] 					= 'lv_admin/agenda/hapus_data_agenda/$1';

$route['alumni'] 										= 'lv_alumni/alumni';
$route['alumni/add-status'] 								= 'lv_alumni/alumni/tambah_status_alumni';
$route['alumni/profil'] 									= 'lv_alumni/alumni/lihat_profil_alumni';
$route['alumni/ganti-password'] 							= 'lv_alumni/alumni/edit_password_alumni';
$route['alumni/profil/edit'] 							= 'lv_alumni/alumni/edit_profil_alumni';
$route['alumni/profil/edit/(:any)'] 						= 'lv_alumni/alumni/edit_profil_alumni/$1';

$route['alumni/cari-alumni'] 							= 'lv_alumni/alumni_terdekat';
$route['alumni/karir'] 									= 'lv_alumni/karir';
$route['alumni/karir/detail'] 							= 'lv_alumni/karir/lihat_detail_informasi_karir_alumni';
$route['alumni/karir/detail/(:any)'] 					= 'lv_alumni/karir/lihat_detail_informasi_karir_alumni/$1';

$route['alumni/ts-alumni'] 								= 'lv_alumni/ts_alumni';