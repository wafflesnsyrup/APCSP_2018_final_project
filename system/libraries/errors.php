<?php

// Start the session
session_start();

// This function destroys an error
function destroyError() {
  unset($_SESSION['error']);
}

// This function sets the error title
function errorTitle($title) {
  $_SESSION['error']['title'] = $title;
}

// This function sets the error body
function errorBody($body) {
  $_SESSION['error']['body'] = $body;
}

// This function sets the error return url
function errorReturnUrl($url) {
  $_SESSION['error']['returnURL'] = $url;
}

// This function redirects the user to the error parsing page
function runError() {
  redirectTo('/error.php');
}

// This function generates a formatted error and runs the error
function throwError($title, $body) {
  destroyError();
  errorTitle($title);
  errorBody($body);
  //errorReturnURL($returnURL);
  runError();
}

?>
