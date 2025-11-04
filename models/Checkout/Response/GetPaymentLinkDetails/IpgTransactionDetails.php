<?php

namespace Fisrv\Models;

class IpgTransactionDetails extends FisrvObject
{
    public string $ipgTransactionId;

    public TransactionStatus $transactionStatus;

    public string $approvalCode;

    public string $transactionResult;

    public string $approvedAmount;

    public string $paymentToken;

    public string $transactionState;

    public string $processor;

    public string $schemeTransactionId;

    public string $transactionTime;

    public string $merchantId;

    public string $terminalId;

    public string $country;

    public string $transactionOrigin;

    public string $transactionType;

    public string $orderId;

    public string $apiTraceId;

    public string $clientRequestId;

    public string $paymentMethodDetails;
}
