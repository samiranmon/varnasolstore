<?php

class Exinent_CustomerActivation_Model_Observer {

    const XML_PATH_MODULE_DISABLED = 'customer/customeractivation/disable_ext';
    const XML_PATH_ALWAYS_NOTIFY_ADMIN = 'customer/customeractivation/always_send_admin_email';
    const XML_PATH_ACTIVATION_STATUS = 'customer/customeractivation/activation_status_default';
    const XML_PATH_ACTIVATION_START_DATE = 'customer/customeractivation/date_start';
    const XML_PATH_ACTIVATION_END_DATE = 'customer/customeractivation/date_end';

    public function page_block_html_topmenu_gethtml_before(Varien_Event_Observer $observer) {

        $session = Mage::getSingleton('customer/session');
        $customerGroupId = $session->getCustomerGroupId();
        if ($customerGroupId == 2) {
            $event = $observer->getEvent();
            $menu = $event->getMenu();
            $menuCollection = $menu->getChildren();

            if ($block = Mage::app()->getLayout()->getBlock('catalog.topnav')) {
                if ($links = $block->getAdditionalLinks()) {
                    foreach ($links as $link) {
                        $data = array(
                            'id' => 'category-additionalnode-' . crc32($link['url']),
                            'name' => $link['label'],
                            'url' => $link['url'],
                            'is_active' => $link['is_active'],
                        );

                        $node = new Varien_Data_Tree_Node($data, 'id', $menu->getTree());
                        $menuCollection->add($node);
                    }
                }
            }
        }
    }

    public function customerLogin($observer) {

        if (Mage::getStoreConfig(self::XML_PATH_MODULE_DISABLED, Mage::app()->getStore()) == 0) {
            return;
        }

        if ($this->_isApiRequest()) {
            return;
        }

        $customer = $observer->getEvent()->getCustomer();
        if ($customer->getGroupId() == '1') {
            return;
        }
        $session = Mage::getSingleton('customer/session');

        if ($customer->getCustomerActivated() == 'New' || $customer->getCustomerActivated() == 2 || $customer->getCustomerActivated() == 0 || $customer->getCustomerActivated() == 4 || $customer->getCustomerActivated() == 5) {
            /*
             * Fake the old logout() method without deleting the session and all messages
             *///echo 'status'.$customer->getCustomerActivated();

            $session->setCustomer(Mage::getModel('customer/customer'))
                    ->setId(null)
                    ->setCustomerGroupId(Mage_Customer_Model_Group::NOT_LOGGED_IN_ID);
            if ($this->_checkRequestRoute('customer', 'account', 'createpost') || $session->getNewRegistration() == 1) {
                /*
                 * If this is a regular registration, simply display message
                 */
                $message = Mage::helper('customeractivation')->__('Thank you! Admin representative will contact you shortly regarding your application.');

                $session->addSuccess($message);
                $session->setNewRegistration(0);
            } else {
                /*
                 * All other types of login
                 */
                Mage::throwException(Mage::helper('customeractivation')->__('This account is not approved.'));
            }
        }
    }

    public function customerSaveBefore($observer) {
        $customer = $observer->getEvent()->getCustomer();
		

        $storeId = Mage::helper('customeractivation')->getCustomerStoreId($customer);

        if (Mage::getStoreConfig(self::XML_PATH_MODULE_DISABLED, $storeId) == 0) {
            return;
        }

        if (!$customer->getId()) {
            $customer->setCustomerActivationNewAccount(true);
            if (!(Mage::app()->getStore()->isAdmin() && $this->_checkControllerAction('customer', 'save'))) {
                // Do not set the default status on the admin customer edit save action
                $groupId = $customer->getGroupId();
                $defaultStatus = Mage::helper('customeractivation')->getDefaultActivationStatus($groupId, $storeId);
                $startdate = Mage::getStoreConfig(self::XML_PATH_ACTIVATION_START_DATE, Mage::app()->getStore());
                $enddate = Mage::getStoreConfig(self::XML_PATH_ACTIVATION_END_DATE, Mage::app()->getStore());

                $paymentDate = date('Y-m-d');
                $paymentDate = date('Y-m-d', strtotime($paymentDate));

                $contractDateBegin = date('Y-m-d', strtotime($startdate));
                $contractDateEnd = date('Y-m-d', strtotime($enddate));

                if ($paymentDate > $contractDateBegin && $paymentDate < $contractDateEnd) {
			
                    $date_range = 'between';
                } else if ($paymentDate > $contractDateBegin && $enddate == '') {
                    $date_range = 'notmentioned';
					
                } else {
                    $date_range = 'notin';
                }

                $groupId = $customer->getGroupId();
                $defaultStatus = Mage::helper('customeractivation')->getDefaultActivationStatus($groupId, $storeId);
                if ($customer->getGroupId() == 1) {
                    $customer->setCustomerActivated('1');
                } else if (Mage::getStoreConfig(self::XML_PATH_ACTIVATION_STATUS, Mage::app()->getStore()) == 1) {
					if(($date_range == 'between') || ($date_range == 'notmentioned')) {
					$customer->setCustomerActivated('1');					
				}
			} else {
                    $customer->setCustomerActivated('New');
                }


                if (!$defaultStatus) {
                    // Suppress the "enter your billing address for VAT validation" message.
                    // This setting will not be saved, its just for this request.
                    $helper = Mage::helper('customer/address');
                    if (method_exists($helper, 'isVatValidationEnabled')) {
                        if (is_callable(array($helper, 'isVatValidationEnabled'))) {
                            if (Mage::helper('customer/address')->isVatValidationEnabled($storeId)) {
                                Mage::app()->getStore($storeId)->setConfig(
                                        Mage_Customer_Helper_Address::XML_PATH_VAT_VALIDATION_ENABLED, false
                                );
                            }
                        }
                    }
                }
            }
        }
    }

    public function customerSaveAfter($observer) {
        /** @var Mage_Customer_Model_Customer $customer */
        $customer = $observer->getEvent()->getCustomer();
		
        $storeId = Mage::helper('customeractivation')->getCustomerStoreId($customer);

        if (Mage::getStoreConfig(self::XML_PATH_MODULE_DISABLED, $storeId) == 0) {
            return;
        }

        $startdate = Mage::getStoreConfig(self::XML_PATH_ACTIVATION_START_DATE, Mage::app()->getStore());
        $enddate = Mage::getStoreConfig(self::XML_PATH_ACTIVATION_END_DATE, Mage::app()->getStore());

        $paymentDate = date('Y-m-d');
        $paymentDate = date('Y-m-d', strtotime($paymentDate));

        $contractDateBegin = date('Y-m-d', strtotime($startdate));
        $contractDateEnd = date('Y-m-d', strtotime($enddate));
		

        if ($paymentDate > $contractDateBegin && $paymentDate < $contractDateEnd) {
            $date_range = 'between';
        } else if ($paymentDate > $contractDateBegin && $enddate == '') {
            $date_range = 'notmentioned';
        } else {
            $date_range = 'notin';
        }

        $groupId = $customer->getGroupId();
        $defaultStatus = Mage::helper('customeractivation')->getDefaultActivationStatus($groupId, $storeId);
		
		
        if ($customer->getGroupId() == 1) {
            $customer->setCustomerActivated('1');			
        } else if (Mage::getStoreConfig(self::XML_PATH_ACTIVATION_STATUS, Mage::app()->getStore()) == 1) {
			if(($date_range == 'between') || ($date_range == 'notmentioned')) {
            $customer->setCustomerActivated('1');            
			}
        } else {
            $customer->setCustomerActivated('New');			
        }

        try {
            if (Mage::app()->getStore()->isAdmin()) {
                if (!$customer->getOrigData('customer_activated') && $customer->getCustomerActivated()) {
                    // Send customer email only if it isn't a new account and it isn't activated by default
                    if (!($customer->getCustomerActivationNewAccount() && $defaultStatus)) {
                        Mage::helper('customeractivation')->sendCustomerNotificationEmail($customer);
                    }
                }
            } else {
                if ($customer->getCustomerActivationNewAccount()) {
                    // Only notify the admin if the default is deactivated or the "always notify" flag is configured
                    $alwaysNotify = Mage::getStoreConfig(self::XML_PATH_ALWAYS_NOTIFY_ADMIN, $storeId);
                    if (!$defaultStatus || $alwaysNotify) {
                        Mage::helper('customeractivation')->sendAdminNotificationEmail($customer);
                    }
                }
                $customer->setCustomerActivationNewAccount(false);
            }
        } catch (Exception $e) {
            Mage::throwException($e->getMessage());
        }
    }

    public function salesCovertQuoteAddressToOrder(Varien_Event_Observer $observer) {
        /** @var $address Mage_Sales_Model_Quote_Address */
        $address = $observer->getEvent()->getAddress();
        $this->_abortCheckoutRegistration($address->getQuote());
    }

    protected function _abortCheckoutRegistration(Mage_Sales_Model_Quote $quote) {
        if (Mage::getStoreConfig(self::XML_PATH_MODULE_DISABLED, $quote->getStoreId()) == 0) {
            return;
        }

        if ($this->_isApiRequest()) {
            return;
        }

        if (!Mage::getSingleton('customer/session')->isLoggedIn() && !$quote->getCustomerIsGuest()) {
            // Order is being created by non-activated customer
            $customer = $quote->getCustomer()->save();
            if ($customer->getGroupId() == 1) {
                return;
            }
            if ($customer->getCustomerActivated() == 'New' || $customer->getCustomerActivated() == 2 || $customer->getCustomerActivated() == 0 || $customer->getCustomerActivated() == 4 || $customer->getCustomerActivated() == 5) {

                $message = Mage::helper('customeractivation')->__(
                        'Please wait for your account to be activated, then log in and continue with the checkout'
                );
                Mage::getSingleton('core/session')->addSuccess($message);

                // Handle redirect to login page
                $targetUrl = Mage::getUrl('customer/account/login');
                $response = Mage::app()->getResponse();

                if (Mage::app()->getRequest()->isAjax()) {
                    // Assume one page checkout
                    $result = array('redirect' => $targetUrl);
                    $response->setBody(Mage::helper('core')->jsonEncode($result));
                } else if ($response->canSendHeaders(true)) {
                    // Assume multishipping checkout
                    $response->clearHeader('location')
                            ->setRedirect($targetUrl);
                }
                $response->sendResponse();
                /* ugly, but we need to stop the further order processing */
                exit();
            }
        }
    }

    protected function _isApiRequest() {
        return Mage::app()->getRequest()->getModuleName() === 'api';
    }

    protected function _checkRequestRoute($module, $controller, $action) {
        $req = Mage::app()->getRequest();
        if (strtolower($req->getModuleName()) == $module && strtolower($req->getControllerName()) == $controller && strtolower($req->getActionName()) == $action
        ) {
            return true;
        }
        return false;
    }

    protected function _checkControllerAction($controller, $action) {
        $req = Mage::app()->getRequest();
        return $this->_checkRequestRoute($req->getModuleName(), $controller, $action);
    }

    public function adminhtmlBlockHtmlBefore(Varien_Event_Observer $observer) {
        // Check the grid is the customer grid
        if ($observer->getBlock()->getId() != 'customerGrid') {
            return;
        }

        // Check if there is a massaction block and if yes, add the massaction for customeractivation
        $massBlock = $observer->getBlock()->getMassactionBlock();
        if ($massBlock) {
            /** @var $helper Exinent_CustomerActivation_Helper_Data */
            $helper = Mage::helper('customeractivation');

            $noEmail = Exinent_CustomerActivation_Helper_Data::STATUS_ACTIVATE_WITHOUT_EMAIL;
            $withEmail = Exinent_CustomerActivation_Helper_Data::STATUS_ACTIVATE_WITH_EMAIL;
            $deactivate = Exinent_CustomerActivation_Helper_Data::STATUS_DEACTIVATE;

            $massBlock->addItem(
                    'customer_activated', array(
                'label' => $helper->__('Activate Customer'),
                'url' => Mage::getUrl('customeractivation/admin/massActivation'),
                'additional' => array(
                    'status' => array(
                        'name' => 'customer_activated',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => $helper->__('Customer Activated'),
                        'values' => array(
                            2 => $helper->__('Pending'),
                            1 => $helper->__('Approved'),
                            0 => $helper->__('Rejected'),
                            4 => $helper->__('In Active'),
                            5 => $helper->__('On Hold')
                        )
                    )
                )
                    )
            );
        }
    }

    public function eavCollectionAbstractLoadBefore(Varien_Event_Observer $observer) {
        if (Mage::getStoreConfig(self::XML_PATH_MODULE_DISABLED, Mage::app()->getStore()) == 0) {
            return;
        }

        // Cheap check to reduce overhead on product and category collections
        if (Mage::app()->getRequest()->getControllerName() !== 'customer') {
            return;
        }

        /** @var $collection Mage_Customer_Model_Resource_Customer_Collection */
        $collection = $observer->getEvent()->getCollection();

        // Only add attribute to customer collections
        $customerTypeId = Mage::getSingleton('eav/config')->getEntityType('customer')->getId();
        $collectionTypeId = $collection->getEntity()->getTypeId();
        if ($customerTypeId == $collectionTypeId) {
            $collection->addAttributeToSelect('customer_activated');
        }
    }

}
