<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Label extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Label_model');
        $this->load->model('Serial_number');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'label/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'label/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'label/index.html';
            $config['first_url'] = base_url() . 'label/index.html';
        }
 
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Label_model->total_rows($q);
        $label = $this->Label_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'label_data' => $label,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'label/label_list',
            'judul' => 'Data Labelisasi',
        );
        $this->load->view('v_index', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('label/create_action'),
	        'no_label' => $this->Serial_number->make_no_label(),
	        'unit' => set_value('unit'),
            'cluster' => set_value('cluster'),
            'type' => set_value('type'),
            'object' => set_value('object'),
            'serial_number' => set_value('serial_number'),
            'year' => set_value('year'),
            'source' => set_value('source'),
            'room' => set_value('room'),
            'konten' => 'label/label_form',
            'judul' => 'Data Labelisasi',
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
                'no_label' => $this->Serial_number->make_no_label(),
		        'unit' => $this->input->post('unit',TRUE),
                'cluster' => $this->input->post('cluster',TRUE),
                'type' => $this->input->post('type',TRUE),
                'object' => $this->input->post('object',TRUE),
                'serial_number' => $this->input->post('serial_number',TRUE),
                'year' => $this->input->post('year',TRUE),
                'source' => $this->input->post('source',TRUE),
                'room' => $this->input->post('room',TRUE),
	        );

            $this->Label_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('label'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Label_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('label/update_action'),
		        'no_label' => set_value('no_label', $row->no_label),
		        'unit' => set_value('unit', $row->unit),
                'cluster' => set_value('cluster', $row->cluster),
                'type' => set_value('type', $row->type),
                'object' => set_value('object', $row->object),
                'serial_number' => set_value('serial_number', $row->serial_number),
                'year' => set_value('year', $row->year),
                'source' => set_value('source', $row->source),
                'room' => set_value('room', $row->room),
                'konten' => 'label/label_form',
                'judul' => 'Data Labelisasi',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('label'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no_label', TRUE));
        } else {
            $data = array(
		        'unit' => $this->input->post('unit',TRUE),
                'cluster' => $this->input->post('cluster',TRUE),
                'type' => $this->input->post('type',TRUE),
                'object' => $this->input->post('object',TRUE),
                'serial_number' => $this->input->post('serial_number',TRUE),
                'year' => $this->input->post('year',TRUE),
                'source' => $this->input->post('source',TRUE),
                'room' => $this->input->post('room',TRUE),
	        );

            $this->Label_model->update($this->input->post('no_label', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('label'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Label_model->get_by_id($id);

        if ($row) {
            $this->Label_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('label'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('label'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('room', 'Ruangan', 'trim|required');
        $this->form_validation->set_rules('source', 'Sumber Dana', 'trim|required');
        $this->form_validation->set_rules('year', 'Tahun Pengadaan', 'trim|required');
        $this->form_validation->set_rules('serial_number', 'No Urut', 'trim|required');
        $this->form_validation->set_rules('Object', 'Objek', 'trim|required');
        $this->form_validation->set_rules('type', 'Jenis', 'trim|required');
        $this->form_validation->set_rules('cluster', 'Kelompok', 'trim|required');
	    $this->form_validation->set_rules('unit', 'Unit', 'trim|required');
	    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function label_excel()
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

        $objSheet->setCellValue('A1', 'DATA LABELISASI');

        $cell  = 2;
        $objSheet->setCellValue('A'. $cell, 'No Label');
        $objSheet->setCellValue('B'. $cell, 'Kode Barang');
        $objSheet->setCellValue('C'. $cell, 'No Urut');
        $objSheet->setCellValue('D'. $cell, 'Tahun Pengadaan');
        $objSheet->setCellValue('E'. $cell, 'Sumber Dana');
        $objSheet->setCellValue('F'. $cell, 'Ruangan');

        $objXLS->getActiveSheet()->getStyle('A' .  $cell . ':F' . $cell)->applyFromArray($font)->applyFromArray($borderStyle);

        $objXLS->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray)->applyFromArray($font);
        $objXLS->setActiveSheetIndex(0)->mergeCells('A1:F1');

        $cell++;
        $query = $this->db->query("SELECT * FROM label")->result();
        $space = " . ";
        $total = 0;
        $objXLS->getActiveSheet()->getStyle('A' .  $cell . ':F' . $cell)->applyFromArray($borderStyle);
        foreach ($query as $r) {
            $objSheet->setCellValueExplicit('A'.$cell, $r->no_label, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('B'.$cell, $r->unit .$space. $r->cluster .$space. $r->type .$space. $r->object, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('C'.$cell, $r->serial_number, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('D'.$cell, $r->year, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('E'.$cell, $r->source, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('F'.$cell, $r->room, PHPExcel_Cell_DataType::TYPE_STRING);
            $cell++;
            $no++;
        }

        $objXLS->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objXLS->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objXLS->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objXLS->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objXLS->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objXLS->getActiveSheet()->getColumnDimension('F')->setWidth(15);

        $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel2007');

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="LIST DATA LABEL ' .date("d/m/y"). '.xlsx"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter->save('php://output'); 
        exit();     
    }

    public function label_word($id)
    {
        $data = $this->Label_model->get_by_id($id);
        $name = $this->Label_model->get_room($data->room)->name_room;
        $PHPWord = new PHPWord(); // New Word Document
        $document = $PHPWord->createSection(); // New portrait section

        echo $data->unit;
        echo $data->cluster;
        // Add text elements
        $document = $PHPWord->loadTemplate('assets/doc/Sticker.docx');
        $document->setValue('un', $data->unit);
        $document->setValue('cl', $data->cluster);
        $document->setValue('ty', $data->type);
        $document->setValue('ob', $data->object);
        $document->setValue('sn', $data->serial_number);
        $document->setValue('name', $name);
        $document->setValue('year', $data->year);
        $document->setValue('source', $data->source);
        
        $document->save('LABEL.docx');
        redirect(site_url('label'));
        // Save File / Download (Download dialog, prompt user to save or simply open it)
        //$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');

        //header('Content-Type: application/vnd.ms-word'); //mime type
        //header('Content-Disposition: attachment;filename="LABEL.docx"'); //tell browser what's the file name
        //header('Cache-Control: max-age=0'); //no cache
        //$document->save('php://output');
        exit();
    }
}

