<?php
require("config.php");
require("functions.php");

$result = parse_signed_request($_POST['signed_request']);

$dbh = connectDatabase();
$statement = $dbh->prepare("UPDATE `users` SET is_active = 0 WHERE user_id = :user_id");
$statement->execute(array('user_id' => $result["user_id"]));

echo "OK";

?>