<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel_admin extends CI_Controller
{

	public function index()
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			$this->load->view('404_content');
		} else {
			$data['user']   	 = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['web_ppg']	 = $this->db->get_where('tbl_web', "id_web='1'")->row();
			$data['judul_web'] = "Dashboard";

			$thn							 = date('Y');
			$data['v_thn']		 = $thn;
			foreach ($this->Model_data->statistik_tahun($thn)->result_array() as $row) {
				$data['grafik'][] = (float)$row['2020'];
				$data['grafik'][] = (float)$row['2021'];
				$data['grafik'][] = (float)$row['2022'];
				$data['grafik'][] = (float)$row['2023'];
				$data['grafik'][] = (float)$row['2024'];
				$data['grafik'][] = (float)$row['2025'];
			}
			$this->db->order_by('id_blok', 'ASC');
			$data['blok'] = $this->db->get('tbl_blok')->result();
			$data['bloknumber'] = $this->db->get('tbl_blok_nomor')->result();
			$data['kelurahan'] = $this->db->get('tbl_kelurahan')->result();

			$this->load->view('admin/header', $data);
			$this->load->view('admin/dashboard', $data);
			$this->load->view('admin/footer');

			if (isset($_POST['btnnonaktif'])) {
				$data = array(
					'status_ppg'	=> 'tutup',
					'tgl_diubah'  => $this->Model_data->date('waktu_default')
				);
				$this->db->update('tbl_web', $data, array('id_web' => '1'));
				redirect('panel_admin');
			}
			if (isset($_POST['btnaktif'])) {
				$data = array(
					'status_ppg'	=> 'buka',
					'tgl_diubah'  => $this->Model_data->date('waktu_default')
				);
				$this->db->update('tbl_web', $data, array('id_web' => '1'));
				redirect('panel_admin');
			}
		}
	}

	public function log_in()
	{
		$ceks = $this->session->userdata('ppg');
		if (isset($ceks)) {
			$this->load->view('404_content');
		} else {
			$this->load->view('admin/login/header');
			$this->load->view('admin/login/login');
			$this->load->view('admin/login/footer');

			if (isset($_POST['btnlogin'])) {
				$username = $_POST['username'];
				$pass	   = $_POST['password'];

				$query  = $this->db->get_where('tbl_user', "username='$username'");
				$cek    = $query->result();
				$cekun  = $cek[0]->username;
				$jumlah = $query->num_rows();

				if ($jumlah == 0) {
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;&nbsp;</span>
						</button>
						<strong>Username "' . $username . '"</strong> belum terdaftar.
						</div>'
					);
					redirect('panel_admin/log_in');
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
							<strong>Username atau Password Salah!</strong>.
							</div>'
						);
						redirect('panel_admin/log_in');
					} else {

						$this->session->set_userdata('ppg', "$cekun");
						$this->session->set_userdata('id_user@sman1_belitang', "$row->id_user");

						redirect('panel_admin');
					}
				}
			}
		}
	}

	public function iuran()
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			$this->load->view('404_content');
		} else {
			$data['user']   	 = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['web_ppg']	 = $this->db->get_where('tbl_web', "id_web='1'")->row();

			if (isset($_GET['bln']) && isset($_GET['thn'])) {
				$bln = $_GET['bln'];
				$thn = $_GET['thn'];
				$data['iuran'] = $this->db->query("SELECT * FROM tbl_iuran WHERE YEAR(tanggal) = '" . $thn . "' AND MONTH(tanggal) = '" . $bln . "' ")->result();
				$data['bloks']		 = $this->db->get('tbl_blok')->result();
				$data['pedagang']	= $this->db->get('tbl_pedagang')->result();
			}
			$data['blok']		 = $this->db->get('tbl_blok')->result();
			$data['bloknumber']		 = $this->db->get('tbl_blok_nomor')->result();
			$tanggal_sekarang = date('Y-m-d');
			$tanggal_awal_bulan = date('Y-m-28'); //Ganti angka 01 kalo mau setiap tanggal tsb input iuran otomatis, untuk Demo
			$tempo = date('Y-m-15');

			if ($tanggal_sekarang == $tanggal_awal_bulan) {
				$checking = $this->db->query("SELECT * FROM tbl_iuran WHERE tanggal='" . $tanggal_awal_bulan . "'");
				if ($checking->num_rows() == 0) {
					$pdgng = $this->db->get('tbl_pedagang')->result();
					foreach ($pdgng as $pd) :
						$datas = array(
							'tanggal' => $tanggal_sekarang,
							'user_id' => $pd->id_pedagang,
							'blok' => $pd->blokdagangan,
							'bloknomor' => $pd->bloknomor,
							'tagihan' => 40000,
							'tempo' => $tempo,
							'status' => 0
						);
						$this->db->insert('tbl_iuran', $datas);
					endforeach;
				}
			}

			$data['judul_web'] = "Dashboard";
			$this->load->view('admin/header', $data);
			$this->load->view('admin/iuran/iuran', $data);
			$this->load->view('admin/footer');

			if (isset($_POST['btnnonaktif'])) {
				$data = array(
					'status_ppg'	=> 'tutup',
					'tgl_diubah'  => $this->Model_data->date('waktu_default')
				);
				$this->db->update('tbl_web', $data, array('id_web' => '1'));
				redirect('panel_admin');
			}
			if (isset($_POST['btnaktif'])) {
				$data = array(
					'status_ppg'	=> 'buka',
					'tgl_diubah'  => $this->Model_data->date('waktu_default')
				);
				$this->db->update('tbl_web', $data, array('id_web' => '1'));
				redirect('panel_admin');
			}
		}
	}

	// public function tambahIuran()
	// {
	// 	$data = array(
	// 		'tanggal' => $this->input->post('tanggal'),
	// 		'nama_petugas' => $this->input->post('nama_petugas'),
	// 		'tipe' => $this->input->post('tipe'),
	// 		'blok' => $this->input->post('blok'),
	// 		'penghasilan' => $this->input->post('penghasilan'),
	// 	);
	// 	$query = $this->db->insert('tbl_iuran',$data);
	// 	redirect('panel_admin/iuran');
	// }

	public function editIuran($id, $thn, $bln)
	{
		$data = array(
			'status' => 1
		);
		$this->db->where('id', $id);
		$query = $this->db->update('tbl_iuran', $data);
		redirect('panel_admin/iuran?thn=' . $thn . '&bln=' . $bln . '');
	}

	public function deleteIuran($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_iuran');
		redirect('panel_admin/iuran');
	}

	public function denah($aksi = '', $id = '')
	{
		$id = $this->uri->segment(3);
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			redirect('panel_admin/log_in');
		} else {

			$data['user']  			  = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['judul_web'] 		= "Denah Lokasi Pasar Tumpah";
			$this->db->order_by('id_blok', 'ASC');
			$data['blok']	= $this->db->get_where('tbl_blok', "id_kelurahan='$id'")->result();
			$data['bloknumber']	= $this->db->get('tbl_blok_nomor')->result();
			$data['kel'] = $this->db->get_where('tbl_kelurahan', "id_kelurahan='$id'")->row();

			// $this->db->where('id_kelurahan_dagangan', $id);
			// $cekPedagang = $this->db->get('tbl_kelurahan')->result();

			// $this->db->order_by('id_jns', 'ASC');
			// $data['v_jns'] = $this->db->get('tbl_jns');
			// $this->db->select('*');
			// $this->db->from('tbl_blok');
			// $this->db->join('tbl_kelurahan', 'tbl_kelurahan.id_kelurahan = tbl_blok.id_kelurahan', 'left');
			// $this->db->order_by('id_blok', 'ASC');
			// $data['v_blok'] = $this->db->get();

			$this->load->view('admin/header', $data);
			$this->load->view('admin/denah', $data);
			$this->load->view('admin/footer');
		}
	}

	public function permohonan()
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			$this->load->view('404_content');
		} else {
			$data['user']   	 = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['web_ppg']	 = $this->db->get_where('tbl_web', "id_web='1'")->row();
			$data['permohonan']		 = $this->db->get('tbl_permohonan')->result();
			$data['blok']		 = $this->db->get('tbl_blok')->result();
			$data['bloknomor']		 = $this->db->get('tbl_blok_nomor')->result();
			$data['pedagang']		= $this->db->get('tbl_pedagang')->result();
			$data['judul_web'] = "Dashboard";
			$this->load->view('admin/header', $data);
			$this->load->view('admin/permohonan/permohonan', $data);
			$this->load->view('admin/footer');

			if (isset($_POST['btnnonaktif'])) {
				$data = array(
					'status_ppg'	=> 'tutup',
					'tgl_diubah'  => $this->Model_data->date('waktu_default')
				);
				$this->db->update('tbl_web', $data, array('id_web' => '1'));
				redirect('panel_admin');
			}
			if (isset($_POST['btnaktif'])) {
				$data = array(
					'status_ppg'	=> 'buka',
					'tgl_diubah'  => $this->Model_data->date('waktu_default')
				);
				$this->db->update('tbl_web', $data, array('id_web' => '1'));
				redirect('panel_admin');
			}
		}
	}

	public function editStatusPermohonan($id, $status, $id_user, $blokdagangan, $bloknomor)
	{
		$data = array(
			'status' => $status
		);
		$this->db->where('id', $id);
		$this->db->update('tbl_permohonan', $data);

		if ($status == 1) {
			$data2 = array(
				'blokdagangan' => $blokdagangan,
				'bloknomor' => $bloknomor
			);
			$this->db->where('id_pedagang', $id_user);
			$this->db->update('tbl_pedagang', $data2);
		}

		redirect('panel_admin/permohonan');
	}
	public function deletePermohonan($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_permohonan');
		redirect('panel_admin/permohonan');
	}

	public function keanggotaan()
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			$this->load->view('404_content');
		} else {
			$data['user']   	 = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['web_ppg']	 = $this->db->get_where('tbl_web', "id_web='1'")->row();
			$data['keanggotaan']		 = $this->db->get('tbl_permohonan_keanggotaan')->result();
			$data['blok']		 = $this->db->get('tbl_blok')->result();
			$data['bloknomor']		 = $this->db->get('tbl_blok_nomor')->result();
			$data['pedagang']		= $this->db->get('tbl_pedagang')->result();
			$data['judul_web'] = "Dashboard";
			$this->load->view('admin/header', $data);
			$this->load->view('admin/keanggotaan/keanggotaan', $data);
			$this->load->view('admin/footer');

			if (isset($_POST['btnnonaktif'])) {
				$data = array(
					'status_ppg'	=> 'tutup',
					'tgl_diubah'  => $this->Model_data->date('waktu_default')
				);
				$this->db->update('tbl_web', $data, array('id_web' => '1'));
				redirect('panel_admin');
			}
			if (isset($_POST['btnaktif'])) {
				$data = array(
					'status_ppg'	=> 'buka',
					'tgl_diubah'  => $this->Model_data->date('waktu_default')
				);
				$this->db->update('tbl_web', $data, array('id_web' => '1'));
				redirect('panel_admin');
			}
		}
	}



	public function editStatusKeanggotaan($id, $status, $id_user, $tgl_keanggotaan, $jangka)
	{
		$data = array(
			'status' => $status
		);
		$this->db->where('id', $id);
		$this->db->update('tbl_permohonan_keanggotaan', $data);
		$tgl = date_create($tgl_keanggotaan);
		// $tgl2 = $tgl->format('Y-m-d');
		if ($status == 1) {
			if ($jangka == 1) {
				$tglTambah = date_add($tgl, date_interval_create_from_date_string('1 Years'));
			} else if ($jangka == 2) {
				$tglTambah = date_add($tgl, date_interval_create_from_date_string('2 Years'));
			} else if ($jangka == 3) {
				$tglTambah = date_add($tgl, date_interval_create_from_date_string('3 Years'));
			}
			$tgls = date_format($tglTambah, 'Y-m-d');
			$data2 = array(
				'tgl_keanggotaan' => $tgls
			);
			$this->db->where('id_pedagang', $id_user);
			$this->db->update('tbl_pedagang', $data2);
		}

		redirect('panel_admin/keanggotaan');
	}

	public function deleteKeanggotaan($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_permohonan_keanggotaan');
		redirect('panel_admin/keanggotaan');
	}

	public function terima()
	{
		$kriteria_id = $this->uri->segment(3);
		$tgl_skrg = date('Y-m-d');
		$tambah = mktime(0, 0, 0, date('m') + 0, date('d') + 0, date('Y') + 1);
		$tglTambah = date('Y-m-d', $tambah);
		$data = array(
			'tgl_keanggotaan' => $tglTambah,
			'status_verifikasi'    => "diterima"
		);
		$this->db->where('id_pedagang', $kriteria_id);
		$this->db->update('tbl_pedagang', $data);

		redirect('panel_admin/set_pengumuman');
	}

	public function tolak()
	{
		$kriteria_id = $this->uri->segment(3);
		$data = array(
			'tgl_keanggotaan' => NULL,
			'status_verifikasi'    => "ditolak"
		);
		$this->db->where('id_pedagang', $kriteria_id);
		$this->db->update('tbl_pedagang', $data);

		redirect('panel_admin/set_pengumuman');
	}

	public function profile()
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			redirect('panel_admin/log_in');
		} else {
			$data['user']  			  = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['judul_web'] 		= "Profile";

			$this->load->view('admin/header', $data);
			$this->load->view('admin/profile', $data);
			$this->load->view('admin/footer');

			if (isset($_POST['btnupdate'])) {
				$username	 		= $this->input->post('username');
				$nama_lengkap	= $this->input->post('nama_lengkap');

				$data = array(
					'username'	   => $username,
					'nama_lengkap' => $nama_lengkap
				);
				$this->db->update('tbl_user', $data, array('username' => $ceks));

				$this->session->has_userdata('ppg');
				$this->session->set_userdata('ppg', "$username");

				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					</button>
					<strong>Sukses!</strong> Profile berhasil diperbarui.
					</div>'
				);

				redirect('panel_admin/profile');
			}
		}
	}

	public function kriteria($aksi = '', $id = '')
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			redirect('panel_admin/log_in');
		} else {

			$data['user']  			  = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['judul_web'] 		= "Data Blok & Jenis Dagangan";
			$data['bloknumber']	= $this->db->get('tbl_blok_nomor');

			$this->db->order_by('id_jns', 'ASC');
			$data['v_jns'] = $this->db->get('tbl_jns');
			$this->db->select('*');
			$this->db->from('tbl_blok');
			$this->db->join('tbl_kelurahan', 'tbl_kelurahan.id_kelurahan = tbl_blok.id_kelurahan', 'left');
			$this->db->order_by('id_blok', 'ASC');
			$data['v_blok'] = $this->db->get();

			$this->load->view('admin/header', $data);
			$this->load->view('admin/kriteria/kriteria', $data);
			$this->load->view('admin/footer');
		}
	}

	public function ubah_pass()
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			redirect('panel_admin/log_in');
		} else {
			$data['user']  			  = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['judul_web'] 		= "Ubah Password";

			$this->load->view('admin/header', $data);
			$this->load->view('admin/ubah_pass', $data);
			$this->load->view('admin/footer');

			if (isset($_POST['btnupdate2'])) {
				$password_lama 	= $this->input->post('password_lama');
				$password 	= $this->input->post('password');
				$password2 	= $this->input->post('password2');

				if ($data['user']->row()->password != $password_lama) {
					$this->session->set_flashdata(
						'msg2',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
						</button>
						<strong>Gagal!</strong> Password Lama tidak cocok.
						</div>'
					);
				} elseif ($password != $password2) {
					$this->session->set_flashdata(
						'msg2',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
						</button>
						<strong>Gagal!</strong> Password Baru & Ulangi Password Baru tidak cocok.
						</div>'
					);
				} else {
					$data = array(
						'password'	=> $password
					);
					$this->db->update('tbl_user', $data, array('username' => $ceks));

					$this->session->set_flashdata(
						'msg2',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
						</button>
						<strong>Sukses!</strong> Password berhasil diperbarui.
						</div>'
					);
				}
				redirect('panel_admin/ubah_pass');
			}
		}
	}


	public function statistik($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			redirect('panel_admin/log_in');
		} else {
			$data['user']  			    = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['judul_web']			= "Statistik Pendaftaran Siswa";

			if ($aksi == 'thn') {
				$thn = $id;
			} else {
				$thn = date('Y');
			}
			$data['v_thn']				= $thn;

			foreach ($this->Model_data->statistik($thn)->result_array() as $row) {
				$data['grafik'][] = (float)$row['Januari'];
				$data['grafik'][] = (float)$row['Februari'];
				$data['grafik'][] = (float)$row['Maret'];
				$data['grafik'][] = (float)$row['April'];
				$data['grafik'][] = (float)$row['Mei'];
				$data['grafik'][] = (float)$row['Juni'];
				$data['grafik'][] = (float)$row['Juli'];
				$data['grafik'][] = (float)$row['Agustus'];
				$data['grafik'][] = (float)$row['September'];
				$data['grafik'][] = (float)$row['Oktober'];
				$data['grafik'][] = (float)$row['Nopember'];
				$data['grafik'][] = (float)$row['Desember'];
			}

			foreach ($this->Model_data->statistik($thn, 'diverifikasi')->result_array() as $row) {
				$data['grafik2'][] = (float)$row['Januari'];
				$data['grafik2'][] = (float)$row['Februari'];
				$data['grafik2'][] = (float)$row['Maret'];
				$data['grafik2'][] = (float)$row['April'];
				$data['grafik2'][] = (float)$row['Mei'];
				$data['grafik2'][] = (float)$row['Juni'];
				$data['grafik2'][] = (float)$row['Juli'];
				$data['grafik2'][] = (float)$row['Agustus'];
				$data['grafik2'][] = (float)$row['September'];
				$data['grafik2'][] = (float)$row['Oktober'];
				$data['grafik2'][] = (float)$row['Nopember'];
				$data['grafik2'][] = (float)$row['Desember'];
			}

			foreach ($this->Model_data->statistik($thn, 'diterima')->result_array() as $row) {
				$data['grafik3'][] = (float)$row['Januari'];
				$data['grafik3'][] = (float)$row['Februari'];
				$data['grafik3'][] = (float)$row['Maret'];
				$data['grafik3'][] = (float)$row['April'];
				$data['grafik3'][] = (float)$row['Mei'];
				$data['grafik3'][] = (float)$row['Juni'];
				$data['grafik3'][] = (float)$row['Juli'];
				$data['grafik3'][] = (float)$row['Agustus'];
				$data['grafik3'][] = (float)$row['September'];
				$data['grafik3'][] = (float)$row['Oktober'];
				$data['grafik3'][] = (float)$row['Nopember'];
				$data['grafik3'][] = (float)$row['Desember'];
			}

			foreach ($this->Model_data->statistik($thn, 'tidak diterima')->result_array() as $row) {
				$data['grafik4'][] = (float)$row['Januari'];
				$data['grafik4'][] = (float)$row['Februari'];
				$data['grafik4'][] = (float)$row['Maret'];
				$data['grafik4'][] = (float)$row['April'];
				$data['grafik4'][] = (float)$row['Mei'];
				$data['grafik4'][] = (float)$row['Juni'];
				$data['grafik4'][] = (float)$row['Juli'];
				$data['grafik4'][] = (float)$row['Agustus'];
				$data['grafik4'][] = (float)$row['September'];
				$data['grafik4'][] = (float)$row['Oktober'];
				$data['grafik4'][] = (float)$row['Nopember'];
				$data['grafik4'][] = (float)$row['Desember'];
			}

			$this->db->like('tgl_pedagang', "$thn", 'after');
			$data['total_pendaftar'] 		 = $this->db->get("tbl_pedagang")->num_rows();

			$this->db->like('tgl_pedagang', "$thn", 'after');
			$data['total_diverifikasi'] 	 = $this->db->get_where("tbl_pedagang", "status_verifikasi='berhasil'")->num_rows();

			$this->db->like('tgl_pedagang', "$thn", 'after');
			$data['total_diterima'] 			 = $this->db->get_where("tbl_pedagang", "status_verifikasi='diterima'")->num_rows();

			$this->db->like('tgl_pedagang', "$thn", 'after');
			$data['total_tidak_diterima'] = $this->db->get_where("tbl_pedagang", "status_verifikasi='ditolak'")->num_rows();

			$this->load->view('admin/header', $data);
			$this->load->view('admin/statistik/index', $data);
			$this->load->view('admin/footer');
		}
	}

	public function set_pengumuman($aksi = '', $id = '')
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			redirect('panel_admin/log_in');
		} else {
			$data['user']  			  = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['judul_web'] 		= "Setting Pengumuman";

			if ($aksi == 'lulus') {
				$data = array(
					'status_pendaftaran'	=> 'lulus'
				);
				$this->db->update('tbl_pedagang', $data, array('no_pendaftaran' => "$id"));
				redirect('panel_admin/set_pengumuman');
			} elseif ($aksi == 'tdk_lulus') {
				$data = array(
					'status_pendaftaran'	=> 'tidak lulus'
				);
				$this->db->update('tbl_pedagang', $data, array('no_pendaftaran' => "$id"));
				redirect('panel_admin/set_pengumuman');
			} elseif ($aksi == 'batal') {
				$data = array(
					'status_pendaftaran'	=> null
				);
				$this->db->update('tbl_pedagang', $data, array('no_pendaftaran' => "$id"));
				redirect('panel_admin/set_pengumuman');
			} elseif ($aksi == 'thn') {
				$thn = $id;
			} else {
				$thn = date('Y');
			}


			$data['v_pedagang']  		=  $this->db->get('tbl_pedagang');
			$data['v_thn']				= $thn;
			$data['kelurahan'] = $this->db->get('tbl_kelurahan')->result();
			$this->db->order_by('id_jns', 'ASC');
			$data['v_jns'] = $this->db->get('tbl_jns');
			$this->db->order_by('id_blok', 'ASC');
			$data['v_blok'] = $this->db->get('tbl_blok')->result();

			$this->load->view('admin/header', $data);
			$this->load->view('admin/set_pengumuman/set_pengumuman', $data);
			$this->load->view('admin/footer');
		}
	}

	public function tambah_blok()
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			redirect('panel_admin/log_in');
		} else {
			$data['user']  			  = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['judul_web'] 		= "Tambah Blok";
			$data['kelurahan'] = $this->db->get('tbl_kelurahan');

			$this->load->view('admin/header', $data);
			$this->load->view("admin/kriteria/tambah_kriteria", $data);
			$this->load->view('admin/footer');

			if (isset($_POST['btn_tambah_blok'])) {
				$id_kelurahan	= $this->input->post('id_kelurahan');
				$nama_blok	= $this->input->post('nama_blok');
				$pj_blok	= $this->input->post('pj_blok');
				$no_hp_pj	= $this->input->post('no_hp_pj');

				$data = array(
					'id_kelurahan'	=> $id_kelurahan,
					'nama_blok'	=> $nama_blok,
					'pj_blok'	=> $pj_blok,
					'no_hp_pj'	=> $no_hp_pj
				);
				$this->db->insert('tbl_blok', $data);

				redirect('panel_admin/kriteria');
				return true;
			}
		}
	}
	public function update_blok()
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			redirect('panel_admin/log_in');
		} else {
			$data['user']  			  = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['judul_web'] 		= "Update Nilai";

			$kriteria_id = $this->uri->segment(3);
			$this->load->model("Model_data");
			$data["data_kriteria"] = $this->Model_data->ngambil_satu_blok($kriteria_id);
			$data["fetch_data_lr"] = $this->Model_data->ngambilsemuablok();
			$data['kelurahan'] = $this->db->get('tbl_kelurahan');

			$this->load->view('admin/header', $data);
			$this->load->view("admin/kriteria/edit_kriteria", $data);
			$this->load->view('admin/footer');

			if (isset($_POST['update_data_p'])) {
				$id_blok	= $this->input->post('id_blok');
				$id_kelurahan	= $this->input->post('id_kelurahan');
				$nama_blok	= $this->input->post('nama_blok');
				$pj_blok	= $this->input->post('pj_blok');
				$no_hp_pj	= $this->input->post('no_hp_pj');

				$data = array(
					'id_blok'	=> $id_blok,
					'id_kelurahan'	=> $id_kelurahan,
					'nama_blok'	=> $nama_blok,
					'pj_blok'	=> $pj_blok,
					'no_hp_pj'	=> $no_hp_pj
				);
				$this->db->where('id_blok', $id_blok);
				$this->db->update('tbl_blok', $data);

				redirect('panel_admin/kriteria');
				return true;
			}
		}
	}

	public function update_jns()
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			redirect('panel_admin/log_in');
		} else {
			$data['user']  			  = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['judul_web'] 		= "Update Nilai";

			$kriteria_id = $this->uri->segment(3);
			$this->load->model("Model_data");
			$data["data_kriteria"] = $this->Model_data->ngambil_satu_jns($kriteria_id);
			$data["fetch_data_lr"] = $this->Model_data->ngambilsemuajns();

			$this->load->view('admin/header', $data);
			$this->load->view("admin/kriteria/edit_kriteria_jns", $data);
			$this->load->view('admin/footer');

			if (isset($_POST['update_data_p'])) {
				$id_jns	= $this->input->post('id_jns');
				$nama_jns	= $this->input->post('nama_jns');

				$data = array(
					'id_jns'	=> $id_jns,
					'nama_jns'	=> $nama_jns
				);
				$this->db->where('id_jns', $id_jns);
				$this->db->update('tbl_jns', $data);

				redirect('panel_admin/kriteria');
				return true;
			}
		}
	}

	public function kelurahan($aksi = '', $id = '')
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			redirect('panel_admin/log_in');
		} else {

			$data['user']  			  = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['kelurahan']  			  = $this->db->get('tbl_kelurahan')->result();
			$data['judul_web'] 		= "Data Kelurahan & Pasien Covid";
			// $data['bloknumber']	= $this->db->get('tbl_blok_nomor');

			// $this->db->order_by('id_jns', 'ASC');
			// $data['v_jns'] = $this->db->get('tbl_jns');
			// $this->db->order_by('id_blok', 'ASC');
			// $data['v_blok'] = $this->db->get('tbl_blok');

			$this->load->view('admin/header', $data);
			$this->load->view('admin/kelurahan/kelurahan', $data);
			$this->load->view('admin/footer');
		}
	}

	public function kelurahanById()
	{
		$id = $this->input->post('id');
		$get = $this->db->get_where('tbl_kelurahan', "id_kelurahan ='$id' ")->row();
		echo json_encode($get);
	}

	public function doKelurahan()
	{
		$operation = $this->input->post('operation');
		$config['upload_path']          = './assets/file_geo/';
		$config['allowed_types']        = '*';

		$this->load->library('upload');
		$this->upload->initialize($config);
		$out = array();
		if ($operation == 'tambah') {
			if (!$this->upload->do_upload('file_geo_kelurahan')) {
				$error = array('error' => $this->upload->display_errors());
				$out['cond'] = '0';
				$out['msg'] = $error;
			} else {
				$file = $this->upload->data('file_name');
				$data = array(
					'nama_kelurahan' => $this->input->post('nama_kelurahan'),
					'positif_kelurahan' => $this->input->post('positif_kelurahan'),
					'negatif_kelurahan' => $this->input->post('negatif_kelurahan'),
					'file_geo_kelurahan' => $file
				);
				$proc = $this->db->insert('tbl_kelurahan', $data);
				if ($proc) {
					$out['cond'] = '1';
				} else {
					$out['cond'] = '0';
				}
			}
		} else if ($operation == 'edit') {
			if (!$this->upload->do_upload('file_geo_kelurahan')) {
				$file = $this->input->post('old_file_geo_kelurahan');
				$id = $this->input->post('id_kelurahan');
				$data = array(
					'nama_kelurahan' => $this->input->post('nama_kelurahan'),
					'positif_kelurahan' => $this->input->post('positif_kelurahan'),
					'negatif_kelurahan' => $this->input->post('negatif_kelurahan'),
					'file_geo_kelurahan' => $file
				);
				$this->db->where('id_kelurahan', $id);
				$proc = $this->db->update('tbl_kelurahan', $data);
				if ($proc) {
					$out['cond'] = '1';
					$out['msg'] = 'no up';
				} else {
					$out['cond'] = '0';
				}
			} else {
				$file = $this->upload->data('file_name');
				$id = $this->input->post('id_kelurahan');
				$data = array(
					'nama_kelurahan' => $this->input->post('nama_kelurahan'),
					'positif_kelurahan' => $this->input->post('positif_kelurahan'),
					'negatif_kelurahan' => $this->input->post('negatif_kelurahan'),
					'file_geo_kelurahan' => $file
				);
				$this->db->where('id_kelurahan', $id);
				$proc = $this->db->update('tbl_kelurahan', $data);
				if ($proc) {
					$out['cond'] = '1';
					$out['msg'] = 'up';
				} else {
					$out['cond'] = '0';
				}
			}
		}
		echo json_encode($out);
	}

	public function deleteKelurahan($id)
	{
		$this->db->where('id_kelurahan', $id);
		$proc = $this->db->delete('tbl_kelurahan');
		redirect('panel_admin/kelurahan');
	}

	public function user($aksi = '', $id = '')
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			redirect('panel_admin/log_in');
		} else {

			$data['user']  			  = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['users']  			  = $this->db->get_where('tbl_user', "username !='$ceks'")->result();
			$data['judul_web'] 		= "Data User Akun";
			// $data['bloknumber']	= $this->db->get('tbl_blok_nomor');

			// $this->db->order_by('id_jns', 'ASC');
			// $data['v_jns'] = $this->db->get('tbl_jns');
			// $this->db->order_by('id_blok', 'ASC');
			// $data['v_blok'] = $this->db->get('tbl_blok');

			$this->load->view('admin/header', $data);
			$this->load->view('admin/user/user', $data);
			$this->load->view('admin/footer');
		}
	}

	public function userById()
	{
		$id = $this->input->post('id');
		$get = $this->db->get_where('tbl_user', "id_user ='$id' ")->row();
		echo json_encode($get);
	}

	public function doUser()
	{
		$operation = $this->input->post('operation');
		$out = array();
		if ($operation == 'tambah') {
			$data = array(
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('username'),
				'level' => $this->input->post('level')
			);
			$proc = $this->db->insert('tbl_user', $data);
			if ($proc) {
				$out['cond'] = '1';
			} else {
				$out['cond'] = '0';
			}
		} else if ($operation == 'edit') {
			$id = $this->input->post('id_users');
			$data = array(
				'level' => $this->input->post('level')
			);
			$this->db->where('id_user', $id);
			$proc = $this->db->update('tbl_user', $data);
			if ($proc) {
				$out['cond'] = '1';
			} else {
				$out['cond'] = '0';
			}
		}
		echo json_encode($out);
	}

	public function deleteUsers($id)
	{
		$this->db->where('id_user', $id);
		$proc = $this->db->delete('tbl_user');
		redirect('panel_admin/user');
	}

	public function kmeans($aksi = '', $id = '')
	{
		$ceks = $this->session->userdata('ppg');
		if (!isset($ceks)) {
			redirect('panel_admin/log_in');
		} else {

			$data['user']  			  = $this->db->get_where('tbl_user', "username='$ceks'");
			$data['kelurahan']  			  = $this->db->get('tbl_kelurahan')->result();
			$data['judul_web'] 		= "Perhitungan K-means Clustering";

			if ($this->input->post('hitung')) {
				$this->db->limit(2, 0);
				$this->db->order_by('RAND ()');
				$getDataRand = $this->db->get('tbl_kelurahan')->result();
				$c1xAwal = 0;
				$c1yAwal = 0;
				$c2xAwal = 0;
				$c2yAwal = 0;
				$countdata = 0;
				foreach ($getDataRand as $g) {
					if ($countdata == 0) {
						$c1xAwal = $g->positif_kelurahan;
						$c1yAwal = $g->negatif_kelurahan;
					} else {
						$c2xAwal = $g->positif_kelurahan;
						$c2yAwal = $g->negatif_kelurahan;
					}
					$countdata++;
				}

				$hasilC1x = 0;
				$hasilC1y = 0;
				$hasilC2x = 0;
				$hasilC2y = 0;
				$semuaCluster1 = array();
				$j = 1;
				for ($i = 0; $i < $j; $i++) {
					if ($i == 0) {
						$c1x = $c1xAwal;
						$c1y = $c1yAwal;
						$c2x = $c2xAwal;
						$c2y = $c2yAwal;
					} else if ($i != 0) {
						$c1x = $hasilC1x;
						$c1y = $hasilC1y;
						$c2x = $hasilC2x;
						$c2y = $hasilC2y;
					}

					$semuaCluster2 = array();
					$hasilC1x = 0;
					$hasilC1y = 0;
					$hasilC2x = 0;
					$hasilC2y = 0;
					$jmlhdata1 = 0;
					$jmlhdata2 = 0;

					foreach ($data['kelurahan'] as $k) {
						$hasil1 = sqrt((pow($k->positif_kelurahan - $c1x, 2)) + pow($k->negatif_kelurahan - $c1y, 2));
						$hasil2 = sqrt((pow($k->positif_kelurahan - $c2x, 2)) + pow($k->negatif_kelurahan - $c2y, 2));

						if ($hasil1 < $hasil2) {
							$hasilC1x += $k->positif_kelurahan;
							$hasilC1y += $k->negatif_kelurahan;
							$jmlhdata1 += 1;
							if ($i == 0) {
								array_push($semuaCluster1, 1);
							} else if ($i != 0) {
								array_push($semuaCluster2, 1);
							}
						} else if ($hasil1 > $hasil2) {
							$hasilC2x += $k->positif_kelurahan;
							$hasilC2y += $k->negatif_kelurahan;
							$jmlhdata2 += 1;
							if ($i == 0) {
								array_push($semuaCluster1, 2);
							} else if ($i != 0) {
								array_push($semuaCluster2, 2);
							}
						}
					}

					if ($jmlhdata1 == 0) {
						$hasilC1x = $hasilC1x;
						$hasilC1y = $hasilC1y;
					} else {
						$hasilC1x = $hasilC1x / $jmlhdata1;
						$hasilC1y = $hasilC1y / $jmlhdata1;
					}

					if ($jmlhdata2 == 0) {
						$hasilC2x = $hasilC2x;
						$hasilC2y = $hasilC2y;
					} else {
						$hasilC2x = $hasilC2x / $jmlhdata2;
						$hasilC2y = $hasilC2y / $jmlhdata2;
					}

					$jmlhPerbedaan = 0;
					if (!empty($semuaCluster2)) {
						for ($k = 0; $k < count($semuaCluster1); $k++) {
							if ($semuaCluster1[$k] != $semuaCluster2[$k]) {
								$jmlhPerbedaan += 1;
							}
						}
						if ($jmlhPerbedaan != 0) {
							$semuaCluster1 = array();
							for ($l = 0; $l < count($semuaCluster2); $l++) {
								array_push($semuaCluster1, $semuaCluster2[$l]);
							}
							$j = $j + 1;
						} else if ($jmlhPerbedaan == 0) {
							$jumlahData = $jmlhdata1 + $jmlhdata2;
							$hasilJmlhData1 = ($jmlhdata1 / $jumlahData) * 100;
							$hasilJmlhData2 = ($jmlhdata2 / $jumlahData) * 100;
						}
					} else {
						$j = $j + 1;
					}
				}
				$nom = 0;
				foreach ($data['kelurahan'] as $kel) {
					$dat = array(
						'nilai_kmeans_kelurahan' => $semuaCluster2[$nom]
					);
					$this->db->where('id_kelurahan', $kel->id_kelurahan);
					$this->db->update('tbl_kelurahan', $dat);
					$nom++;
				}
				redirect('panel_admin/kmeans');
			}

			$this->load->view('admin/header', $data);
			$this->load->view('admin/kmeans/kmeans', $data);
			$this->load->view('admin/footer');
		}
	}

	public function logout()
	{
		if ($this->session->has_userdata('ppg') != '' and $this->session->has_userdata('id_user@sman1_belitang') != '') {
			$this->session->sess_destroy();
		}
		redirect('panel_admin/log_in');
	}
}
