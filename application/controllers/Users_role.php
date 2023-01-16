<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_role extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_role_model');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'users_role/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users_role/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users_role/index.html';
            $config['first_url'] = base_url() . 'users_role/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_role_model->total_rows($q);
        $users_role = $this->Users_role_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'users_role_data' => $users_role,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'users_role/users_role_list',
            'judul' => 'Data Hak Akses',
        );
        $this->load->view('v_index', $data);
    }

    public function create() 
    {
        
        $data = array(
            'button' => 'Create',
            'action' => site_url('users_role/create_action'),
	        'id_role' => set_value('id_role'),
	        'name_role' => set_value('name_role'),
            'konten' => 'users_role/users_role_form',
            'judul' => 'Data Hak Akses',
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
                'id_role' => $this->input->post('id_role', TRUE),
		        'name_role' => $this->input->post('name_role', TRUE),
	        );
            $this->Users_role_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('users_role'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Users_role_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users_role/update_action'),
		        'id_role' => set_value('id_role', $row->id_role),
		        'name_role' => set_value('name_role', $row->name_role),
                'konten' => 'users_role/users_role_form',
                'judul' => 'Data Hak Akses',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users_role'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_role', TRUE));
        } else {
            $data = array(
		        'name_role' => $this->input->post('name_role',TRUE),
	        );
            $this->Users_role_model->update($this->input->post('id_role', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('users_role'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->Users_role_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('users_role'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users_role'));
        }
    }

    public function _rules() 
    {
	    $this->form_validation->set_rules('name_role', 'Hak Akses', 'trim|required');
	    $this->form_validation->set_rules('id_role', 'ID Hak Akses', 'trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Users.php */