<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cam extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $this->output->enable_profiler(TRUE); 
               
    }

    public function index(){

        $data['page_header_title'] = "Confirmation Chat";    
        $this->load->view('cam_initial', $data);
    }

   public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function video_cam(){
        $data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Session";
        $type_user = $this->session->userdata('type');

        if($type_user == "counselors"){
            $chat_room_name = $this->uri->segment(3);
            $data['roomName'] = $chat_room_name;
            $data['loginName'] = 'counselors';
        }
        else if($type_user == "students"){

            if($this->input->post('submit')){
            $student_id = $this->session->userdata('id');
            $student_no = $this->input->post('loginName');
            $chat_room_name = $this->generateRandomString();
            $arrayData = array('student_id'=>$student_id,'student_no' => $student_no,'video_chat_name'=>$chat_room_name);
            $ins = $this->k_model->insert_new_data($arrayData, 'video_chat');
            $data['roomName'] = $chat_room_name;
            $data['loginName'] = $student_no;
         }
        }

        
        
        $this->load->view('cam', $data, FALSE);
    }

    public function view_video_chat(){
       
        $data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Video Management";
        $crud = new grocery_CRUD;
        $crud->set_table('video_chat');
        $path = base_url();
        $crud->unset_read()
             ->unset_edit()
             ->unset_add()
             ->unset_print()
             ->unset_export();
        $crud->unset_columns('student_id');
        $crud->add_action('Photos', $path.'/assets/grocery_crud/themes/flexigrid/css/images/magnifier.png', '','',array($this,'chatroomName_and_loginName'));
        

        $output = $crud->render();
        $output->data = $data;
        $this->load->view('universal_page', $output);
    }
	
	function chatroomName_and_loginName($primary_key , $row)
    {
        
        return site_url('cam/video_cam').'/'.$row->video_chat_name;
    }
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */