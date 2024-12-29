<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'welcome';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;




$route['default_controller'] = 'users'; // Set Users controller as the default controller
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Custom Routes for Users Controller
$route['users'] = 'users/index'; // List all users
$route['users/create'] = 'users/create'; // Display the form to add a user and handle submission
$route['users/edit/(:num)'] = 'users/edit/$1'; // Display the form to edit user with ID
$route['users/update/(:num)'] = 'users/update/$1'; // Handle updating the user with ID
$route['users/delete/(:num)'] = 'users/delete/$1'; // Handle deleting the user with ID


$route['api/users'] = 'api/Users/index';       // Get all users
$route['api/users/(:num)'] = 'api/users/get/$1';  // Get user by ID
$route['api/users/create'] = 'api/users/create';  // Create a new user
$route['api/users/update/(:num)'] = 'api/users/update/$1';  // Update user by ID
$route['api/users/delete/(:num)'] = 'api/users/delete/$1';  // Delete user by ID


$route['api/users'] = 'users/index';
