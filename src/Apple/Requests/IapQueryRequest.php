<?php

namespace Omnipay\Apple\Requests;

use Omnipay\Apple\Responses\IapPurchaseResponse;
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
            'receipt' => $this->getReceipt()
        ];
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
        $request = $this->httpClient->post($endPoint)->setBody($data);
        $response = $request->send()->getBody();
        $responseBody = json_decode($response, true);

        return $this->response = new IapPurchaseResponse($this, $responseBody);
    }
}
