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

class ModuleLostPasswordRedirect extends \Contao\ModulePassword
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
    
    protected function sendPasswordLink($objMember)
	{
		$optIn = System::getContainer()->get('contao.opt_in');
		$optInToken = $optIn->create('pw', $objMember->email, array('tl_member'=>array($objMember->id)));

		// Prepare the simple token data
		$arrData = $objMember->row();
		$arrData['activation'] = $optInToken->getIdentifier();
		$arrData['domain'] = Idna::decode(Environment::get('host'));
		//$arrData['link'] = Idna::decode(Environment::get('url')) . Environment::get('requestUri') . ((strpos(Environment::get('requestUri'), '?') !== false) ? '&' : '?') . 'token=' . $optInToken->getIdentifier();
        $arrData['link'] = "bingbongnoise" . 'token=' . $optInToken->getIdentifier();

		// Send the token
		$optInToken->send(
			sprintf($GLOBALS['TL_LANG']['MSC']['passwordSubject'], Idna::decode(Environment::get('host'))),
			System::getContainer()->get('contao.string.simple_token_parser')->parse($this->reg_password, $arrData)
		);

		System::getContainer()->get('monolog.logger.contao.access')->info('A new password has been requested for user ID ' . $objMember->id . ' (' . Idna::decodeEmail($objMember->email) . ')');

		// Check whether there is a jumpTo page
		if (($objJumpTo = $this->objModel->getRelated('jumpTo')) instanceof PageModel)
		{
			$this->jumpToOrReload($objJumpTo->row());
		}

		$this->reload();
	}
    
}
