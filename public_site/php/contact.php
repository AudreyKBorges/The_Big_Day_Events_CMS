<!DOCTYPE html>
<html lang="en">

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
                <li><a href="register.php">Login or Sign Up</a></li>   
              </ul>
            </nav>  
            <div class="form">
      <form accept-charset="UTF-8" action="" method="POST" target="_blank">
              <fieldset class="contact">
                <div class="contact-us">Contact Us</div>
                <p class="cform">We would love to help you plan your big day. Please fill out the form and we will
                  respond soon.
                </p>
                  <div>
                    <label for="name">Full Name</label>
                      <input required type="text" id="name" name="user_name" placeholder="Required" required>
                  </div>
                  <div>
                    <label for="email">Email Address</label>
                      <input required type="email" id="email" name="user_email" placeholder="Required" required>
                  </div>
                  <div>
                    <label for="phone">Phone Number</label>
                      <input type="tel" id="phone" name="user_phone" placeholder="Required" required>
                  </div> 
                </fieldset>
              <fieldset>
                  <label>What can we help you with?</label>
                    <textarea id="comment" name="user_comment"></textarea>
                    <button class="submit" type="submit" name="submit">Submit</button>
                  </div>
                </fieldset>
              </form>  
              </div>   
        <footer class="main-footer"></footer>
    </div>
</body>
</html>