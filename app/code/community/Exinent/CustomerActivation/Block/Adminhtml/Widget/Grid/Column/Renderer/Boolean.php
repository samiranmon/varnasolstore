<?php

class Exinent_CustomerActivation_Block_Adminhtml_Widget_Grid_Column_Renderer_Boolean extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Text {

    public function render(Varien_Object $row) {
        $data = $row->getCustomerActivated();
        if ($data == 'New')
            $data = 3;
        switch ($data) {
            case 1:
                return $this->__('Approved');
            case 2:
                return $this->__('Pending');
            case 0:
                return $this->__('Rejected');
            case 3:
                return $this->__('New');
            case 4:
                return $this->__('In Active');
            case 5:
                return $this->__('On Hold');
        }
    }

}
