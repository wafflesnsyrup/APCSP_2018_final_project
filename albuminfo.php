<!doctype html>
<html>
  <head>
    <title>Lorem ipsum Album Info</title>
    <?php require($_SERVER['DOCUMENT_ROOT'] . "/system/head.php"); ?>
  </head>
  <body>
    <?php
    if (!isset($_GET['id']) || empty($_GET['id'])) {
      // If this page was called and there was no album selected, or the value was left empty, throw error
      throwError('albuminfo.php : processing : album_id_not_given', 'It looks like an album id was not given, without that information we can\'t process your request.');
    } else {
      // If an album was passed over, give a variable 'album' it's value
      $id = $_GET['id'];
    }

    if (doesAlbumExist($id)) {
      // If the album exists read the contents of the index file and select the albums section
      $albumInfo = getAlbumInfo($id);
      //print("<pre>".print_r($albumInfo,true)."</pre>");
    } else {
      // If the album does not exist, throw error
      throwError('albuminfo.php : processing : album_does_not_exist', 'It looks like you requested an album that does not exist, without a valid album we can\'t process your request.');
    }
    ?>
    <div class="container-fluid no-padding">
      <div class="album-header img-container">
        <div class="img" style="background-image:url('/system/assets/placeholders/1.png');"></div>
        <div class="title centered shadow-out">
          <h1 class="light capitalize"><?php echo $albumInfo->name; ?></h1>
        </div>
      </div>

      <div class="pop shadow-in bac-light">
        <h6 class="dark"><a href="<?php echo $GLOBALS['domain'] . "/albumview.php?page=1&album=" . $albumInfo->id; ?>" class="white">View Album Contents</a></h6>
      </div>

      <div class="jumbotron bac-light shadow-in no-curve mar-bot no-margin">
        <h1 class="white">Album info:</h1>
      </div>

      <div class="pop shadow-out bac-dark mar-bot mar-top">
        <h6 class="light">Name: <?php echo $albumInfo->name; ?></h6>
        <h6 class="light">Views: <?php echo $albumInfo->views; ?></h6>
        <h6 class="light">Author: <?php echo $albumInfo->author; ?></h6>
        <h6 class="light">Last activity: <?php echo $albumInfo->lastUpdated->date . " at " . $albumInfo->lastUpdated->time; ?></h6>
        <h6 class="light">Contributors: </h6>
        <?php
        foreach ($albumInfo->contributors->children() as $value) {
          echo "<a href=\"#\">@" . $value . " </a>";
        }
        ?>
        <h6 class="light">Tags: </h6>
        <?php
        foreach ($albumInfo->tags->children() as $value) {
          echo "<a href=\"#\" class=\"btn btn-spacing shadow-in bac-light white\" role=\"button\">#" . $value . " </a>";
        }
        ?>
        <h6 class="light">Files: <?php echo countFiles('/assets/albums/'.$albumInfo->id.'/'); ?></h6>
      </div>

      <div class="pop shadow-in bac-light">
        <h6 class="dark"><a href="<?php echo $GLOBALS['domain'] . "/albumview.php?page=1&album=" . $albumInfo->id; ?>" class="white">View Album Contents</a></h6>
      </div>

      <div class="pop shadow-in bac-light">
        <h6 class="dark"><a href="<?php echo $GLOBALS['domain'] . "/zipdownload.php?id=" . $albumInfo->id . "&name=" . $albumInfo->name; ?>" class="white">Download <?php echo sizeConvert(round(getSize('/assets/albums/'.$albumInfo->id), 2)); ?></a></h6>
      </div>

    </div>
    <hr>


    <?php require($_SERVER['DOCUMENT_ROOT'] . "/system/footer.php"); ?>
  </body>
</html>
