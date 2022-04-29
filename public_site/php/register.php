<?php /*
* Audrey Borges
* WEBD-325-45
* Week 3 Project: Logging In
* April 10, 2022
*
* This is the register user file.
*/

require_once 'db_connection.php';

$conn = openCon();

echo "Connected Successfully";
 
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // Validate username
 if (empty(trim($_POST["username"]))) {
   $username_err = "Please enter a username.";
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
      } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if ($stmt->execute()) {
                $stmt->store_result();
                
                if ($stmt->num_rows == 1) {
                    $username_err = "This username is taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "An error has occurred. Please try again later.";
            }
            $stmt->close();
        }
    }
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";     
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must contain at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";     
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
         
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("ss", $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            if ($stmt->execute()) {
                header("location: login.php");
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
    <title>Sign Up</title>
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
          <li><a href="index.php">Back to main site</a></li>  
        </ul>
      </nav>  
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="submit" value="Submit">
                <input type="reset" class="reset" value="Reset">
            </div>
            <p>Already have an account? <a href="../staff_site/php/login.php">Log in here</a>.</p>
        </form>
    </div>  
  </body>
</html>