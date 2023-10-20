<?php
// require './vendor/autoload.php'; // Include the Composer autoloader
require __DIR__ . '/../vendor/autoload.php';


putenv('GOOGLE_APPLICATION_CREDENTIALS=./vendor/google_config.json');

$client = new Google\Client();
$client->setAuthConfig(__DIR__.'/../vendor/google_config.json');
$client->setClientId('727154685669-b270m6d5h7t3j1lc077s7m9r4s6vo512.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setAccessType('offline'); // Use 'offline' to get a refresh token
$client->setRedirectUri('http://localhost/besecure/handler/goauth'); // The redirect URI you specified
// $client->setApprovalPrompt('consent');


// You can then authenticate the client and make API requests.

$client->addScope('email');
$client->addScope('profile');
$client->addScope('openid');

?>