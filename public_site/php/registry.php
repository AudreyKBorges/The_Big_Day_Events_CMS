<?php
include_once 'db_connection.php';
?>
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
        <header class="grid-banner">
                    <img class="banner" srcset="
                    ../images/cover2.png 850w" sizes="(max-width: 600px)
                   800px" src="../images/cover2.png" alt="Baby's breath flowers on pink painted wood">
                </header>
            <nav class="main-nav">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <div class="dropdown">
                  <button class="dropbtn">Wedding Website</button>
                  <div class="dropdown-content">
                    <a href="the_happy_couple.php">The Happy Couple</a>
                    <a href="wedding_details.php">Wedding Details</a>
                    <a href="registry.php">Registry</a>
                    <a href="rsvp.php">RSVP</a>
                  </div>
                </div>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="register.php">Login</a></li>   
              </ul>
            </nav> 
        <footer class="main-footer">Designed and developed by Audrey Borges.</footer>
    </div>
</body>
</html>

