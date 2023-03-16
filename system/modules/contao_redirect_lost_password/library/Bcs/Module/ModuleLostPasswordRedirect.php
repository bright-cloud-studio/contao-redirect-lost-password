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
        
        // This is where our custom code will go
        
    }
}
