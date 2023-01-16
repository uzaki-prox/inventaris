<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Change_pass extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }

    public function index()
    {
        $change_pass = $this->Users_model->get_by_id($this->session->userdata('niy'));

        $data = array(
            'change_pass_data' => $change_pass,
            'button' => 'Change Password',
            'konten' => 'change_pass/change_pass_list',
            'judul' => 'About Me',
        );
        $this->load->view('v_index', $data);
    }

    public function cpw()
    {
        $data = array(
            'button' => 'Change Password',
            'action' => site_url('change_pass/cpw_action'),
            'niy' => set_value('niy'),
            'psw_lama' => set_value('psw_lama'),
	        'password' => set_value('password'),
	        'psw_conf' => set_value('psw_conf'),
            'konten' => 'change_pass/change_pass_form',
            'judul' => 'Ganti Password',
	    );
        $this->load->view('v_index', $data);
    }

    public function cpw_action()
    {
        $this->_rules();

        /*if ($_POST AND $this->form_validation->run() == TRUE) {
            $old_password = $this->input->post('psw_lama');
            $params['password'] = sha1($this->input->post('password'));
            $status = $this->Users_model->change_password($this->session->userdata('nip'), $params);
            $this->session->set_flashdata('message', 'Update password success');
            redirect('change_pass');
        } else {
            if ($this->Users_model->get_by_id($this->session->userdata('nip')) == NULL) {
                redirect('change_pass');
            }
            redirect('change_pass');
        }*/

        if ($this->form_validation->run() == FALSE) {
            $this->change_pass($this->input->post('niy', TRUE));
        } else {
            $data = array(
                'password' => $this->input->post('password',TRUE),
	        );

            $this->Users_model->change_password($this->input->post('niy', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('change_pass'));
        }
    }

    public function check_current_password()
    {
        $row = $this->Users_model->get_by_id($this->session->userdata('niy'));
        $user = $row->password;
        $pass = $this->input->post('psw_lama');
        if ($user == $pass) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_current_password', 'Password lama tidak sesuai');
            return FALSE;
        }
    }

    public function _rules()
    {
	    $this->form_validation->set_rules('psw_lama', 'Old Password', 'required|callback_check_current_password');
	    $this->form_validation->set_rules('password', 'New Password', 'required|matches[psw_conf]|min_length[6]');
	    $this->form_validation->set_rules('psw_conf', 'Confirm New Password', 'required|min_length[6]');
	    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file change_pass.php */