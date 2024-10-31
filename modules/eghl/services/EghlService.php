<?php

namespace app\modules\eghl\services;

class EghlService
{
    private $password;
    private $serviceId;
    private $serviceUrl;
    private $merchantReturlUrl;
    private $merchantApprovalUrl;
    private $merchantCallbackUrl;
    private $merchantUnApprovalUrl;
    private $currencyCode;
    private $transactionType;
    private $paymentMethod;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/eghl.php';

        $this->serviceId = $config['service_id'];
        $this->password = $config['password'];
        $this->merchantReturlUrl = $config['merchant_return_url'];
        $this->merchantApprovalUrl = $config['merchant_approval_url'];
        $this->merchantUnApprovalUrl = $config['merchant_unapproval_url'];
        $this->merchantCallbackUrl = $config['merchant_callback_url'];
        $this->pageTimeout = $config['page_timeout'];
        $this->transactionType = $config['transaction_type'];
        $this->paymentMethod = $config['payment_method'];
        $this->serviceUrl = $config['service_url'];
    }

    /**
     * @return string
     */
    public function getServiceUrl(): string
    {
        return $this->serviceUrl;
    }

    /**
     * @param array $data
     * @return array
     */
    public function getParams(array $data): array
    {
        return [
            'TransactionType' => $this->transactionType,
            'PymtMethod' => $this->paymentMethod,
            'ServiceID' => $this->serviceId,
            'MerchantReturnURL' => $this->merchantReturlUrl,
            'MerchantApprovalURL' => $this->merchantApprovalUrl,
            'MerchantUnApprovalURL' => $this->merchantUnApprovalUrl,
            'MerchantCallBackURL' => $this->merchantCallbackUrl,
            'CurrencyCode' => $data["CurrencyCode"],
            'UserIp' => $this->getUserIp(),
            'PageTimeout' => $this->pageTimeout,
            'HashValue' => $this->generateHash($data),
            'Amount' => $data["Amount"],
            'PaymentID' => $data['PaymentID'],
            'OrderNumber'=> $data['OrderNumber'] ?? 1,
            'PaymentDesc' => $data['PaymentDesc'],
            'CustName'  => $data['CustName'] ?? '',
            'CustEmail' => $data['CustEmail'] ?? '',
            'CustPhone' => $data['CustPhone'] ?? ''
        ];
    }

    /**
     * Get the hashing value
     * @param array
     * @return string
     */
    public function generateHash(array $value): string
    {
        return hash('sha256', $this->password . $this->serviceId . $value['PaymentID'] . $this->merchantReturlUrl . $value['Amount'] . $value['CurrencyCode'] . $this->getUserIp() . $this->pageTimeout);
    }

    /**
     * @return string
     */
    public function getUserIp(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($ip[0]);
        }

        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Validate payment response
     * @param array $data
     * @return boolean
     */
    public function validatePaymentResponse(array $data): bool
    {
        $hash = (hash('sha256', $this->password . $data["TxnID"] . $this->serviceId . $data["PaymentID"] . $data["TxnStatus"] . $data["Amount"] . $data["CurrencyCode"] . $data["AuthCode"]));

        return ($hash === $data["HashValue"]);
    }
}