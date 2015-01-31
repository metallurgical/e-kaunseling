<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {

	
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

	public function categories()
	{
		
		$crud = new grocery_CRUD();
        $state = $crud->getState();
		$data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Category Management";
		$crud->set_table('forum_categories');
		$crud->callback_after_delete(array($this,'callback_after_delete_categories'));
		$output = $crud->render();
		$output->data = $data;
		$this->load->view('universal_page', $output);
		
       
    }

    function callback_after_delete_categories($id){

        if($id)
        {
            $where = array(
                'forum_category_id' => $id
                );
            $this->k_model->delete_data("forum_topics", $where);           
            $this->k_model->delete_data("forum_answers", $where);

            return true;
        }
        else
        {
            return true;
        }

    }

    public function topics()
	{
		
		$data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Topics Management";
		$crud = new grocery_CRUD();        
		$crud->set_table('forum_topics');
		$crud->set_relation('forum_category_id','forum_categories','forum_category_name');
		$crud->set_relation('forum_topic_create_by','students','student_no');
		$crud->display_as('forum_category_id','Category')
			 ->display_as('forum_topic_create_by','Student No');
	    $crud->callback_after_delete(array($this,'callback_after_delete_topics'));
		$output = $crud->render();
		$output->data = $data;
		$state = $crud->getState();
		$this->load->view('universal_page', $output);
       
    }

    function callback_after_delete_topics($id){

        if($id)
        {
            $where = array(
                'forum_topic_id' => $id
                );
            $this->k_model->delete_data("forum_answers", $where);
            return true;
        }
        else
        {
            return true;
        }

    }

    public function answers()
	{
		
		$data['page_header_title'] = ucfirst($this->uri->segment(1)) . " Answers Management";
		$crud = new grocery_CRUD();        
		$crud->set_table('forum_answers');
		$crud->set_relation('forum_topic_id','forum_topics','forum_topic_title')
		     ->set_relation('forum_answer_from','students','student_no')
		     ->set_relation('forum_category_id','forum_categories','forum_category_name');
		$crud->display_as('forum_topic_id','From topic')
			 ->display_as('forum_answer_from','Student No')
			 ->display_as('forum_category_id','Category');
		$output = $crud->render();
		$output->data = $data;
		$state = $crud->getState();
		$this->load->view('universal_page', $output);
       
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */