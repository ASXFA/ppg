<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title><?php echo $judul_web; ?></title>
  <base href="<?php echo base_url(); ?>" />
  <link rel="icon" type="image/png" href="assets/images/favicon.png" />
  <style>
    table {
      border-collapse: collapse;
    }

    thead>tr {
      background-color: #0070C0;
      color: #f1f1f1;
    }

    thead>tr>th {
      background-color: #0070C0;
      color: #fff;
      padding: 10px;
      border-color: #fff;
    }

    th,
    td {
      padding: 2px;
    }

    th {
      color: #222;
    }

    body {
      font-family: Calibri;
    }
  </style>
</head>

<body onload="window.print();">
  <?php $this->load->view('kop_lap'); ?>
  <h4 align="center" style="margin-top:0px;"><u>BUKTI PENDAFTARAN</u></h4>
  <b>
    <center>
      PENDATAAN PEDAGANG GASIBU (PPG) <br>
      TAHUN <?php echo $thn_ppg; ?> / <?php echo $thn_ppg + 1; ?></center>
  </b>
  <br>
  <div style="float:right;">
    <img src='./assets/images/profile/<?php echo $user->foto ?>' alt="" width="70%"><br>
  </div>
  <table width="70%" border="0">
    <tr>
      <td width="200">NO. PENDAFTARAN</td>
      <td width="1">:</td>
      <td><?php echo $user->no_pendaftaran; ?></td>
    </tr>
    <tr>
      <td>TANGGAL PENDAFTARAN </td>
      <td>:</td>
      <td><?php echo $this->Model_data->tgl_id(date('d-m-Y', strtotime($user->tgl_pedagang))); ?></td>
    </tr>
    <tr>
      <td>TANGGAL CETAK </td>
      <td>:</td>
      <td><?php echo $this->Model_data->tgl_id(date('d-m-Y')); ?></td>
    </tr>
    <tr>
      <td>NIS</td>
      <td>:</td>
      <td><?php echo $user->nik; ?></td>
    </tr>
    <tr>
      <td>NISN</td>
      <td>:</td>
      <td><?php echo $user->nokk; ?></td>
    </tr>
    <tr>
      <td>NAMA LENGKAP</td>
      <td>:</td>
      <td><?php echo ucwords($user->nama_lengkap); ?></td>
    </tr>
    <tr>
      <td>JENIS KELAMIN</td>
      <td>:</td>
      <td><?php echo $user->jk; ?></td>
    </tr>
    <tr>
      <td>TEMPAT, TANGGAL LAHIR</td>
      <td>:</td>
      <td><?php echo "$user->tempat_lahir, " . $this->Model_data->tgl_id($user->tgl_lahir); ?></td>
    </tr>
    <tr>
      <td>AGAMA</td>
      <td>:</td>
      <td><?php echo $user->agama; ?></td>
    </tr>
    <tr>
      <td>NO. HANDPHONE (HP)</td>
      <td>:</td>
      <td><?php echo $user->no_hp_pedagang; ?></td>
    </tr>
    <tr>
      <td>Data Dagangan</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td style="padding-left:55px;">Nama Dagangan</td>
      <td>:</td>
      <td><?php echo ucwords($user->nama_dagangan); ?></td>
    </tr>
    <tr>
      <td style="padding-left:55px;">Jenis Dagangan</td>
      <td>:</td>
      <td><?php echo ucwords($user->jns_dagangan); ?></td>
    </tr>
    <tr>
      <td style="padding-left:55px;">No HP</td>
      <td>:</td>
      <td><?php echo ucwords($user->no_hp_dagangan); ?></td>
    </tr>
    <tr>
      <td style="padding-left:55px;">Blok Dagangan</td>
      <td>:</td>
      <td><?php echo ucwords($ngambilblok->nama_blok); ?></td>
    </tr>
    <tr>
      <td style="padding-left:55px;">PJ Blok</td>
      <td>:</td>
      <td><?php echo ucwords($ngambilblok->pj_blok); ?></td>
    </tr>
    <tr>
      <td style="padding-left:55px;">Alamat</td>
      <td>:</td>
      <td><?php echo ucwords($user->detail_lokasi_dagangan); ?></td>
    </tr>
    <tr>
      <td style="padding-left:55px;">Wilayah yang dipilih</td>
      <td>:</td>
      <?php $kel = $this->db->get_where('tbl_kelurahan', "id_kelurahan='$user->id_kelurahan_dagangan'")->row(); ?>
      <td><?php echo "Kelurahan " . $kel->nama_kelurahan ?></td>
    </tr>
  </table>
  <br>

  <div style="float:right;">
    Bandung, <?php echo $this->Model_data->tgl_id(date('d-m-Y')); ?> <br>
    Gubernur Jawa Barat, <br>
    <img src="img/ttd.jpg" alt="" width="100"><br>
    <b><u>Ridwan Kamil</u></b><br>
  </div>
  <br><br><br><br><br><br><br><br><br><br>
  </table>

</body>

</html>