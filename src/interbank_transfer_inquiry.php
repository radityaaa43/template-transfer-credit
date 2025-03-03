<?php

require 'utils.php';

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

  $beneficiaryBankCode = '';
  $beneficiaryAccountNo = '';
  $deviceId = '';
  $channel = '';

  $validateInputs = sanitizeInput([
    'partnerId' => $partnerId,
    'channelId' => $channelId,
    'beneficiaryBankCode' => $beneficiaryBankCode,
    'beneficiaryAccountNo' => $beneficiaryAccountNo,
    'deviceId' => $deviceId,
    'channel' => $channel
  ]);

  $response = fetchInterbankTransferInquiry(
    $clientSecret,
    $validateInputs['partnerId'],
    $baseUrl,
    $accessToken,
    $validateInputs['channelId'],
    $timestamp,
    $validateInputs['beneficiaryBankCode'],
    $validateInputs['beneficiaryAccountNo'],
    $validateInputs['deviceId'],
    $validateInputs['channel']
  );

  echo $response;
} catch (Exception $e) {
  error_log('Error: ' . $e->getMessage());
  exit(1);
}
