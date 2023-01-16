<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Object extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Object_model');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'object/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'object/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'object/index.html';
            $config['first_url'] = base_url() . 'object/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Object_model->total_rows($q);
        $object = $this->Object_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'object_data' => $object,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'object/object_list',
            'judul' => 'Data Objek',
        );
        $this->load->view('v_index', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('object/create_action'),
	        'id_object' => set_value('id_object'),
	        'name_object' => set_value('name_object'),
            'descript' => set_value('descript'),
            'asset' => set_value('asset'),
            'konten' => 'object/object_form',
            'judul' => 'Data Objek',
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
                'id_object' => $this->input->post('id_object',TRUE),
		        'name_object' => $this->input->post('name_object',TRUE),
                'descript' => $this->input->post('descript',TRUE),
                'asset' => $this->input->post('asset',TRUE),
	        );

            $this->Object_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('object'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Object_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('object/update_action'),
		        'id_object' => set_value('id_object', $row->id_object),
		        'name_object' => set_value('name_object', $row->name_object),
                'descript' => set_value('descript', $row->descript),
                'asset' => set_value('asset', $row->asset),
                'konten' => 'object/object_form',
                'judul' => 'Data Objek',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('object'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_object', TRUE));
        } else {
            $data = array(
                'id_object' => $this->input->post('id_object', TRUE),
		        'name_object' => $this->input->post('name_object',TRUE),
                'descript' => $this->input->post('descript',TRUE),
                'asset' => $this->input->post('asset',TRUE),
	        );

            $this->Object_model->update($this->input->post('id_object2', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('object'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Object_model->get_by_id($id);

        if ($row) {
            $this->Object_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('object'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('object'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('asset', 'Jenis Aset', 'trim|required');
        $this->form_validation->set_rules('descript', 'Keterangan', 'trim|required');
	    $this->form_validation->set_rules('name_object', 'Nama Objek', 'trim|required');
	    $this->form_validation->set_rules('id_object', 'ID Objek', 'trim'); 
	    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

