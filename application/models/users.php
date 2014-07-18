<?php
class Users extends CI_Model {

    var $id   = '';
    var $name = '';
    var $email    = '';
    var $password    = '';
    var $type    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('users', 10);
        return $query->result();
    }
    
    function get_list() 
    {
        $query = $this->db->get('users');
        return $query->result();
    }

    function insert_entry($input)
    {
        $this->db->insert('users', $input);
        return $this->db->insert_id();
    }

    function update_entry($input, $condition)
    {
        $this->db->update('users', $input, $condition);
    }

    function remove_entry($id) 
    {
        $this->db->delete('users', array('id'=>$id));
    }

    function login($input) 
    {
        $query = $this->db->get_where('users', array('email'=>$input['email']));
        $count = $query->num_rows();
        $responce = array();
        if($count == 1) {
            $user = $query->row();
            if(md5($input['password']) == $user->password) {
                $responce['status'] = "SUCCESS";
                $responce['user'] = $query->row();
            } else {
                $responce['status'] = "FAIL";
                $responce['login_error'] = "Invalid user credentials";
            }
        } else {
            $responce['status'] = "FAIL";
            if($count > 1) {
                $responce['login_error'] = "Unexpected user conflicts";
            } else {
                $responce['login_error'] = "No user found";                
            }
        }
        return $responce;
    }

}
