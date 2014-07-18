<?php
class Pnews_images extends CI_Model {

    var $id         = '';
    var $news_id    = '';
    var $image    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('pnews_images', 10);
        return $query->result();
    }
    
    function get_list() 
    {
        $query = $this->db->get('pnews_images');
        return $query->result();
    }

    function get_image($id) 
    {
        $query = $this->db->get_where('pnews_images', array('id'=>$id));
        return $query->row();
    }

    function get_image_of_news($id)
    {
        $query = $this->db->get_where('pnews_images', array('news_id', $id));
        return $query->result();        
    }

    function insert_entry($input)
    {
        $this->db->insert('pnews_images', $input);
        return $this->db->insert_id();
    }

    function update_entry($input, $condition)
    {
        $this->db->update('pnews_images', $input, $condition);
    }

    function remove_entry($id) 
    {
        $this->db->delete('pnews_images', array('id'=>$id));
    }

}
