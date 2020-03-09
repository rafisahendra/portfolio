<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('Template');
		$this->load->model('Kategori_model','kat');
		$this->load->model('Website_model','webs');
	
	}

	public function index()
	{ 
		$data['title'] ='Home Portfolio';
		$this->template->backend('backend/halaman/box',$data);
		
	}




	// ===================== Input Menggunakan Ajax ====================================
	public function kategori(){
		$data['title'] ='Kategori';
		$this->template->backend('backend/halaman/kategori',$data);
	}


	//Ambil data dari databae untuk di looping 
	public function ambil_kategori(){
		$kategori = $this->kat->get_kategori();
		echo json_encode($kategori);
	}

	public function ambil_website(){
		$website = $this->webs->get_website();
		echo json_encode($website);
	}


	
	public function add_kategori(){

	// 	if($this->input->post('nmk')== NULL){
	// 	$result['pesanboss']="*Nama Kategori harus Disi";
	// 	}else{
	// 	$result['pesanboss']="";
	// }
	// echo json_encode($result);
		$post = $this->input->post();
		$result = array();
		foreach($post['nama_kategori'] AS $key => $val)
		{
		$result[] = array(
		"kategori_nama" => $post['nama_kategori'][$key],
		// "N2" => $post['N2'][$key],
		// "N3" => $post['N3'][$key]
		);
		}
		$tersimpan = $this->kat->ketegori_add($result); //Jika tidak ada data yang kosong Maka lakukan proses penyimpanan
		echo json_encode($tersimpan);
	}
	
	public function edd_kategori(){
		$kategoriById = $this->kat->get_kategoriById();
		echo json_encode($kategoriById);

	}

	public function upd_kategori(){

		if($this->input->post('nmk')== NULL){
			$result['pesanboss']="*Nama Kategori harus Disi";
			}else{
			$result['pesanboss']="";
			}
		
			echo json_encode($result);

			$this->kat->ketegori_upd();
	}

	public function kategori_del(){

			$result =$this->kat->del_kategori();
			echo json_encode($result);
	}

	public function website_del(){
		if(!empty($this->input->post('gambar'))) {  
	
		$gambar_name= $this->input->post('gambar');
		$gambar = './upload/images/'.$gambar_name ;
		$untuk_hapus = unlink($gambar); 
		}  
		
		$result = $this->webs->del_website();
		echo json_encode($result);
	}

	// ===================== Input Menggunakan Ajax ========================================

	// ===================== Input Menggunakan Ajax Web ====================================
	public function website(){
		$data['title'] ='Website';
		$this->template->backend('backend/halaman/website',$data);
	}


	public function do_upload_delete_tmp(){

		if(!empty($this->input->post('path'))) {  
			$path_name = $this->input->post('path');
			$path = './upload/images/'.$path_name ;
			$result = unlink($path); 
			echo json_encode($result);
		}  

 
	}

	public function do_upload_add_img(){
		

		$config['upload_path']="./upload/images"; //path folder file upload
		$config['allowed_types']='gif|jpg|png|jpeg'; //type file yang boleh di upload
		$config['encrypt_name'] = TRUE; //enkripsi file name upload

		$this->load->library('upload',$config); //call library upload 
			if($this->upload->do_upload("website_gambar")){ //upload file
		$data  = array('website_gambar' => $this->upload->data()); //ambil file name yang diupload
		$image = $data['website_gambar']['file_name']; 
			
		}
		if(@$image  != NULL){
		$lokasi = $config['upload_path']= "./upload/images";
		$path = base_url('/upload/images/'.$image) ;
		// $result['im']= $image;
		// echo json_encode($result);
				if($lokasi)
			{
				echo '
				
				<div class="row" align="center">
				<div class="col-md-2"></div>
					<div class="col-md-8">
						<img src="'.$path.'" class="img-responsive" width="100%" />
						<button type="button"  id="remove_button" class="btn btn-sm"> <b style="color:#ff2b2b;"> X </b></button>
						<label>Enkripsi Nama Foto</label>
						<input type"hidden" readonly class="form-control" id="path_name" name="path_name"  value="'.$image.'" >
					</div>
				</div>
				';
			}
		}
	    // $config['upload_path']="./upload/images"; //path folder file upload
        // $config['allowed_types']='gif|jpg|png|jpeg'; //type file yang boleh di upload
		// $config['encrypt_name'] = TRUE; //enkripsi file name upload
		
		// $this->load->library('upload',$config); //call library upload 
		// if($this->upload->do_upload("website_gambar")){ //upload file
		// 	$data  = array('website_gambar' => $this->upload->data()); //ambil file name yang diupload
		// 	$image = $data['website_gambar']['file_name']; 
			
		
		//     $result= $this->webs->simpan_upload($image); //kirim value ke model Website_model
		//     echo json_decode($result);
		// }
		}

	public function add_website(){
		
            $result= $this->webs->simpan_upload(); //kirim value ke model Website_model
            echo json_decode($result);
        
	}

}
