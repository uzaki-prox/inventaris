<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cluster extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cluster_model');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'cluster/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'cluster/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'cluster/index.html';
            $config['first_url'] = base_url() . 'cluster/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Cluster_model->total_rows($q);
        $cluster = $this->Cluster_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'cluster_data' => $cluster,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'cluster/cluster_list',
            'judul' => 'Data Kelompok Unit',
        );
        $this->load->view('v_index', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('cluster/create_action'),
	        'id_cluster' => set_value('id_cluster'),
	        'name_cluster' => set_value('name_cluster'),
            'konten' => 'cluster/cluster_form',
            'judul' => 'Data Kelompok Unit',
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
                'id_cluster' => $this->input->post('id_cluster',TRUE),
		        'name_cluster' => $this->input->post('name_cluster',TRUE),
	        );

            $this->Cluster_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('cluster'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Cluster_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cluster/update_action'),
		        'id_cluster' => set_value('id_cluster', $row->id_cluster),
		        'name_cluster' => set_value('name_cluster', $row->name_cluster),
                'konten' => 'cluster/cluster_form',
                'judul' => 'Data Kelompok Unit',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cluster'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_cluster', TRUE));
        } else {
            $data = array(
                'id_cluster' => $this->input->post('id_cluster', TRUE),
		        'name_cluster' => $this->input->post('name_cluster',TRUE),
	        );

            $this->Cluster_model->update($this->input->post('id_cluster2', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('cluster'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Cluster_model->get_by_id($id);

        if ($row) {
            $this->Cluster_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('cluster'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cluster'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name_cluster', 'Jenis Kelompok', 'trim|required');
	$this->form_validation->set_rules('id_cluster', 'ID Kelompok', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

