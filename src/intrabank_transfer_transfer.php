<?php

use BRI\Util\GenerateDate;

require 'utils.php';

// url path values
$baseUrl = 'https://sandbox.partner.api.bri.co.id'; //base url

try {
  list($clientId, $clientSecret, $privateKey) = getCredentials();

  list($accessToken, $timestamp) = getAccessToken(
    $clientId,
    $pKeyId,
    $baseUrl
  );

  // change variables accordingly
  $partnerId = ''; //partner id
  $channelId = ''; // channel id

  $beneficiaryAccountNo = '';
  $deviceId = '';
  $channel = '';
  $partnerReferenceNo = '';
  $sourceAccountNo = '';
  $feeType = '';
  $remark = '';
  $customerReference = '';
  $transactionDate = (new GenerateDate())->generate();
  $value = ''; // 10000.00
  $currency = '';

  $validateInputs = sanitizeInput([
    'partnerId' => $partnerId,
    'channelId' => $channelId,
    'beneficiaryAccountNo' => $beneficiaryAccountNo,
    'deviceId' => $deviceId,
    'channel' => $channel,
    'partnerReferenceNo' => $partnerReferenceNo,
    'sourceAccountNo' => $sourceAccountNo,
    'feeType' => $feeType,
    'remark' => $remark,
    'customerReference' => $customerReference,
    'transactionDate' => $transactionDate,
    'value' => $value,
    'currency' => $currency
  ]);

  $response = fetchIntrabankTransferTransfer(
    $clientSecret,
    $validateInputs['partnerId'],
    $baseUrl,
    $accessToken,
    $validateInputs['channelId'],
    $timestamp,
    $validateInputs['partnerReferenceNo'],
    $validateInputs['value'],
    $validateInputs['beneficiaryAccountNo'],
    $validateInputs['sourceAccountNo'],
    $validateInputs['feeType'],
    $validateInputs['remark'],
    $validateInputs['transactionDate'],
    $validateInputs['currency'],
    $validateInputs['customerReference'],
    $validateInputs['deviceId'],
    $validateInputs['channel']
  );

  echo $response;
} catch (Exception $e) {
  error_log('Error: ' . $e->getMessage());
  exit(1);
}
