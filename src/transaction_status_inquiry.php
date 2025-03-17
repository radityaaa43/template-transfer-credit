<?php

require 'utils.php';

// env values
$clientId = $_ENV['CONSUMER_KEY']; // customer key
$clientSecret = $_ENV['CONSUMER_SECRET']; // customer secret
$pKeyId = $_ENV['PRIVATE_KEY']; // private key

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

try {
  list($clientId, $clientSecret, $privateKey) = getCredentials();

  list($accessToken, $timestamp) = getAccessToken(
    $clientId,
    $privateKey,
    $baseUrl
  );

  // change variables accordingly
  $partnerId = ''; //partner id
  $channelId = ''; // channel id

  $beneficiaryAccountNo = '';
  $deviceId = '';
  $channel = '';
  $originalPartnerReferenceNo = '';
  $serviceCode = '';
  $transactionDate = ''; // 2021-11-30T10:30:24+07:00

  $validateInputs = sanitizeInput([
    'partnerId' => $partnerId,
    'channelId' => $channelId,
    'beneficiaryAccountNo' => $beneficiaryAccountNo,
    'deviceId' => $deviceId,
    'channel' => $channel,
    'originalPartnerReferenceNo' => $originalPartnerReferenceNo,
    'serviceCode' => $serviceCode,
    'transactionDate' => $transactionDate
  ]);

  $response = fetchTransactionStatusInquiry(
    $clientSecret,
    $validateInputs['partnerId'],
    $baseUrl,
    $accessToken,
    $validateInputs['channelId'],
    $timestamp,
    $validateInputs['originalPartnerReferenceNo'],
    $validateInputs['serviceCode'],
    $validateInputs['transactionDate'],//(new GenerateDate())->generate(),
    $validateInputs['deviceId'],
    $validateInputs['channel']
  );

  echo $response;
} catch (Exception $e) {
  error_log('Error: ' . $e->getMessage());
  exit(1);
}
