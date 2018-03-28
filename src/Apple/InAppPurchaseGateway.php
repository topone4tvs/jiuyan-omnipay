<?php

namespace Omnipay\Apple;

use Omnipay\Apple\Requests\IapPurchaseRequest;
use Omnipay\Apple\Requests\IapQueryRequest;
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

    public function setEnvironment($environment)
    {
        return $this->setParameter('environment', $environment);
    }

    public function getEnvironment()
    {
        return strtoupper($this->getParameter('environment'));
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(IapQueryRequest::class, $parameters);
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
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function query(array $parameters = [])
    {
        return $this->createRequest(IapQueryRequest::class, $parameters);
    }
}
