<!doctype html>
<html>
  <head>
    <title>Lorem ipsum Album View</title>
    <?php require($_SERVER['DOCUMENT_ROOT'] . "/system/head.php"); ?>
  </head>
  <body>

    <?php
    // Number of page links
    $paginationPages = 5;
    // Album id
    //$album = "ariyy378945nqd09ust97869w8yn7y";

    //ariyy378945nqd09ust97869w8yn7y
    //78ayrnnnn89a79y89aqye7h978fdgs

    // Files to display per page
    $filesPerPage = 20;

    if (isset($_GET['album']) && !empty($_GET['album'])) {
      // If album exists, give a variable it's value
      $album = $_GET['album'];
    } else {
      // If album does not exist, throw error
      throwError('albumview.php : processing : album_was_not_given', 'It looks like an album was not given to view, without that information we can\'t process your request.');
    }

    if (isset($_GET['page']) && !empty($_GET['page'])) {
      // If pages exists, give a variable it's value
      $currentPage = $_GET['page'];
    } else {
      // If page does not exist, give it a default of 1
      $currentPage = 1;
    }

    if (doesAlbumExist($album)) {
      // If the album exists read the contents of the index file and select the albums section
      $albumInfo = getAlbumInfo($id);
      //print("<pre>".print_r($albumInfo,true)."</pre>");
    } else {
      // If the album does not exist, throw error
      throwError('albuminfo.php : processing : album_does_not_exist', 'It looks like you requested an album that does not exist, without a valid album we can\'t process your request.');
    }

    // Find how many pages there are
    $totalPages = getTotalPages($filesPerPage, $album);

    if ($currentPage > $totalPages) {
      // If the page variable is greater than how many pages there are, give it the maximum page value.
      $currentPage--;
    }

    // Get total amount of files
    $totalFiles = count(getFiles($album));
    ?>

    <div id="top"></div>

    <?php require($_SERVER['DOCUMENT_ROOT'] . "/system/assets/HTMLIncludes/pageChanger.php"); ?>

    <div class="pop shadow-in bac-light">
      <h6 class="dark"><a href="<?php echo $GLOBALS['domain'] . "/albuminfo.php?&id=" . $album; ?>" class="white">View album info</a></h6>
    </div>

    <div class="pop shadow-in bac-light">
      <h6 class="dark"><a href="<?php echo $GLOBALS['domain'] . "/albumlist.php"; ?>" class="white">View more albums</a></h6>
    </div>

    <?php

    displayAlbumContents($album, $filesPerPage, $currentPage, $totalFiles);

    ?>

    <div class="pop shadow-in bac-light">
      <h6 class="dark"><a href="#top" class="white">Back to top</a></h6>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'] . "/system/assets/HTMLIncludes/pageChanger.php"); ?>

    <?php require($_SERVER['DOCUMENT_ROOT'] . "/system/footer.php"); ?>
  </body>
</html>
