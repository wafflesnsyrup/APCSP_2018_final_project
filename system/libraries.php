<?php

// Start the session
session_start();

// This function requires all libraries
function requireAllLibraries() {
  require($_SERVER['DOCUMENT_ROOT'] . "/system/libraries/basic.php");
  require($_SERVER['DOCUMENT_ROOT'] . "/system/libraries/gallery.php");
  require($_SERVER['DOCUMENT_ROOT'] . "/system/libraries/sql.php");
  require($_SERVER['DOCUMENT_ROOT'] . "/system/libraries/xml.php");
  require($_SERVER['DOCUMENT_ROOT'] . "/system/libraries/files.php");
  require($_SERVER['DOCUMENT_ROOT'] . "/system/libraries/errors.php");
  require($_SERVER['DOCUMENT_ROOT'] . "/system/libraries/fileFormats.php");
}

?>
