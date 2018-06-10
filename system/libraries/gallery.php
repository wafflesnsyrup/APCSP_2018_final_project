<?php
/*
Index: (search for these names to find functions easier)

doesAlbumExist($id)
getAlbumInfo($id)
*/

// Start the session
session_start();

// This function checks to see if a given album exists
function doesAlbumExist($id) {
  // Load the index xml file into an array
  $xml = XMLToArray('/assets/albums/index.xml');

  // Loop through all album nodes
  foreach ($xml->album as $album) {
    // Does the album nodes id match the search id?
    if ((string) $album['id'] == $id) {
      // Album node exists, return true
      return true;
    }
  }

  // Could not find album node with matching id, return false
  return false;

  /*
  // Search throught the file for all realnames and names to be used for searching
  $ids = $xml->xpath('//album/id');
  $name = $xml->xpath('//album/name');

  // Loop through each album in the search, checking to see if the file exists
  for ($i = 0; $i < count($ids); $i++) {
    if ((string) $name[$i] == $id || (string) $ids[$i] == $id) {
      // If either the name or realName of an album entry equals the search, return true
      return true;
    } else {
      // If either the name or realName of an album entry noes not equal the search, continue
      return false;
    }
    //1echo "----------------------------------------------------------------------------------------<br/>";
  }
  // The entire index file has been looked through and none of the albums match the search criteria, return false;
  return false;
  */
}

function getAlbumInfo($id) {
  // Read the index XML file into an object
  $xml = XMLToArray('/assets/albums/index.xml');

  // Format the search query
  $query = '//album[@id="' . $id . '"]';

  // Get the contents of the found node
  $nodes = $xml->xpath($query);

  // Return the values found
  return $nodes[0];
}

function paginate($cp, $tp, $pp) {
  if ($cp == ($tp - $tp) + 1) {
    $state = "first";
  } elseif ($cp == $tp) {
    $state = "last";
  } else {
    $state = "middle";
  }

  return 0;

}

function getAlbums($version) {
  // Album input controll, //1 = sfw, 2 = nsfw, 3 = all
  $file = $_SERVER['DOCUMENT_ROOT'] . "/assets/albums/albums" . $version . ".txt";

  $albums = file($file, FILE_IGNORE_NEW_LINES);
  return $albums;
}

function getFirstfile($album) {
  $files = getFiles($album);
  sort($files);
  $firstFile = $files['2'];
  return $firstFile;
}

function getAlbumTitle($album, $version) {
  // Album input controll, //1 = sfw, 2 = nsfw, 3 = all
  $file = $_SERVER['DOCUMENT_ROOT'] . "/assets/albums/albumTitles" . $version . ".txt";

  $albums = file($file, FILE_IGNORE_NEW_LINES);
  return $albums[$album];
}

function getTotalPages($filesPerPage, $album) {
  $totalFiles = count(getFiles($album));
  $totalPages = ((int) ($totalFiles / $filesPerPage));
  return $totalPages + 1;
}

function genTop() {
  echo "<div class=\"shadow-out card card-pin\">";
}

function genBottom($album, $file) {
  echo "<div class=\"overlay\">";
  echo "<h3 class=\"card-title title\">" . $file . "</h3>";
  echo "<div class=\"download\">";
  echo "<a href=\"" . $GLOBALS['domain'] . "/assets/albums/" . $album . "/" . $file . "\" download>";
  echo "<i class=\"material-icons\" aria-hidden=\"true\">get_app</i>";
  echo "</a>";
  echo "</div>";
  echo "<div class=\"more\">";
  echo "<a href=\"" . $GLOBALS['domain'] . "/fileinfo.php?id=" . $album . "&file=" . $file .  "&page=" . $GLOBALS['currentPage'] . "\">";
  echo "<i class=\"material-icons\">info</i>";
  echo "</a>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
}

function displayAlbumContents($id, $filesPerPage, $currentPage, $totalFiles) {

  // Get an array of albums to display
  $files = getFiles($id);

  if ($filesPerPage - ($totalFiles - (($filesPerPage * $currentPage) - $filesPerPage)) > 0) {
    $filesOnPage = $totalFiles - ($filesPerPage * ($currentPage - 1));
  } else {
    $filesOnPage = $filesPerPage;
  }
  echo "<div class=\"container-fluid mar-top mar-bot\">";
  echo "<div class=\"card-columns\">";

  // Loop for the amount of files per page
  for ($i = ($currentPage * $filesPerPage) - $filesPerPage; $i < $filesOnPage + (($currentPage * $filesPerPage) - $filesPerPage); $i++) {
    $filesDisplayed = $filesOnPage;
    // Genrate the thumbnail
    $thumbnail = $files[$i];
    $thumbnail = "/assets/albums/" . $id . "/" . $thumbnail;

    // Start the card
    genTop();

    // Display the file
    generateThumbnail($id, $files, $i);

    // End the card
    genBottom($id, $files[$i]);
  }

  echo "</div>";
  echo "</div>";

}

function displayAlbumCovers($columnCSS, $version = 1) {
  // Get the list of albums to display
  $albums = getAlbums($version);
  // Start bootsrap container
  echo "<div class=\"container-fluid\">";
  // Display header card for album info
  echo "<div class=\"card\" onclick=\"\">";
  echo "<div class=\"card-header div-2 color-2\">";
  echo "<h1 class=\"card-text text-center\">Albums:</h1>";
  echo "</div>";
  echo "<ul class=\"list-group list-group-flush\">";
  echo "<li class=\"list-group-item div-2 color-3\">";
  echo "<p class=\"card-text text-center\"><span class=\"badge badge-light\">" . count($albums) . "</span> total albums</p>";
  echo "</li>";
  echo "</div>";
  echo "<div class=\"card-columns\">";
  // Loop through, displaying albums x per row
  for ($i = 0; $i < count($albums); $i++) {
    $thumbnail = getFirstfile($albums[$i]);
    $thumbnail = "/assets/albums/" . $albums[$i] . "/" . $thumbnail;

    $albumTitle = getAlbumTitle($i, $version);

    // Style and display the file
    echo "<div class=\"card\"onclick=\"\">";
    echo "<div class=\"cord-body no-overflow\">";
    echo "<img class=\"card-img\" id=\"" . $i . "\" src=\"" . $thumbnail . "\" href=\"#\">";
    echo "</div>";
    echo "<div class=\"card-footer div-2 color-2\">";
    echo "<p class=\"card-text\"><a href=\"https://stelladraco27-staging.herokuapp.com/index/gallery/gallery.php?stage=content&album=" . $albums[$i] . "&page=1&title=" . $albumTitle . "\">" . $albumTitle . "</a></p>";
    echo "</div>";
    echo "</div>";

  }
  // End card column
  echo "</div>";
  // Display card footer for album info
  echo "<div class=\"card\" onclick=\"\">";
  echo "<div class=\"card-header div-2 color-2\">";
  echo "<h1 class=\"card-text text-center\">FIN</h1>";
  echo "</div>";
  echo "<ul class=\"list-group list-group-flush\">";
  echo "<li class=\"list-group-item div-2 color-3\">";
  echo "<p class=\"card-text\"><span class=\"badge badge-light\">" . count($albums) . "</span> total albums</p>";
  echo "</li>";
  echo "</div>";
  // End bootsrap container
  echo "</div>";
}

?>
