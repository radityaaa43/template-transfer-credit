<?php

use BRI\Util\GenerateDate;

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

  $partnerReferenceNo = '';
  $beneficiaryAccountName = '';
  $beneficiaryAccountNo = '';
  $beneficiaryBankCode = '';
  $sourceAccountNo = '';
  $transactionDate = (new GenerateDate())->generate();
  $beneficiaryAddress = '';
  $beneficiaryBankName = '';
  $beneficiaryEmail = '';
  $customerReference = '';
  $value = "";
  $currency = '';
  $deviceId = '';
  $channel = '';

  $validateInput = sanitizeInput([
    'partnerId' => $partnerId,
    'channelId' => $channelId,
    'partnerReferenceNo' => $partnerReferenceNo,
    'beneficiaryAccountName' => $beneficiaryAccountName,
    'beneficiaryAccountNo' => $beneficiaryAccountNo,
    'beneficiaryBankCode' => $beneficiaryBankCode,
    'sourceAccountNo' => $sourceAccountNo,
    'transactionDate' => $transactionDate,
    'beneficiaryAddress' => $beneficiaryAddress,
    'beneficiaryBankName' => $beneficiaryBankName,
    'beneficiaryEmail' => $beneficiaryEmail,
    'customerReference' => $customerReference,
    'value' => $value,
    'currency' => $currency,
    'deviceId' => $deviceId,
    'channel' => $channel
  ]);

  $response = fetchInterbankTransferTransfer(
    $clientSecret,
    $validateInput['partnerId'],
    $baseUrl,
    $accessToken,
    $validateInput['channelId'],
    $timestamp,
    $validateInput['partnerReferenceNo'],
    $validateInput['value'],
    $validateInput['beneficiaryAccountName'],
    $validateInput['beneficiaryAccountNo'],
    $validateInput['beneficiaryBankCode'],
    $validateInput['sourceAccountNo'],
    $validateInput['transactionDate'],
    $validateInput['currency'],
    $validateInput['beneficiaryAddress'],
    $validateInput['beneficiaryBankName'],
    $validateInput['beneficiaryEmail'],
    $validateInput['customerReference'],
    $validateInput['deviceId'],
    $validateInput['channel']
  );

  echo $response;
} catch (Exception $e) {
  error_log('Error: ' . $e->getMessage());
  exit(1);
}
