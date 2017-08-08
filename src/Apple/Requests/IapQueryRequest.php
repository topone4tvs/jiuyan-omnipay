<?php

namespace Omnipay\Apple\Requests;

use Omnipay\Apple\Responses\IapQueryResponse;

/**
 * Class IapPurchaseRequest
 * @package Omnipay\Alipay\Requests
 * @link    https://doc.open.alipay.com/docs/doc.htm?treeId=59&articleId=103663&docType=1
 */
class IapQueryRequest extends AppleBaseRequest
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
        //$endPoint = 'http://qainlove.in66.com/api/script/talent/ranking/score/recording?action_category=photo&action_user_id=100779025&item_owner_id=10025&ext_params={"photo_id":["989006186"],"currentUserId":103417211}';
        //$request = $this->httpClient->post($endPoint)->setPostField('receipt-data', $data['receipt-data']);
        list($response, $error) = $this->post($endPoint, json_encode($data));
        $responseBody = json_decode($response, true);

        return $this->response = new IapQueryResponse($this, $responseBody);
    }
}
