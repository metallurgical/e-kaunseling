<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Students extends CI_Controller {

	
	public function access_map(){
        return array(
            'index'=>'view',
            'update'=>'edit'
        );
    }

    public function rendering_view($filename, $data){

    	$output = $this->grocery_crud->render();
    	if($data === "undefined" || $data === "null" || $data === ""){
    		//do nothing
    	}
    	else{
    		$output->data = $data;    	
    	}    	
    	    	    	
        $this->load->view('students', $output);
    }

	public function index()
	{
		$data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Management";
		$this->grocery_crud->set_table('students');
		$this->rendering_view('students', $data);
       
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */