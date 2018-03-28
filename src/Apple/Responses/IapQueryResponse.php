<?php

namespace Omnipay\Apple\Responses;

use Omnipay\Common\Message\AbstractResponse;

class IapQueryResponse extends AbstractResponse
{
    public function getData()
    {
        return $this->data['receipt'] ? $this->data['receipt'] : [];
    }

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        if (isset($this->data['status']) && $this->data['status'] != 0) {
            \Log::error('iap receipt verify failed status:' . $this->data['status']);
            return false;
        }
        return true;
    }
}
