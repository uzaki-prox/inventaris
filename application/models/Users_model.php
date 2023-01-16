<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public $table = 'users';
    public $id = 'niy';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('niy', $q);
	    $this->db->or_like('name', $q);
	    $this->db->or_like('place_birth', $q);
        $this->db->or_like('date_birth', $q);
        $this->db->or_like('address', $q);
	    $this->db->or_like('password', $q);
	    $this->db->or_like('id_role', $q);
	    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('niy', $q);
	    $this->db->or_like('name', $q);
	    $this->db->or_like('place_birth', $q);
        $this->db->or_like('date_birth', $q);
        $this->db->or_like('address', $q);
	    $this->db->or_like('password', $q);
	    $this->db->or_like('id_role', $q);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // change password
    function change_password($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    public function get_role($id) {
        $this->db->where('id_role', $id);
        $row = $this->db->get('role')->row(0);
        return $row;
    }

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-14 04:12:27 */
/* http://harviacode.com */