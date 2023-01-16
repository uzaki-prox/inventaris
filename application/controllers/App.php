<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	
	public function index()
	{
		if ($this->session->userdata('id_role') == "") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'home',
            'judul' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
	}

	public function login()
	{

		if ($this->input->post() == NULL) {
			$this->load->view('login');
		} else {
			$niy = $this->input->post('niy');
			$password = md5($this->input->post('password'));
			$cek_user = $this->db->query("SELECT * FROM users WHERE niy='$niy' AND password='$password' ");
			if ($cek_user->num_rows() == 1) {
				foreach ($cek_user->result() as $row) {
					$sess_data['niy'] = $row->niy;
					$sess_data['name'] = $row->name;
					$sess_data['place_birth'] = $row->place_birth;
					$sess_data['date_birth'] = $row->date_birth;
					$sess_data['address'] = $row->address;
					$sess_data['id_role'] = $row->id_role;
					$this->session->set_userdata($sess_data);
				}
				redirect('app');
			} else {
				?>
				<script type="text/javascript">
					alert('NIY dan Password kamu salah !');
					window.location="<?php echo base_url('app/login'); ?>";
				</script>
				<?php
			}

		}
	}

	function logout()
	{
		$this->session->unset_userdata('niy');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('place_birth');
		$this->session->unset_userdata('date_birth');
		$this->session->unset_userdata('address');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('id_role');
		session_destroy();
		redirect('app/login');
	}

}
