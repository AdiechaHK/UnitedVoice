<?php
class User_post_like extends CI_Model {

    var $id         = '';
    var $user_id    = '';
    var $post_id    = '';
    var $like    = '';
    var $like_at = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('user_post_like', 10);
        return $query->result();
    }
    
    function get_list() 
    {
        $query = $this->db->get('user_post_like');
        return $query->result();
    }

    function get_like($id) 
    {
        $query = $this->db->get_where('user_post_like', array('id'=>$id));
        return $query->row();
    }

    function get_like_where($condition) 
    {
        $query = $this->db->get_where('user_post_like', $condition);
        return $query->row();
    }

    function insert_entry($input)
    {
        $this->db->insert('user_post_like', $input);
        return $this->db->insert_id();
    }

    function update_entry($input, $condition)
    {
        $this->db->update('user_post_like', $input, $condition);
    }

    function remove_entry($id) 
    {
        $this->db->delete('user_post_like', array('id'=>$id));
    }

    function toggle_like($uid, $pid) {
        $condition = array('user_id'=> $uid, 'post_id'=>$pid);
        $like_entry = $this->get_like_where($condition);
        if($like_entry != NULL) {
            $like_entry->like = ($like_entry->like == 0 ? 1: 0);
            $this->update_entry($like_entry, $condition);

        } else {
            $like_id = $this->insert_entry(array('user_id'=>$uid, 'post_id'=>$pid, 'like'=>1));
            $like_entry = $this->get_like($like_id);
        }
        return $like_entry->like;
    }
}
