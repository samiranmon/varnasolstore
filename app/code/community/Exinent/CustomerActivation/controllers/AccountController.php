<?php

/**
 * Fontis Recaptcha Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category   Fontis
 * @package    Fontis_Recaptcha
 * @author     Denis Margetic
 * @author     Chris Norton
 * @copyright  Copyright (c) 2011 Fontis Pty. Ltd. (http://www.fontis.com.au)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
include_once "Mage/Customer/controllers/AccountController.php";

class Exinent_CustomerActivation_AccountController extends Mage_Customer_AccountController {
const XML_PATH_ACTIVATION_STATUS = 'customer/customeractivation/activation_status_default';
    public function createPostAction() {
        /** @var $session Mage_Customer_Model_Session */
        if (Mage::getStoreConfig("fontis_recaptcha/recaptcha/customer", Mage::app()->getStore()) && !($this->getRequest()->getPost('group_id'))) { // check that recaptcha is actually enabled
            $privatekey = Mage::getStoreConfig("fontis_recaptcha/setup/private_key", Mage::app()->getStore());

            // check response
            $resp = Mage::helper("fontis_recaptcha")->recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]
            );


            if ($resp == true) { // if recaptcha response is correct, use core functionality
                $this->getgeneralCustomer();
                parent::createPostAction();
            } else {

                $this->_getSession()->addError($this->__('Your reCAPTCHA entry is incorrect. Please try again.'));
                $this->_getSession()->setCustomerFormData($this->getRequest()->getPost());
                $this->_redirectReferer();
                return;
            }
        } else { // if recaptcha is not enabled, use core function
            $session = $this->_getSession();
            if ($session->isLoggedIn()) {
                $this->_redirect('*/*/');
                return;
            }
            $session->setEscapeMessages(true); // prevent XSS injection in user input
            if (!$this->getRequest()->isPost()) {
                $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
                $this->_redirectError($errUrl);
                return;
            }

            $customer = $this->_getCustomer();
            //$default_address = $this->getRequest()->getPost('default_shipping');
            
            $default_address = $this->getRequest()->getPost('both_not_same'); // Akash added new hidden field for checking

            $shipping_address = $this->getRequest()->getPost('shipping');
            //echo "<pre>";print_r($this->getRequest()->getPost());
            //echo "<pre>";print_r($this->getRequest()->getPost('shipping'));die();  
            
            //Billing & shipping address both are same
            if ($default_address == 1) {
                $customer = Mage::getModel('customer/customer');
                $customer->setWebsiteId(Mage::app()->getWebsite()->getId());
                $customer->loadByEmail($this->getRequest()->getPost('email'));
                $street = $this->getRequest()->getPost('street');

                if (!$customer->getId()) {
                    $customer->setEmail($this->getRequest()->getPost('email'));
                    $customer->setFirstname($this->getRequest()->getPost('firstname'));
                    $customer->setLastname($this->getRequest()->getPost('lastname'));
                    $customer->setPassword($this->getRequest()->getPost('password'));
                }

                try {
                    $customer->save(); //// Akash saved customer 
                    $customer->setConfirmation(null);
                    // $customer->save();

                    //Make a "login" of new customer
                    Mage::getSingleton('customer/session')->loginById($customer->getId());
                } catch (Exception $ex) {
                    //Zend_Debug::dump($ex->getMessage());
                }
				
                //create customer address array & set billing and shipping as same
                $_custom_address = array(
                    'firstname' => $this->getRequest()->getPost('firstname'),
                    'lastname' => $this->getRequest()->getPost('lastname'),
                    'street' => array(
                        '0' => $street[0],
                        '1' => $street[1],
                    ),
                    'city' => $this->getRequest()->getPost('city'),
                    'region_id' => $this->getRequest()->getPost('region_id'),
                    'region' => $this->getRequest()->getPost('region'),
                    'postcode' => $this->getRequest()->getPost('postcode'),
                    'country_id' => $this->getRequest()->getPost('country_id'),
                    'telephone' => $this->getRequest()->getPost('telephone'),
                );

                $customAddress = Mage::getModel('customer/address');
                $customAddress->setData($_custom_address)
                        ->setCustomerId($customer->getId())
                        ->setIsDefaultBilling('1')
                        ->setIsDefaultShipping('1')
                        ->setSaveInAddressBook('1');

                try {
                    $customAddress->save();
                } catch (Exception $ex) {
                    //Zend_Debug::dump($ex->getMessage());
                }
            } else { //Billing & shipping address both are not same
                $customer = Mage::getModel('customer/customer');

                $customer->setWebsiteId(Mage::app()->getWebsite()->getId());
                $customer->loadByEmail($this->getRequest()->getPost('email'));

                $street = $this->getRequest()->getPost('street');
                if (!$customer->getId()) {
                    $customer->setEmail($this->getRequest()->getPost('email'));
                    $customer->setFirstname($this->getRequest()->getPost('firstname'));
                    $customer->setLastname($this->getRequest()->getPost('lastname'));
                    $customer->setPassword($this->getRequest()->getPost('password'));
                }

                try {
                    $customer->setConfirmation(null);
                    $customer->save();
                    //Make a "login" of new customer
                    Mage::getSingleton('customer/session')->loginById($customer->getId());
                } catch (Exception $ex) {
                    
                }

                //Billing address array and save customer address
                $_custom_billing_address = array(
                    'firstname' => $this->getRequest()->getPost('firstname'),
                    'lastname' => $this->getRequest()->getPost('lastname'),
                    'street' => array(
                        '0' => $street[0],
                        '1' => $street[1],
                    ),
                    'city' => $this->getRequest()->getPost('city'),
                    'region_id' => $this->getRequest()->getPost('region_id'),
                    'region' => $this->getRequest()->getPost('region'),
                    'postcode' => $this->getRequest()->getPost('postcode'),
                    'country_id' => $this->getRequest()->getPost('country_id'),
                    'telephone' => $this->getRequest()->getPost('telephone'),
                );

                $customAddress_billing = Mage::getModel('customer/address');
                $customAddress_billing->setData($_custom_billing_address)
                        ->setCustomerId($customer->getId())
                        ->setIsDefaultBilling('1')
                        ->setSaveInAddressBook('1');

                try {
                    $customAddress_billing->save();
                } catch (Exception $ex) {
                    
                }

                //Shipping address array and save customer address
                $_custom_shipping_address = array(
                    'firstname' => $this->getRequest()->getPost('firstname'),
                    'lastname' => $this->getRequest()->getPost('lastname'),
                    'street' => array(
                        '0' => $shipping_address['street'][0],
                        '1' => $shipping_address['street'][1],
                    ),
                    'city' => $shipping_address['city'],
                    'region_id' => $shipping_address['region'],
                    'region' => $shipping_address['region'],
                    'postcode' => $shipping_address['postcode'],
                    'country_id' => $shipping_address['country_id'],
                    'telephone' => $shipping_address['telephone'],
                );

                $customAddress_shipping = Mage::getModel('customer/address');
                $customAddress_shipping->setData($_custom_shipping_address)
                        ->setCustomerId($customer->getId())
                        ->setIsDefaultShipping('1')
                        ->setSaveInAddressBook('1');

                try {
                    $customAddress_shipping->save();
                } catch (Exception $ex) {
                    $message = $ex->getMessage();
                    print_r($message);
                }
                //die();
            }

            //set extra parameters and save customer
            
            //// Akash
            if ($this->getRequest()->getPost('group_id')) {
                $customer->setGroupId($this->getRequest()->getPost('group_id'));
            } else {
                $customer->getGroupId();
            }
            $storeId = Mage::helper('customeractivation')->getCustomerStoreId($customer);
            $defaultStatus = Mage::helper('customeractivation')->getDefaultActivationStatus($this->getRequest()->getPost('group_id'), $storeId);
             if (Mage::getStoreConfig(self::XML_PATH_ACTIVATION_STATUS, Mage::app()->getStore()) == 1) {
               $customer->setCustomerActivated('1');    
             }else{
                $customer->setCustomerActivated('New');
            }
            //// Akash

            $customer->setUniqueloginId(Mage::helper('core')->getRandomString(9, '0123456789'));
            $customer->setUpsNumber($this->getRequest()->getPost('upsnumber'));
            $customer->setFedexNumber($this->getRequest()->getPost('fedexnumber'));
            $customer->setAccountspayableEmail($this->getRequest()->getPost('accountpayble_email'));
            $customer->setStoreType($this->getRequest()->getPost('storetype'));
            $customer->setWebsiteUrl($this->getRequest()->getPost('website_url'));
            $customer->setIswebsiteLive($this->getRequest()->getPost('iswebsitelive'));
            $customer->setDateFounded($this->getRequest()->getPost('datefounded'));
            $customer->setPaymentmethods($this->getRequest()->getPost('paymentterms'));
            $customer->setRepresentativeEmail($this->getRequest()->getPost('representative_email'));
            $brandsCarry = $this->getRequest()->getPost('brandsyoucarry');

            if ($customer->getGroupId() == 2) {
                $brands = implode(',', $brandsCarry);
                $customer->setBrandsCarry($brands);
            }
                
              /*  try {
                $logoImage='';
                $uploader = new Varien_File_Uploader('attachment');
                $uploader->setFilesDispersion(true);
                $uploader->setFilenamesCaseSensitivity(false);              
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png', 'pdf'));
                $uploader->setAllowRenameFiles(true);
                $path = Mage::getBaseDir('media') . DS . 'customerlogs' . DS;
                $uploader->save($path, $_FILES['attachment']['name']);
                $fileName = $uploader->getUploadedFileName();
                $logoImage = 'customerlogs/' . $fileName;
                $customer->setLogoImage($logoImage);
                    
                } catch (Exception $e) {
                    echo $e->getMessage();
                    Mage::log($e->getMessage());
                }
                */
              

            /*try {
                $paymentreferenceImage = null;
                $paymentreference = new Varien_File_Uploader('net30reference');
                $uploader->setAllowedExtensions(array('doc', 'pdf', 'txt', 'docx', 'jpg', 'jpeg', 'gif', 'png'));
                $paymentreference->setAllowRenameFiles(true);
                $paymentreferencepath = Mage::getBaseDir('media') . DS . 'net30Reference' . DS;
                $imgpath = $paymentreference->save($paymentreferencepath, $_FILES['net30reference']['name']);
                $paymentreferenceImage = 'net30Reference/' . $_FILES['net30reference']['name'];
                $customer->setNet30Reference($paymentreferenceImage);
            } catch (Exception $e) {
                echo $e->getMessage();
                Mage::log($e->getMessage());
            }*/

            $customer->save();

            $this->_dispatchRegisterSuccess($customer);
            $this->_successProcessRegistration($customer);
            //send email to customer
            if ($customer->getGroupId() == 2) {
                Mage::helper('customeractivation')->sendCustomer1NotificationEmail($customer);
            }

            $errUrl = $this->_getUrl('*/*/login', array('_secure' => true));
            $this->_redirectError($errUrl);
        }
    }

    public function getgeneralCustomer() {
        /** @var $session Mage_Customer_Model_Session */
        $session = $this->_getSession();
        if ($session->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }
        $session->setEscapeMessages(true); // prevent XSS injection in user input
        if (!$this->getRequest()->isPost()) {
            $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
            $this->_redirectError($errUrl);
            return;
        }

        $customer = $this->_getCustomer();

        try {
            $errors = $this->_getCustomerErrors($customer);

            if (empty($errors)) {
                //$customer->save();
                //$this->_dispatchRegisterSuccess($customer);
                //$this->_successProcessRegistration($customer);

                Mage::helper('customeractivation')->sendCustomerNotificationEmail($customer);


                return;
            } else {
                $this->_addSessionError($errors);
            }
        } catch (Mage_Core_Exception $e) {
            $session->setCustomerFormData($this->getRequest()->getPost());
            if ($e->getCode() === Mage_Customer_Model_Customer::EXCEPTION_EMAIL_EXISTS) {
                $url = $this->_getUrl('customer/account/forgotpassword');
                $message = $this->__('There is already an account with this email address. If you are sure that it is your email address, <a href="%s">click here</a> to get your password and access your account.', $url);
                $session->setEscapeMessages(false);
            } else {
                $message = $e->getMessage();
            }
            $session->addError($message);
        } catch (Exception $e) {
            $session->setCustomerFormData($this->getRequest()->getPost())
                    ->addException($e, $this->__('Cannot save the customer.'));
        }
        $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
        $this->_redirectError($errUrl);
    }

    public function loginPostAction() {
        $groupid = $this->getRequest()->getParam('groupname');
        Mage::getSingleton('customer/session')->unsetMygroupId();
        Mage::getSingleton('customer/session')->setMygroupId($groupid);
        Mage::register('groupId', $groupid);
        if (!$this->_validateFormKey()) {
            $this->_redirect('*/*/');
            return;
        }

        if ($this->_getSession()->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }
        $session = $this->_getSession();

        if ($this->getRequest()->isPost()) {
            $login = $this->getRequest()->getPost('login');
            if (!empty($login['username']) && !empty($login['password'])) {
                try {
                    $session->login($login['username'], $login['password']);
                    if ($session->getCustomer()->getIsJustConfirmed()) {
                        $this->_welcomeCustomer($session->getCustomer(), true);
                    }
                } catch (Mage_Core_Exception $e) {
                    switch ($e->getCode()) {
                        case Mage_Customer_Model_Customer::EXCEPTION_EMAIL_NOT_CONFIRMED:
                            $value = $this->_getHelper('customer')->getEmailConfirmationUrl($login['username']);
                            $message = $this->_getHelper('customer')->__('This account is not confirmed. <a href="%s">Click here</a> to resend confirmation email.', $value);
                            break;
                        case Mage_Customer_Model_Customer::EXCEPTION_INVALID_EMAIL_OR_PASSWORD:
                            $message = $e->getMessage();
                            break;
                        default:
                            $message = $e->getMessage();
                    }
                    $session->addError($message);
                    $session->setUsername($login['username']);
                } catch (Exception $e) {
                    // Mage::logException($e); // PA DSS violation: this exception log can disclose customer password
                }
            } else {
                $session->addError($this->__('Login and password are required.'));
            }
        }
        $this->_loginPostRedirect();
    }

    protected function _loginPostRedirect() {
        $mygroupId = Mage::getSingleton('customer/session')->getMygroupId();
        $session = $this->_getSession();
        if ($mygroupId != 2 || $session->getId() != null) {
            Mage::getModel('core/session')->setMessages(Mage::getModel('core/message_collection'));
            return parent::_loginPostRedirect();
        } elseif ($mygroupId == 2 && $session->getId() == null) {
            Mage::getModel('core/session')->addError('AccountId or Password is Invalid');
            $this->_redirect('customerActivation/index/wholesalelogin/');
        }
        if (!$session->getBeforeAuthUrl() || $session->getBeforeAuthUrl() == Mage::getBaseUrl()) {
            // Set default URL to redirect customer to
            $session->setBeforeAuthUrl($this->_getHelper('customer')->getAccountUrl());
            // Redirect customer to the last page visited after logging in
            if ($session->isLoggedIn()) {
                if (!Mage::getStoreConfigFlag(
                                Mage_Customer_Helper_Data::XML_PATH_CUSTOMER_STARTUP_REDIRECT_TO_DASHBOARD
                        )) {
                    $referer = $this->getRequest()->getParam(Mage_Customer_Helper_Data::REFERER_QUERY_PARAM_NAME);
                    if ($referer) {
                        // Rebuild referer URL to handle the case when SID was changed
                        $referer = $this->_getModel('core/url')
                                ->getRebuiltUrl($this->_getHelper('core')->urlDecode($referer));
                        if ($this->_isUrlInternal($referer)) {
                            $session->setBeforeAuthUrl($referer);
                        }
                    }
                } else if ($session->getAfterAuthUrl()) {
                    $session->setBeforeAuthUrl($session->getAfterAuthUrl(true));
                }
            } else {
                $session->setBeforeAuthUrl($this->_getHelper('customer')->getLoginUrl());
            }
        } else if ($session->getBeforeAuthUrl() == $this->_getHelper('customer')->getLogoutUrl()) {

            $session->setBeforeAuthUrl($this->_getHelper('customer')->getDashboardUrl());
        } else {
            if (!$session->getAfterAuthUrl()) {
                $session->setAfterAuthUrl($session->getBeforeAuthUrl());
            }
            if ($session->isLoggedIn()) {
                $session->setBeforeAuthUrl($session->getAfterAuthUrl(true));
            }
        }
    }

}

?>
