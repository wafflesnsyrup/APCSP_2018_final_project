<?php

// Start the session
session_start();

// This function counts the files in a directory
function countFiles($dir, $ext = "") {
  $dir = $_SERVER['DOCUMENT_ROOT'] . $dir;
  if (glob($dir . "*" . $ext) != false)
  {
    $filecount = count(glob($dir . "*" . $ext));
    return $filecount;
  }
  else
  {
    return "basic.php : countFiles() : error : could not count files in given directory : " . $dir;
  }
}

// This function zips a file and downloads it to the users computer
function zipAndDownload($id, $name) {
  $handle = $_SERVER['DOCUMENT_ROOT'] . "/assets/albums/" . $id . "/";
  $zipname = $name . ".zip";
  $zip = new ZipArchive;
  $zip->open($zipname, ZipArchive::CREATE);
  if ($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {
      if ($entry != "." && $entry != ".." && !strstr($entry,'.php')) {
          $zip->addFile($entry);
      }
    }
    closedir($handle);
  }
  $zip->close();
  header('Content-Type: application/zip');
  header("Content-Disposition: attachment; filename='adcs.zip'");
  header('Content-Length: ' . filesize($zipname));
  header("Location: adcs.zip");
}

// This function returns the file names as an array from a givin directory
function getFiles($album) {
  $dir = "/assets/albums/" . $album . "/";
  $files = array();
  foreach (new DirectoryIterator($_SERVER['DOCUMENT_ROOT'] . $dir) as $fileInfo) {
      if($fileInfo->isDot() || !$fileInfo->isFile()) continue;
      $files[] = $fileInfo->getFilename();
  }
  return $files;
}

// This function returns the file size of a directory
function getSize($dir)
{
    $size = 0;
    foreach (glob(rtrim($_SERVER['DOCUMENT_ROOT'] . $dir, '/').'/*', GLOB_NOSORT) as $each) {
        $size += is_file($each) ? filesize($each) : folderSize($each);
    }
    return $size;
}

function toKilobytes($b) {
  $kb = $b / 1024;
  return $kb . "KB";
}

function toMegabytes($b) {
  $mb = $b / 1024 / 1024;
  return $mb . "MB";
}

function toGigabytes($b) {
  $gb = $b / 1024 / 1024 / 1024;
  return $gb . "GB";
}

function toTerabytes($b) {
  $tb = $b / 1024 / 1024 / 1024 / 1024;
  return $tb . "TB";
}

function sizeConvert($b) {
  if ($b >= 1099511627776) {
    return toTerabytes($b);
  } else if ($b >= 1073741824) {
    return toGigabytes($b);
  } else if ($b >= 1048576) {
    return toMegabytes($b);
  } else if ($b >= 1024) {
    return toKilobytes($b);
  } else {
    return $b . "B";
  }
}
?>
