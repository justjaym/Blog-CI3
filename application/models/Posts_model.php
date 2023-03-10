<?php

class Posts_model extends CI_Model{

    public function __construct(){

        $this->load->database();

    }

    public function get_posts(){
        // $this->db->query('SELECT * FROM `post` as p JOIN `user` as u ON `u`.`id` = `p`.`id` WHERE `slug` = "$param"');
        $query = $this->db->get('post');
        return $query->result_array();

    }    
    
    public function get_posts_search($param){

        $this->db->like('title', $param);
        $query = $this->db->get('post');
        return $query->result_array();

    }


    public function get_posts_single($param){
        // $this->db->query('SELECT * FROM `post` as p JOIN `user` as u ON `u`.`id` = `p`.`id` WHERE `slug` = "$param"');

        $this->db->where('id', $param);
        $result = $this->db->get('post');

        return $result->row_array();


    }

    public function get_posts_edit($param){
        // $this->db->query('SELECT * FROM `post` as p JOIN `user` as u ON `u`.`id` = `p`.`id` WHERE `slug` = "$param"');
        $this->db->where('slug', $param);
        // $this->db->select('*');
        // $this->db->from('post');
        // $this->db->join('user', 'u.id = p.id');
        $result = $this->db->get('post');
        // $result2 = $this->db->get('user');

        return $result->row_array();
        // return $result2->row_array();


    }

    public function register_user(){

        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'is_admin' => $this->input->post('is_admin')
        );
        return $this->db->insert('user', $data);
    }

    public function insert_post(){
        $id = $this->session->id;
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'title' => $this->input->post('title'),
            'slug' => url_title($this->input->post('title'), '-', true),
            'body' => $this->input->post('body')
        );

        return $this->db->insert('post', $data);
        
    }

    public function update_post(){
        
        $id = $this->input->post('id');
        $data = array(
            'title' => $this->input->post('title'),
            'body' => $this->input->post('body')
        );

        $this->db->where('id', $id);
        return $this->db->update('post', $data);
        
    }

    public function delete_post(){
        
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('post');

        return true;
    }

    public function login(){

        $this->db->where('email', $this->input->post('username', true));
        $this->db->where('password', $this->input->post('password', true));
        $result = $this->db->get('user');

        if($result->num_rows() == 1){

            return $result->row_array();
        }else{

            return false;
        }
    }
}