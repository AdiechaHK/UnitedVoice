<?php
class User_post_comment extends CI_Model {

    var $id         = '';
    var $user_id    = '';
    var $post_id    = '';
    var $comment    = '';
    var $comment_at = '';
    var $ip         = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('user_post_comment', 10);
        return $query->result();
    }
    
    function get_list() 
    {
        $query = $this->db->get('user_post_comment');
        return $query->result();
    }

    function get_comment($id) 
    {
        $query = $this->db->get_where('user_post_comment', array('id'=>$id));
        return $query->row();
    }

    function insert_entry($input)
    {
        $this->db->insert('user_post_comment', $input);
        return $this->db->insert_id();
    }

    function update_entry($input, $condition)
    {
        $this->db->update('user_post_comment', $input, $condition);
    }

    function remove_entry($id) 
    {
        $this->db->delete('user_post_comment', array('id'=>$id));
    }

    function get_comments_for_post($post, $page) 
    {
        $this->db->select("`user_post_comment`.`comment` as comment, `user_post_comment`.`comment_at` as time, `users`.`name` as user_name");
        $this->db->from("`user_post_comment`");
        $this->db->join("`users`", "users.id = user_post_comment.user_id");
        $this->db->order_by("`user_post_comment`.`comment_at`", "asc");
        $this->db->where('post_id', $post);
        $this->db->limit(10, $page * 10);
        $query = $this->db->get();
        return $query->result();

    }

}
