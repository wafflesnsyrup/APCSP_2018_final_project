<!doctype html>
<html>
  <head>
    <title>Lorem ipsum File Info</title>
    <?php require($_SERVER['DOCUMENT_ROOT'] . "/system/head.php"); ?>
  </head>
  <body>
    <?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {
      // If id exists, give a variable it's value
      $id = $_GET['id'];
    } else {
      // If id does not exist, throw error
      throwError('fileinfo.php : processing : id_not_given', 'It looks like an album id was not given for us to show information on, without that information we can\'t process your request.');
    }

    if (isset($_GET['file']) && !empty($_GET['file'])) {
      // If file exists, give a variable it's value
      $file = $_GET['file'];
    } else {
      // If file does not exist, throw error
      throwError('fileinfo.php : processing : file_not_given', 'It looks like the file was not given for us to show information on, without that information we can\'t process your request.');
    }

    if (isset($_GET['page']) && !empty($_GET['page'])) {
      // If page exists, give a variable it's value
      $page = $_GET['page'];
    } else {
      // If page does not exist, throw error
      throwError('fileinfo.php : processing : page_not_given', 'It looks like an album page was not given for us to show information on, without that information we can\'t process your request.');
    }

    ?>

    <div class="pop shadow-in bac-light">
      <h6 class="dark"><a href="<?php echo $GLOBALS['domain'] . "/albumview.php?page=" . $page . "&album=" . $id; ?>" class="white">Back</a></h6>
    </div>

    <?

    echo "<div class=\"container mar-top mar-bot\">";

    if (isSupported($file, '2')) {
      $type = isSupported($file, '1');
      switch ($type) {
        case ('image'):
          displayImage($file, $id, '2');
          break;
        case ('video'):
          displayVideo($file, $id, '2');
          break;
        case ('flash'):
          displayFlash($file, $id, '2');
          break;
        default:
          throwError('fileinfo.php : body : file_type_not_matched : type = ' . $type, 'Don\'t worry! It\'s not your fault. We just ran into a problem when no switch case was not met.');
      }
    } else {
      throwError('fileinfo.php : body : file_type_not_supported', 'Don\'t worry! It\'s not your fault. We just ran into a file format that is not supported.');
    }

    echo "</div>";
    ?>

    <div class="pop shadow-in bac-light">
      <h6 class="dark"><a href="<?php echo $GLOBALS['domain'] . "/albumview.php?page=" . $page . "&album=" . $id; ?>" class="white">Back</a></h6>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 shadow-in bac-sec">
          <h6 class="light">File info:</h6>
          <p>Lorem ipsum: asdfsadf</p>
          <p>Lorem ipsum: asdfasdf</p>
          <p>Lorem ipsum: asdfasdf</p>
          <p>Lorem ipsum: asdfasdf</p>
          <p>Lorem ipsum: asdfasdf</p>
        </div>
        <div class="col-md-8 shadow-in bac-sec">
          <h6 class="light">Tags: </h6>
          <?php
          for ($i = 0; $i < 5; $i++) {
            echo "<a href=\"#\" class=\"btn btn-spacing shadow-in bac-light white\" role=\"button\">#" . $i . "abcd</a>";
          }
          ?>
          <h6 class="light">Actions: </h6>
          <a href="#" class="btn btn-spacing shadow-in bac-light white" role="button">Favorite +</a>
          <a href="#" class="btn btn-spacing shadow-in bac-light white" role="button">Add to V-Album</a>
          <a href="#" class="btn btn-spacing shadow-in bac-light white" role="button">Delete</a>
          <a href="#" class="btn btn-spacing shadow-in bac-light white" role="button">Edit</a>
          <a href="#" class="btn btn-spacing shadow-in bac-light white" role="button">Share</a>
        </div>
      </div>
    </div>

    <div class="pop shadow-in bac-light">
      <h6 class="white">Downloads: </h6>
      <?php
      for ($i = 0; $i < 5; $i++) {
        echo "<a href=\"#\" class=\"btn btn-spacing shadow-in bac-light white\" role=\"button\">#" . $i . "abcd</a>";
      }
      ?>
    </div>

    <div class="container-fluid no-padding">
      <div class="jumbotron bac-light no-margin mar-top shadow-in no-curve">
        <h1 class="white"><?php echo $file; ?></h1>
      </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'] . "/system/footer.php"); ?>
  </body>
</html>
