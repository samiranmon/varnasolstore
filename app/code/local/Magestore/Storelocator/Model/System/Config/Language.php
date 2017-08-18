<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Storelocator
 * @module      Storelocator
 * @author      Magestore Developer
 *
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 *
 */

/**
 * Class Magestore_Storelocator_Model_System_Config_Language
 */
class Magestore_Storelocator_Model_System_Config_Language {

    /**
     * @return array
     */
    public function toOptionArray() {
        $options = array(
            array('value' => 'ca_ES', 'label' => Mage::helper('storelocator')->__('Catalan')),
            array('value' => 'cs_CZ', 'label' => Mage::helper('storelocator')->__('Czech')),
            array('value' => 'cy_GB', 'label' => Mage::helper('storelocator')->__('Welsh')),
            array('value' => 'da_DK', 'label' => Mage::helper('storelocator')->__('Danish')),
            array('value' => 'de_DE', 'label' => Mage::helper('storelocator')->__('German')),
            array('value' => 'eu_ES', 'label' => Mage::helper('storelocator')->__('Basque')),
            array('value' => 'en_PI', 'label' => Mage::helper('storelocator')->__('English (Pirate)')),
            array('value' => 'en_UD', 'label' => Mage::helper('storelocator')->__('English (Upside Down)')),
            array('value' => 'ck_US', 'label' => Mage::helper('storelocator')->__('Cherokee')),
            array('value' => 'en_US', 'label' => Mage::helper('storelocator')->__('English (US)')),
            array('value' => 'es_LA', 'label' => Mage::helper('storelocator')->__('Spanish')),
            array('value' => 'es_CL', 'label' => Mage::helper('storelocator')->__('Spanish (Chile)')),
            array('value' => 'es_CO', 'label' => Mage::helper('storelocator')->__('Spanish (Colombia)')),
            array('value' => 'es_ES', 'label' => Mage::helper('storelocator')->__('Spanish (Spain)')),
            array('value' => 'es_MX', 'label' => Mage::helper('storelocator')->__('Spanish (Mexico)')),
            array('value' => 'es_VE', 'label' => Mage::helper('storelocator')->__('Spanish (Venezuela)')),            
            array('value' => 'fi_FI', 'label' => Mage::helper('storelocator')->__('Finnish')),
            array('value' => 'fr_FR', 'label' => Mage::helper('storelocator')->__('French (France)')),
            array('value' => 'gl_ES', 'label' => Mage::helper('storelocator')->__('Galician')),
            array('value' => 'hu_HU', 'label' => Mage::helper('storelocator')->__('Hungarian')),
            array('value' => 'it_IT', 'label' => Mage::helper('storelocator')->__('Italian')),
            array('value' => 'ja_JP', 'label' => Mage::helper('storelocator')->__('Japanese')),
            array('value' => 'ko_KR', 'label' => Mage::helper('storelocator')->__('Korean')),
            array('value' => 'nb_NO', 'label' => Mage::helper('storelocator')->__('Norwegian (bokmal)')),
            array('value' => 'nn_NO', 'label' => Mage::helper('storelocator')->__('Norwegian (nynorsk)')),
            array('value' => 'nl_NL', 'label' => Mage::helper('storelocator')->__('Dutch')),
            array('value' => 'pl_PL', 'label' => Mage::helper('storelocator')->__('Polish')),
            array('value' => 'pt_BR', 'label' => Mage::helper('storelocator')->__('Portuguese (Brazil)')),
            array('value' => 'pt_PT', 'label' => Mage::helper('storelocator')->__('Portuguese (Portugal)')),
            array('value' => 'ro_RO', 'label' => Mage::helper('storelocator')->__('Romanian')),
            array('value' => 'ru_RU', 'label' => Mage::helper('storelocator')->__('Russian')),
            array('value' => 'sk_SK', 'label' => Mage::helper('storelocator')->__('Slovak')),
            array('value' => 'sl_SI', 'label' => Mage::helper('storelocator')->__('Slovenian')),
            array('value' => 'sv_SE', 'label' => Mage::helper('storelocator')->__('Swedish')),
            array('value' => 'th_TH', 'label' => Mage::helper('storelocator')->__('Thai')),
            array('value' => 'ku_TR', 'label' => Mage::helper('storelocator')->__('Kurdish')),
            array('value' => 'zh_CN', 'label' => Mage::helper('storelocator')->__('Simplified Chinese (China)')),
            array('value' => 'zh_HK', 'label' => Mage::helper('storelocator')->__('Traditional Chinese (Hong Kong)')),
            array('value' => 'zh_TW', 'label' => Mage::helper('storelocator')->__('Traditional Chinese (Taiwan)')),
            array('value' => 'fb_LT', 'label' => Mage::helper('storelocator')->__('Leet Speak')),
            array('value' => 'af_ZA', 'label' => Mage::helper('storelocator')->__('Afrikaans')),
            array('value' => 'sq_AL', 'label' => Mage::helper('storelocator')->__('Albanian')),
            array('value' => 'hy_AM', 'label' => Mage::helper('storelocator')->__('Armenian')),
            array('value' => 'az_AZ', 'label' => Mage::helper('storelocator')->__('Azeri')),
            array('value' => 'be_BY', 'label' => Mage::helper('storelocator')->__('Belarusian')),
            array('value' => 'bn_IN', 'label' => Mage::helper('storelocator')->__('Bengali')),
            array('value' => 'bs_BA', 'label' => Mage::helper('storelocator')->__('Bosnian')),
            array('value' => 'bg_BG', 'label' => Mage::helper('storelocator')->__('Bulgarian')),
            array('value' => 'hr_HR', 'label' => Mage::helper('storelocator')->__('Croatian')),
            array('value' => 'nl_BE', 'label' => Mage::helper('storelocator')->__('Dutch (Belgie)')),
            array('value' => 'en_GB', 'label' => Mage::helper('storelocator')->__('English (UK)')),
            array('value' => 'eo_EO', 'label' => Mage::helper('storelocator')->__('Esperanto')),
            array('value' => 'et_EE', 'label' => Mage::helper('storelocator')->__('Estonian')),
            array('value' => 'fo_FO', 'label' => Mage::helper('storelocator')->__('Faroese')),
            array('value' => 'fr_CA', 'label' => Mage::helper('storelocator')->__('French (Canada)')),
            array('value' => 'ka_GE', 'label' => Mage::helper('storelocator')->__('Georgian')),
            array('value' => 'el_GR', 'label' => Mage::helper('storelocator')->__('Greek')),
            array('value' => 'gu_IN', 'label' => Mage::helper('storelocator')->__('Gujarati')),
            array('value' => 'hi_IN', 'label' => Mage::helper('storelocator')->__('Hindi')),
            array('value' => 'is_IS', 'label' => Mage::helper('storelocator')->__('Icelandic')),
            array('value' => 'id_ID', 'label' => Mage::helper('storelocator')->__('Indonesian')),
            array('value' => 'ga_IE', 'label' => Mage::helper('storelocator')->__('Irish')),
            array('value' => 'jv_ID', 'label' => Mage::helper('storelocator')->__('Javanese')),
            array('value' => 'kn_IN', 'label' => Mage::helper('storelocator')->__('Kannada')),
            array('value' => 'kk_KZ', 'label' => Mage::helper('storelocator')->__('Kazakh')),
            array('value' => 'la_VA', 'label' => Mage::helper('storelocator')->__('Latin')),
            array('value' => 'lv_LV', 'label' => Mage::helper('storelocator')->__('Latvian')),
            array('value' => 'li_NL', 'label' => Mage::helper('storelocator')->__('Limburgish')),
            array('value' => 'lt_LT', 'label' => Mage::helper('storelocator')->__('Lithuanian')),
            array('value' => 'mk_MK', 'label' => Mage::helper('storelocator')->__('Macedonian')),
            array('value' => 'mg_MG', 'label' => Mage::helper('storelocator')->__('Malagasy')),
            array('value' => 'ms_MY', 'label' => Mage::helper('storelocator')->__('Malay')),
            array('value' => 'mt_MT', 'label' => Mage::helper('storelocator')->__('Maltese')),
            array('value' => 'mr_IN', 'label' => Mage::helper('storelocator')->__('Marathi')),
            array('value' => 'mn_MN', 'label' => Mage::helper('storelocator')->__('Mongolian')),
            array('value' => 'ne_NP', 'label' => Mage::helper('storelocator')->__('Nepali')),
            array('value' => 'pa_IN', 'label' => Mage::helper('storelocator')->__('Punjabi')),
            array('value' => 'rm_CH', 'label' => Mage::helper('storelocator')->__('Romansh')),
            array('value' => 'sa_IN', 'label' => Mage::helper('storelocator')->__('Sanskrit')),
            array('value' => 'sr_RS', 'label' => Mage::helper('storelocator')->__('Serbian')),
            array('value' => 'so_SO', 'label' => Mage::helper('storelocator')->__('Somali')),
            array('value' => 'sw_KE', 'label' => Mage::helper('storelocator')->__('Swahili')),
            array('value' => 'tl_PH', 'label' => Mage::helper('storelocator')->__('Filipino')),
            array('value' => 'ta_IN', 'label' => Mage::helper('storelocator')->__('Tamil')),
            array('value' => 'tt_RU', 'label' => Mage::helper('storelocator')->__('Tatar')),
            array('value' => 'te_IN', 'label' => Mage::helper('storelocator')->__('Telugu')),
            array('value' => 'ml_IN', 'label' => Mage::helper('storelocator')->__('Malayalam')),
            array('value' => 'uk_UA', 'label' => Mage::helper('storelocator')->__('Ukrainian')),
            array('value' => 'uz_UZ', 'label' => Mage::helper('storelocator')->__('Uzbek')),
            array('value' => 'vi_VN', 'label' => Mage::helper('storelocator')->__('Vietnamese')),
            array('value' => 'xh_ZA', 'label' => Mage::helper('storelocator')->__('Xhosa')),
            array('value' => 'zu_ZA', 'label' => Mage::helper('storelocator')->__('Zulu')),
            array('value' => 'km_KH', 'label' => Mage::helper('storelocator')->__('Khmer')),
            array('value' => 'tg_TJ', 'label' => Mage::helper('storelocator')->__('Tajik')),
            array('value' => 'ar_AR', 'label' => Mage::helper('storelocator')->__('Arabic')),
            array('value' => 'he_IL', 'label' => Mage::helper('storelocator')->__('Hebrew')),
            array('value' => 'ur_PK', 'label' => Mage::helper('storelocator')->__('Urdu')),
            array('value' => 'fa_IR', 'label' => Mage::helper('storelocator')->__('Persian')),
            array('value' => 'sy_SY', 'label' => Mage::helper('storelocator')->__('Syriac')),
            array('value' => 'yi_DE', 'label' => Mage::helper('storelocator')->__('Yiddish')),
            array('value' => 'gn_PY', 'label' => Mage::helper('storelocator')->__('Guarani')),
            array('value' => 'qu_PE', 'label' => Mage::helper('storelocator')->__('Quechua')),
            array('value' => 'ay_BO', 'label' => Mage::helper('storelocator')->__('Aymara')),
            array('value' => 'se_NO', 'label' => Mage::helper('storelocator')->__('Northern Sami')),
            array('value' => 'ps_AF', 'label' => Mage::helper('storelocator')->__('Pashto')),
            array('value' => 'tl_ST', 'label' => Mage::helper('storelocator')->__('Klingon')),
        );
        return $options;
    }

}