<?php
class Template{
    protected $_ci;
    
    public function __construct(){
        $this->_ci = &get_instance(); 
    }
    
  
    public function backend($content, $data = NULL){
        $data['header'] = $this->_ci->load->view('backend/template/header',$data, TRUE);
        $data['content'] = $this->_ci->load->view($content, $data, TRUE);
        $data['footer'] = $this->_ci->load->view('backend/template/footer',$data, TRUE);

        $this->_ci->load->view('backend/template/index',$data);
    }

 
}