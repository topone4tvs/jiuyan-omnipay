<?php
/**
 * Created by PhpStorm.
 * User: topone4tvs
 * Date: 2018/3/28
 * Time: 14:35
 */
namespace Omnipay\Jyalipay\Responses;

use Omnipay\Alipay\Responses\AbstractAopResponse;

class AgpUnSignAgreementResponse extends AbstractAopResponse
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