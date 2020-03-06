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

    public function get_kategoriById(){
        $kategoriId =$this->input->post('idk');
        return $this->db->get_where('tbl_kategori', array('kategori_id'=> $kategoriId))->result();
    }

    public function ketegori_upd(){

        $data = array(
        'kategori_nama' => $this->input->post('nmk')
        );

        $where = array( 'kategori_id' => $this->input->post('id'));

        $this->db->where($where);
        $this->db->update('tbl_kategori',$data);

        // $post = $this->input->post(); //CARA LAIN
        // $this->db->set('kategori_nama ', $post['nmk']);
        // $this->db->where('kategori_id', $post['id']);
        // $this->db->update('tbl_kategori');
    
    }

    public function del_kategori(){

        $kategoriId =$this->input->post('idk');
        $this->db->delete('tbl_kategori', array('kategori_id' => $kategoriId));
    }

	

}
