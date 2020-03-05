<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('Template');
		$this->load->model('Kategori_model','kat');
	
	}

	public function index()
	{ 
		$data['title'] ='Home Portfolio';
		$this->template->backend('backend/halaman/boxes',$data);
		
	}

	public function kategori(){
		$data['title'] ='Kategori Dalam Website';
		$this->template->backend('backend/halaman/kategori',$data);
	}

	public function ambil_kategori(){
		$kategori = $this->kat->get_kategori();
		echo json_encode($kategori);
	}
	
	public function add_kategori(){

		if($this->input->post('nmk')== NULL){
		$result['pesanboss']="*Nama Kategori harus Disi";
		}else{
		$result['pesanboss']="";
		}
	
		echo json_encode($result);

		$this->kat->ketegori_add();

	}
	
	public function website(){
		
		
	}
}
