<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	public function get_kategori()
	{
		return $this->db->get('tbl_kategori')->result();
		
    }
    public function ketegori_add(){
        $this->db->set('kategori_nama', $this->input->post('nmk'));
        $this->db->insert('tbl_kategori');
    }

	

}
