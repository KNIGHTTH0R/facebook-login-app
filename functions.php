<?php

// Instantiate a $fb Object
function getFBObject() {
    global $config;

    $fb = new Facebook\Facebook([
        'app_id' => $config["Facebook"]["AppID"],
        'app_secret' => $config["Facebook"]["AppSecret"],
        'default_graph_version' => 'v2.2',
        ]);

    return $fb;
}

// Get a Login-Url to authenticate with facebook.
function getFacebookLoginUrl() {
    global $config;

    $fb = getFBObject();

    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl('http://' . $config["Domain"] . '/fb-callback.php', $permissions);

    return htmlspecialchars($loginUrl);
}

// Connect to a MySQL Database using PDO
function connectDatabase() {
    global $config;

    $pdo = new PDO('mysql:host=' . $config["DB"]["Host"] . ';dbname=' . $config["DB"]["Database"], $config["DB"]["User"], $config["DB"]["Password"]);
    return $pdo;
}

// Query some basic info from Facebook and return it
function getUserInfo() {
    $fb = getFBObject();
    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->get('/me?fields=id,name,picture', $_SESSION['fb-access-token']);
    }
    catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    $user = $response->getGraphUser();
    return $user;
}