<?php

namespace Omnipay\PayPal\Message;

/**
 * PayPal Express Authorize Request
 */
class ExpressUpdateRecurringPaymentsProfileRequest extends AbstractRequest
{
    const API_VERSION = '204.0';
    const METHOD = 'UpdateRecurringPaymentsProfile';

    /**
     * @return string
     */
    public function getProfileId()
    {
        return $this->getParameter('profileId');
    }

    /**
     * @param string $profileId
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setProfileId($profileId)
    {
        return $this->setParameter('profileId', $profileId);
    }

    /**
     * @return mixed
     */
    public function getProfileData()
    {
        return $this->getParameter('profile_data');
    }

    /**
     * @param $profileData
     *
     * @return mixed
     */
    public function setProfileData($profileData)
    {
        return $this->setParameter('profile_data', $profileData);
    }

    public function getData()
    {
        $this->validate('profileId');

        $data              = $this->getBaseData();
        $data['VERSION']   = self::API_VERSION;
        $data['METHOD']    = self::METHOD;
        $data['PROFILEID'] = $this->getProfileId();

        $profileData = $this->getProfileData();

        if (count($profileData)) {
            foreach ($profileData as $key => $value) {
                $data[$key] = $value;
            }
        }

        return $data;
    }
}
