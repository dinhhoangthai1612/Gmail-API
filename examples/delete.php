<?php
require_once '../vendor/autoload.php';
require_once('includes/sample_config.php');
require_once('includes/auth.php');

use GmailWrapper\Messages;

if (!isset($_GET['messageId'])) {
    header('Location:messages.php');
    exit;
}
$msgs = new Messages($authenticate);
$msgs->trash($_GET['messageId']);
echo "Delete Successfully";
echo '<p><a href="labels.php">Back</a></p>';