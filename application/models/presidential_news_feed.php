<?php
class Presidential_news_feed extends CI_Model {

    var $id   = '';
    var $headline = '';
    var $place    = '';
    var $post_at = '';
    var $artical_text    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('presidential_news_feed', 10);
        return $query->result();
    }

    function get_populated_list() 
    {
        $query = $this->db->query('SELECT 
            `news`.`id` as `id`,
            `news`.`headline` as `headline`,
            `news`.`place` as `place`,
            `news`.`post_at` as `post_at`,
            `news`.`artical_text` as `artical_text`,
            GROUP_CONCAT(`news`.`image`) as images
            FROM (SELECT 
                `inner_news`.`id` as `id`,
                `inner_news`.`headline` as `headline`,
                `inner_news`.`place` as `place`,
                `inner_news`.`post_at` as `post_at`,
                `inner_news`.`artical_text` as `artical_text`,
                `image_tbl`.`image` as `image`
                FROM `presidential_news_feed` AS `inner_news`
                LEFT JOIN `pnews_images` AS `image_tbl`
                ON `image_tbl`.`news_id` = `inner_news`.`id`
                ) AS `news`
            GROUP BY `news`.`id`');
        return $query->result();
    }
    function get_list() 
    {
        $query = $this->db->get('presidential_news_feed');
        return $query->result();
    }

    

    function insert_entry($input)
    {
        $this->db->insert('presidential_news_feed', $input);
        return $this->db->insert_id();
    }

    function update_entry($input, $condition)
    {
        $this->db->update('presidential_news_feed', $input, $condition);
    }

    function remove_entry($id) 
    {
        $this->db->delete('presidential_news_feed', array('id'=>$id));
    }

}
// select COALESCE(a.headline, a.image) from () as a group by a.id
/*
select a.headline, GROUP_CONCAT(a.image) from (SELECT b.id, b.headline, c.image
FROM presidential_news_feed AS b
LEFT JOIN pnews_images AS c ON b.id = c.news_id) as a group by a.id
*/