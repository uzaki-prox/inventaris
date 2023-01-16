<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asset extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Asset_model');
        $this->load->model('Serial_number');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'asset/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'asset/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'asset/index.html';
            $config['first_url'] = base_url() . 'asset/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Asset_model->total_rows($q);
        $asset = $this->Asset_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'asset_data' => $asset,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'asset/asset_list',
            'judul' => 'Data Jenis Aset',
        );
        $this->load->view('v_index', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('asset/create_action'),
	        'id_asset' => $this->Serial_number->make_id_asset(),
	        'name_asset' => set_value('name_asset'),
            'konten' => 'asset/asset_form',
            'judul' => 'Data Jenis Aset',
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
                'id_asset' => $this->input->post('id_asset',TRUE),
		        'name_asset' => $this->input->post('name_asset',TRUE),
	        );

            $this->Asset_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('asset'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Asset_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('asset/update_action'),
		        'id_asset' => set_value('id_asset', $row->id_asset),
		        'name_asset' => set_value('name_asset', $row->name_asset),
                'konten' => 'asset/asset_form',
                'judul' => 'Data Jenis Aset',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('asset'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_asset', TRUE));
        } else {
            $data = array(
		        'name_asset' => $this->input->post('name_asset',TRUE),
	        );

            $this->Asset_model->update($this->input->post('id_asset', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('asset'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Asset_model->get_by_id($id);

        if ($row) {
            $this->Asset_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('asset'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('asset'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name_asset', 'Jenis Asset', 'trim|required');
	$this->form_validation->set_rules('id_asset', 'ID Asset', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

