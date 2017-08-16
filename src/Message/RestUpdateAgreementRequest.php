<?php
/**
 * PayPal REST Fetch Transaction Request
 */

namespace Omnipay\PayPal\Message;

/**
 * PayPal REST Update Agreement Request
 *
 * This sample code demonstrate how you can update a billing agreement, as documented here at:
 * https://developer.paypal.com/docs/api/payments.billing-agreements/#agreement_update
 * API used: /v1/payments/billing-agreements/<Agreement-Id>
 *
 * Example -- note this example assumes that the subscription creation request has been successful
 * and that there is already an agreement recorded in PayPal
 *
 * <code>
 *      curl -v -X PATCH https://api.sandbox.paypal.com/v1/payments/billing-agreements/I-1TJ3GAGG82Y9 \
 *          -H "Content-Type:application/json" \
 *          -H "Authorization: Bearer <Access-Token>" \
 *          -d '[{
 *                  "op": "replace",
 *                  "path": "/",
 *                  "value": {
 *                      "description": "Updated description.",
 *                      "start_date": "2017-12-22T09:13:49Z",
 *                      "shipping_address": {
 *                          "line1": "Hotel Blue Diamond",
 *                          "line2": "Church Street",
 *                          "city": "San Jose",
 *                          "state": "CA",
 *                          "postal_code": "95112",
 *                          "country_code": "US"
 *                      }
 *                  }
 *              }]'
 * </code>
 *
 * @see Omnipay\PayPal\RestGateway
 * @link https://developer.paypal.com/docs/api/payments.billing-agreements/#agreement_update
 */
class RestUpdateAgreementRequest extends AbstractRestRequest
{
    /**
     * Get the agreement id
     *
     * @return mixed
     */
    public function getAgreementId()
    {
        return $this->getParameter('agreementId');
    }

    /**
     * Set the agreement id
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setAgreementId($value)
    {
        return $this->setParameter('agreementId', $value);
    }

    /**
     * Get the Merchant Preferences for Agreement
     *
     * @return mixed
     */
    public function getMerchantPreferences()
    {
        return $this->getParameter('merchantPreferences');
    }

    /**
     * Set the Merchant Preferences for Agreement
     *
     * @return mixed
     */
    public function setMerchantPreferences(array $value)
    {
        return $this->setParameter('merchantPreferences', $value);
    }

    /**
     * Get HTTP Method.
     *
     * The HTTP method for fetchTransaction requests must be GET.
     * Using POST results in an error 500 from PayPal.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'PATCH';
    }

    /**
     * @return array
     */
    public function getData()
    {
        $this->validate('agreementId');

        $data = array(
            array(
                'path'  => '/',
                'value' => $this->getMerchantPreferences(),
                'op'    => 'replace'
            )
        );
        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return parent::getEndpoint() . '/payments/billing-agreements/' . $this->getAgreementId();
    }
}
