<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Complete_inst extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Complete_inst_model');
        $this->load->model('Serial_number');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'complete_inst/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'complete_inst/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'complete_inst/index.html';
            $config['first_url'] = base_url() . 'complete_inst/index.html';
        }

        $config['per_page'] = 20;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Complete_inst_model->total_rows($q);
        $complete = $this->Complete_inst_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'complete_data' => $complete,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'complete_inst/complete_inst_list',
            'judul' => 'Uraian Kelengkapan',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Complete_inst_model->get_by_id($id);
        if ($row) {
            $data = array(
		    'id_complet' => $row->id_complet,
            'instrument_complet' => $row->instrument_complet,
		    'descript' => $row->descript,
	        );
            $this->load->view('complete_inst/complete_inst_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('complete_inst'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('complete_inst/create_action'),
	        'id_complet' => $this->Serial_number->make_id_complet(),
            'instrument_complet' => set_value('instrument_complet'),
	        'descript' => set_value('descript'),
            'konten' => 'complete_inst/complete_inst_form',
            'judul' => 'Uraian Kelengkapan',
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
                'id_complet' => $this->input->post('id_complet',TRUE),
                'instrument_complet' => $this->input->post('instrument_complet',TRUE),
		        'descript' => $this->input->post('descript',TRUE),
	        );
            $this->Complete_inst_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('complete_inst'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Complete_inst_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('complete_inst/update_action'),
		        'id_complet' => set_value('id_complet', $row->id_complet),
                'instrument_complet' => set_value('instrument_complet', $row->instrument_complet),
		        'descript' => set_value('descript', $row->descript),
                'konten' => 'complete_inst/complete_inst_form',
                'judul' => 'Uraian Kelengkapan',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('complete_inst'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_complet', TRUE));
        } else {
            $data = array(
                'instrument_complet' => $this->input->post('instrument_complet',TRUE),
		        'descript' => $this->input->post('descript',TRUE),
	        );

            $this->Complete_inst_model->update($this->input->post('id_complet', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('complete_inst'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Complete_inst_model->get_by_id($id);

        if ($row) {
            $this->Complete_inst_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('complete_inst'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('complete_inst'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('instrument_complet', 'Uraian Kebersihan', 'trim|required');
	    $this->form_validation->set_rules('descript', 'Keterangan', 'trim|required');
	    $this->form_validation->set_rules('id_complet', 'ID Uraian Kebersihan', 'trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function complete_inst_excel()
    {
        $data = $this->Complete_inst_model->get_all();
        $objXLS   = new PHPExcel();
        $objSheet = $objXLS->setActiveSheetIndex(0);            

        $no = 1;
        $font = array('font' => array( 'bold' => true, 'color' => array('rgb'  => '000000')));
        $objXLS->setActiveSheetIndex(0);        
        $styleArray = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb'  => 'FFFFFF'
                        ),
                    ),
                ),
            ),
        );

        $borderStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'rgb'  => '000000' 
                    ),
                ),
            ),
        );

        $objSheet->setCellValue('A1', 'DATA POIN KELENGKAPAN');

        $cell  = 2;
        $objSheet->setCellValue('A'. $cell, 'ID Kelengkapan');
        $objSheet->setCellValue('B'. $cell, 'Uraian Kelengkapan');
        $objSheet->setCellValue('C'. $cell, 'Keterangan');

        $objXLS->getActiveSheet()->getStyle('A' .  $cell . ':C' . $cell)->applyFromArray($font)->applyFromArray($borderStyle);

        $objXLS->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleArray)->applyFromArray($font);
        $objXLS->setActiveSheetIndex(0)->mergeCells('A1:C1');

        $cell++;
        $query = $this->db->query("SELECT * FROM complet_instrument")->result();
        $total = 0;
        $objXLS->getActiveSheet()->getStyle('A' .  $cell . ':C' . $cell)->applyFromArray($borderStyle);
        foreach ($query as $r) {
            $objSheet->setCellValueExplicit('A'.$cell, $r->id_complet, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('B'.$cell, $r->instrument_complet, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('C'.$cell, $r->descript, PHPExcel_Cell_DataType::TYPE_STRING);
            $cell++;
            $no++;
        }

        $objXLS->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objXLS->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objXLS->getActiveSheet()->getColumnDimension('C')->setWidth(50);

        $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel2007');

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="LIST POIN KELENGKAPAN ' . date("d/m/y") .'.xlsx"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter->save('php://output'); 
        exit();     
    }

}
