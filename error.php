<!doctype html>
<html>
  <head>
    <title>Oh no!</title>
    <?php require($_SERVER['DOCUMENT_ROOT'] . "/system/head.php"); ?>
  </head>
  <body>
    <?php

    // Start the session
    session_start();

    if (isset($_SESSION['error'])) {
      // Get error information
      $title = $_SESSION['error']['title'];
      $body = $_SESSION['error']['body'];
      //$returnURL = $_SESSION['error']['returnURL'];
    } else {
      // Create an error error (lol)
      $title = "error.php : body : error : no_error_given";
      $body = "It looks like you were redirected here without error information! There may be an error, and we will try to find it.";
      //$returnURL = $GLOBALS['domain'] . "/index.php";
    }

    ?>

    <div class="container-fluid no-padding">
      <div class="row">
        <div class="col-md-12 col-main">
          <h3 class="dark"><?php echo $title; ?></h3>
        </div>
      </div>
      <div class="jumbotron bac-dark shadow-in no-curve">
        <h1 class="light"><?php echo $body; ?></h6>
      </div>

      <div class="pop shadow-out bac-light text-center">
        <h6 class="dark"><a href="/index.php" class="white">Home</a></h6>
      </div>
    </div>

    <?php destroyError(); ?>

    <?php require($_SERVER['DOCUMENT_ROOT'] . "/system/footer.php"); ?>
  </body>
</html>
