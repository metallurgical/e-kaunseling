<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(TRUE); 
        @session_start();       
    }

	
	public function index()
	{
        @session_start();
        if( !isset( $_SESSION['chatusername'] )  || !isset( $_SESSION['username'] )  ){
            $_SESSION['chatusername'] = 'User 2';
            $_SESSION['username'] = '2';
        }

		$data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Management";
		$this->load->view('chat', $data, FALSE);
       
    }

    public function student_chat(){
        $data['page_header_title'] = "Live Chat";
        $this->load->view('chat', $data);
    }

    public function retrieve_data(){
        $student_id = $this->session->userdata('id');
        $where = array('student_id' => $student_id);
        $allData = $this->k_model->get_all_rows('chat',$where, false, false, false, false);
    }
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */