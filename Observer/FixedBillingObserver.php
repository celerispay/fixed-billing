<?php
namespace Boostsales\FixedBilling\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\ScopeInterface;

class FixedBillingObserver implements ObserverInterface{

    protected $_scopeConfig;

    const XML_CONFIG_PATH_ENABLE = 'general/fixedbilling/enable';
    const XML_CONFIG_PATH_FIRSTNAME = 'general/fixedbilling/firstname';
    const XML_CONFIG_PATH_LASTNAME = 'general/fixedbilling/lastname';
    const XML_CONFIG_PATH_STREET = 'general/fixedbilling/street';
    const XML_CONFIG_PATH_CITY = 'general/fixedbilling/city';
    const XML_CONFIG_PATH_COUNTRY = 'general/fixedbilling/country';
    const XML_CONFIG_PATH_DEPARTMENT = 'general/fixedbilling/department';
    const XML_CONFIG_PATH_POSTCODE = 'general/fixedbilling/postcode';
    const XML_CONFIG_PATH_TELEPHONE = 'general/fixedbilling/telephone';
    const XML_CONFIG_PATH_EMAIL = 'general/fixedbilling/email';
    const XML_CONFIG_PATH_COMPANY = 'general/fixedbilling/company';
    const XML_CONFIG_PATH_INVOICEEMAIL = 'general/fixedbilling/invoiceEmail';

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ){
        $this->_scopeConfig = $scopeConfig;
    }

    public function isEnabled(){
       $enable = $this->_scopeConfig->getValue(self::XML_CONFIG_PATH_ENABLE,ScopeInterface::SCOPE_STORE);
       return $enable;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer){

        if($this->isEnabled()){
            $order = $observer->getOrder();

            $order->getBillingAddress()->setFirstname($this->_scopeConfig->getValue(self::XML_CONFIG_PATH_FIRSTNAME,ScopeInterface::SCOPE_STORE));
            $order->getBillingAddress()->setLastname($this->_scopeConfig->getValue(self::XML_CONFIG_PATH_LASTNAME,ScopeInterface::SCOPE_STORE));
            $order->getBillingAddress()->setStreet($this->_scopeConfig->getValue(self::XML_CONFIG_PATH_STREET,ScopeInterface::SCOPE_STORE));
            $order->getBillingAddress()->setCity($this->_scopeConfig->getValue(self::XML_CONFIG_PATH_CITY,ScopeInterface::SCOPE_STORE));
            $order->getBillingAddress()->setCountryId($this->_scopeConfig->getValue(self::XML_CONFIG_PATH_COUNTRY,ScopeInterface::SCOPE_STORE));
            $order->getBillingAddress()->setPostcode($this->_scopeConfig->getValue(self::XML_CONFIG_PATH_POSTCODE,ScopeInterface::SCOPE_STORE));
            $order->getBillingAddress()->setTelephone($this->_scopeConfig->getValue(self::XML_CONFIG_PATH_TELEPHONE,ScopeInterface::SCOPE_STORE));
            $order->getBillingAddress()->setEmail($this->_scopeConfig->getValue(self::XML_CONFIG_PATH_EMAIL,ScopeInterface::SCOPE_STORE));
            $order->getBillingAddress()->setCompany($this->_scopeConfig->getValue(self::XML_CONFIG_PATH_COMPANY,ScopeInterface::SCOPE_STORE));
            $order->getBillingAddress()->setInvoiceEmail($this->_scopeConfig->getValue(self::XML_CONFIG_PATH_INVOICEEMAIL,ScopeInterface::SCOPE_STORE));
        } else {
            return $this;
        }
    }
}