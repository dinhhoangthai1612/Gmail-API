<?php
require_once '../vendor/autoload.php';
require_once('includes/sample_config.php');
require_once('includes/auth.php');

use GmailWrapper\Messages;

$msgs = new Messages($authenticate);
$label = $msgs->createLabel('Demo label');
echo "Create Label Successfully";
echo '<br><a href="labels.php">Back</a>';