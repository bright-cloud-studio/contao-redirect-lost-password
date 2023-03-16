<?php

/**
 * Bright Cloud Studio's Contao Redirect Lost Password
 *
 * Copyright (C) 2023 Bright Cloud Studio
 *
 * @package    bright-cloud-studio/contao-redirect-lost-password
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
**/

namespace Bcs\Module;
use Contao;
use Contao\Config;

class ModuleLostPasswordRedirect extends \Contao\ModuleLogin
{
    public function generate()
    {
        // perform our normal generation
        return parent::generate();
    }

    protected function compile()
    {
        // perform our normal compilation functions
        parent::compile();
        
        // get our selected failure page
        $objTarget = $this->objModel->getRelated('jumpToAlternative');
        
        // if we have a failure page selected
        if($objTarget != null) {
            
            // get authorization values
            $container = \System::getContainer();
            $authorizationChecker = $container->get('security.authorization_checker');
            
            
            // if value isnt empty, meaning we failed the previous login
            if($this->Template->value != "") {
                
                // if we havent been authorized, meaning granted a role, then we didn't just log in successfully
                if (!$authorizationChecker->isGranted('ROLE_MEMBER')) {
                
                	// the the url of the failure page
        			$strRedirect = $objTarget->getAbsoluteUrl();
        			
                    // forward ourselves to that page
                    header("Location: " . $strRedirect);
                    
                    // this will stop any other successive forwards, doesn't work without this surprisingly.
                    echo " ";
                    
                }
            }
            
        }
        
    }
}
