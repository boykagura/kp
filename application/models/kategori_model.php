<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model 
{
	public function getKategori() {

		$query = $this->db->get('tbl_kategori');
        return $query->result_array();

	}
	public function deleteKategori ($id){

		$this->db->where('id', $id);
		$this->db->delete('tbl_kategori');
	}
	public function insertKategori($data, $table)
	{
		$this->db->insert($table, $data);
	}
	public function editKategori ($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('tbl_kategori', $data);
	}
}
