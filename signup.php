<?php
  require "header.php";
?>
    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <h1>Signup</h1>
          <form class="signupp" action="includes/signup.inc.php" method="post">
            <input  class ="forminput" type="text" name="uid" placeholder="Username">
            <input class ="forminput"type="text" name="mail" placeholder="E-mail">
            <input class ="forminput"type="password" name="pwd" placeholder="Password">
            <input class ="forminput"type="password" name="pwd-repeat" placeholder="Repeat password">
            <button class ="buttonform" type="submit" name="signup-submit">Signup</button>
          </form>
        </section>
      </div>
    </main>
<?php
  require "footer.php";
?>
