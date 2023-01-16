<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Room_kind extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Room_kind_model');
        $this->load->model('Serial_number');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'room_kind/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'room_kind/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'room_kind/index.html';
            $config['first_url'] = base_url() . 'room_kind/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Room_kind_model->total_rows($q);
        $room_kind = $this->Room_kind_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'room_kind_data' => $room_kind,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'room_kind/room_kind_list',
            'judul' => 'Data Jenis Ruangan',
        );
        $this->load->view('v_index', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('room_kind/create_action'),
	        'id_kind' => $this->Serial_number->make_id_kind(),
	        'name_kind' => set_value('name_kind'),
            'konten' => 'room_kind/room_kind_form',
            'judul' => 'Data Jenis Ruangan',
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
                'id_kind' => $this->input->post('id_kind',TRUE),
		        'name_kind' => $this->input->post('name_kind',TRUE),
	        );

            $this->Room_kind_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('room_kind'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Room_kind_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('room_kind/update_action'),
		        'id_kind' => set_value('id_kind', $row->id_kind),
		        'name_kind' => set_value('name_kind', $row->name_kind),
                'konten' => 'room_kind/room_kind_form',
                'judul' => 'Data Jenis Ruangan',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('room_kind'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kind', TRUE));
        } else {
            $data = array(
		        'name_kind' => $this->input->post('name_kind',TRUE),
	        );

            $this->Room_kind_model->update($this->input->post('id_kind', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('room_kind'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Room_kind_model->get_by_id($id);

        if ($row) {
            $this->Room_kind_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('room_kind'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('room_kind'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name_kind', 'Jenis', 'trim|required');
	$this->form_validation->set_rules('id_kind', 'ID Jenis', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

