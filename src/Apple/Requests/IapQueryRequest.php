<?php

namespace Omnipay\Apple\Requests;

use Omnipay\Apple\Responses\IapQueryResponse;
use Omnipay\Common\Message\AbstractRequest;

/**
 * Class IapPurchaseRequest
 * @package Omnipay\Alipay\Requests
 * @link    https://doc.open.alipay.com/docs/doc.htm?treeId=59&articleId=103663&docType=1
 */
class IapQueryRequest extends AbstractRequest
{
    protected $_endpoint = 'https://buy.itunes.apple.com/verifyReceipt';
    protected $_testEndpoint = 'https://sandbox.itunes.apple.com/verifyReceipt';


    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        return [
            'receipt-data' => $this->getReceipt()
        ];
    }

    public function setPaymentStatus($paymentStatus)
    {
        $this->setParameter('payment_status', $paymentStatus);
    }

    public function getPaymentStatus()
    {
        return $this->getParameter('payment_status');
    }

    public function setTransactionId($transactionId)
    {
        $this->setParameter('transaction_id', $transactionId);
    }

    public function getTransactionId()
    {
        return $this->getParameter('transaction_id');
    }

    public function setEnvironment($environment)
    {
        $this->setParameter('environment', $environment);
    }

    public function getEnvironment()
    {
        return $this->getParameter('environment');
    }

    public function setReceipt($receiptData)
    {
        $this->setParameter('receipt', $receiptData);
    }

    public function getReceipt()
    {
        return $this->getParameter('receipt');
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $endPoint = $this->_endpoint;
        if ($this->getEnvironment() == 'test') {
            $endPoint = $this->_testEndpoint;
        }

        /**
         * 只要通知过来的支付状态不是成，则都不进行校验，因为只要成功状态下，才会把凭据传过来
         */
        if ($this->getPaymentStatus() != 1) {
            $finalResponse = [
                'status' => 0,
                'receipt' => ['ok']
            ];
            return $this->response = new IapQueryResponse($this, $finalResponse);
        }

        $request = $this->httpClient->post($endPoint)->setBody(json_encode($data), 'application/json');
        $responseBody = $request->send()->json();
        $currentTransactionId = $this->getTransactionId();
        $transactionData = isset($responseBody['receipt']['in_app']) ? $responseBody['receipt']['in_app'] : [];
        $finalReceipt = [];
        foreach ($transactionData as $item) {
            if ($item && isset($item['transaction_id']) && $item['transaction_id'] && $currentTransactionId == $item['transaction_id']) {
                $finalReceipt = $item; 
            }
        }
        $finalResponse = [
            'status' => $responseBody['status'],
            'receipt' => $finalReceipt
        ];
        if (in_array($finalResponse['status'], [21007, 21008])) {
            if ($finalResponse['status'] == 21007) {
                $this->setEnvironment('test');
            } else {
                $this->setEnvironment('product');
            }
            return $this->sendData($data);
        } else {
            return $this->response = new IapQueryResponse($this, $finalResponse);
        }
        //list($response, $error) = $this->post($endPoint, json_encode($data));
        //$responseBody = json_decode($response, true);

    }
}
