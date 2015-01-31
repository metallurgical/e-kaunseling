<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Counselors extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(TRUE);        
    }

	public function access_map(){
        return array(
            'index'=>'view',
            'update'=>'edit'
        );
    }

    

	public function index()
	{
        $crud = new grocery_CRUD();
        $state = $crud->getState();
        $data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Management";
		$crud->set_table('counselors');
        $output = $crud->render();
        $output->data = $data;
        $this->load->view('universal_page', $output);
       
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */