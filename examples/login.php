<?php
session_start();

require_once '../vendor/autoload.php';
require_once('includes/sample_config.php');

use GmailWrapper\Authenticate;

$authenticate = Authenticate::getInstance(CLIENT_ID,CLIENT_SECRET,APPLICATION_NAME,DEVELOPER_KEY);

if(!$authenticate->isAuthenticated()) {
    $response = $authenticate->getLogInURL('http://localhost:82/gmailphp/examples/login.php', ['openid','https://www.googleapis.com/auth/gmail.readonly','https://mail.google.com/','https://www.googleapis.com/auth/gmail.modify','https://www.googleapis.com/auth/gmail.compose','https://www.googleapis.com/auth/gmail.send'],'offline', 'force');
    if(!$response['status']) {
        echo $response['message'];
        exit;
    }
    $loginUrl = $response['data'];
    echo "<a href='{$loginUrl}'>Login</a>";
}
if(isset($_GET['code'])) {
    $auth = $authenticate->logIn($_GET['code']); 
    if($auth['status']) {
        $_SESSION['tokens'] = $authenticate->getTokens();
    } else {
        echo $auth['message'];
    }
    echo '<br><h3>Login successfully</h3>';
    echo '<p><a href="labels.php">Go to lables</a></p>';
    echo '<p><a href="send.php">New Message</a></p>';
}

