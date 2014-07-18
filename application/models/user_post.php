<?php
class User_post extends CI_Model {

    var $id   = '';
    var $user_id = '';
    var $post_text    = '';
    var $active    = '';
    var $ip    = '';
    var $post_at = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('user_post', 10);
        return $query->result();
    }

    function get_list_recent_first($uid, $page = 0) {
        if(isset($uid) && $uid > 0) {

            $query = $this->db->query("select p.id as id, p.post_text as post_text, p.post_at as `time`, u.id as user_id, u.name as user_name, l.`like` as liked
                from user_post as p
                join users as u on u.id = p.user_id
                left join (select `like`, `post_id` from user_post_like where user_id = ".$uid.") as l
                on l.post_id = p.id where p.id not in (select post_id from user_post_remove where user_id = ".$uid.") order by p.post_at desc limit ".($page*10).", 10 ");
            return $query->result();
        } else {
            
            $this->db->select("`user_post`.`id` as id, `user_post`.`post_text` as post_text, `user_post`.`post_at` as time, `users`.`id` as user_id, `users`.`name` as user_name");
            $this->db->from("`user_post`");
            $this->db->join("`users`", "users.id = user_post.user_id");
            $this->db->order_by("`user_post`.`post_at`", "desc");
            $this->db->limit(10, $page * 10);
            $query = $this->db->get();
            return $query->result();
        }
    }
    
    function get_list() 
    {
        $query = $this->db->get('user_post');
        return $query->result();
    }

    function insert_entry($input)
    {
        $this->db->insert('user_post', $input);
        return $this->db->insert_id();
    }

    function update_entry($input, $condition)
    {
        $this->db->update('user_post', $input, $condition);
    }

    function remove_entry($id) 
    {
        $this->db->delete('user_post', array('id'=>$id));
    }

}
