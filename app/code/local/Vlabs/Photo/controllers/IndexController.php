<?php

class Vlabs_Photo_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveAction() {
        
        $title = $this->getRequest()->getPost('title');
        $image = $this->getRequest()->getPost('image');die;
        //$telephone = '' . $this->getRequest()->getPost('telephone');

        if (isset($title) && ($title != '') && isset($image) && ($image != '')) {
            //on cree notre objet et on l'enregistre en base
            $contact = Mage::getModel('photo/photo');
            $contact->setData('title', $title);
            $contact->setData('image', $image);
            //$contact->setData('telephone', $telephone);
            $contact->save();
        }
        
        $this->_redirect('photo/index/index');
    }

}
