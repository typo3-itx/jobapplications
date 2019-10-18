<?php
namespace ITX\Jobs\Controller;


/***
 *
 * This file is part of the "Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Stefanie Döll, it.x informationssysteme gmbh
 *           Benjamin Jasper, it.x informationssysteme gmbh
 *
 ***/
/**
 * ApplicationController
 */
class ApplicationController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * applicationRepository
     * 
     * @var \ITX\Jobs\Domain\Repository\ApplicationRepository
     * @inject
     */
    protected $applicationRepository = null;

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
        $postingUid = $this->request->getArgument('postingUid');
        $this->view->assign("postingUid", $postingUid);
    }

    /**
     * action create
     * 
     * @param \ITX\Jobs\Domain\Model\Application $newApplication
     * @return void
     */
    public function createAction(\ITX\Jobs\Domain\Model\Application $newApplication)
    {
		$postingUid = $this->request->getArgument("postingUid");
		$newApplication->setPosting($postingUid);
        $this->applicationRepository->add($newApplication);
        $this->addFlashMessage("Success");
        $this->redirect("list", "Posting");
    }
}