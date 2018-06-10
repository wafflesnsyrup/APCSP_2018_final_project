<?php

// Start the session
session_start();


// This function reads an xml file into a variable and returns the variable as an array
function XMLToArray($xml) {
  $return = simplexml_load_file($_SERVER['DOCUMENT_ROOT'] . $xml) or die("basic.php : XMLToArray() : ERROR : 1 : Unable to load default XML file at path: " . $xml . "</br>");
  return $return;
}

?>
