<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_$v_thn.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $judul_web; ?></title>
    <base href="<?php echo base_url();?>"/>
  	<link rel="icon" type="image/png" href="assets/images/favicon.png"/>
    <style>
    table {
        border-collapse: collapse;
    }
    thead > tr{
      background-color: #0070C0;
      color:#f1f1f1;
    }
    thead > tr > th{
      background-color: #0070C0;
      color:#fff;
      padding: 10px;
      border-color: #fff;
    }
    th, td {
      padding: 2px;
    }

    th {
        color: #222;
    }
    body{
      font-family:Calibri;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2
    }
    </style>
  </head>
  <body>

    <table width="100%" border="1">
      <tr>
        <th rowspan="4" >No.</th>
        <th colspan="5" rowspan="2"> DAFTAR SISWA</th>
      </tr>
      <tr></tr>
      <tr>
        <th rowspan="2" >NAMA LENGKAP</th>
        <th rowspan="2" >NISN</th>
        <th rowspan="2" >ASAL SEKOLAH</th>
        <th rowspan="2" >TOTAL BOBOT</th>
        <th rowspan="2" >STATUS KELULUSAN</th>
      </tr>
      <tr></tr>

      <?php $no=1;
      error_reporting(0);
      foreach ($v_siswa->result() as $baris) {?>
        <tr>
          <th><?php echo $no++; ?></th>
          <td><?php echo ucwords($baris->nama_lengkap); ?></td>
          <td><?php echo $baris->nisn; ?></td>
          <td><?php echo $baris->nama_sekolah; ?></td>
          <td><?php echo $baris->jumlah_bobot; ?></td>
          <td><?php echo $baris->status_pendaftaran; ?></td>
        </tr>
      <?php
      }?>
    </table>

  </body>
</html>
