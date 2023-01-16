<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Serial_number extends CI_Model
{

    function make_id_clean()
    {
        $this->db->select('RIGHT(clean_instrument.id_clean,3) as id', FALSE);
        $this->db->order_by('id_clean','DESC');
        $this->db->limit(1);
        $query = $this->db->get('clean_instrument');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $id_full = "ICL".$id_max;
        return $id_full;
    }

    function make_id_complet()
    {
        $this->db->select('RIGHT(complet_instrument.id_complet,3) as id', FALSE);
        $this->db->order_by('id_complet','DESC');
        $this->db->limit(1);
        $query = $this->db->get('complet_instrument');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $id_full = "ICM".$id_max;
        return $id_full;
    }

    function make_id_room()
    {
        $this->db->select('RIGHT(room.id_room,3) as id', FALSE);
        $this->db->order_by('id_room','DESC');
        $this->db->limit(1);
        $query = $this->db->get('room');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $id_full = "R".$id_max;
        return $id_full;
    }

    function make_no_label()
    {
        $this->db->select('RIGHT(label.no_label,5) as id', FALSE);
        $this->db->order_by('no_label','DESC');
        $this->db->limit(1);
        $query = $this->db->get('label');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $id_full = "NL".$id_max;
        return $id_full;
    }

    function make_id_kind()
    {
        $this->db->select('RIGHT(room_kind.id_kind,2) as id', FALSE);
        $this->db->order_by('id_kind','DESC');
        $this->db->limit(1);
        $query = $this->db->get('room_kind');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $id_full = "RK".$id_max;
        return $id_full;
    }

    function make_id_asset()
    {
        $this->db->select('RIGHT(asset.id_asset,2) as id', FALSE);
        $this->db->order_by('id_asset','DESC');
        $this->db->limit(1);
        $query = $this->db->get('asset');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $id_full = "A".$id_max;
        return $id_full;
    }

    function make_no_deprec()
    {
        $this->db->select('RIGHT(depreciation.no_deprec,2) as id', FALSE);
        $this->db->order_by('no_deprec','DESC');
        $this->db->limit(1);
        $query = $this->db->get('depreciation');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $id_full = "ND".$id_max;
        return $id_full;
    }

    function make_no_clean()
    {
        $this->db->select('RIGHT(qc_cleaning.no_clean,2) as id', FALSE);
        $this->db->order_by('no_clean','DESC');
        $this->db->limit(1);
        $query = $this->db->get('qc_cleaning');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $id_full = "QCL".$id_max;
        return $id_full;
    }

    function make_no_complet()
    {
        $this->db->select('RIGHT(qc_completness.no_complet,2) as id', FALSE);
        $this->db->order_by('no_complet','DESC');
        $this->db->limit(1);
        $query = $this->db->get('qc_cleaning');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $id_full = "QCM".$id_max;
        return $id_full;
    }
    
    function make_no_infrastructure()
    {
        $this->db->select('RIGHT(qc_infrastructure.no_infra,2) as id', FALSE);
        $this->db->order_by('no_infra','DESC');
        $this->db->limit(1);
        $query = $this->db->get('qc_infrastructure');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $id_full = "QIF".$id_max;
        return $id_full;
    }

    function make_qc_rclean()
    {
        $this->db->select('RIGHT(qc_room_clean.qc_rclean,2) as id', FALSE);
        $this->db->order_by('qc_rclean','DESC');
        $this->db->limit(1);
        $query = $this->db->get('qc_room_clean');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $id_full = "QRL".$id_max;
        return $id_full;
    }

    function make_qc_rcomplet()
    {
        $this->db->select('RIGHT(qc_room_complet.qc_rcomplet,2) as id', FALSE);
        $this->db->order_by('qc_rcomplet','DESC');
        $this->db->limit(1);
        $query = $this->db->get('qc_room_complet');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $id_full = "QRM".$id_max;
        return $id_full;
    }

    function make_qc_cleaning()
    {
        $this->db->select('RIGHT(qc_cleaning.no_clean,2) as id', FALSE);
        $this->db->order_by('no_clean','DESC');
        $this->db->limit(1);
        $query = $this->db->get('qc_cleaning');
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->id) + 1;
        }else{
            $kode = 1;
        }
        $id_max = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $id_full = "QCC".$id_max;
        return $id_full;
    }

}
