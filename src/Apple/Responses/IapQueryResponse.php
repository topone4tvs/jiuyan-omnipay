<?php

namespace Omnipay\Apple\Responses;

use Omnipay\Common\Message\AbstractResponse;

class IapQueryResponse extends AbstractResponse
{
    public function getData()
    {
        $finalData = isset($this->data['receipt']['in_app']) ? $this->data['receipt']['in_app'][0] : [];
        return $finalData;
    }

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
        return false;
    }
}
