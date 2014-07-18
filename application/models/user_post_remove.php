<?php
class User_post_remove extends CI_Model {

    var $id         = '';
    var $user_id    = '';
    var $post_id    = '';
    var $remove    = '';
    var $remove_at = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('user_post_remove', 10);
        return $query->result();
    }
    
    function get_list() 
    {
        $query = $this->db->get('user_post_remove');
        return $query->result();
    }

    function get_remove($id) 
    {
        $query = $this->db->get_where('user_post_remove', array('id'=>$id));
        return $query->row();
    }

    function get_remove_where($condition) 
    {
        $query = $this->db->get_where('user_post_remove', $condition);
        return $query->row();
    }

    function insert_entry($input)
    {
        $this->db->insert('user_post_remove', $input);
        return $this->db->insert_id();
    }

    function update_entry($input, $condition)
    {
        $this->db->update('user_post_remove', $input, $condition);
    }

    function remove_entry($id) 
    {
        $this->db->delete('user_post_remove', array('id'=>$id));
    }

    function toggle_remove($uid, $pid) {
        $condition = array('user_id'=> $uid, 'post_id'=>$pid);
        $remove_entry = $this->get_remove_where($condition);
        if($remove_entry != NULL) {
            $remove_entry->remove = ($remove_entry->remove == 0 ? 1: 0);
            $this->update_entry($remove_entry, $condition);

        } else {
            $remove_id = $this->insert_entry(array('user_id'=>$uid, 'post_id'=>$pid, 'remove'=>1));
            $remove_entry = $this->get_remove($remove_id);
        }
        return $remove_entry->remove;
    }
}
