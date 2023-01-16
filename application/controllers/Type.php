<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Type extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Type_model');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'type/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'type/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'type/index.html';
            $config['first_url'] = base_url() . 'type/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Type_model->total_rows($q);
        $type = $this->Type_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'type_data' => $type,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'type/type_list',
            'judul' => 'Data Jenis Objek',
        );
        $this->load->view('v_index', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('type/create_action'),
	        'id_type' => set_value('id_type'),
	        'name_type' => set_value('name_type'),
            'descript' => set_value('descript'),
            'konten' => 'type/type_form',
            'judul' => 'Data Jenis Objek',
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
                'id_type' => $this->input->post('id_type',TRUE),
		        'name_type' => $this->input->post('name_type',TRUE),
                'descript' => $this->input->post('descript',TRUE),
	        );

            $this->Type_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('type'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Type_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('type/update_action'),
		        'id_type' => set_value('id_type', $row->id_type),
		        'name_type' => set_value('name_type', $row->name_type),
                'descript' => set_value('descript', $row->descript),
                'konten' => 'type/type_form',
                'judul' => 'Data Jenis Objek',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('type'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_type', TRUE));
        } else {
            $data = array(
                'id_type' => $this->input->post('id_type', TRUE),
		        'name_type' => $this->input->post('name_type',TRUE),
                'descript' => $this->input->post('descript',TRUE),
	        );

            $this->Type_model->update($this->input->post('id_type2', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('type'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Type_model->get_by_id($id);

        if ($row) {
            $this->Type_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('type'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('type'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('descript', 'Keterangan', 'trim|required');
	    $this->form_validation->set_rules('name_type', 'Nama Jenis', 'trim|required');
	    $this->form_validation->set_rules('id_type', 'ID Jenis', 'trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

