<?php
namespace ITX\Jobs\Controller;


use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2020
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * ContactController
 */
class ContactController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * contactRepository
     * 
     * @var \ITX\Jobs\Domain\Repository\ContactRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $contactRepository = null;

    /**
     * action list
     * 
     * @param ITX\Jobs\Domain\Model\Contact
     * @return void
     */
    public function listAction()
    {
    	$contacts = array();
    	$selectedContactsStr = $this->settings["selectedContacts"];
    	if (!empty($selectedContactsStr)) {
			$contacts = explode(",",$selectedContactsStr);
		}
		$contactObjects = $this->contactRepository->findMultipleByUid($contacts);
        $this->view->assign('contacts', $contactObjects);
    }
}
