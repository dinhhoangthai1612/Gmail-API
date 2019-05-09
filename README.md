# PHP Wrapper for Gmail API

Installation:

GmailPHP is available via [Composer/Packagist], so you can easily install it by adding the following line to your composer.json file

```"adevait/gmail-wrapper": "1.0.*"```

or executing the following in you command line.

```composer require adevait/gmail-wrapper```

Usage notes:

In addition to the source code, example files with implementation of every function of this wrapper are added in the examples directory. Sample config file is also added, which content should be replaced with the real APP name, client details and developer key.

Available functions:

* Login (examples/login.php)
* Send message (examples/send.php)
* List messages (examples/messages.php)
* View message (examples/message_details.php)
* Delete message (examples/delete.php)
* Add label (examples/add_remove_labels.php)
* List labels (examples/labels.php)
* Create label (examples/create_label.php)

Additional functions that can be used similarly to the ones in the examples are removing a label, undoing a delete operation and creating a draft message.

## Support

Please direct any feedback to dinhhoangthai1612@gmail.com
