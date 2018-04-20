<?php
//$params = require(__DIR__ . '/params.php');
//$db = require(__DIR__ . '/db.php');
//$authmanager= require(__DIR__ . '/authmanager.php');
return [
    'components' => [
        // list of component configurations
       
        
       
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            
        ],
        
       // 'db' => $db,
       // 'authManager' => $authmanager,
        
       
    ],
   // 'params' => $params,
];
?>
