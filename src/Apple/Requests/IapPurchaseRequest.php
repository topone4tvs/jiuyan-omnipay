<?php

namespace Omnipay\Apple\Requests;

use Omnipay\Apple\Responses\IapPurchaseResponse;
use Omnipay\Common\Message\AbstractRequest;

/**
 * Class IapPurchaseRequest
 * @package Omnipay\Alipay\Requests
 * @link    https://doc.open.alipay.com/docs/doc.htm?treeId=59&articleId=103663&docType=1
 */
class IapPurchaseRequest extends AbstractRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        return [];
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
        return $this->response = new IapPurchaseResponse($this, $data);
    }
}
