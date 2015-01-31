<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class S_forum extends CI_Controller {

	
	public function access_map(){
        return array(
			'index'      =>	'view',
			'view_categories' => 'view',
			'view_topics'    => 'view',
			'view_answers'     => 'view',
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
		$path = base_url();

		$data['page_header_title'] = "Forum Module";

		$crud->set_table('forum_categories');
		$crud->unset_delete()
			 ->unset_edit()
			 ->unset_export()
			 ->unset_print()
			 ->unset_add()
			 ->unset_read();		
		$crud->add_action('View Topics', $path.'/assets/grocery_crud/themes/flexigrid/css/images/magnifier.png', 's_forum/view_topics');
		$output = $crud->render();
		$output->data = $data;
		$this->load->view('universal_page', $output);		
		
    }

    public function view_topics(){

		$crud  = new grocery_CRUD();
		$state = $crud->getState();
		$path = base_url();

    	$category_id = $this->uri->segment(3);
    	$where       = array( 
			 					'forum_category_id' => $category_id
			 				);
    	$data['category']   = $this->k_model->get_specified_row('forum_categories',$where,false,false,false);    	
		$data['page_header_title'] = "All Topics in ".$data['category']['forum_category_name'];
		$crud->where('forum_category_id',$category_id);
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
	    	 //->callback_column('forum_topic_post_no',array($this,'callback_display_posted_no'));		
		$crud->add_action('View Topics', $path.'/assets/grocery_crud/themes/flexigrid/css/images/magnifier.png', 's_forum/view_answers/'.$category_id);
		
		$output = $crud->render();
		$output->data = $data;
		$this->load->view('universal_page', $output);		
		
    }

   /* public function callback_display_posted_no($value, $row){

    	$where       = array( 
			 					'forum_topic_id' => $value
			 				);
	    $topic = $this->k_model->get_all_rows('forum_answers',$where,false,false,false,false);

		return count($topic);
    }*/

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

	public function add_topic_data($post_array) {
	  $topic_id = $this->uri->segment(4);
	  $category_id = $this->uri->segment(3);
      $student_id = $this->session->userdata('id');

	  $post_array['forum_category_id'] = $category_id;
	  $post_array['forum_topic_id'] = $topic_id;	 
	  $post_array['forum_answer_from'] = $student_id;
	  $post_array['forum_answer_date'] = date('Y-m-d');
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

	

	public function insert_count_topic_number($post_array,$primary_key){

		$topic_id = $this->uri->segment(4);
		$where       = array( 
			 					'forum_topic_id' => $topic_id
			 				);
	    $bil = $this->k_model->get_all_rows('forum_answers',$where,false,false,false);
		$usingCondition       = array( 
			 					'forum_topic_id' => $topic_id
			
			 				);
	    $tableToUpdate = "forum_topics";
		$columnToUpdate = array('forum_topic_post_no' => count($bil));
		$this->k_model->update_data($columnToUpdate, $tableToUpdate, $usingCondition);
		return true;
	}


	public function view_answers(){

		$crud  = new grocery_CRUD();
		$state = $crud->getState();
		$path = base_url();

    	$category_id = $this->uri->segment(3);
    	$topic_id = $this->uri->segment(4);
    	$student_id = $this->session->userdata('id');
    	
    	$where       = array( 
			 					'forum_topics.forum_topic_id' => $topic_id
			 				);
    	$tableNameToJoin = array('forum_categories'); 
    	$tableRelation = array('forum_topics.forum_category_id = forum_categories.forum_category_id'
                               );
    	$data['topics']   = $this->k_model->get_all_rows('forum_topics',$where, $tableNameToJoin, $tableRelation, false, false);   	
		$data['page_header_title'] = "All Discussion in ".$data['topics'][0]['forum_category_name'];

		
		$crud->where('forum_topic_id',$topic_id);
		$crud->set_table('forum_answers');
		$crud->unset_delete()
			 ->unset_edit()
			 ->unset_export()
			 ->unset_print()
			 ->unset_read();

		$crud->unset_columns('forum_topic_id','forum_category_id'); // never displayed this column in list
		$crud->display_as('forum_answer_from','Post by')			// set sefault value for these field in list
			 ->display_as('forum_answer_text','Description')
			 ->display_as('forum_answer_date','Date posted');

	    $crud->callback_column('forum_answer_from',array($this,'callback_display_create_by'));	// change value displayed in list
		$crud->add_fields('forum_answer_text','forum_category_id','forum_topic_id','forum_answer_from','forum_answer_date'); 	// add only these field into database

		$crud->callback_after_insert(array($this, 'insert_count_topic_number'));
		$crud->callback_before_insert(array($this,'add_topic_data')); // insert form topic id
		$crud->change_field_type('forum_category_id','invisible')
			 ->change_field_type('forum_topic_id','invisible')
			 ->change_field_type('forum_answer_from','invisible')
			 ->change_field_type('forum_answer_date','invisible');

		
		$output = $crud->render();
		$output->data = $data;
		$this->load->view('universal_page', $output);		
		
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */