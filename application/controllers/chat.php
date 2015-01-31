<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(TRUE); 
        //@session_start();       
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
        $user_type = $this->session->userdata('type');
        $chat_parent_id = 1;

        if($user_type == "counselors"){
            $where = array('chat_parent_id' => $chat_parent_id);
        }else{
            $where = array('student_id' => $student_id);
        }        

        $allData = $this->k_model->get_all_rows('chat',$where, false, false, false, false);
        echo json_encode($allData);
    }

    public function send_data(){

        $user_type = $this->session->userdata('type');
        $student_id = $this->session->userdata('id'); 
        $msg = $this->input->post('msg');
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
                            'chat_message' => $msg

                            );

        $ins = $this->k_model->insert_new_data($arrayData,'chat');
           

    }

    public function counselor_list_chat(){

        $crud = new grocery_CRUD();
        $state = $crud->getState();
        $data['page_header_title'] = 'List '.ucfirst($this->uri->segment(1)) . " Management";
        $crud->set_table('chat_parent');

        $crud->unset_read()
             ->unset_edit()
             ->unset_add();
        $output = $crud->render();
        $output->data = $data;
        $this->load->view('universal_page', $output);
    }
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */