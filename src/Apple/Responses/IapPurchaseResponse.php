<?php

namespace Omnipay\Apple\Responses;

use Omnipay\Common\Message\AbstractResponse;

class IapPurchaseResponse extends AbstractResponse
{

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return true;
    }
}
