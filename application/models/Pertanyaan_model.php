<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan_model extends CI_Model 
{
	public function getPertanyaan() {

		$sql = "SELECT p.id AS id, p.pertanyaan AS pertanyaan, k.kategori AS kategori FROM tbl_pertanyaan p, tbl_kategori k WHERE k.id=p.id_kategori";
		$query = $this->db->query($sql);
        return $query->result_array();

	}
	public function deletePertanyaan ($id){

		$this->db->where('id', $id);
		$this->db->delete('tbl_pertanyaan');
	}

	public function editPertanyaan ($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('tbl_pertanyaan', $data);
	}

	public function insertData($data, $table)
	{
		$this->db->insert($table, $data);
	}
}
