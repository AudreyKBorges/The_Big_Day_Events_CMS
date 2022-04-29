<?php include 'functions.php'; ?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Big Day Events</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
</head>

<body>
        <div class="grid-container">
            <nav class="backend-nav">
              <ul>
                <h3>The Big Day Events Website Builder</h3>
                <li><a href="menu.php">Menu</a></li>   
                <li><a href="">Log Out</a></li>   
              </ul>
            </nav>  
            <div class="menu-options">
             <!-- notification message -->
         <?php if (isset($_SESSION['success'])) : ?>
           <div class="error success" >
               <h3>
                   <?php
                       echo $_SESSION['success'];
                       unset($_SESSION['success']);
         endif ?>
             <!-- logged in user information -->
       <div class="profile_info">
           <div>
               <?php if (isset($_SESSION['user'])) : ?>
                   <strong><?php echo $_SESSION['user']['username']; ?></strong>
               <?php endif ?>
           </div>

            <h2><u>Menu Options</u></h2>
            <ul>
                <li><a class="menu" href="manage_content.php">Manage website content</a></li>
                <li><a class="menu" href="create_user.php">Add user</a></li>
                <li><a class="menu" href="register.php">Log Out</a></li>
            </ul>
        </div>
    </div>
</body>
</html>