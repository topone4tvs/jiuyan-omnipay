<?php

namespace Omnipay\Apple;

use Omnipay\Alipay\Requests\LegacyAppPurchaseRequest;
use Omnipay\Apple\Requests\IapPurchaseRequest;
use Omnipay\Apple\Requests\InAppPurchaseRequest;
use Omnipay\Common\AbstractGateway;

/**
 * Class InAppPurchaseGateway
 * @package Omnipay\Apple
 */
class InAppPurchaseGateway extends AbstractGateway
{

    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     */
    public function getName()
    {
        return 'Apple InAppPurchase Payment Gateway';
    }


    public function getDefaultParameters()
    {
        $data = parent::getDefaultParameters();

        $data['signType'] = 'RSA';

        return $data;
    }

    /**
     * @param array $parameters
     *
     * @return LegacyCompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(LegacyCompletePurchaseRequest::class, $parameters);
    }


    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest(IapPurchaseRequest::class, $parameters);
    }

        /**
     * @param array $parameters
     *
     * @return LegacyQueryRequest
     */
    public function query(array $parameters = [])
    {
        return $this->createRequest(LegacyQueryRequest::class, $parameters);
    }
}
