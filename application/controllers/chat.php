<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(TRUE); 
        @session_start();       
    }

	/*public function access_map(){
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
    }*/

	public function index()
	{
        @session_start();
        if( !isset( $_SESSION['chatusername'] )  || !isset( $_SESSION['username'] )  ){
            $_SESSION['chatusername'] = 'User 2';
            $_SESSION['username'] = '2';
        }

		$data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Management";
		//$this->grocery_crud->set_table('counselors');
		$this->load->view('chat', $data, FALSE);;
       
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */