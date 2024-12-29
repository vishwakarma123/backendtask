<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        header('Content-Type: application/json');
    }

    // Get all users
    public function index() {
        $users = $this->User_model->get_all_users();
        echo json_encode($users);
    }

    // Get a single user by ID
    public function get($id) {
        $user = $this->User_model->get_user($id);
        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(['error' => 'User not found']);
        }
    }

    // Create a new user
    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);

        $insert_data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'dob' => $data['dob']
        ];

        $inserted = $this->User_model->create_user($insert_data);
        echo json_encode(['success' => $inserted]);
    }

    // Update a user by ID
    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        $update_data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'dob' => $data['dob']
        ];

        if (!empty($data['password'])) {
            $update_data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        $updated = $this->User_model->update_user($id, $update_data);
        echo json_encode(['success' => $updated]);
    }

    // Delete a user by ID
    public function delete($id) {
        $deleted = $this->User_model->delete_user($id);
        echo json_encode(['success' => $deleted]);
    }
}
?>
