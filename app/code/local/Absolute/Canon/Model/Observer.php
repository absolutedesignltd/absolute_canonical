<?php 

class Absolute_Canon_Model_Observer {

    public function coreBlockAbstractToHtmlBefore($o) {

        $block = $o->getBlock();

        if($block instanceof Mage_Page_Block_Html_Head && Mage::registry('current_category') && !Mage::registry('current_product')) {

            $url = Mage::registry('current_category')->getUrl();

            // remove default canonical
            $block->removeItem('link_rel', $url);

            // add page number to URL
            $page_number = Mage::getBlockSingleton('page/html_pager')->getCurrentPage();

            if ($page_number > 1) {
               $url .= '?p='.$page_number;
            }
            
            $block->addLinkRel('canonical', $url);
        }
    }

}