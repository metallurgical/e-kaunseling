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
        $this->output->enable_profiler(TRUE);
        
    }



    public function student_appointments(){

    	$crud = new grocery_CRUD();
        $state = $crud->getState();
		$data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Management";
		$crud->set_table('appointments');
		$crud->where('student_id',$this->session->userdata('id'));
		$crud->unset_columns('student_id','appointment_reply')
			 ->unset_read_fields('student_id'); // never displayed this column in list

		$crud->add_fields('appointment_date','appointment_time','appointment_message','student_id')
			 ->edit_fields('appointment_date','appointment_time','appointment_message');

		$crud->callback_column('appointment_status',array($this,'callback_display_status'))
			 ->callback_read_field('appointment_status',array($this,'callback_display_status')) // on view/read part
			 ->callback_read_field('appointment_reply',array($this,'callback_display_reply'))
			 ->callback_before_insert(array($this,'callback_add_student_data'));  // on view/read part
	
		$crud->change_field_type('student_id','invisible');



		$output = $crud->render();
		$output->data = $data;
		$this->load->view('universal_page', $output);
    }

    public function counselor_appointments(){
    	$crud = new grocery_CRUD();
        $state = $crud->getState();
        $path = base_url();
		$data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Management";
		$crud->set_table('appointments');
		$crud->unset_columns('appointment_reply')	// never displayed this column in list
			 ->unset_delete()
			 ->unset_add(); 
		 
		$crud->callback_column('student_id',array($this,'callback_display_student_no'))
			 ->callback_column('appointment_status',array($this,'callback_display_status'))
			 ->callback_read_field('student_id',array($this,'callback_display_student_no'))
			 ->callback_read_field('appointment_reply',array($this,'callback_display_reply'))
			 ->callback_read_field('appointment_status',array($this,'callback_display_status'))
			 ->callback_edit_field('appointment_status',array($this,'callback_edit_status'));	// change value displayed in list

	    $crud->edit_fields('appointment_reply','appointment_status');
	    

		$output = $crud->render();
		$output->data = $data;
		$this->load->view('universal_page', $output);
    }

    public function callback_edit_status($value, $primary_key){

    	$a = ($value == 0) ? 'selected' : '';
    	$b = ($value == 1) ? 'selected' : '';
    	$c = ($value == 2) ? 'selected' : '';
    	$d = ($value == 3) ? 'selected' : '';

    	$display = '<select name="appointment_status">
    					<option value="0" '.$a.'>In progress</option>
    					<option value="1" '.$b.'>Approved</option>
    					<option value="2" '.$c.'>Rejected</option>
    					<option value="3" '.$d.'>Passed</option>
    				</select>';
    	return $display;
	}

	

    public function callback_display_student_no($value, $row){
    	$where       = array( 
			 					'student_id' => $value
			 				);
	    $student = $this->k_model->get_specified_row('students',$where,false,false,false);
		return $student['student_no'];
    }

    public function callback_add_student_data($post_array) {
	  
      	$student_id = $this->session->userdata('id');	  
	  	$post_array['student_id'] = $student_id;
	  	return $post_array;
	} 

	public function callback_display_reply($value, $row){

		if($value == ""){
			$reply = "No message for this time";
		}
		else{
			$reply = $value;
		}

		return $reply;		
	}
	

    public function callback_display_status($value, $row){
    	
    if($this->session->userdata('type') == "counselors"){
    	if($value == 0){
	    	$status = '<font color="orange">In Progress</font>';
	    }
	    else if($value == 1){
	    	$status = '<font color="green">Approved</font> <br /><br />
	    	<input type="button" value="Chat With Student"/> <br /><br />
	    	<input type="button" value="Video Chat With Student"/> ';
	    }
	    elseif($value == 2){
	    	$status = '<font color="red">Rejected</font>';
	    }
	    else if($value == 3){
	    	$status = '<font color="brown">Passed</font>';
	    }

    }else{

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
    }
	    
		return $status;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */