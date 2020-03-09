<?php
class Website_model extends CI_Model{
 
    function simpan_upload(){
        $kategori_id        = $this->input->post('kategori_id'); 
        $website_nama       = $this->input->post('website_nama'); 
        $image              = $this->input->post('path_name'); 
        $tanggal_posting    = date('Y-m-d'); 
        $website_keterangan = $this->input->post('website_keterangan'); 

        $data = array(
                'kategori_id'         => $kategori_id,
                'website_nama'        => $website_nama,
                'website_gambar'      => $image,
                'tanggal_posting'     => $tanggal_posting,
                'website_keterangan'  => $website_keterangan
         );  

        return $this->db->insert('tbl_website',$data);
         
    }

    public function get_pinjaman($id_pinjaman){
        $this->db->select('p.*,  a.nama_lengkap');
        $this->db->from('peminjaman p');
        $this->db->join('anggota a', 'p.id_anggota = a.id_anggota');
        $this->db->where('id_peminjaman ',$id_pinjaman );
        return $this->db->get('')->result();   
    } 

    function get_website(){
        $this->db->select('w.*,  k.kategori_nama');
        $this->db->from('tbl_website w');
        $this->db->join('tbl_kategori k','w.kategori_id = k.kategori_id');



        return $this->db->get('')->result();
    }

    function del_website(){

        $websiteId =$this->input->post('idw');
        return  $this->db->delete('tbl_website', array('website_id' => $websiteId));
    }
     
}