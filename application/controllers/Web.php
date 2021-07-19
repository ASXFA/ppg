<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends CI_Controller
{

	public function index()
	{
		$this->load->model('model_kelurahan');
		$data['kelurahan'] = $this->model_kelurahan->getAll();
		$data['web_ppg']	 = $this->db->get_where('tbl_web', "id_web='1'")->row();
		$this->load->view('web/index2', $data);
	}

	public function pendaftaran($id = '')
	{
		$id_kelurahan = $id;
		$this->db->order_by('id_jns', 'ASC');
		$data['v_jns'] = $this->db->get('tbl_jns')->result();


		// $this->db->order_by('id_blok', 'ASC');
		// $data['v_blok'] = $this->db->get('tbl_blok')->result();
		$this->db->order_by('id_blok', 'ASC');
		$data['blok']	= $this->db->get_where('tbl_blok', "id_kelurahan='$id_kelurahan'")->result();
		$data['bloknumber'] = $this->db->get('tbl_blok_nomor')->result();
		$ambilblok = $this->db->get('tbl_pedagang')->result();
		foreach ($ambilblok as $ab) {
			$this->db->not_like('id', $ab->bloknomor);
		}
		$data['bloknumbers'] = $this->db->get('tbl_blok_nomor')->result();
		$data['kel'] = $this->db->get_where('tbl_kelurahan', "id_kelurahan='$id_kelurahan'")->row();

		$this->load->view('web/pendaftaran', $data);

		if (isset($_POST['btndaftar'])) {
			$this->db->order_by('id_pedagang', 'DESC');
			$sql 		= $this->db->get('tbl_pedagang');

			if ($sql->num_rows() == 0) {
				$no_pendaftaran   = "PGG18004001";
			} else {
				$noUrut 	 	= substr($sql->row()->no_pendaftaran, 8, 3);
				$noUrut++;
				$no_pendaftaran	  = "PGG18004" . sprintf("%03s", $noUrut);
			}

			$nik							= $this->input->post('nik');
			$nokk							= $this->input->post('nokk');
			$nama_lengkap			= $this->input->post('nama_lengkap');
			$jk								= $this->input->post('jk');
			$tempat_lahir			= $this->input->post('tempat_lahir');
			$tgl_lahir				= $this->input->post('tgl_lahir') . "-" . $this->input->post('bln_lahir') . "-" . $this->input->post('thn_lahir');
			$agama						= $this->input->post('agama');
			$alamat_pedagang			= $this->input->post('alamat_pedagang');
			$no_hp_pedagang			= $this->input->post('no_hp_pedagang');
			$nama_dagangan				= $this->input->post('nama_dagangan');
			$jns_dagangan					= $this->input->post('jns_dagangan');
			$pekerjaan_ayah		= $this->input->post('pekerjaan_ayah');
			$no_hp_dagangan			= $this->input->post('no_hp_dagangan');
			$blokdagangan							= $this->input->post('blokdagangan');
			$bloknomor							= $this->input->post('bloknomor');
			$detail_lokasi_dagangan		= $this->input->post('detail_lokasi_dagangan');
			$id_kelurahan_dagangan 		= $this->input->post('id_kelurahan_dagangan');
			$tgl_pedagang				= $this->Model_data->date('waktu_default');

			$upload_image = $_FILES['foto_pedagang']['name'];
			$asal = $_FILES['foto_pedagang']['tmp_name'];

			move_uploaded_file($asal, './assets/images/profile/' . $upload_image);

			$data = array(
				'no_pendaftaran'		=> $no_pendaftaran,
				'password'				  => $no_pendaftaran,
				'nik'				  			=> $nik,
				'nokk'				  			=> $nokk,
				'nama_lengkap'			=> $nama_lengkap,
				'jk'				  			=> $jk,
				'tempat_lahir'			=> $tempat_lahir,
				'tgl_lahir'				  => $tgl_lahir,
				'agama'				  	  => $agama,
				'alamat_pedagang'			=> $alamat_pedagang,
				'no_hp_pedagang'				=> $no_hp_pedagang,
				'foto'				=> $upload_image,
				'nama_dagangan'				  => $nama_dagangan,
				'jns_dagangan'				  => $jns_dagangan,
				'no_hp_dagangan'				=> $no_hp_dagangan,
				'blokdagangan'			=> $blokdagangan,
				'bloknomor'			=> $bloknomor,
				'detail_lokasi_dagangan'		=> $detail_lokasi_dagangan,
				'id_kelurahan_dagangan'			=> $id_kelurahan_dagangan,
				'tgl_pedagang'				  => $tgl_pedagang,
				'status_verifikasi'		=> 'menunggu',
				'status_pendaftaran'				  => 'berhasil'

			);
			$this->db->insert('tbl_pedagang', $data);

			$this->session->set_userdata('no_pendaftaran', "$no_pendaftaran");
			redirect('panel_pedagang');
		}
	}

	public function logcs()
	{
		$ceks = $this->session->userdata('no_pendaftaran');
		if (isset($ceks)) {
			redirect('panel_pedagang');
		} else {
			// $this->load->view('web/index', $data);
			$this->load->view('web/index');

			if (isset($_POST['btnlogin'])) {
				$username = $_POST['username'];
				$pass	   = $_POST['password'];

				$this->db->like('tgl_pedagang', date('Y'), "after");
				$query  = $this->db->get_where('tbl_pedagang', "nik='$username'");
				$cek    = $query->result();
				$cekun  = $cek[0]->no_pendaftaran;
				$jumlah = $query->num_rows();

				if ($jumlah == 0) {
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;&nbsp;</span>
						</button>
						<strong>No. Pendaftaran "' . $username . '"</strong> belum terdaftar.
						</div>'
					);
					redirect('logcs');
				} else {
					$row = $query->row();
					$cekpass = $row->password;
					if ($cekpass <> $pass) {
						$this->session->set_flashdata(
							'msg',
							'<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;&nbsp;</span>
							</button>
							<strong>No. Pendaftaran atau NISN Salah!</strong>.
							</div>'
						);
						redirect('logcs');
					} else {

						$this->session->set_userdata('no_pendaftaran', "$cekun");

						redirect('panel_pedagang');
					}
				}
			}
		}
	}


	function error_not_found()
	{
		$this->load->view('404_content');
	}
}
