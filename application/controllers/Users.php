<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users/index.html';
            $config['first_url'] = base_url() . 'users/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_model->total_rows($q);
        $users = $this->Users_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'users_data' => $users,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'users/users_list',
            'judul' => 'Data User',
        );
        $this->load->view('v_index', $data);
    }

    public function create() 
    {
        
        $data = array(
            'button' => 'Create',
            'action' => site_url('users/create_action'),
	        'niy' => set_value('niy'),
	        'name' => set_value('name'),
	        'place_birth' => set_value('place_birth'),
            'date_birth' => set_value('date_birth'),
            'address' => set_value('address'),
	        'password' => set_value('password'),
	        'id_role' => set_value('id_role'),
            'konten' => 'users/users_form',
            'judul' => 'Data User',
	    );
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'niy' => $this->input->post('niy',TRUE),
		    'name' => $this->input->post('name',TRUE),
		    'place_birth' => $this->input->post('place_birth',TRUE),
            'date_birth' => $this->input->post('date_birth',TRUE),
            'address' => $this->input->post('address',TRUE),
		    'password' => md5($this->input->post('password',TRUE)),
		    'role' => $this->input->post('role',TRUE),
	        );
            $this->Users_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('users'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users/update_action'),
		        'niy' => set_value('niy', $row->niy),
		        'name' => set_value('name', $row->name),
		        'place_birth' => set_value('place_birth', $row->place_birth),
                'date_birth' => set_value('date_birth', $row->date_birth),
                'address' => set_value('address', $row->address),
		        'password' => set_value('password', $row->password),
		        'id_role' => set_value('id_role', $row->id_role),
                'konten' => 'users/users_form',
                'judul' => 'Data User',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('niy', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'place_birth' => $this->input->post('place_birth',TRUE),
        'date_birth' => $this->input->post('date_birth',TRUE),
        'address' => $this->input->post('address',TRUE),
		'password' => md5($this->input->post('password',TRUE)),
		'id_role' => $this->input->post('id_role',TRUE),
	    );
            $this->Users_model->update($this->input->post('niy', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('users'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->Users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('users'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function _rules() 
    {
	    $this->form_validation->set_rules('name', 'Nama Pegawai', 'trim|required');
	    $this->form_validation->set_rules('place_birth', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('date_birth', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('address', 'Alamat', 'trim|required');
	    $this->form_validation->set_rules('password', 'Password', 'trim|required');
	    $this->form_validation->set_rules('role', 'Status', 'trim|required');
	    $this->form_validation->set_rules('niy', 'NIY', 'trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Users.php */