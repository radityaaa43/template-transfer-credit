<?php
require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..' . '')->load();

require __DIR__ . '/../../briapi-sdk/autoload.php';

// env values
$clientId = $_ENV['CONSUMER_KEY']; // customer key
$clientSecret = $_ENV['CONSUMER_SECRET']; // customer secret
$pKeyId = $_ENV['PRIVATE_KEY']; // private key

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url
$path = '/snap/v1.0/balance-inquiry'; //informasi rekening api path
$accessTokenPath = '/snap/v1.0/access-token/b2b'; //access token path

// change variables accordingly
$partnerId = ''; //partner id
$channelId = ''; // channel id
