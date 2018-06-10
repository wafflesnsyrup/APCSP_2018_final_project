<?php

// Start the session
session_start();

// This function redirects a user to a specified page
function redirectTo($page)
{
  header('location: ' . $page);
  die;
}

?>
