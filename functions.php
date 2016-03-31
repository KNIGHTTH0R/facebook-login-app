<?php

// Get a Login-Url to authenticate with facebook.
function getFacebookLoginUrl() {
    global $config;

    $fb = new Facebook\Facebook([
      'app_id' => $config["Facebook"]["AppID"],
      'app_secret' => $config["Facebook"]["AppSecret"],
      'default_graph_version' => 'v2.2',
      ]);

    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl('http://' . $config["Domain"] . '/fb-callback.php', $permissions);

    return htmlspecialchars($loginUrl);
}