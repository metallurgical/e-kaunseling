<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cam extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        //$this->output->enable_profiler(TRUE); 
        //@session_start();       
    }

public function index(){

    $data['page_header_title'] = "Login name";    
    $this->load->view('cam_initial', $data);
}

    public function video_cam(){
        $data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Session";

        if($this->input->post('submit')){
            $data['roomName'] = "TestingJah";
            $data['loginName'] = $this->input->post('loginName');
        }
        
        $this->load->view('cam', $data, FALSE);
    }

	
	/*public function index()
	{
        @session_start();
        if( !isset( $_SESSION['chatusername'] )  || !isset( $_SESSION['username'] )  ){
            $_SESSION['chatusername'] = 'User 2';
            $_SESSION['username'] = '2';
        }

		$data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Management";
		$this->load->view('chat', $data, FALSE);
       
    }*/

    /*public function manage_session(){

        $student_id = $this->session->userdata('id');
        $data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Session";

        if($this->input->post('submit')){

            $arrayData = array(
                                'student_id' => $this->session->userdata('id'),
                                'chat_parent_date' => date('Y-m-d'),
                                'chat_parent_time' => date('h:i:s')
                                );
            $ins = $this->k_model->insert_new_data($arrayData,'chat_parent');
            $where = array('student_id' => $student_id);
            $order_by = array('chat_parent_id','desc');
            $sel = $this->k_model->get_specified_row('chat_parent',$where,$order_by,false, false);
            
            redirect('chat/student_chat/'.$sel['chat_parent_id']);
        }
        $this->load->view('manage_session', $data, FALSE);
    }

    public function student_chat(){
        $user_type = $this->session->userdata('type');

        //if($user_type == "students"){
            $data['chat_parent_id'] = $this->uri->segment(3);
        //}
        //
        if($user_type == "students"){
            $data['student_id'] = $this->session->userdata('id');
        }
        else{
            $where = array('chat_parent_id' => $data['chat_parent_id']);
            $sel = $this->k_model->get_specified_row('chat_parent',$where,false,false, false);
            $data['student_id'] = $sel['student_id'];
        }

        $data['page_header_title'] = "Live Chat";
        $this->load->view('chat', $data);
    }

    public function retrieve_data(){
        $student_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('type');
        $chat_parent_id = $this->input->post('chat_parent_id');

        if($user_type == "counselors"){
            $where = array('chat_parent_id' => $chat_parent_id);
        }else{
            $where = array('student_id' => $student_id, 'chat_parent_id' => $chat_parent_id);
        }        

        $allData = $this->k_model->get_all_rows('chat',$where, false, false, false, false);
        echo json_encode($allData);
    }

    public function send_data(){

        $user_type = $this->session->userdata('type');
        $student_id = $this->input->post('student_id'); 
        $msg = $this->input->post('msg');
        $chat_parent_id = $this->input->post('chat_parent_id');
        $chat_from = "";

        if($user_type == "counselors"){

            $chat_from = 0;
        }
        else{

            $chat_from = $student_id;
        }

        $arrayData = array(
                            'student_id' => $student_id,
                            'chat_from' => $chat_from,
                            'chat_to' => 'counselor',
                            'chat_message' => $msg,
                            'chat_parent_id' => $chat_parent_id

                            );

        $ins = $this->k_model->insert_new_data($arrayData,'chat');
           

    }

    public function counselor_list_chat(){

        $crud = new grocery_CRUD();
        $state = $crud->getState();
        $data['page_header_title'] = 'List '.ucfirst($this->uri->segment(1)) . " Management";
        $path = base_url();
        $crud->set_table('chat_parent');

        $crud->unset_read()
             ->unset_edit()
             ->unset_add()
             ->unset_print()
             ->unset_export();

        $crud->add_action('View Chat', $path.'/assets/grocery_crud/themes/flexigrid/css/images/magnifier.png', 'chat/student_chat');

        $output = $crud->render();
        $output->data = $data;
        $this->load->view('universal_page', $output);
    }*/
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */