<?php 
/*
* Audrey Borges
* WEBD-325-45
* Week 3 Project: Logging In
* April 10, 2022
*
* This is the user login file.
*/

require_once 'db_connection.php';

$conn = openCon();

echo "Connected Successfully";
    
session_start();

// Limit the number of login attempts
if (!isset($_SESSION['wrong_password'])) {
    $_SESSION['wrong_password'] = 0;
}
$_SESSION['wrong_password']++;
if ($_SESSION['wrong_password'] > 5) {
    echo "You have run out of login attempts and no longer have access.";
    exit();
}
 
// Check if the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit();
}
 
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate user credentials
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = $username";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            
            $param_username = $username;
            
            if ($stmt->execute()) {
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {                    
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            
                            header("location: welcome.php");
                        } else {
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "An error has occurred. Please try again later.";
            }
            $stmt->close();
        }
    }
    closeCon($conn);
}
?>
 
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
</head>

<body>
    <nav>
        <ul>
          <h3>The Big Day Events Website Builder</h3>
          <li><a href="/public_site/php/index.php">Back to main site</a></li>  
        </ul>
      </nav> 
    <div class="wrapper">
        <h2>Log In</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="submit" value="Log in">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>