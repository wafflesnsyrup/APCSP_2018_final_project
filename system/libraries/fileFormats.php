<?php

// Start the session
session_start();

// This function checks to see if a given input file format is supported
function isSupported($file, $return = '1') {

  // Get the file extension
  $extension = getExtension($file);

  // Parse the file extension and retun different things
  switch ($extension) {
    case ('mp4'):
    case ('webm'):
      if ($return == '1') {
        return 'video';
      } else {
        return true;
      }
    case ('png'):
    case ('jpg'):
    case ('jpeg'):
    case ('gif'):
      if ($return == '1') {
        return 'image';
      } else {
        return true;
      }
    case ('flv'):
    case ('swf'):
      if ($return == '1') {
        return 'flash';
      } else {
        return true;
      }
    default:
      if ($return == '1') {
        throwError('albums.php : isSupported() : file_type_not_supported : info : file ' . $file . ' extension ' . $extension . ' did not match any supported file formats', 'Don\'t worry! It\'s not your fault. We just ran into a file format that is not supported and the program had to exit.');
      } else {
        return false;
      }
  }
}

// Images and gifs
function displayImage($file, $id, $type = '1') {
  if ($type == '1') {
    echo "<img class=\"card-img\" src=\"/assets/albums/" . $id . "/" . $file . "\" href=\"#\">";
  } else {
    echo "<img class=\"img\" src=\"/assets/albums/" . $id . "/" . $file . "\" href=\"#\">";
  }
}

// Flash games
function displayFlash($file, $id, $type = '1') {
  if ($type == '1') {
    echo "<div class=\"card-body preview-thumb\">";
    echo "<p class=\"card-text\">";
    echo "Flash preview unavailable";
    echo "</p>";
    echo "</div>";
  } else {
    echo "<object class=\"fsh\">";
    echo "<param name=\"movie\" value=\"/assets/albums/" . $id . "/" . $file . "\">";
    echo "<embed src=\"/assets/albums/" . $id . "/" . $file . "\" quality=\"high\" menu=\"false\" pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" class=\"fsh\">";
    echo "</embed>";
    echo "</object>";
  }
}

// Videos
function displayVideo($file, $id, $type = '1') {
  if ($type == '1') {
    echo "<div class=\"card-body preview-thumb\">";
    echo "<p class=\"card-text\">";
    echo "Video preview unavailable";
    echo "</p>";
    echo "</div>";
  } else {
    echo "<video class=\"vid\" controls>";
    echo "<source src=\"assets/albums/" . $id . "/" . $file . "\" type=\"video/mp4\">";
    echo "Your browser does not support the video tag.";
    echo "</video>";
  }
}

// This function generates a thumbnail depending on what type of file it is
function generateThumbnail($id, $files, $i) {
  if (isSupported($files[$i], '2')) {
    $type = isSupported($files[$i], '1');
    switch ($type) {
      case ('image'):
        displayImage($files[$i], $id);
        break;
      case ('video'):
        displayVideo($files[$i], $id);
        break;
      case ('flash'):
        displayFlash($files[$i], $id);
        break;
      default:
        throwError('albums.php : generateThumbnail() : generate thumbnail switch : file_type_not_matched : type = ' . $type, 'Don\'t worry! It\'s not your fault. We just ran into a problem when no switch case was not met.');
    }
  } else {
    throwError('albums.php : generateThumbnail() : file_type_not_supported', 'Don\'t worry! It\'s not your fault. We just ran into a file format that is not supported.');
  }
}

// This function returns the file extension of a string input
function getExtension($file, $type) {
  return pathinfo($file, PATHINFO_EXTENSION);
}

?>
