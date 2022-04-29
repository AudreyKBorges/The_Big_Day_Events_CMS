<?php

session_start();

$username = "";
$email = "";
$errors = array();

// Call the register() function if signup/log in is clicked
if (isset($_POST['submit'])) {
    register();
}

// Register user
function register()
{
    global $db, $errors, $username, $email, $user_ID, $user_type;

    $username = ($_POST['username']);
    $email = ($_POST['email']);
    $password_1 = ($_POST['password_1']);
    $password_2 = ($_POST['password_2']);

    // Make sure form is completed correctly
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // If the form is error-free, register user
    if (count($errors) == 0) {
        $password = password_hash($password_1, 'PASSWORD_DEFAULT');
        if (isset($_POST['user_type'])) {
            $user_type = ($_POST['user_type']);
            $query = "INSERT INTO users (user_ID, username, email, user_type, password)
                   VALUES('$user_ID', '$username', '$email', '$user_type', '$password')";
            mysqli_query($db, $query);
            $_SESSION['success'] = "New user successfully created.";
            header('location: menu.php');
        } else {
            $query = "INSERT INTO users (user_ID, username, email, user_type, password)
                   VALUES('$user_ID','$username', '$email', '$user_type', '$password')";
                   mysqli_query($db, $query);

            // User id
            $logged_in_user_id = mysqli_insert_id($db);

            // Give logged in user access to session
            $_SESSION['user'] = getUserById($logged_in_user_id);
            $_SESSION['success'] = "You are logged in.";
            header('location: menu.php');              
        }
    }
}

function login()
{
    global $password_1, $valid_response;
    $valid_response = $password_1;

    if (count($valid_response) < 5) {
        die('Your password is incorrect.');
    }
}

function getUserById($id)
{
    global $db;
    $query = "SELECT * FROM users WHERE id=" . $id;
    $result = mysqli_query($db, $query);

    $user = mysqli_fetch_assoc($result);
    return $user;
}

function Display_error()
{
    global $errors;
    if (count($errors) > 0) {
        echo '<div class="error">';
        foreach ($errors as $error) {
               echo $error .'<br>';
        }
        echo '</div>';
    }
}  

// Ensure that user is logged in before accessing page
function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}
