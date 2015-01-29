<?php
class K_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    /**
     * [insert_new_data insert data into table - any type of table]
     * @param  [type] $arrayData [data value received from controller(column and value already)]
     * @param  [type] $table     [name of table to insert the data]
     * @return [type]            [description]
     */
     function insert_new_data($arrayData,$table)
    {

        $this->db->insert($table,$arrayData);
        //$this->db->_error_message();
       // return  $this->db->_error_message();
        return $this->db->insert_id();
    }
    /**
     * [delete_data delete all type of table]
     * @param  [type] $table [name of table]
     * @param  [type] $where [condition to applied]
     * @return [type]        [description]
     */
    public function delete_data($table, $where){

        $this->db->where($where);
        $this->db->delete($table);
    }
    /**
    * [get_all_rows This function can use for all the tables, default function is to call all the results rows in table]
    * @param  [string] $table [name of table you want to fetch data]
    * @param  [array] $where [condition to apply]
    * @return [type]        [return data sets]
    */
    function get_all_rows1($table,$where, $tableNameToJoin, $tableRelation, $likes, $places)
    {
            //$data = array();
            //$query = $this->db->query("SELECT *FROM $table");

            $this->db->select('*');
            $this->db->from($table);

            if($where!=false){
               $this->db->where($where);
            }
           
           if($tableNameToJoin!=false && $tableRelation!=false){

                $this->db->join($tableNameToJoin, $tableRelation);
           }

           if($likes!=false){
            $this->db->like($likes, 'after'); 
           }
            /*foreach ($query->result_array() as $row)
            {
               $data[] = $row;
            }*/
            $query = $this->db->get();
            return $query->result_array(); 
            //return $data;
    }
    
    /**
     * [get_specified_row This function can use for all the tables, default function is to call the specified results rows in table]
     * @param  [string] $table [name of table you want to fetch data]
     * @param  [array] $where [where condition]
     * @param  [array] $order_by [order by]
     * @return [type] [return sepcified row]
     */
    function get_specified_row($table,$where,$order_by,$tableNameToJoin, $tableRelation)
    {
        
        $this->db->select('*');
        $this->db->from($table);

        if($where!=false)
        {
             $this->db->where($where); 
        }

        if($order_by!=false)
        {
            $this->db->order_by($order_by[0], $order_by[1]);
        }

        if($tableNameToJoin && $tableRelation){

                $this->db->join($tableNameToJoin, $tableRelation);
           }

        $query = $this->db->get();
        return $query->row_array();    
    }

    /**
     * [update_data update datas in any tables you want]
     * @param  [array] $columnToUpdate [what column you want to update = array value]
     * @param  [string] $tableToUpdate  [what table you want to update]
     * @param  [array] $usingCondition [using condition or not]
     * @return [type]                 [description]
     */
    
    function update_data($columnToUpdate, $tableToUpdate, $usingCondition)
    {
        
        $this->db->where($usingCondition);
        $this->db->update($tableToUpdate, $columnToUpdate);


    }

    function get_all_rows($table,$where, $tableNameToJoin, $tableRelation, $likes, $places)
    {
           
            $this->db->select('*');
            $this->db->from($table);

            if($where!=false){
               $this->db->where($where);
            }
           
           if($tableNameToJoin!=false && $tableRelation!=false){
                for ($i=0; $i < count($tableNameToJoin); $i++){
                    $this->db->join($tableNameToJoin[$i], $tableRelation[$i]);
                }
                
           }

           if($likes!=false){
            $this->db->like($likes, 'after'); 
           }
            
            $query = $this->db->get();
            return $query->result_array(); 
            
    }


    /**
     * [display_message display flash message data in view part]
     * @param  [string] $messageType [what type of message you want to display]
     * @param  [string] $urlToGo     [url you want to redirect after making the process ==> if using current url just use current_url()]
     * @return [type]              [description]
     * currently only 3 types of message can appear on page (save, record, error) ->can change the if else to add another type of message
     */
    function display_message($messageType, $urlToGo)
    {
        /**
         * usage :
         * calling this method in controller of course
         * example : display_message("save","jobs/index/add")
         * @var [type]
         */
        if($messageType=="save")
        {
             $this->session->set_flashdata('save', 'Successfully saved');

        }
        else if($messageType=="record")
        {
             $this->session->set_flashdata('record', 'Data successfully recorded');
        }
        else if($messageType=="error")
        {
             $this->session->set_flashdata('error', 'There is an errors in processing, please try again.');
        }
        else if($messageType=="convert")
        {
             $this->session->set_flashdata('convert', 'Successfully converted.');
        }
        else if($messageType=="email")
        {
             $this->session->set_flashdata('email', 'Successfully sent email.');
        }
       

       return redirect($urlToGo);
    }



}
