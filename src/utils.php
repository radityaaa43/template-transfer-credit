<?php

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..' . '')->load();

require __DIR__ . '/../../briapi-sdk/autoload.php';

use BRI\TransferCredit\InterbankTransfer;
use BRI\TransferCredit\IntrabankTransfer;
use BRI\TransferCredit\TransactionStatusInquiry;
use BRI\Util\ExecuteCurlRequest;
use BRI\Util\GetAccessToken;
use BRI\Util\PrepareRequest;

function getCredentials(): array {
  $clientId = $_ENV['CONSUMER_KEY'] ?? null; // customer key
  $clientSecret = $_ENV['CONSUMER_SECRET'] ?? null; // customer secret
  $privateKey = $_ENV['PRIVATE_KEY'] ?? null; // private key

  return [
    $clientId,
    $clientSecret,
    $privateKey
  ];
}

function getAccessToken(
  string $clientId,
  string $pKeyId,
  string $baseUrl
): array {
  $getAccessToken = new GetAccessToken();

  [$accessToken, $timestamp] = $getAccessToken->get(
    $clientId,
    $pKeyId,
    $baseUrl
  );

  return [$accessToken, $timestamp];
}

// Sanitize input parameters
function sanitizeInput(array $inputs): array {
  $sanitized = [];
  foreach ($inputs as $key => $value) {
      $sanitized[$key] = filter_var($value, FILTER_SANITIZE_STRING);
      if (empty($sanitized[$key])) {
          throw new Exception("Invalid input parameter for $key");
      }
  }
  return $sanitized;
}

function fetchInterbankTransferInquiry(
  string $clientSecret,
  string $partnerId,
  string $baseUrl,
  string $accessToken,
  string $channelId,
  string $timestamp,
  string $beneficiaryBankCode,
  string $beneficiaryAccountNo,
  string $deviceId,
  string $channel
): string {
  $executeCurlRequest = new ExecuteCurlRequest();
  $prepareRequest = new PrepareRequest();

  $interbankTransfer = new InterbankTransfer(
    $executeCurlRequest,
    $prepareRequest
  );

  $response = $interbankTransfer->inquiry(
    $clientSecret,
    $partnerId,
    $baseUrl,
    $accessToken,
    $channelId,
    $timestamp,
    $beneficiaryBankCode,
    $beneficiaryAccountNo,
    $deviceId,
    $channel
  );

  return $response;
}

function fetchInterbankTransferTransfer(
  string $clientSecret,
  string $partnerId,
  string $baseUrl,
  string $accessToken,
  string $channelId,
  string $timestamp,
  string $partnerReferenceNo,
  string $value,
  string $beneficiaryAccountName,
  string $beneficiaryAccountNo,
  string $beneficiaryBankCode,
  string $sourceAccountNo,
  string $transactionDate,
  string $currency,
  string $beneficiaryAddress,
  string $beneficiaryBankName,
  string $beneficiaryEmail,
  string $customerReference,
  string $deviceId,
  string $channel
): string {
  $executeCurlRequest = new ExecuteCurlRequest();
  $prepareRequest = new PrepareRequest();

  $interbankTransfer = new InterbankTransfer(
    $executeCurlRequest,
    $prepareRequest
  );

  $response = $interbankTransfer->transfer(
    $clientSecret,
    $partnerId,
    $baseUrl,
    $accessToken,
    $channelId,
    $timestamp,
    $partnerReferenceNo,
    $value,
    $beneficiaryAccountName,
    $beneficiaryAccountNo,
    $beneficiaryBankCode,
    $sourceAccountNo,
    $transactionDate,
    $currency,
    $beneficiaryAddress,
    $beneficiaryBankName,
    $beneficiaryEmail,
    $customerReference,
    $deviceId,
    $channel
  );

  return $response;
}

function fetchIntrabankTransferInquiry(
  string $clientSecret,
  string $partnerId,
  string $baseUrl,
  string $accessToken,
  string $channelId,
  string $timestamp,
  string $beneficiaryAccountNo,
  string $deviceId,
  string $channel
): string {
  $executeCurlRequest = new ExecuteCurlRequest();
  $prepareRequest = new PrepareRequest();

  $intrabankTransfer = new IntrabankTransfer(
    $executeCurlRequest,
    $prepareRequest
  );

  $response = $intrabankTransfer->inquiry(
    $clientSecret,
    $partnerId,
    $baseUrl,
    $accessToken,
    $channelId,
    $timestamp,
    $beneficiaryAccountNo,
    $deviceId,
    $channel
  );

  return $response;
}

function fetchIntrabankTransferTransfer(
  string $clientSecret,
  string $partnerId,
  string $baseUrl,
  string $accessToken,
  string $channelId,
  string $timestamp,
  string $partnerReferenceNo,
  string $value,
  string $beneficiaryAccountNo,
  string $sourceAccountNo,
  string $feeType,
  string $remark,
  string $transactionDate,
  string $currency,
  string $customerReference,
  string $deviceId,
  string $channel
): string {
  $executeCurlRequest = new ExecuteCurlRequest();
  $prepareRequest = new PrepareRequest();

  $intrabankTransfer = new IntrabankTransfer(
    $executeCurlRequest,
    $prepareRequest
  );

  $response = $intrabankTransfer->transfer(
    $clientSecret,
    $partnerId,
    $baseUrl,
    $accessToken,
    $channelId,
    $timestamp,
    $partnerReferenceNo,
    $value,
    $beneficiaryAccountNo,
    $sourceAccountNo,
    $feeType,
    $remark,
    $transactionDate,
    $currency,
    $customerReference,
    $deviceId,
    $channel
  );

  return $response;
}

function fetchTransactionStatusInquiry(
  string $clientSecret,
  string $partnerId,
  string $baseUrl,
  string $accessToken,
  string $channelId,
  string $timestamp,
  string $originalPartnerReferenceNo,
  string $serviceCode,
  string $transactionDate,//(new GenerateDate())->generate(),
  string $deviceId,
  string $channel
): string {
  $executeCurlRequest = new ExecuteCurlRequest();
  $prepareRequest = new PrepareRequest();

  $transactionStatusInquiry = new TransactionStatusInquiry(
    $executeCurlRequest,
    $prepareRequest
  );

  $response = $transactionStatusInquiry->inquiry(
    $clientSecret,
    $partnerId,
    $baseUrl,
    $accessToken,
    $channelId,
    $timestamp,
    $originalPartnerReferenceNo,
    $serviceCode,
    $transactionDate,//(new GenerateDate())->generate(),
    $deviceId,
    $channel
  );

  return $response;
}
