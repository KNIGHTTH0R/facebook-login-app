<?php
// Start and kill the session -> the user is logged out
session_start();
session_destroy();

require("config.php");
require("functions.php");

// Now send the user back to the main page
header("Location: " . https() . "://" . $config["Domain"] . '/');
?>