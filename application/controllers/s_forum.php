<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class S_forum extends CI_Controller {

	
	public function access_map(){
        return array(
			'index'      =>	'view',
			'view_categories' => 'view',
			'view_topics'    => 'view',
			'topics'     => 'view',
			'update'     =>	'edit'
        );
    }

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
    }

	
    public function view_categories(){
    	
		$crud  = new grocery_CRUD();
		$state = $crud->getState();

		$data['page_header_title'] = "Forum Module";

		$crud->set_table('forum_categories');
		$crud->unset_delete()
			 ->unset_edit()
			 ->unset_export()
			 ->unset_print()
			 ->unset_add()
			 ->unset_read();		
		$crud->add_action('View Topics', '../assets/grocery_crud/themes/flexigrid/css/images/magnifier.png', 's_forum/view_topics');
		$output = $crud->render();
		$output->data = $data;
		$this->load->view('view_categories', $output);		
		
    }

    public function view_topics(){

		$crud  = new grocery_CRUD();
		$state = $crud->getState();

    	$category_id = $this->uri->segment(3);
    	$where       = array( 
			 					'forum_category_id' => $category_id
			 				);
    	$data['category']   = $this->k_model->get_specified_row('forum_categories',$where,false,false,false);    	
		$data['page_header_title'] = "All Topics in ".$data['category']['forum_category_name'];

		$crud->set_table('forum_topics');
		$crud->unset_delete()
			 ->unset_edit()
			 ->unset_export()
			 ->unset_print()
			 ->unset_read();


		$crud->add_fields('forum_topic_title','Content','forum_topic_date_created','forum_topic_create_by','forum_category_id');
		$crud->callback_add_field('Content', function () {
		        	return '<textarea cols="10" rows="5" name="forum_answer_text"></textarea>';
		    	})
			 ->callback_add_field('forum_topic_date_created', function () {
		        	return '<input type="hidden" name="forum_topic_date_created" value="'.date('d/m/Y').'"/>'.date('d/m/Y');
		    	})
			 ->callback_add_field('forum_topic_create_by', function () {
		        	return '<input type="hidden" name="forum_topic_create_by" value="'.$this->session->userdata('id').'" readonly/>'.$this->session->userdata('no');
		    	});
		$crud->change_field_type('forum_category_id','invisible');


		
	    $crud->callback_before_insert(array($this,'add_create_by_id'));
	    $crud->callback_after_insert(array($this, 'add_into_forum_answer'));


	    $crud->columns('forum_topic_title','forum_topic_date_created','forum_topic_post_no','forum_topic_create_by');
	    $crud->unset_columns('forum_topic_id','forum_category_id');
	    $crud->callback_column('forum_topic_create_by',array($this,'callback_display_create_by'));		
		/*$crud->add_action('View Topics', '../../assets/grocery_crud/themes/flexigrid/css/images/magnifier.png', 's_forum/view_topics');*/
		
		$output = $crud->render();
		$output->data = $data;
		$this->load->view('view_topics', $output);		
		
    }

    public function callback_display_create_by($value, $row){
    	$where       = array( 
			 					'student_id' => $value
			 				);
	    $student = $this->k_model->get_specified_row('students',$where,false,false,false);
		return $student['student_no'];
    }

    public function add_create_by_id($post_array) {
	  $category_id = $this->uri->segment(3);
	  $post_array['forum_category_id'] = $category_id;	 
	  return $post_array;
	}    

	public function add_into_forum_answer($post_array,$primary_key){
		$category_id = $this->uri->segment(3);
	    $arrayData = array(
	        "forum_topic_id" => $primary_key,
	        "forum_category_id" => $category_id,
	        "forum_answer_from" => $post_array['forum_topic_create_by'],
	        "forum_answer_text" => $post_array['forum_answer_text'],
	        "forum_answer_date" => date('Y/m/d')
	    );
	 
	    $this->k_model->insert_new_data($arrayData,'forum_answers');	 
	    return true;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */