<?php $this->load->view('themes/admin/header') ?>
<?php $this->load->view('themes/admin/sidebar') ?>
	<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
		<div class="page-content padding-30 container-fluid">	
			<div class="row">
        <div class="col-md-12">
          <div class="alert alert-alt alert-blue" role="alert" style="" align="justify">
            <strong>
              <a href="javascript:void(0)">Informasi Data Grafik Aluminium - Alumni Teknik Informatika Universitas Muhammadiyah Malang</a>
            </strong><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<hr>
            <a href="http://informatika.umm.ac.id/">Teknik Informatika Universitas Muhammadiyah Malang</a>
          </div>
        </div>

				<div class="col-lg-6 col-md-6">
					<div class="panel panel-primary panel-line">
						<div class="panel-body container-fluid">
							<div class="row">
					      <div id="grafikJumlahAlumni"></div>
              </div>
						</div>
					</div>
				</div>

        <div class="col-lg-6 col-md-6">
          <div class="panel panel-primary panel-line">
            <div class="panel-body container-fluid">
              <div class="row">
                <div id="grafikWaktuPekerjaanPertama"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="panel panel-primary panel-line">
            <div class="panel-body container-fluid">
              <div class="row">
                <div id="grafikPerkembanganBekerjaAlumni"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="panel panel-primary panel-line">
            <div class="panel-body container-fluid">
              <div class="row">
                <div id="grafikHubunganPekerjaanKuliah"></div>
              </div>
            </div>
          </div>
        </div>


			</div>
		</div>
	</div>

	<!-- Morris.js charts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdn.oesmith.co.uk/morris-0.4.1.min.js"></script>
	<!-- membuat grafik highcharts -->
    <script type="text/javascript">
      // membuat grafik jumlah alumni
      var hl = <?php echo $hasilLaki;?>;
      var hp = <?php echo $hasilPerempuan;?>;
      Highcharts.chart('grafikJumlahAlumni',{
        chart: {
          events:{
            load: function(event){
              var total = hl+hp;
              var text = this.renderer.text(
                'Total Alumni : ' +total+ ' Orang',
                this.plotLeft,
                this.plotTop
              ).attr({
                zIndex: 5
              }).add()
            }
          },
          type: 'pie',
          marginTop: 90
        },
        credits: {
          enabled: false
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.y} Orang</b>'
        },
        title: {
          text: 'JUMLAH ALUMNI'
        },
        subtitle: {
          text: '- ALUMINIUM -'
        },
        xAxis: {
          categories: ['JUMLAH ALUMINIUM'],
          labels: {
            style: {
              fontSize: '10px',
              fontFamily: 'Verdana, sans-serif'
            }
          }
        },
        legend: {
          labelFormatter: function(){
            var total = hl+hp;
            if(this.name=='Laki-Laki')
              return this.name + ' : ' + hl + ' Orang';
            else
              return this.name + ' : ' + hp + ' Orang';
          }
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: false
            },
            showInLegend: true
          }
        },
        series:[{
          'name':'Jumlah Alumni (Aluminium)',
          'data' : [
            ['Laki-Laki', hl],
            ['Perempuan',hp]
          ]
        }]
      });

      // grafik Alumni yang sudah bekerja
      var b1 = <?php echo $hasilSudahBekerja;?>;
      var b2 = <?php echo $hasilBelumBekerja;?>;
      
      Highcharts.chart('grafikPerkembanganBekerjaAlumni',{
        chart:{
          events:{
            load: function(event){
              var total = b1 + b2;
              var text = this.renderer.text(
                'Total Alumni isi Tracer Study : ' +total+ ' Orang',
                this.plotLeft,
                this.plotTop
              ).attr({
                zIndex: 5
              }).add()
            }
          },
          type: 'pie',
          marginTop: 90
        },
        credits:{
          enabled:false
        },
        tooltip:{
          pointFormat: '{series.name}: <b>{point.y} Orang</b>'
        },
        title:{
          text: 'Perkembangan Aluminium'
        },
        subtitle:{
          text: '- Alumni Lulusan 2015-2016 -'
        },
        xAxis:{
          categories:['Jumlah Alumni'],
          labels:{
            style:{
              fontSize: '14px',
              fontFamily: 'Verdana, sans-serif'
            }
          }
        },
        yAxis:{

        },
        legend:{
          labelFormatter: function(){
            var total = b1+b2;
            if(this.name=='Sudah Bekerja')
              return this.name + ' : ' + b1 + ' Orang';
            else
              return this.name + ' : ' + b2 + ' Orang';
          }
        },
        plotOptions:{
          pie:{
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels:{
              enabled:false
            },
            showInLegend: true
          }
        },
        series:[{
          'name' : 'Jumlah Alumni',
          'data' :[
            ['Sudah Bekerja', b1],
            ['Belum Bekerja', b2]
          ]
        }]
      });

      // grafik Lama Waktu Tunggu untuk Pekerjaan Pertama
      <?php
        foreach ($hasilLamaWaktuTungguPekerjaanPertama as $row){
          $dataJumlah[] = $row->Jumlah;
          $dataBulan[] = $row->Bulan;
        }
      ?>
      Highcharts.chart('grafikWaktuPekerjaanPertama',{
        chart:{
          type: 'column',
          marginTop: 50,
          renderTo: 'container'
        },
        credits:{
          enabled:false
        },
        tooltip:{
          pointFormat: 'Jumlah : <b>{point.y} Orang</b>'
        },
        title:{
          text: 'Lama Waktu Tunggu untuk Pekerjaan Pertama'
        },
        subtitle:{
          text: 'Alumni Lulusan 2015-2016'
        },
        xAxis:{
          categories:[<?php echo join($dataBulan , ',')?>],
          labels:{
            style:{
              fontSize: '24px',
              fontFamily: 'Bauhaus 93 Regular'
            }
          }
        },
        yAxis:{
          categories:['<div style="font-size:13px;font-weight:bold;-moz-transform:rotate(270deg);">Jumlah Alumni (Orang)</div>']
        },
        plotOptions:{
          column:{
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels:{
              enabled:false
            },
            showInLegend: true
          }
        },
        series:[{
          name:['Waktu Tunggu untuk Pekerjaan Pertama (Bulan)'],
          data:[  <?php echo join($dataJumlah, ',')?>]
        }]
      });
      
      // grafik Gambaran Tingkat Pendidikan dengan Pekerjaan
      var sangatErat = <?php echo $hasilSangatErat;?>;
      var erat = <?php echo $hasilErat;?>;
      var cukupErat = <?php echo $hasilCukupErat;?>;
      var kurangErat = <?php echo $hasilKurangErat;?>;
      var tidakSamaSekali = <?php echo $hasilTidakSamaSekali;?>;

      Highcharts.chart('grafikHubunganPekerjaanKuliah',{
        chart:{
          events:{
            load: function(event){
              var total = sangatErat + erat + cukupErat + kurangErat + tidakSamaSekali;
              var text = this.renderer.text(
                'Total Alumni yang sudah bekerja: ' +total+ ' Orang',
                this.plotLeft,
                this.plotTop
              ).attr({
                zIndex: 5
              }).add()
            }
          },
          type: 'pie',
          marginTop: 90
        },
        credits:{
          enabled:false
        },
        tooltip:{
          pointFormat: '{series.name}: <b>{point.y} Orang</b>'
        },
        title:{
          text: 'Hubungan antara Bidang Studi dengan Pekerjaan'
        },
        subtitle:{
          text: 'Alumni Lulusan 2015-2016'
        },
        xAxis:{
          categories:['Puas'],
          labels:{
            style:{
              fontSize: '14px',
              fontFamily: 'Verdana, sans-serif'
            }
          }
        },
        legend:{
          labelFormatter: function(){
            if(this.name=='Sangat Erat')
              return this.name + ' : ' + sangatErat + ' Orang';
            else if(this.name=='Erat')
              return this.name + ' : ' + erat + ' Orang';
            else if(this.name=='Cukup Erat')
              return this.name + ' : ' + cukupErat + ' Orang';
            else if(this.name=='Kurang Erat')
              return this.name + ' : ' + kurangErat + ' Orang';
            else
              return this.name + ' : ' + tidakSamaSekali + ' Orang';
          }
        },
        plotOptions:{
          pie:{
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels:{
              enabled:false
            },
            showInLegend: true
          }
        },
        series:[{
          name:'Jumlah Alumni',
          data:[
            ['Sangat Erat', sangatErat],
            ['Erat', erat],
            ['Cukup Erat', cukupErat],
            ['Kurang Erat', kurangErat],
            ['Tidak Sama Sekali', tidakSamaSekali]
          ]
        }]
      });
    </script>

<?php $this->load->view('themes/footer') ?>

