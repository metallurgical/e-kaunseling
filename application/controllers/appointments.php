<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointments extends CI_Controller {

	
	public function access_map(){
        return array(
			'index'      =>	'view',
			'categories' => 'view',
			'answers'    => 'view',
			'topics'     => 'view',
			'update'     =>	'edit'
        );
    }

    public function __construct()
    {
        parent::__construct();
        
    }

    public function student_appointments(){

    	$crud = new grocery_CRUD();
        $state = $crud->getState();
		$data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Management";
		$crud->set_table('appointments');
		$crud->unset_columns('student_id','appointment_reply'); // never displayed this column in list

		$crud->add_fields('appointment_date','appointment_time','appointment_message','student_id');
		$crud->edit_fields('appointment_date','appointment_time','appointment_message');

		$crud->callback_column('appointment_status',array($this,'callback_display_status'));	// change value displayed in list
		$crud->callback_read_field('appointment_status',array($this,'callback_display_status')) // on view/read part
			 ->callback_read_field('appointment_reply',array($this,'callback_display_reply'));  // on view/read part
		$crud->unset_read_fields('student_id');
		$crud->callback_before_insert(array($this,'callback_add_student_data')); 
		$crud->change_field_type('student_id','invisible');



		$output = $crud->render();
		$output->data = $data;
		$this->load->view('student_appointments', $output);
    }

    public function callback_add_student_data($post_array) {
	  
      	$student_id = $this->session->userdata('id');	  
	  	$post_array['student_id'] = $student_id;
	  	return $post_array;
	} 

	public function callback_display_reply($value, $row){

		if($value == ""){
			$reply = "No message from counselor yet";
		}
		else{
			$reply = $value;
		}

		return $reply;		
	}
	

    public function callback_display_status($value, $row){
    	
	    if($value == 0){
	    	$status = '<font color="orange">In Progress</font>';
	    }
	    else if($value == 1){
	    	$status = '<font color="green">Approved</font> <br /><br />
	    	<input type="button" value="Chat With Counselor"/> <br /><br />
	    	<input type="button" value="Video Chat With Counselor"/> ';
	    }
	    elseif($value == 2){
	    	$status = '<font color="red">Rejected</font>';
	    }
	    else if($value == 3){
	    	$status = '<font color="brown">Passed</font>';
	    }
		return $status;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */