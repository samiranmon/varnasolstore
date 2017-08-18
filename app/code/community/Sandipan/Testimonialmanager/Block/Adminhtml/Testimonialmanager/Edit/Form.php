<?php
class Sandipan_Testimonialmanager_Block_Adminhtml_Testimonialmanager_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

    protected function _prepareForm()
    {
        
         $attribute_code=Mage::getModel('eav/entity_attribute')->getIdByCode('catalog_product', "manufacturer");
            $attributeInfo = Mage::getModel('eav/entity_attribute')->load($attribute_code);
            $attribute_table = Mage::getModel('eav/entity_attribute_source_table')->setAttribute($attributeInfo);
            $attributeOptions = $attribute_table->getAllOptions(false);
            $default=array('value'=>'','label'=>'Choose Brand');
            $i=0;
            $manufacturer[$i]=$default;
            foreach($attributeOptions as $key=>$value){
                $i++;
                $manufacturer[$i]=$value;
            }
        
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
        
        $fieldset = $form->addFieldset('testimonial_form', array(
            'legend'	  => Mage::helper('testimonialmanager')->__('Testimonial'),
            )
        );
        
        $fieldset->addField('menufecturer_id', 'select', array(
                    'name'      => 'menufecturer_id',
                    'label'     => Mage::helper('testimonialmanager')->__('Select Brand'),
                    'required'  => true,
                    'class'     => 'required-entry',
                    'values'    =>$manufacturer,
                ));

        $fieldset->addField('testimonial_name', 'text', array(
            'name'      => 'testimonial_name',
            'label'     => Mage::helper('testimonialmanager')->__('Contact Name'),
            'required'  => true,
        ));

        $fieldset->addField('testimonial_company', 'text', array(
            'name'      => 'testimonial_company',
            'label'     => Mage::helper('testimonialmanager')->__('Product Name'),
           
        ));
        
        
          
        // Store selection 
        if (!Mage::app()->isSingleStoreMode()) {
        $fieldset->addField('stores', 'multiselect', array(
                                'name'      => 'stores[]',
                                'label'     => Mage::helper('cms')->__('Store View'),
                                'title'     => Mage::helper('cms')->__('Store View'),
                                'required'  => true,
                                'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
                ));
			}
            else {
        $fieldset->addField('stores', 'hidden', array(
                        'name'      => 'stores[]',
                        'value'     => Mage::app()->getStore(true)->getId()
        ));
        // $model->setStoreId(Mage::app()->getStore(true)->getId());
            }
        
        

        $fieldset->addField('testimonial_email', 'text', array(
            'name'      => 'testimonial_email',
            'label'     => Mage::helper('testimonialmanager')->__('Email'),
            'required'  => true,
	    'class'		=> ' validate-email',
        ));
		
        

        $fieldset->addField('testimonial_img', 'image', array(
            'name'      => 'testimonial_img',
            'label'     => Mage::helper('testimonialmanager')->__('Image'),
        ));

        $fieldset->addField('summary_rating', 'note', array(
            'label'     => Mage::helper('review')->__('Summary Rating'),
            'text'      => $this->getLayout()->createBlock('testimonialmanager/adminhtml_rating_summary')->toHtml(),
        ));

        $fieldset->addField('detailed_rating', 'note', array(
            'label'     => Mage::helper('review')->__('Detailed Rating'),
            'text'      => '<div id="rating_detail">'
                           . $this->getLayout()->createBlock('testimonialmanager/adminhtml_rating_detailed')->toHtml()
                           . '</div>',
        ));

        $fieldset->addField('testimonial_text', 'editor', array(
            'name'      => 'testimonial_text',
            'label'     => Mage::helper('testimonialmanager')->__('Text'),
            'title'     => Mage::helper('testimonialmanager')->__('Text'),
            'style'     => 'width:100%;height:200px;',
            'required'  => true,
        ));
        
        $fieldset->addField('testimonial_website', 'text', array(
            'name'      => 'testimonial_website',
            'label'     => Mage::helper('testimonialmanager')->__('City And State'),
		 'required'  => true,	
        ));

        $fieldset->addField('testimonial_position', 'text', array(
            'name'      => 'testimonial_position',
            'label'     => Mage::helper('testimonialmanager')->__('Sort Order / Position'),
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('testimonialmanager')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 3,
                    'label'     => Mage::helper('core')->__('Pending'),
                ),
                array(
                    'value'     => 2,
                    'label'     => Mage::helper('core')->__('Approved'),
                ),
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('core')->__('Not Approved'),
                ),
            ),
        ));

        $fieldset->addField('testimonial_sidebar', 'select', array(
            'label'     => Mage::helper('testimonialmanager')->__('Display in sidebox'),
            'name'      => 'testimonial_sidebar',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('core')->__('Yes'),
                ),
                array(
                    'value'     => 2,
                    'label'     => Mage::helper('core')->__('No'),
                ),
            ),
        ));

        if (Mage::registry('testimonialmanager')) {
            $form->setValues(Mage::registry('testimonialmanager')->getData());
        }

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}
