<?php
class User_model extends CI_Model {

     public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    // Insert a new user
    public function create_user($data) {
        return $this->db->insert('users', $data);
    }

    // Get a single user by ID
    public function get_user($id) {
        $this->db->where('id', $id);
        return $this->db->get('users')->row();
    }

    // Get all users
    public function get_all_users() {
        return $this->db->get('users')->result();
    }

    // Update an existing user
    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    // Delete a user
    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
}
?>
