<?php

	namespace ITX\Jobapplications\Tests\Unit\Controller;

	/**
	 * Test case.
	 *
	 * @author Stefanie Döll
	 * @author Benjamin Jasper
	 */
	class ContactControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
	{
		/**
		 * @var \ITX\Jobapplications\Controller\ContactController
		 */
		protected $subject = null;

		/**
		 * @test
		 */
		public function listActionFetchesAllContactsFromRepositoryAndAssignsThemToView()
		{

			$allContacts = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
								->disableOriginalConstructor()
								->getMock();

			$contactRepository = $this->getMockBuilder(\ITX\Jobapplications\Domain\Repository\ContactRepository::class)
									  ->setMethods(['findAll'])
									  ->disableOriginalConstructor()
									  ->getMock();
			$contactRepository->expects(self::once())->method('findAll')->will(self::returnValue($allContacts));
			$this->inject($this->subject, 'contactRepository', $contactRepository);

			$view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
			$view->expects(self::once())->method('assign')->with('contacts', $allContacts);
			$this->inject($this->subject, 'view', $view);

			$this->subject->listAction();
		}

		/**
		 * @test
		 */
		public function showActionAssignsTheGivenContactToView()
		{
			$contact = new \ITX\Jobapplications\Domain\Model\Contact();

			$view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
			$this->inject($this->subject, 'view', $view);
			$view->expects(self::once())->method('assign')->with('contact', $contact);

			$this->subject->showAction($contact);
		}

		/**
		 * @test
		 */
		public function createActionAddsTheGivenContactToContactRepository()
		{
			$contact = new \ITX\Jobapplications\Domain\Model\Contact();

			$contactRepository = $this->getMockBuilder(\ITX\Jobapplications\Domain\Repository\ContactRepository::class)
									  ->setMethods(['add'])
									  ->disableOriginalConstructor()
									  ->getMock();

			$contactRepository->expects(self::once())->method('add')->with($contact);
			$this->inject($this->subject, 'contactRepository', $contactRepository);

			$this->subject->createAction($contact);
		}

		/**
		 * @test
		 */
		public function editActionAssignsTheGivenContactToView()
		{
			$contact = new \ITX\Jobapplications\Domain\Model\Contact();

			$view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
			$this->inject($this->subject, 'view', $view);
			$view->expects(self::once())->method('assign')->with('contact', $contact);

			$this->subject->editAction($contact);
		}

		/**
		 * @test
		 */
		public function updateActionUpdatesTheGivenContactInContactRepository()
		{
			$contact = new \ITX\Jobapplications\Domain\Model\Contact();

			$contactRepository = $this->getMockBuilder(\ITX\Jobapplications\Domain\Repository\ContactRepository::class)
									  ->setMethods(['update'])
									  ->disableOriginalConstructor()
									  ->getMock();

			$contactRepository->expects(self::once())->method('update')->with($contact);
			$this->inject($this->subject, 'contactRepository', $contactRepository);

			$this->subject->updateAction($contact);
		}

		/**
		 * @test
		 */
		public function deleteActionRemovesTheGivenContactFromContactRepository()
		{
			$contact = new \ITX\Jobapplications\Domain\Model\Contact();

			$contactRepository = $this->getMockBuilder(\ITX\Jobapplications\Domain\Repository\ContactRepository::class)
									  ->setMethods(['remove'])
									  ->disableOriginalConstructor()
									  ->getMock();

			$contactRepository->expects(self::once())->method('remove')->with($contact);
			$this->inject($this->subject, 'contactRepository', $contactRepository);

			$this->subject->deleteAction($contact);
		}

		protected function setUp()
		{
			parent::setUp();
			$this->subject = $this->getMockBuilder(\ITX\Jobapplications\Controller\ContactController::class)
								  ->setMethods(['redirect', 'forward', 'addFlashMessage'])
								  ->disableOriginalConstructor()
								  ->getMock();
		}

		protected function tearDown()
		{
			parent::tearDown();
		}
	}
