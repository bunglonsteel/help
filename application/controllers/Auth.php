<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{

		if ($this->session->userdata('email')) {
			redirect('/');
		}

		$this->form_validation->set_rules('username', 'Username / Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

		if ($this->form_validation->run() == false) {
			$this->load->view('login');
		} else {
			$account  = strip_tags(html_escape($this->input->post('username', TRUE)));
			$password = strip_tags(html_escape($this->input->post('password', TRUE)));
			$user     = $this->db->where('username', $account)->or_where('email', $account)->from('users')->get()->row_array();

			if ($user) {
				if (password_verify($password, $user['password'])) {
					$this->session->set_userdata('email', $user['email']);
					$this->session->set_flashdata('success_login', 'true');
					redirect('/');
				} else {
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger alert-dismissible fs-7 py-2_5" role="alert">
							Password salah, ulangi lagi.
						</div>'
					);
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger alert-dismissible fs-7 py-2_5" role="alert">
						Username / Email tidak ditemukan.
                    </div>'
				);
				redirect('auth');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success alert-dismissible fs-7 py-2_5" role="alert">
				Anda berhasil logout.
			</div>'
		);
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('blocked');
	}
}

/* End of file Auth.php */
