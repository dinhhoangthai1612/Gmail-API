<?php
require_once '../vendor/autoload.php';
require_once('includes/sample_config.php');
require_once('includes/auth.php');

use GmailWrapper\Messages;

if(isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['body'])) {
    $message = new Messages($authenticate);
    $thread = isset($_GET['thread']) ? $_GET['thread'] : false;
    $attachments = array();
    if(isset($_FILES['attachment']) && $attachmentCount = count(array_filter($_FILES['attachment']['name']))) {
        $error_message = '';
        for ($i=0; $i < $attachmentCount; $i++) { 
            switch( $_FILES['attachment']['error'][$i] ) {
                case UPLOAD_ERR_OK:
                    array_push($attachments, [$_FILES['attachment']['name'][$i], $_FILES['attachment']['tmp_name'][$i]]);
                    break;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $error_message .= '<p>'.($i+1).' File too large.</p>';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $error_message .= '<p>'.($i+1).' File upload was not completed.</p>';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $error_message .= '<p>'.($i+1).' Zero-length file uploaded.</p>';
                    break;
                default:
                    $error_message .= '<p>'.($i+1).' Internal error #'.$_FILES['attachment']['error'][$i].'</p>';
                    break;
            }
            if($error_message) {
                echo $error_message;
                exit;
            }
        }
    }
    $send = $message->send($_POST['email'],$_POST['subject'],$_POST['body'],$attachments,$thread);
    if(!$send['status']) {
        echo $send['message'];
        exit;
    }
    echo '<div class="alert alert-success" role="alert" align="center">Sent Successfully</div>';
    echo '<p><a href="labels.php">Go to labels</a></p>';
    echo '<p><a href="label_details.php?labelId=INBOX">Go to Inbox</a></p>';
    echo '<p><a href="label_details.php?labelId=SENT">View sent message</a></p>'; 
    echo '<p><a href="label_details.php?labelId=TRASH">Trash</a></p>';
}
?>
<style>
    .form-group {
        display: block;
    }
    img {
        display: block;
        margin: auto;
        padding: auto;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send an Email</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-8" style="margin:0 auto; float:none;">
                <img src="../src/Img/gmail.png" alt="gmail">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Input Email address">
                    </div>

                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control" name="subject" placeholder="Input Subject">
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="body" class="form-control" id="" cols="30" rows="10" placeholder="Input Message"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="file" name="attachment[]" multiple>
                    </div>

                    <div class="form-group" align="center">
                        <input class="btn btn-info" type="submit" name="submit"/><br><br>
                        <?php echo '<p><a href="labels.php">Back</a></p>'; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

