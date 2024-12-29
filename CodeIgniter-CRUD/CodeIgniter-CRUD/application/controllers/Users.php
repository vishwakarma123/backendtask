<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->database(); 
    }

    // List all users
    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('users/index', $data);
    }

    // Create a new user
    public function create() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->index();
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'dob' => $this->input->post('dob')
            ];

            $this->User_model->create_user($data);
            redirect('users');
        }
    }

    // Edit user (Display form)
    public function edit($id) {
        $data['user'] = $this->User_model->get_user($id);

        if (empty($data['user'])) {
            show_404();
        }

        $this->load->view('users/edit', $data);
    }

    // Update user
    public function update($id) {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);  // Reload edit form with errors
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'dob' => $this->input->post('dob')
            ];

            if ($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            }

            $this->User_model->update_user($id, $data);
            redirect('users');
        }
    }

    // Delete user
    public function delete($id) {
        $this->User_model->delete_user($id);
        redirect('users');
    }
}
?>
