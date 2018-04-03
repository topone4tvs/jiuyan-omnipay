<?php

namespace Omnipay\Jyalipay\Requests;

use Omnipay\Alipay\Requests\AbstractAopRequest;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Jyalipay\Responses\AgpPayAndSignAgreementResponse;

/**
 * Class AopTradeAppPayRequest
 * @package Omnipay\Alipay\Requests
 * @link    https://doc.open.alipay.com/docs/doc.htm?treeId=204&articleId=105465&docType=1
 */
class AgpPayAndSignAgreementRequest extends AbstractAopRequest
{
    protected $method = 'alipay.trade.page.pay';

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $data['order_string'] = http_build_query($data);

        return $this->response = new AgpPayAndSignAgreementResponse($this, $data);
    }

    public function validateParams()
    {
        parent::validateParams();

        $this->validateBizContent('subject', 'out_trade_no', 'total_amount', 'product_code');
    }

    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->getParameter('notify_url');
    }

    /**
     * @param string $value
     * @return \Omnipay\Common\Message\AbstractRequest|$this
     */
    public function setNotifyUrl($value)
    {
        return $this->setParameter('notify_url', $value);
    }
}
