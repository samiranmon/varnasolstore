<?php

class Vlabs_Photo_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout()->_setActiveMenu('photo/set_time')
                ->_addBreadcrumb('test Manager', 'test Manager');
        return $this;
    }

    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function editAction() {
        $testId = $this->getRequest()->getParam('id');
        $testModel = Mage::getModel('photo/photo')->load($testId);
        if ($testModel->getId() || $testId == 0) {
            Mage::register('photo_data', $testModel);
            $this->loadLayout();
            $this->_setActiveMenu('photo/set_time');
            $this->_addBreadcrumb('photo Manager', 'photo Manager');
            $this->_addBreadcrumb('Photo Description', 'Photo Description');
            $this->getLayout()->getBlock('head')
                    ->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()
                            ->createBlock('photo/adminhtml_photo_edit'))
                    ->_addLeft($this->getLayout()
                            ->createBlock('photo/adminhtml_photo_edit_tabs')
            );
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')
                    ->addError('Test does not exist');
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        if ($this->getRequest()->getPost()) {
            try {
                $postData = $this->getRequest()->getPost();
                $testModel = Mage::getModel('photo/photo');
                if ($this->getRequest()->getParam('id') <= 0)
                    $testModel->setCreatedTime(
                            Mage::getSingleton('core/date')
                                    ->gmtDate()
                    );
                
                
                $uploader = new Varien_File_Uploader('image');
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png')); // or pdf or anything


                $uploader->setAllowRenameFiles(false);

                // setAllowRenameFiles(true) -> move your file in a folder the magento way
                // setAllowRenameFiles(true) -> move your file directly in the $path folder
                $uploader->setFilesDispersion(false);

                $path = Mage::getBaseDir('media') .'/slider/';

                $uploader->save($path, $_FILES['image']['name']);

                $postData['image'] = $_FILES['image']['name'];
               
//                  $a=$_POST['stores'];
// print_r($a);
//                  die;


                 if(count($_POST['stores']) > 0)
                                {
                                    $v = '';
                                    $last = count($_POST['stores']);
                                    $i = 1;
                                    foreach ($_POST['stores'] as $value)
                                    {
                                       $v .= $value;
                                       if($i != $last){$v .= ',';}
                                       
                                       $i++;
                                    }
                                    $postData['stores'] = $v;
                                }
                                else{
                                  $postData['stores'] = 0;
                                }


                $testModel
                        ->addData($postData)
                        ->setUpdateTime(
                                Mage::getSingleton('core/date')
                                ->gmtDate())
                        ->setId($this->getRequest()->getParam('id'))
                        ->save();
                
                Mage::getSingleton('adminhtml/session')
                        ->addSuccess('successfully saved');
                Mage::getSingleton('adminhtml/session')
                        ->settestData(false);
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                        ->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')
                        ->settestData($this->getRequest()
                                ->getPost()
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()
                            ->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $testModel = Mage::getModel('photo/photo');
                $testModel->setId($this->getRequest()
                                ->getParam('id'))
                        ->delete();
                Mage::getSingleton('adminhtml/session')
                        ->addSuccess('successfully deleted');
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                        ->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

}
