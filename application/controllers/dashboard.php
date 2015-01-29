<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	public function access_map(){
        return array(
            'index'=>'view',
            'update'=>'edit'
        );
    }

	public function index()
	{
		$this->load->view('dashboard');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */