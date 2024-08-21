<?php

namespace Fisrv\Payments;

use Exception;
use Fisrv\Exception\ErrorResponse;
use Fisrv\HttpClient\HttpClient;
use Fisrv\HttpClient\RequestType;
use Fisrv\Models\CardLookupRequest;
use Fisrv\Models\CardLookupResponse;
use Fisrv\Models\PaymentsClientRequest;
use Fisrv\Models\PaymentsClientResponse;

final class PaymentsClient extends HttpClient
{
    /**
     * Checkout client constructor
     *
     * @param array<string, string | bool> $config Config paramter as key value array
     */
    public function __construct(array $config)
    {
        parent::__construct('/ipp/payments-gateway/v2/', $config);
    }

    /**
     * Create a primary credit card transaction
     *
     * @param array<string, mixed> | \Fisrv\Models\PaymentsClientRequest $request
     * @throws \Exception
     * @return \Fisrv\Models\PaymentsClientResponse
     */
    public function createPaymentCardSaleTransaction(array|PaymentsClientRequest $request): PaymentsClientResponse
    {
        if (is_array($request)) {
            $request = new PaymentsClientRequest($request);
        }

        $request->requestType = 'PaymentCardSaleTransaction';
        $response = $this->buildRequest(RequestType::POST, $this->endpointRoot . 'payments/', $request, PaymentsClientResponse::class);

        if (!$response instanceof PaymentsClientResponse) {
            throw new Exception('Response is of malformed type');
        }

        return $response;
    }

    /**
     * Return a transaction by ID
     *
     * @param \Fisrv\Models\PaymentsClientRequest $request
     * @param string $transactionId
     * @throws \Exception
     * @return \Fisrv\Models\PaymentsClientResponse
     */
    public function returnTransaction(PaymentsClientRequest $request, string $transactionId): PaymentsClientResponse
    {
        $request->requestType = 'ReturnTransaction';
        $response = $this->buildRequest(RequestType::POST, $this->endpointRoot . 'payments/' . $transactionId, $request, PaymentsClientResponse::class);

        if (!$response instanceof PaymentsClientResponse) {
            throw new Exception('Response is of malformed type');
        }

        return $response;
    }

    public function cardInfoLookup(CardLookupRequest $request): CardLookupResponse
    {
        $response = $this->buildRequest(RequestType::POST, $this->endpointRoot . 'card-information', $request, CardLookupResponse::class);

        if (!$response instanceof CardLookupResponse) {
            throw new Exception('Response is of malformed type');
        }

        return $response;
    }

    public function pingHealthCheck(): string|bool|ErrorResponse
    {
        try {
            $response = $this->cardInfoLookup(new CardLookupRequest([
                "paymentCard" => [
                    "number" => '5424180279791732'
                ],
            ]));
        } catch (ErrorResponse $e) {
            return $e;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        if ($response->httpCode !== 200) {
            return json_encode($response);
        }

        return true;
    }
}
