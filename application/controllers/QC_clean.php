<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class QC_clean extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('QC_clean_model');
        $this->load->model('Room_model');
        $this->load->model('Room_clean_model');
        $this->load->model('Serial_number');
        $current_date = date('Y-m-d');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Room_model->total_rows($q);
        $room_clean = $this->Room_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'room_clean_data' => $room_clean,
            'q' => $q, 
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'qc_clean/qc_clean_list',
            'judul' => 'List Form Per Ruangan',
        );
        $this->load->view('v_index', $data);
    }

    public function save_list($id) 
    {
        $poin_clean = $this->QC_clean_model->list_instrument($id);
        $current_date = date('Y-m-d');
        
        foreach($poin_clean as $instrument_data){
            $data = array(
                'no_clean' => $this->Serial_number->make_qc_cleaning(),
                'date' => $current_date,
                'room' => $id,
                'instrument' => $instrument_data->instrument,
            );
            $this->QC_clean_model->insert($data);
        }
                                                                                  
        redirect(site_url('qc_clean/form_qc/' .$current_date));
    } 

    public function form_qc($id)
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Room_clean_model->total_rows($q);
        $list_date = $this->QC_clean_model->list_instrument($id, $config['per_page'], $start, $q);

        $data = array(
            'button' => 'Add',
            'action' => site_url('qc_clean/update'),
            'date' => $current_date,
            'room' => $id,
            'list_date_data' => $list_date,
            'konten' => 'qc_clean/qc_clean_form',
            'judul' => 'Form Quality Control Kebersihan',
        );

        $this->load->view('v_index', $data);
    }

/*     public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('qc_clean/create_action'),
	        'no_clean' => $this->Serial_number->make_no_clean(),
	        'date' => date('Y-m-d'),
            'room' => set_value('room'),
            'instrument' => set_value('instrument'),
            'clean' => set_value('clean'),
            'status' => set_value('status'),
            'descript' => set_value('descript'),
            'konten' => 'qc_clean/qc_clean_form',
            'judul' => 'Quality Control Kebersihan',
	    );
        $this->load->view('v_index', $data);
    } 
    
    public function create() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            redirect(site_url('qc_clean/form_qc/'.$this->input->post('room')));
        } else {
            $data = array(
                //'no_clean' => $this->input->post('no_clean',TRUE),
                'date' => $this->input->post('date',TRUE),
                'room' => $this->input->post('room', TRUE),
                'instrument' => $this->input->post('instrument',TRUE),
                'clean' => $this->input->post('clean', TRUE),
                'descript' => $this->input->post('descript', TRUE),
	        );

            $json_data['clean'] = json_decode($data);
            $this->QC_clean_model->insert($json_data);
            $this->session->set_flashdata('message', 'Adding Record Success');
            redirect(site_url('qc_clean'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->QC_clean_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('qc_clean/update_action'),
		        'no_clean' => set_value('no_clean', $row->no_clean),
		        'date' => set_value('date', $row->date),
                'room' => set_value('room', $row->room),
                'instrument' => set_value('instrument', $row->instrument),
                'clean' => set_value('clean', $row->clean),
                'status' => set_value('status', $row->status),
                'descript' => set_value('descript', $row->descript),
                'konten' => 'qc_clean/qc_clean_form',
                'judul' => 'Quality Control Kebersihan',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('qc_clean'));
        }
    }
    */
    public function update() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no_clean', TRUE));
        } else {
            $data = array(
		        'date' => $current_date,
                'room' => $this->input->post('room',TRUE),
                'instrument' => $this->input->post('instrument',TRUE),
                'clean' => $this->input->post('clean',TRUE),
                'descript' => $this->input->post('descript',TRUE),
	        );

            $this->QC_clean_model->update($this->input->post('no_clean', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('qc_clean'));
        }
    }

    /* public function delete_temp($id) 
    {
        $row = $this->QC_clean_model->get_by_date($id);

        if ($row) {
            $this->QC_clean_model->delete_temp($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('qc_clean'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('qc_clean'));
        }
    } */
    
    public function delete($id) 
    {
        $row = $this->QC_clean_model->get_by_id($id);

        if ($row) {
            $this->QC_clean_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('qc_clean'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('qc_clean'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('descript', 'Tahun Pengadaan', 'trim|required');
        $this->form_validation->set_rules('clean', 'Objek', 'trim|required');
	    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function qc_clean_excel()
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

        $objSheet->setCellValue('A1', 'DATA QUALITY CONTROL KEBERSIHAN');

        $cell  = 2;
        $objSheet->setCellValue('A'. $cell, 'No ');
        $objSheet->setCellValue('B'. $cell, 'Ruangan');
        $objSheet->setCellValue('C'. $cell, 'Instrument');
        $objSheet->setCellValue('D'. $cell, 'Tahun Pengadaan');
        $objSheet->setCellValue('E'. $cell, 'Sumber Dana');
        $objSheet->setCellValue('F'. $cell, 'Ruangan');

        $objXLS->getActiveSheet()->getStyle('A' .  $cell . ':F' . $cell)->applyFromArray($font)->applyFromArray($borderStyle);

        $objXLS->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray)->applyFromArray($font);
        $objXLS->setActiveSheetIndex(0)->mergeCells('A1:F1');

        $cell++;
        $query = $this->db->query("SELECT * FROM qc_clean")->result();
        $space = " . ";
        $total = 0;
        $objXLS->getActiveSheet()->getStyle('A' .  $cell . ':F' . $cell)->applyFromArray($borderStyle);
        foreach ($query as $r) {
            $objSheet->setCellValueExplicit('A'.$cell, $r->no_clean, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('B'.$cell, $r->date .$space. $r->room .$space. $r->type .$space. $r->clean, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('C'.$cell, $r->status, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('D'.$cell, $r->descript, PHPExcel_Cell_DataType::TYPE_STRING);
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
        header('Content-Disposition: attachment;filename="LIST DATA qc_clean ' .date("d/m/y"). '.xlsx"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter->save('php://output'); 
        exit();     
    }

    public function qc_clean_word($id)
    {
        $data = $this->QC_clean_model->get_by_id($id);
        $name = $this->QC_clean_model->get_room($data->room)->name_room;
        $PHPWord = new PHPWord(); // New Word Document
        $document = $PHPWord->createSection(); // New portrait section

        echo $data->date;
        echo $data->room;
        // Add text elements
        $document = $PHPWord->loadTemplate('assets/doc/Sticker.docx');
        $document->setValue('un', $data->date);
        $document->setValue('cl', $data->room);
        $document->setValue('ty', $data->instrument);
        $document->setValue('ob', $data->clean);
        $document->setValue('sn', $data->status);
        $document->setValue('name', $name);
        $document->setValue('descript', $data->descript);
        $document->setValue('source', $data->source);
        
        $document->save('qc_clean.docx');
        redirect(site_url('qc_clean'));
        // Save File / Download (Download dialog, prompt user to save or simply open it)
        //$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');

        //header('Content-Type: application/vnd.ms-word'); //mime type
        //header('Content-Disposition: attachment;filename="LABEL.docx"'); //tell browser what's the file name
        //header('Cache-Control: max-age=0'); //no cache
        //$document->save('php://output');
        exit();
    }
}

