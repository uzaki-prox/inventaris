<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Room_complet extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Room_complet_model');
        $this->load->model('Room_model');
        $this->load->model('Serial_number');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
 
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Room_model->total_rows($q);
        $room_complet = $this->Room_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'room_complet_data' => $room_complet,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'qc_room/room_complet_list',
            'judul' => 'Poin Kelengkapan Per Ruangan',
        );
        $this->load->view('v_index', $data);
    }

    public function list_poin($id)
    {
        $config['total_rows'] = $this->Room_complet_model->total_rows($id);
        $poin_complet = $this->Room_complet_model->list_poin($id);

        $data = array(
            'button' => 'Add',
            'action' => site_url('room_complet/create'),
            'poin_complet_data' => $poin_complet,
            'total_rows' => $config['total_rows'],
            'qc_rcomplet' => $this->Serial_number->make_qc_rcomplet(),
            'room' => $id,
            'instrument' => set_value('instrument'),
            'konten' => 'qc_room/poin_complet_list',
            'judul' => 'List Poin Kelengkapan',
        );
        $this->load->view('v_index', $data);
    }

/*     public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('room_complet/create_action'),
	        'qc_rcomplet' => $this->Serial_number->make_qc_rcomplet(),
            'room' => set_value('room'),
            'instrument' => set_value('instrument'),
            'konten' => 'qc_room/room_complet_form',
            'judul' => 'Poin Kelengkapan Per Ruangan',
	    );
        $this->load->view('v_index', $data);
    } */
    
    public function create() 
    {
        $this->_rules();
        $room = $this->input->post('room');

        if ($this->form_validation->run() == FALSE) {
            redirect(site_url('room_complet/list_poin/'.$room));
        } else {
            $data = array(
                'qc_rcomplet' => $this->input->post('qc_rcomplet',TRUE),
                'room' => $room,
                'instrument' => $this->input->post('instrument',TRUE),
	        );

            $this->Room_complet_model->insert($data);
            $this->session->set_flashdata('message', 'Adding Record Success');
            redirect(site_url('room_complet/list_poin/'.$room));
        }
    }
    
/*     public function update($id)
    {
        $row = $this->Room_complet_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('room_complet/update_action'),
		        'qc_rcomplet' => set_value('qc_rcomplet', $row->qc_rcomplet),
                'room' => set_value('room', $row->room),
                'instrument' => set_value('instrument', $row->instrument),
                'konten' => 'qc_room/room_complet_form',
                'judul' => 'Poin Kelengkapan Per Ruangan',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('room_complet'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('qc_rcomplet', TRUE));
        } else {
            $data = array(
                'room' => $this->input->post('room',TRUE),
                'instrument' => $this->input->post('instrument',TRUE),
	        );

            $this->Room_complet_model->update($this->input->post('qc_rcomplet', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('room_complet'));
        }
    } */
    
    public function delete($id) 
    {
        $row = $this->Room_complet_model->get_by_id($id);

        if ($row) {
            $this->Room_complet_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('room_complet/list_poin/'.$row->room));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('room_complet/list_poin/'.$row->room));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('room', 'Ruangan', 'trim|required');
        $this->form_validation->set_rules('instrument', 'Poin Kelengkapan', 'trim|required');
	    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function room_complet_excel()
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

        $objSheet->setCellValue('A1', 'DATA POIN KELENGKAPAN PER RUANGAN');

        $cell  = 2;
        $objSheet->setCellValue('A'. $cell, 'Kode');
        $objSheet->setCellValue('B'. $cell, 'Ruangan');
        $objSheet->setCellValue('C'. $cell, 'Poin Kelengkapan');

        $objXLS->getActiveSheet()->getStyle('A' .  $cell . ':C' . $cell)->applyFromArray($font)->applyFromArray($borderStyle);

        $objXLS->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleArray)->applyFromArray($font);
        $objXLS->setActiveSheetIndex(0)->mergeCells('A1:C1');

        $cell++;
        $query = $this->db->query("SELECT * FROM room_complet")->result();
        $space = " . ";
        $total = 0;
        $objXLS->getActiveSheet()->getStyle('A' .  $cell . ':C' . $cell)->applyFromArray($borderStyle);
        foreach ($query as $r) {
            $objSheet->setCellValueExplicit('A'.$cell, $r->qc_rcomplet, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('B'.$cell, $r->room, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('C'.$cell, $r->instrument, PHPExcel_Cell_DataType::TYPE_STRING);
            $cell++;
            $no++;
        }

        $objXLS->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objXLS->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objXLS->getActiveSheet()->getColumnDimension('C')->setWidth(15);

        $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel2007');

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="LIST DATA POIN KELENGKAPAN PER RUANGAN ' .date("d/m/y"). '.xlsx"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter->save('php://output'); 
        exit();     
    }
}
