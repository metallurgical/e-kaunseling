<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(TRUE); 
        
    }

	public function index()
	{
		
		
		if($this->input->post('submit')){
			 
			 $formData = $this->input->post();

			 if($formData['category'] == "students"){
			 	$where             = array( 
			 								'student_no' => $formData['no'],
			 								'student_ic' => $formData['ic']
			 						      );            	
			 }
			 else{
			 	$where             = array( 
			 								'counselor_no' => $formData['no'],
			 								'counselor_ic' => $formData['ic']
			 						      );
			 }

			 $data['user']   = $this->k_model->get_specified_row($formData['category'],$where,false,false,false);		 

			 if(empty($data['user'])){
			 	$data['msg'] = "<span style='color:red'>Incorrect ic number or id number</span>";
			 }else{

			 	if($formData['category'] == "students"){
			 	     $newdata = array(
										'no'   => $data['user']['student_no'],
										'ic'   => $data['user']['student_ic'],
										'type' => 'students',
										'id'   => $data['user']['student_id']
				               		);
				    redirect('s_forum/view_forum');
				    $this->session->set_userdata($newdata);    	 	
			    }
			    else{
			 		$newdata = array(
										'no'   => $data['user']['counselor_no'],
										'ic'   => $data['user']['counselor_ic'],
										'type' => 'counselors',
										'id'   => $data['user']['counselor_id']
				               		); 
			 		redirect('c_forum');
			 		$this->session->set_userdata($newdata); 
			 	}
			 	

				
			 }
			 
			 
		}
		
		  if(empty($data)){
		  	     $this->load->view('login'); 
		  }
		  else{
		  	$this->load->view('login', $data);
		  }
		  

		
	}
}