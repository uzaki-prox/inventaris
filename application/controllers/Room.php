<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Room extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Room_model');
        $this->load->model('Serial_number');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'room/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'room/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'room/index.html';
            $config['first_url'] = base_url() . 'room/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Room_model->total_rows($q);
        $room = $this->Room_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'room_data' => $room,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'room/room_list',
            'judul' => 'Data Ruangan',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Room_model->get_by_id($id);
        if ($row) {
            $data = array(
		        'id_room' => $row->id_room,
		        'name_room' => $row->name_room,
                'location' => $row->location,
		        'pic' => $row->pic,
		        'kind' => $row->kind,
	        );
            $this->load->view('room/room_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('room'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('room/create_action'),
	        'id_room' => $this->Serial_number->make_id_room(),
            'name_room' => set_value('name_room'),
            'location' => set_value('location'),
	        'pic' => set_value('pic'),
	        'kind' => set_value('kind'),
            'konten' => 'room/room_form',
            'judul' => 'Data Ruangan',
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
                'id_room' => $this->input->post('id_room',TRUE),
		        'name_room' => $this->input->post('name_room',TRUE),
                'location' => $this->input->post('location',TRUE),
		        'pic' => $this->input->post('pic',TRUE),
		        'kind' => $this->input->post('kind',TRUE),
	        );

            $this->Room_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('room'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Room_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('room/update_action'),
		        'id_room' => set_value('id_room', $row->id_room),
		        'name_room' => set_value('name_room', $row->name_room),
                'location' => set_value('location', $row->location),
		        'pic' => set_value('pic', $row->pic),
		        'kind' => set_value('kind', $row->kind),
                'konten' => 'room/room_form',
                'judul' => 'Data Ruangan',
	        );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('room'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_room', TRUE));
        } else {
            $data = array(
                'name_room' => $this->input->post('name_room',TRUE),
                'location' => $this->input->post('location',TRUE),
		        'pic' => $this->input->post('pic',TRUE),
		        'kind' => $this->input->post('kind',TRUE),
	        );

            $this->Room_model->update($this->input->post('id_room', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('room'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Room_model->get_by_id($id);

        if ($row) {
            $this->Room_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('room'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('room'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('name_room', 'Nama Ruangan', 'trim|required');
        $this->form_validation->set_rules('location', 'Lokasi', 'trim|required');
	$this->form_validation->set_rules('pic', 'PIC', 'trim|required');
	$this->form_validation->set_rules('kind', 'Jenis', 'trim|required');
	$this->form_validation->set_rules('id_room', 'ID Ruangan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function room_excel()
    {
        $data = $this->Room_model->get_all();
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

        $objSheet->setCellValue('A1', 'DATA RUANGAN');

        $cell  = 2;
        $objSheet->setCellValue('A'. $cell, 'ID Ruangan');
        $objSheet->setCellValue('B'. $cell, 'Nama Ruangan');
        $objSheet->setCellValue('C'. $cell, 'Lokasi');
        $objSheet->setCellValue('D'. $cell, 'PIC');
        $objSheet->setCellValue('E'. $cell, 'Jenis');

        $objXLS->getActiveSheet()->getStyle('A' .$cell. ':E' .$cell)->applyFromArray($font)->applyFromArray($borderStyle);

        $objXLS->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleArray)->applyFromArray($font);
        $objXLS->setActiveSheetIndex(0)->mergeCells('A1:E1');

        $cell++;
        $query = $this->db->query("SELECT * FROM room")->result();
        $total = 0;
        $objXLS->getActiveSheet()->getStyle('A' .  $cell . ':E' . $cell)->applyFromArray($borderStyle);
        foreach ($query as $r) {
            $objSheet->setCellValueExplicit('A'.$cell, $r->id_room, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('B'.$cell, $r->name_room, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('C'.$cell, $r->location, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('D'.$cell, $this->Room_model->get_user($r->pic)->name, PHPExcel_Cell_DataType::TYPE_STRING);
            $objSheet->setCellValueExplicit('E'.$cell, $this->Room_model->get_kind($r->kind)->name_kind, PHPExcel_Cell_DataType::TYPE_STRING);
            $cell++;
            $no++;
        }

        $objXLS->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objXLS->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objXLS->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objXLS->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objXLS->getActiveSheet()->getColumnDimension('E')->setWidth(15);

        $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel2007');

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="LIST RUANGAN ' . date("d/m/y") .'.xlsx"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter->save('php://output'); 
        exit();     
    }

}

