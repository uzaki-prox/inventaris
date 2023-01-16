<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Deprec extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Deprec_model');
        $this->load->model('Serial_number');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'deprec/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'deprec/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'deprec/index.html';
            $config['first_url'] = base_url() . 'deprec/index.html';
        }
 
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Deprec_model->total_rows($q);
        $deprec = $this->Deprec_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'deprec_data' => $deprec,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'deprec/deprec_list',
            'judul' => 'Data Penyusutan',
        );
        $this->load->view('v_index', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('deprec/create_action'),
	        'no_deprec' => $this->Serial_number->make_no_deprec(),
	        'no_label' => set_value('no_label'),
            'year_procurement' => set_value('year_procurement'),
            'economics_age' => set_value('economics_age'),
            'acquisition_cost' => set_value('acquisition_cost'),
            'dep_per_year' => set_value('dep_per_year'),
            'remaining_age' => set_value('remaining_age'),
            'konten' => 'deprec/deprec_form',
            'judul' => 'Data Penyusutan',
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
                'no_deprec' => $this->Serial_number->make_no_deprec(),
		        'no_label' => $this->input->post('no_label',TRUE),
                'year_procurement' => $this->input->post('year_procurement',TRUE),
                'economics_age' => $this->input->post('economics_age',TRUE),
                'acquisition_cost' => $this->input->post('acquisition_cost',TRUE),
                'dep_per_year' => $this->input->post('dep_per_year',TRUE),
                'remaining_age' => $this->input->post('remaining_age',TRUE),
	        );

            $this->Deprec_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('deprec'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Deprec_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('deprec/update_action'),
                'no_deprec' => set_value('no_deprec', $row->no_deprec),
		        'no_label' => set_value('no_label', $row->no_label),
		        'year_procurement' => set_value('year_procurement', $row->year_procurement),
                'economics_age' => set_value('economics_age', $row->economics_age),
                'acquisition_cost' => set_value('acquisition_cost', $row->acquisition_cost),
                'dep_per_year' => set_value('dep_per_year', $row->dep_per_year),
                'remaining_age' => set_value('remaining_age', $row->remaining_age),
                'konten' => 'deprec/deprec_form',
                'judul' => 'Data Penyusutan',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('deprec'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no_deprec', TRUE));
        } else {
            $data = array(
                'no_label' => $this->input->post('no_label',TRUE),
		        'year_procurement' => $this->input->post('year_procurement',TRUE),
                'economics_age' => $this->input->post('economics_age',TRUE),
                'acquisition_cost' => $this->input->post($this->Deprec_model->delete_rupiah('acquisition_cost'),TRUE),
                'dep_per_year' => $this->input->post('dep_per_year',TRUE),
                'remaining_age' => $this->input->post('remaining_age',TRUE),
	        );

            $this->Deprec_model->update($this->input->post('no_deprec', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('deprec'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Deprec_model->get_by_id($id);

        if ($row) {
            $this->Deprec_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('deprec'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('deprec'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('remaining_age', 'Sisa Umur', 'trim|required');
        $this->form_validation->set_rules('dep_per_year', 'Penyusutan Per Tahun', 'trim|required');
        $this->form_validation->set_rules('acquisition_cost', 'Harga Perolehan', 'trim|required');
        $this->form_validation->set_rules('economics_age', 'Umur Ekonomi', 'trim|required');
	    $this->form_validation->set_rules('year_procurement', 'Tahun Pengadaan', 'trim|required');
        $this->form_validation->set_rules('no_label', 'No Label', 'trim|required');
	    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function deprec_excel()
    {
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

        $objSheet->setCellValue('A1', 'DATA PENYUSUTAN');

        $cell  = 2;
        $objSheet->setCellValue('A'. $cell, 'No Penyusutan');
        $objSheet->setCellValue('B'. $cell, 'No Label');
        $objSheet->setCellValue('C'. $cell, 'Tahun Pengadaan');
        $objSheet->setCellValue('D'. $cell, 'Umur Ekonomi');
        $objSheet->setCellValue('E'. $cell, 'Harga Perolehan');
        $objSheet->setCellValue('F'. $cell, 'Penyusutan Per Tahun');
        $objSheet->setCellValue('G'. $cell, 'Sisa Umur');

        $objXLS->getActiveSheet()->getStyle('A' .  $cell . ':G' . $cell)->applyFromArray($font)->applyFromArray($borderStyle);

        $objXLS->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray)->applyFromArray($font);
        $objXLS->setActiveSheetIndex(0)->mergeCells('A1:G1');
 
        $cell++;
        $query = $this->db->query("SELECT * FROM depreciation")->result();
        $total = 0;
        $objXLS->getActiveSheet()->getStyle('A' .  $cell . ':G' . $cell)->applyFromArray($borderStyle);
        foreach ($query as $r) {
            $objSheet->setCellValueExplicit('A'.$cell, $r->no_deprec, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('A'.$cell, $r->no_label, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('B'.$cell, $r->year_procurement, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('C'.$cell, $r->economics_age, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('D'.$cell, $r->acquisition_cost, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('E'.$cell, $r->dep_per_year, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('F'.$cell, $r->remaining_age, PHPExcel_Cell_DataType::TYPE_STRING);
            $cell++;
            $no++;
        }

        $objXLS->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objXLS->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objXLS->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objXLS->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objXLS->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objXLS->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objXLS->getActiveSheet()->getColumnDimension('G')->setWidth(15);

        $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel2007');

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="LIST DATA PENYUSUTAN ' .date("d/m/y"). '.xlsx"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter->save('php://output'); 
        exit();     
    }

}

