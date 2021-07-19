<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_data extends CI_Model{

   public function view(){
     return $this->db->get('tbl_pedagang')->result(); // Tampilkan semua data yang ada di tabel siswa
   }

   function ngambilblok($id){
        $this->db->select('*');
        $this->db->from('tbl_pedagang');
        $this->db->join('tbl_blok', 'tbl_pedagang.blokdagangan = tbl_blok.id_blok');
        $this->db->where('id_blok',$id);
        $query = $this->db->get();
        return $query;
   }

function ngambilsemuablok(){
        $this->db->select('*');
        $this->db->from('tbl_pedagang');
        $query = $this->db->get();
        return $query;
   }

   public function ngambil_satu_blok($id)
{
    $this->db->where('id_blok', $id);
    $query = $this->db->get("tbl_blok");

    return $query;
}

function ngambilsemuajns(){
        $this->db->select('*');
        $this->db->from('tbl_jns');
        $query = $this->db->get();
        return $query;
   }

   public function ngambil_satu_jns($id)
{
    $this->db->where('id_jns', $id);
    $query = $this->db->get("tbl_jns");

    return $query;
}

   function statistik($thn='', $aksi='')
   {
     if ($aksi == 'diverifikasi') {
       $status = "AND status_verifikasi='1'";
     }elseif ($aksi == 'diterima') {
       $status = "AND status_verifikasi='diterima'";
     }elseif ($aksi == 'tidak diterima') {
       $status = "AND status_verifikasi='ditolak'";
     }else {
       $status = "";
     }

    $sql= $this->db->query("
    select
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang)WHERE((Month(tgl_pedagang)=1) $status AND (YEAR(tgl_pedagang)='$thn'))),0) AS `Januari`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang)WHERE((Month(tgl_pedagang)=2) $status AND (YEAR(tgl_pedagang)='$thn'))),0) AS `Februari`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang)WHERE((Month(tgl_pedagang)=3) $status AND (YEAR(tgl_pedagang)='$thn'))),0) AS `Maret`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang)WHERE((Month(tgl_pedagang)=4) $status AND (YEAR(tgl_pedagang)='$thn'))),0) AS `April`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang)WHERE((Month(tgl_pedagang)=5) $status AND (YEAR(tgl_pedagang)='$thn'))),0) AS `Mei`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang)WHERE((Month(tgl_pedagang)=6) $status AND (YEAR(tgl_pedagang)='$thn'))),0) AS `Juni`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang)WHERE((Month(tgl_pedagang)=7) $status AND (YEAR(tgl_pedagang)='$thn'))),0) AS `Juli`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang)WHERE((Month(tgl_pedagang)=8) $status AND (YEAR(tgl_pedagang)='$thn'))),0) AS `Agustus`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang)WHERE((Month(tgl_pedagang)=9) $status AND (YEAR(tgl_pedagang)='$thn'))),0) AS `September`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang)WHERE((Month(tgl_pedagang)=10) $status AND (YEAR(tgl_pedagang)='$thn'))),0) AS `Oktober`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang)WHERE((Month(tgl_pedagang)=11) $status AND (YEAR(tgl_pedagang)='$thn'))),0) AS `Nopember`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang)WHERE((Month(tgl_pedagang)=12) $status AND (YEAR(tgl_pedagang)='$thn'))),0) AS `Desember`
     from tbl_pedagang GROUP BY YEAR(tgl_pedagang)
    ");
    return $sql;
   }

   function statistik_tahun($thn='', $aksi='')
   {
     if ($aksi == 'diverifikasi') {
       $status = "AND status_verifikasi='1'";
     }elseif ($aksi == 'diterima') {
       $status = "AND status_pendaftaran='lulus'";
     }elseif ($aksi == 'tidak diterima') {
       $status = "AND status_pendaftaran='tidak lulus'";
     }else {
       $status = "";
     }

    $sql= $this->db->query("
    select
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang) WHERE ((YEAR(tgl_pedagang)='2020'))),0) AS `2020`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang) WHERE ((YEAR(tgl_pedagang)='2021'))),0) AS `2021`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang) WHERE ((YEAR(tgl_pedagang)='2022'))),0) AS `2022`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang) WHERE ((YEAR(tgl_pedagang)='2023'))),0) AS `2023`,
      ifnull((SELECT count(id_pedagang) FROM (tbl_pedagang) WHERE ((YEAR(tgl_pedagang)='2024'))),0) AS `2024`
     from tbl_pedagang GROUP BY YEAR(tgl_pedagang)
    ");
    return $sql;
   }

   // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
   public function insert_multiple($data){
     $this->db->insert_batch('tbl_data', $data);
   }


   public function date($aksi)
   {
     date_default_timezone_set('Asia/Jakarta');
     if ($aksi == 'waktu') {
       $date   = date('d-m-Y H:i:s');
     }elseif ($aksi == 'waktu_default') {
       $date   = date('Y-m-d H:i:s');
     }elseif ($aksi == 'thn') {
       $date   = date('Y');
     }elseif ($aksi == 'bln') {
       $date   = date('m');
     }elseif ($aksi == 'tgl_default') {
       $date   = date('Y-m-d');
     }elseif ($aksi == 'tgl') {
       $date   = date('d-m-Y');
     }elseif ($aksi == 'jam') {
       $date   = date('H:i:s');
     }else {
       $date  = 'Null';
     }

     return $date;
   }

   public static function tgl_id($date)
  {
      $str = explode('-', $date);
      $bulan = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
      );
      return $str['0'] . " " . $bulan[$str[1]] . " " .$str[2];
  }

   public static function bln_id($date)
  {
     $str = explode('-', $date);
      $bulan = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
      );
      return $bulan[$str[0]];
  }
}


?>