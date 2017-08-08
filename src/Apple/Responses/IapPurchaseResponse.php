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
        if ($this->data['receipt'] && $this->data['status'] == 0) {
            return true;
        }
        return true;
    }
}
