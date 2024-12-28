<?php
// Include the database connection
include_once 'db.php';

// Allow preflight requests (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    exit; // End the script here to not execute the rest of the code for OPTIONS requests
}


ini_set('display_errors', 1);
error_reporting(E_ALL);

// Set the content-type to JSON
header('Content-Type: application/json');

// Get the HTTP request method (GET, POST, PUT, DELETE)
 $method = $_SERVER['REQUEST_METHOD'];

// Function to respond with JSON
function respond($data, $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit();
}
// Function to get all users
function getAllUsers() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    respond($users);
}

// Function to get a single user by ID
function getUserById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        respond($user);
    } else {
        respond(["message" => "User not found"]);
    }
}

// Function to create a new user
function createUser($data) {
    global $pdo;
    if (!isset($data->name) || !isset($data->email) || !isset($data->password) || !isset($data->dob)) {
        respond(['message' => 'Invalid input']);
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, dob) VALUES (:name, :email, :password, :dob)");
    $stmt->bindParam(':name', $data->name);
    $stmt->bindParam(':email', $data->email);
    $stmt->bindParam(':password', password_hash($data->password, PASSWORD_BCRYPT)); // Hash password
    $stmt->bindParam(':dob', $data->dob);

    if ($stmt->execute()) {
        respond(['message' => 'User created successfully']);
    } else {
        respond(['message' => 'Error creating user']);
    }
}

// Function to update an existing user
function updateUser($id, $data) {
    global $pdo;
    if (!isset($data->name) && !isset($data->email) && !isset($data->password) && !isset($data->dob)) {
        respond(['message' => 'No data provided to update']);
        exit();
    }

    $updates = [];
    $params = [':id' => $id];

    if (isset($data->name)) {
        $updates[] = "name = :name";
        $params[':name'] = $data->name;
    }
    if (isset($data->email)) {
        $updates[] = "email = :email";
        $params[':email'] = $data->email;
    }
    if (isset($data->password)) {
        $updates[] = "password = :password";
        $params[':password'] = password_hash($data->password, PASSWORD_BCRYPT); // Hash password
    }
    if (isset($data->dob)) {
        $updates[] = "dob = :dob";
        $params[':dob'] = $data->dob;
    }

    if (count($updates) > 0) {
        $sql = "UPDATE users SET " . implode(", ", $updates) . " WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute($params)) {
            respond(['message' => 'User updated successfully']);
        } else {
            respond(['message' => 'Error updating user']);
        }
    }
}

// Function to delete a user by ID
function deleteUser($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        respond(['message' => 'User deleted successfully']);
    } else {
        respond(['message' => 'Error deleting user']);
    }
}

// Handling the HTTP request method
switch ($method) {
    case 'GET':
        // If the ID is provided in the query string, fetch a single user by ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            getUserById($id);
        } else {
            // Otherwise, get all users
            getAllUsers();
        }
        break;

    case 'POST':
        // Create a new user
        $data = json_decode(file_get_contents("php://input"));
        createUser($data);
        break;

    case 'PUT':
        // Update an existing user
        if (!isset($_GET['id'])) {
            respond(['message' => 'User ID is required']);
            exit();
        }
        $id = $_GET['id'];
        $data = json_decode(file_get_contents("php://input"));
        updateUser($id, $data);
        break;

    case 'DELETE':
        // Delete a user
        if (!isset($_GET['id'])) {
            respond(['message' => 'User ID is required']);
            exit();
        }
        $id = $_GET['id'];
        deleteUser($id);
        break;

    default:
        respond(['message' => 'Method Not Allowed']);
        break;
}
?>
