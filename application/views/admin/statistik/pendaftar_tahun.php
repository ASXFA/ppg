<style>
 #chart{
   z-index:-10;}
</style>

    <!-- Dashboard content -->

                <center>
                <div id="chart">
                </div>
                </center>

    <!-- /dashboard content -->

<!-- <script src="assets/highcharts/jquery.min.js" type="text/javascript"></script> -->
<script src="assets/panel/highcharts/highcharts.js" type="text/javascript"></script>
<script src="assets/panel/highcharts/modules/exporting.js" type="text/javascript"></script>
<script src="assets/panel/highcharts/modules/offline-exporting.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(function(){
 new Highcharts.Chart({
  chart: {
   renderTo: 'chart',
   type: 'line',
  },
  title: {
   text: 'Grafik Statistik Data Pendaftaran',
   x: -20
  },
  subtitle: {
   text: 'Jumlah Data Pendaftaran',
   x: -20
  },
  xAxis: {
   categories: ['2020', '2021', '2022', '2023', '2024', '2025']
  },
  yAxis: {
   title: {
    text: 'Total Data Pendaftaran'
   }
  },
  series: [{
   name: 'Data Pendaftaran Per-Tahun',
   data: <?php echo json_encode($grafik); ?>
  }]
 });
});

function thn()
{
  var thn = $('[name="thn"]').val();
    window.location = "panel_admin/statistik/thn/"+thn;
}
$('[name="thn"]').select2({
    placeholder: "- Tahun -"
});
</script>