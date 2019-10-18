<?php
  session_start();
  require "includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="This is an example of a meta description. This will often show up in search results.">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <nav class="nav-header-main">
        <a class="header-logo" href="index.php">
          <img src="img/logo.png" alt="logo">
        </a>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#">About me</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
      <div class="header-login">
        <?php
        if (!isset($_SESSION['id']))
          { 
            echo '
            <form action="includes/login.inc.php" method="post">
            <input type="text" name="mailuid" placeholder="E-mail/Username">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="login-submit">Login</button>
             </form>
             <a href="signup.php" class="header-signup">signup</a>';
           }
           else if(isset($_SESSION['id']))
           {
            echo '
              <form action="includes/logout.inc.php" method="post">
                <button type="submit" name="logout-submit">logout</button>
              </form>';
            }
            ?>
      </div>
    </header>
  </body>
  </html>