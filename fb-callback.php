<?php
error_reporting(E_ALL);
ini_set("display_errors", true);

require __DIR__ . '/vendor/autoload.php'; // For Composer
require("config.php"); // All settings in the $config-Object
require("functions.php");

session_start();

// Instantiate FB-Object
$fb = getFBObject();

$helper = $fb->getRedirectLoginHelper();

// Get the access token from API
try {
    $accessToken = $helper->getAccessToken();
}
catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
}
catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

// Did we get an access token?
if (! isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

// Now we are logged in

// Make sure, we have a long lived token
// During testing, I aready received a long lived token
if (! $accessToken->isLongLived()) {
    // The OAuth 2.0 client handler helps us manage access tokens
    $oAuth2Client = $fb->getOAuth2Client();

    try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    }
    catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
        exit;
    }
}

// -> so save the data in the session object
$_SESSION['logged-in'] = true;
$_SESSION['fb-access-token'] = $accessToken->getValue();

try {
    // Now activate the user in our database
    $dbh = connectDatabase();

    // Since we have the token saved in our session, we can do the following:
    $user = getUserInfo();

    // Now insert or replace into MYSQL Table
    $statement = $dbh->prepare("REPLACE INTO `users` (`user_id`, `name`, `token`, `is_active`) VALUES (:user, :name, :token, :active);");
    $statement->execute(array(
        ':user' => $user['id'],
        ':name' => $user['name'],
        ':token' => $accessToken->getValue(),
        ':active' => 1
        ));
}
catch(Exception $e) {
    echo "Cannot access database: " . $e->getMessage();
    exit;
}

// User is logged in with a long-lived access token.
// Redirect back to main page
header('Location: ' . https() . '://' . $config["Domain"] . '/');

?>