<?php


if (isset($_GET['id']) && !empty($_GET['id']) || isset($_GET['name']) && !empty($_GET['name'])) {
  // If id and name exists, give a variable it's value
  $id = $_GET['id'];
  $name = $_GET['name'];
} else {
  // If album or id does not exist, throw error
  throwError('zipdownload.php : processing : either id or name not given', 'It looks like neither an album id or file name was given, we can\'t zip a a file without this information.');
}

$handle = $_SERVER['DOCUMENT_ROOT'] . "/assets/albums/" . $id . "/";

$zipname = $name;
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
header("Content-Disposition: attachment; filename='" . $name . ".zip'");
header('Content-Length: ' . filesize($zipname));
header("Location: " . $name . ".zip");

?>
