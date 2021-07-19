<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel_pedagang extends CI_Controller
{

	public function index()
	{
		$ceks = $this->session->userdata('no_pendaftaran');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']   	 = $this->db->get_where('tbl_pedagang', "no_pendaftaran='$ceks'");
			$data['web_ppg']	 = $this->db->get_where('tbl_web', "id_web='1'")->row();
			$data['judul_web'] = "Dashboard";

			$this->load->view('pedagang/header', $data);
			$this->load->view('pedagang/dashboard', $data);
			$this->load->view('pedagang/footer');
		}
	}

	public function pengumuman()
	{
		$ceks = $this->session->userdata('no_pendaftaran');
		if (!isset($ceks)) {
			redirect('');
		} else {
			$data['user']   	 = $this->db->get_where('tbl_pedagang', "no_pendaftaran='$ceks'");
			$data['judul_web'] = "Pengumuman";
			$this->load->view('pedagang/header', $data);
			$this->load->view('pedagang/pengumuman', $data);
			$this->load->view('pedagang/footer');
		}
	}

	public function biodata()
	{
		$ceks = $this->session->userdata('no_pendaftaran');
		if (!isset($ceks)) {
			redirect('logcs');
		} else {
			$data['user']  			  = $this->db->get_where('tbl_pedagang', "no_pendaftaran='$ceks'");
			$id = $data['user']->row()->blokdagangan;
			$data['judul_web'] 		= "Biodata " . ucwords($data['user']->row()->nama_lengkap);
			$data['ngambilblok'] = $this->Model_data->ngambilblok($id)->row();

			$this->load->view('pedagang/header', $data);
			$this->load->view('pedagang/biodata', $data);
			$this->load->view('pedagang/footer');
		}
	}

	public function permohonan()
	{
		$ceks = $this->session->userdata('no_pendaftaran');
		if (!isset($ceks)) {
			redirect('logcs');
		} else {
			$data['user']  			  = $this->db->get_where('tbl_pedagang', "no_pendaftaran='$ceks'");
			$id = $data['user']->row()->blokdagangan;
			$data['judul_web'] 		= "Biodata " . ucwords($data['user']->row()->nama_lengkap);
			$data['ngambilblok'] = $this->Model_data->ngambilblok($id)->row();
			$data['blok'] = $this->db->get('tbl_blok')->result();
			$data['bloknumber'] = $this->db->get('tbl_blok_nomor')->result();
			$this->db->where('user_id', $data['user']->row()->id_pedagang);
			$this->db->order_by('id', 'DESC');
			$data['permohonan'] = $this->db->get('tbl_permohonan');

			$this->load->view('pedagang/header', $data);
			$this->load->view('pedagang/permohonan', $data);
			$this->load->view('pedagang/footer');
		}
	}

	public function tambahpermohonan($id)
	{
		$data = array(
			'user_id' => $id,
			'perihal' => $this->input->post('tipe'),
			'blokdagangan' => $this->input->post('blokdagangan'),
			'bloknomor' => $this->input->post('bloknomor'),
			'status' => 0
		);
		$this->db->insert('tbl_permohonan', $data);
		redirect('panel_pedagang');
	}

	public function keanggotaan()
	{
		$ceks = $this->session->userdata('no_pendaftaran');
		if (!isset($ceks)) {
			redirect('logcs');
		} else {
			$data['user']  			  = $this->db->get_where('tbl_pedagang', "no_pendaftaran='$ceks'");
			$id = $data['user']->row()->blokdagangan;
			$data['judul_web'] 		= "Biodata " . ucwords($data['user']->row()->nama_lengkap);
			$data['ngambilblok'] = $this->Model_data->ngambilblok($id)->row();
			$data['blok'] = $this->db->get('tbl_blok')->result();
			$data['bloknumber'] = $this->db->get('tbl_blok_nomor')->result();
			$this->db->where('user_id', $data['user']->row()->id_pedagang);
			$this->db->order_by('id', 'DESC');
			$data['keanggotaan'] = $this->db->get('tbl_permohonan_keanggotaan');

			$this->load->view('pedagang/header', $data);
			$this->load->view('pedagang/keanggotaan', $data);
			$this->load->view('pedagang/footer');
		}
	}

	public function tambahkeanggotaan($id)
	{
		$data = array(
			'user_id' => $id,
			'perihal' => $this->input->post('tipe'),
			'tgl_keanggotaan_awal' => $this->input->post('tgl_keanggotaan_awal'),
			'jangka	' => $this->input->post('jangka'),
			'status' => 0
		);
		$this->db->insert('tbl_permohonan_keanggotaan', $data);
		redirect('panel_pedagang/keanggotaan');
	}


	public function cetak()
	{
		$ceks = $this->session->userdata('no_pendaftaran');
		if (!isset($ceks)) {
			redirect('logcs');
		}
		$data['user'] 			= $this->db->get_where('tbl_pedagang', "no_pendaftaran='$ceks'")->row();
		$data['judul_web'] 	= "Cetak Bukti Pendaftaran " . ucwords($data['user']->nama_lengkap);
		$data['ngambilblok'] = $this->Model_data->ngambilblok($data['user']->blokdagangan)->row();

		$data['thn_ppg'] 	= date('Y', strtotime($data['user']->tgl_pedagang));

		$this->load->view('pedagang/cetak', $data);
	}


	public function cetak_lulus()
	{
		$ceks = $this->session->userdata('no_pendaftaran');
		if (!isset($ceks)) {
			redirect('logcs');
		}
		$this->db->like('tgl_pedagang', date('Y'), 'after');
		$data['user'] 			= $this->db->get_where('tbl_pedagang', "no_pendaftaran='$ceks'")->row();
		$data['ngambilblok'] = $this->Model_data->ngambilblok($data['user']->blokdagangan)->row();
		$data['judul_web'] 	= "Cetak Kartu " . ucwords($data['user']->nama_lengkap);

		if ($data['user']->status_verifikasi != 'diterima') {
			redirect('404');
		}

		$data['thn_ppg'] 	= date('Y', strtotime($data['user']->tgl_pedagang));
		$data['v_ket'] 			= $this->db->get_where('tbl_pengumuman', "id_pengumuman='1'")->row();

		$this->load->view('pedagang/cetak_berhasil', $data);
	}

	public function logout()
	{
		if ($this->session->userdata('no_pendaftaran') != '') {
			$this->session->sess_destroy();
		}
		redirect('');
	}
}
