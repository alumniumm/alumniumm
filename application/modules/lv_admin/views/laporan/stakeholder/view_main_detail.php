	<?php $this->load->view('themes/admin/header'); ?>
	<?php $this->load->view('themes/admin/sidebar'); ?>
		<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		    <div class="page-header">
		      <h1 class="page-title">Kelola Alumni</h1>
		      <ol class="breadcrumb">
		        <li><a href="javascript:void(0)">Admin</a></li>
		        <li><a href="javascript:void(0)">Alumni</a></li>
		        <li class="active">Data Alumni</li>
		      </ol>
		      <div class="page-header-actions">
		        <a class="btn btn-sm btn-primary btn-round waves-effect waves-light waves-round" href="<?php echo base_url()?>" target="_blank">
		          <i class="icon md-link" aria-hidden="true"></i>
		          <span class="hidden-xs">Aluminium</span>
		        </a>
		      </div>
		    </div>
			<div class="page-content">	
				<div class="panel panel-bordered">
					<div class="panel-body">
		              						<table class="table">
												<tr>
													<td width="25%"><b>Nama Pengisi</b></td>
													<td width=""><?php echo $nama;?></td>
												</tr>
												<tr>
													<td width=""><b>Nama Perusahaan</b></td>
													<td><?php echo $perusahaan;?></td>	
												</tr>
												<tr>
													<td><b>Jabatan</b></td>
													<td><?php echo $jabatan;?></td>
												</tr>
												<tr>
													<td width=""><b>Nama Alumni</b></td>
													<td><?php echo $namaAlumni;?></td>	
												</tr>
												<tr align="center">
													<td colspan="">
														<!--<a href="<?php echo base_url().'admin/laporan/stakeholder/konversi_pdf/'.$id_tss;?>"><button class="btn btn-primary button">Ubah (.pdf)</button></a>-->
													</td>
												</tr>
											</table><br><br>


											<table class="table ">
								              <tr>
								                <td><b>No.</b></td>
								                <td align="center"><b>Pertanyaan</b></td>
								                <td align="center"><b>Keterangan</b></td>
								              </tr>
								              <tr>
								                <td colspan="3" style="font-weight:bold;">A. Integritas (Etika dan Moral)</td>
								              </tr>
								              <tr>
								                <td>1.</td>
								                <td>Mampu mematuhi segala peraturan perusahaan / instansi tempat bekerja</td>
								                <td align="center"><?php
								                  if($p1 == 1 || $p1 == '1'){
								                    echo '<output name="result">Sangat Baik</output>';
								                  }else if($p1 == 2 || $p1 == '2'){
								                    echo '<output name="result">Baik</output>';
								                  }else if($p1 == 3 || $p1 == '3'){
								                    echo '<output name="result">Cukup</output>';
								                  }else if($p1 == 4 || $p1 == '4'){
								                    echo '<output name="result">Kurang</output>';
								                  }else{
								                    echo '<output name="result">Belum mengisi.</output>';
								                  }
								                ?>
								              </td>
								              </tr>
								              <tr>
								                <td>2.</td>
								                <td>Etos Kerja</td>
								                <td align="center">
								                  <?php
								                  if($p2 == 1 || $p2 == '1'){
								                    echo '<output name="result">Sangat Baik</output>';
								                  }else if($p2 == 2 || $p2 == '2'){
								                    echo '<output name="result">Baik</output>';
								                  }else if($p2 == 3 || $p2 == '3'){
								                    echo '<output name="result">Cukup</output>';
								                  }else if($p2 == 4 || $p2 == '4'){
								                    echo '<output name="result">Kurang</output>';
								                  }else{
								                    echo '<output name="result">Belum mengisi.</output>';
								                  }
								                ?>
								              </td>
								              </tr>
								              <tr>
								                <td>3.</td>
								                <td>Disiplin tinggi saat bekerja</td>
								                <td align="center">
								                  <?php
								                  if($p3 == 1 || $p3 == '1'){
								                    echo '<output name="result">Sangat Baik</output>';
								                  }else if($p3 == 2 || $p3 == '2'){
								                    echo '<output name="result">Baik</output>';
								                  }else if($p3 == 3 || $p3 == '3'){
								                    echo '<output name="result">Cukup</output>';
								                  }else if($p3 == 4 || $p3 == '4'){
								                    echo '<output name="result">Kurang</output>';
								                  }else{
								                    echo '<output name="result">Belum mengisi.</output>';
								                  }
								                ?>
								              </td>
								              </tr>
								              <tr>
								                <td>4.</td>
								                <td>Mampu menjaga nama baik dan kualitas perusahaan / instansi tempat bekerja</td>
								                <td align="center">
								                  <?php
								                  if($p4 == 1 || $p4 == '1'){
								                    echo '<output name="result">Sangat Baik</output>';
								                  }else if($p4 == 2 || $p4 == '2'){
								                    echo '<output name="result">Baik</output>';
								                  }else if($p4 == 3 || $p4 == '3'){
								                    echo '<output name="result">Cukup</output>';
								                  }else if($p4 == 4 || $p4 == '4'){
								                    echo '<output name="result">Kurang</output>';
								                  }else{
								                    echo '<output name="result">Belum mengisi.</output>';
								                  }
								                ?>
								              </td>
								              </tr>
								              <tr>
								                <td>5.</td>
								                <td>Mampu menjaga nama baik dan kualitas almamater</td>
								                <td align="center">
								                  <?php
								                  if($p5 == 1 || $p5 == '1'){
								                    echo '<output name="result">Sangat Baik</output>';
								                  }else if($p5 == 2 || $p5 == '2'){
								                    echo '<output name="result">Baik</output>';
								                  }else if($p5 == 3 || $p5 == '3'){
								                    echo '<output name="result">Cukup</output>';
								                  }else if($p5 == 4 || $p5 == '4'){
								                    echo '<output name="result">Kurang</output>';
								                  }else{
								                    echo '<output name="result">Belum mengisi.</output>';
								                  }
								                ?>
								                </td>
								              </tr>
								              <tr>
								                <td colspan="3" style="font-weight:bold;">B. Keahlian berdasarkan bidang ilmu (profesionalisme)</td>
								              </tr>
								              <tr>
								                <td>6.</td>
								                <td>Bekerja dalam lingkup keahlian</td>
								                <td align="center">
								                  <?php
								                  if($p6 == 1 || $p6 == '1'){
								                    echo '<output name="result">Sangat Baik</output>';
								                  }else if($p6 == 2 || $p6 == '2'){
								                    echo '<output name="result">Baik</output>';
								                  }else if($p6 == 3 || $p6 == '3'){
								                    echo '<output name="result">Cukup</output>';
								                  }else if($p6 == 4 || $p6 == '4'){
								                    echo '<output name="result">Kurang</output>';
								                  }else{
								                    echo '<output name="result">Belum mengisi.</output>';
								                  }
								                ?>
								                </td>
								              </tr>
								              <tr>
								                <td>7.</td>
								                <td>Bekerja dalam lingkup keahlian yang spesifik</td>
								                <td align="center">
								                <?php
								                if($p7 == 1 || $p7 == '1'){
								                  echo '<output name="result">Sangat Baik</output>';
								                }else if($p7 == 2 || $p7 == '2'){
								                  echo '<output name="result">Baik</output>';
								                }else if($p7 == 3 || $p7 == '3'){
								                  echo '<output name="result">Cukup</output>';
								                }else if($p7 == 4 || $p7 == '4'){
								                  echo '<output name="result">Kurang</output>';
								                }else{
								                  echo '<output name="result">Belum mengisi.</output>';
								                }
								              ?>
								              </td>
								              </tr>
								              <tr>
								                <td>8.</td>
								                <td>Bekerja dalam lingkup yang tidak sesuai dengan minat</td>
								                <td align="center">
								                <?php
								                if($p8 == 1 || $p8 == '1'){
								                  echo '<output name="result">Sangat Baik</output>';
								                }else if($p8 == 2 || $p8 == '2'){
								                  echo '<output name="result">Baik</output>';
								                }else if($p8 == 3 || $p8 == '3'){
								                  echo '<output name="result">Cukup</output>';
								                }else if($p8 == 4 || $p8 == '4'){
								                  echo '<output name="result">Kurang</output>';
								                }else{
								                  echo '<output name="result">Belum mengisi.</output>';
								                }
								              ?>
								              </td>
								              </tr>
								              <tr>
								                <td>9.</td>
								                <td>Bekerja sesuai dengan kebutuhan institusi</td>
								                <td align="center">
								                <?php
								                  if($p9 == 1 || $p9 == '1'){
								                    echo '<output name="result">Sangat Baik</output>';
								                  }else if($p9 == 2 || $p9 == '2'){
								                    echo '<output name="result">Baik</output>';
								                  }else if($p9 == 3 || $p9 == '3'){
								                    echo '<output name="result">Cukup</output>';
								                  }else if($p9 == 4 || $p9 == '4'){
								                    echo '<output name="result">Kurang</output>';
								                  }else{
								                    echo '<output name="result">Belum mengisi.</output>';
								                  }
								                ?>
								                </td>
								              </tr>
								              <tr style="font-weight:bold;">
								                <td colspan="3">C. Bahasa Asing</td>
								              </tr>
								              <tr>
								                <td>10.</td>
								                <td>Mampu berbahasa Inggris</td>
								                <td align="center">
								                <?php
								                  if($p10 == 1 || $p10 == '1'){
								                    echo '<output name="result">Sangat Baik</output>';
								                  }else if($p10 == 2 || $p10 == '2'){
								                    echo '<output name="result">Baik</output>';
								                  }else if($p10 == 3 || $p10 == '3'){
								                    echo '<output name="result">Cukup</output>';
								                  }else if($p10 == 4 || $p10 == '4'){
								                    echo '<output name="result">Kurang</output>';
								                  }else{
								                    echo '<output name="result">Belum mengisi.</output>';
								                  }
								                ?>
								                </td>
								              </tr>
								              <tr>
								                <td>11.</td>
								                <td>Mampu berbahasa asing lain</td>
								                <td align="center">
								                  <?php
								                    if($p11 == 1 || $p11 == '1'){
								                      echo '<output name="result">Sangat Baik</output>';
								                    }else if($p11 == 2 || $p11 == '2'){
								                      echo '<output name="result">Baik</output>';
								                    }else if($p11 == 3 || $p11 == '3'){
								                      echo '<output name="result">Cukup</output>';
								                    }else if($p11 == 4 || $p11 == '4'){
								                      echo '<output name="result">Kurang</output>';
								                    }else{
								                      echo '<output name="result">Belum mengisi.</output>';
								                    }
								                  ?>
								                </td>
								              </tr>
								              <tr style="font-weight:bold;">
								                <td colspan="3">D. Penggunaan teknologi informasi.</td>
								              </tr>
								              <tr>
								                <td>12.</td>
								                <td>Mampu mengoperasikan komputer secara aktif</td>
								                <td align="center">
								                  <?php
								                    if($p12 == 1 || $p12 == '1'){
								                      echo '<output name="result">Sangat Baik</output>';
								                    }else if($p12 == 2 || $p12 == '2'){
								                      echo '<output name="result">Baik</output>';
								                    }else if($p12 == 3 || $p12 == '3'){
								                      echo '<output name="result">Cukup</output>';
								                    }else if($p12 == 4 || $p12 == '4'){
								                      echo '<output name="result">Kurang</output>';
								                    }else{
								                      echo '<output name="result">Belum mengisi.</output>';
								                    }
								                  ?>
								                </td>
								              </tr>
								              <tr>
								                <td>13.</td>
								                <td>Mampu menyiapkan presentasi dan melakukan presentasi dengan menggunakan komputer</td>
								                <td align="center"><?php
								                  if($p13 == 1 || $p13 == '1'){
								                    echo '<output name="result">Sangat Baik</output>';
								                  }else if($p13 == 2 || $p13 == '2'){
								                    echo '<output name="result">Baik</output>';
								                  }else if($p13 == 3 || $p13 == '3'){
								                    echo '<output name="result">Cukup</output>';
								                  }else if($p13 == 4 || $p13 == '4'){
								                    echo '<output name="result">Kurang</output>';
								                  }else{
								                    echo '<output name="result">Belum mengisi.</output>';
								                  }
								                ?></td>
								              </tr>
								              <tr>
								                <td>14.</td>
								                <td>Mampu menyiapkan penggunaan teknologi informasi untuk mendukung pekerjaan</td>
								                <td align="center"><?php
								                  if($p14 == 1 || $p14 == '1'){
								                    echo '<output name="result">Sangat Baik</output>';
								                  }else if($p14 == 2 || $p14 == '2'){
								                    echo '<output name="result">Baik</output>';
								                  }else if($p14 == 3 || $p14 == '3'){
								                    echo '<output name="result">Cukup</output>';
								                  }else if($p14 == 4 || $p14 == '4'){
								                    echo '<output name="result">Kurang</output>';
								                  }else{
								                    echo '<output name="result">Belum mengisi.</output>';
								                  }
								                ?></td>
								              </tr>
								              <tr style="font-weight:bold;">
								                <td colspan="3">E. Komunikasi</td>
								              </tr>
								              <tr>
								                <td>15.</td>
								                <td>Mampu berkomunikasi dengan atasan</td>
								                <td align="center"><?php
								                  if($p15 == 1 || $p15 == '1'){
								                    echo '<output name="result">Sangat Baik</output>';
								                  }else if($p15 == 2 || $p15 == '2'){
								                    echo '<output name="result">Baik</output>';
								                  }else if($p15 == 3 || $p15 == '3'){
								                    echo '<output name="result">Cukup</output>';
								                  }else if($p15 == 4 || $p15 == '4'){
								                    echo '<output name="result">Kurang</output>';
								                  }else{
								                    echo '<output name="result">Belum mengisi.</output>';
								                  }
								                ?></td>
								              </tr>
								              <tr>
								                <td>16.</td>
								                <td>Mampu berkomunikasi dengan bawahan</td>
								                <td align="center">
								                  <?php
								                    if($p16 == 1 || $p16 == '1'){
								                      echo '<output name="result">Sangat Baik</output>';
								                    }else if($p16 == 2 || $p16 == '2'){
								                      echo '<output name="result">Baik</output>';
								                    }else if($p16 == 3 || $p16 == '3'){
								                      echo '<output name="result">Cukup</output>';
								                    }else if($p16 == 4 || $p16 == '4'){
								                      echo '<output name="result">Kurang</output>';
								                    }else{
								                      echo '<output name="result">Belum mengisi.</output>';
								                    }
								                  ?>
								                </td>
								              </tr>
								              <tr>
								                <td>17.</td>
								                <td>Mampu berkomunikasi dengan teman sejawat</td>
								                <td align="center">
								                  <?php
								                    if($p17 == 1 || $p17 == '1'){
								                      echo '<output name="result">Sangat Baik</output>';
								                    }else if($p17 == 2 || $p17 == '2'){
								                      echo '<output name="result">Baik</output>';
								                    }else if($p17 == 3 || $p17 == '3'){
								                      echo '<output name="result">Cukup</output>';
								                    }else if($p17 == 4 || $p17 == '4'){
								                      echo '<output name="result">Kurang</output>';
								                    }else{
								                      echo '<output name="result">Belum mengisi.</output>';
								                    }
								                  ?>
								                </td>
								              </tr>
								              <tr>
								                <td>18.</td>
								                <td>Mampu berkomunikasi dengan masyarakat</td>
								                <td align="center">
								                  <?php
								                    if($p18 == 1 || $p18 == '1'){
								                      echo '<output name="result">Sangat Baik</output>';
								                    }else if($p18 == 2 || $p18 == '2'){
								                      echo '<output name="result">Baik</output>';
								                    }else if($p18 == 3 || $p18 == '3'){
								                      echo '<output name="result">Cukup</output>';
								                    }else if($p18 == 4 || $p18 == '4'){
								                      echo '<output name="result">Kurang</output>';
								                    }else{
								                      echo '<output name="result">Belum mengisi.</output>';
								                    }
								                  ?>
								                </td>
								              </tr>
								              <tr style="font-weight:bold;">
								                <td colspan="3">F. Kerjasama Tim</td>
								              </tr>
								              <tr>
								                <td>19.</td>
								                <td>Mampu menjalin kerjasama dengan perusahaan / institusi lain</td>
								                <td align="center">
								                  <?php
								                    if($p19 == 1 || $p19 == '1'){
								                      echo '<output name="result">Sangat Baik</output>';
								                    }else if($p19 == 2 || $p19 == '2'){
								                      echo '<output name="result">Baik</output>';
								                    }else if($p19 == 3 || $p19 == '3'){
								                      echo '<output name="result">Cukup</output>';
								                    }else if($p19 == 4 || $p19 == '4'){
								                      echo '<output name="result">Kurang</output>';
								                    }else{
								                      echo '<output name="result">Belum mengisi.</output>';
								                    }
								                  ?>
								                </td>
								              </tr>
								              <tr>
								                <td>20.</td>
								                <td>Mampu menjalin kerjasama antar disiplin</td>
								                <td align="center">
								                  <?php
								                    if($p20 == 1 || $p20 == '1'){
								                      echo '<output name="result">Sangat Baik</output>';
								                    }else if($p20 == 2 || $p20 == '2'){
								                      echo '<output name="result">Baik</output>';
								                    }else if($p20 == 3 || $p20 == '3'){
								                      echo '<output name="result">Cukup</output>';
								                    }else if($p20 == 4 || $p20 == '4'){
								                      echo '<output name="result">Kurang</output>';
								                    }else{
								                      echo '<output name="result">Belum mengisi.</output>';
								                    }
								                  ?>
								                </td>
								              </tr>
								              <tr>
								                <td>21.</td>
								                <td>Mampu menjadi pimpinan kelompok kerja antar disiplin</td>
								                <td align="center">
								                  <?php
								                    if($p21 == 1 || $p21 == '1'){
								                      echo '<output name="result">Sangat Baik</output>';
								                    }else if($p21 == 2 || $p21 == '2'){
								                      echo '<output name="result">Baik</output>';
								                    }else if($p21 == 3 || $p21 == '3'){
								                      echo '<output name="result">Cukup</output>';
								                    }else if($p21 == 4 || $p21 == '4'){
								                      echo '<output name="result">Kurang</output>';
								                    }else{
								                      echo '<output name="result">Belum mengisi.</output>';
								                    }
								                  ?>
								                </td>
								              </tr>
								              <tr style="font-weight:bold;">
								                <td colspan="3">G. Komunikasi</td>
								              </tr>
								              <tr>
								                <td>22.</td>
								                <td>Aktif mengikuti seminar / pelatihan / workshop / konfrensi</td>
								                <td align="center">
								                  <?php
								                    if($p22 == 1 || $p22 == '1'){
								                      echo '<output name="result">Sangat Baik</output>';
								                    }else if($p22 == 2 || $p22 == '2'){
								                      echo '<output name="result">Baik</output>';
								                    }else if($p22 == 3 || $p22 == '3'){
								                      echo '<output name="result">Cukup</output>';
								                    }else if($p22 == 4 || $p22 == '4'){
								                      echo '<output name="result">Kurang</output>';
								                    }else{
								                      echo '<output name="result">Belum mengisi.</output>';
								                    }
								                  ?>
								                </td>
								              </tr>
								              <tr>
								                <td>23.</td>
								                <td>Bersedia melanjutkan pendidikan yang lebih tinggi</td>
								                <td align="center"><?php
								                  if($p23 == 1 || $p23 == '1'){
								                    echo '<output name="result">Sangat Baik</output>';
								                  }else if($p23 == 2 || $p23 == '2'){
								                    echo '<output name="result">Baik</output>';
								                  }else if($p23 == 3 || $p23 == '3'){
								                    echo '<output name="result">Cukup</output>';
								                  }else if($p23 == 4 || $p23 == '4'){
								                    echo '<output name="result">Kurang</output>';
								                  }else{
								                    echo '<output name="result">Belum mengisi.</output>';
								                  }
								                ?></td>
								              </tr>
								              <tr>
								                <td>24.</td>
								                <td>Berminat mengikuti kursus / pelatihan biasa</td>
								                <td align="center">
								                  <?php
								                    if($p24 == 1 || $p24 == '1'){
								                      echo '<output name="result">Sangat Baik</output>';
								                    }else if($p24 == 2 || $p24 == '2'){
								                      echo '<output name="result">Baik</output>';
								                    }else if($p24 == 3 || $p24 == '3'){
								                      echo '<output name="result">Cukup</output>';
								                    }else if($p24 == 4 || $p24 == '4'){
								                      echo '<output name="result">Kurang</output>';
								                    }else{
								                      echo '<output name="result">Belum mengisi.</output>';
								                    }
								                  ?>
								                </td>
								              </tr>
								              <tr>
								                <td>25.</td>
								                <td>Terbuka terhadap pengembangan keterampilan pengetahuan baru yang sudah berkembang</td>
								                <td align="center">
								                  <?php
								                    if($p25 == 1 || $p25 == '1'){
								                      echo '<output name="result">Sangat Baik</output>';
								                    }else if($p25 == 2 || $p25 == '2'){
								                      echo '<output name="result">Baik</output>';
								                    }else if($p25 == 3 || $p25 == '3'){
								                      echo '<output name="result">Cukup</output>';
								                    }else if($p25 == 4 || $p25 == '4'){
								                      echo '<output name="result">Kurang</output>';
								                    }else{
								                      echo '<output name="result">Belum mengisi.</output>';
								                    }
								                  ?>
								                </td>
								              </tr>
								            </table>
					</div>
				</div>
			</div>
		</div>

						
    <script type="text/javascript">
      $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            // $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    <script type="text/javascript">
		$(".prosesDetailTS2").click(function() {
			var tabel_1 = document.getElementById('tabel1');
			var tabel_2 = document.getElementById('tabel2');
			tabel_1.style.display = "none";
			tabel_2.style.display = "block";
		});	

		$(".kembaliDetailTS1").click(function() {
			var tabel_1 = document.getElementById('tabel1');
			var tabel_2 = document.getElementById('tabel2');
			tabel_2.style.display = "none";
			tabel_1.style.display = "block";
		});	
	</script>
	<script type="text/javascript">
	  $('#confirm-delete').on('show.bs.modal', function(e) {
	    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	  });
	</script>
	<?php $this->load->view('themes/footer'); ?>