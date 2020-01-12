<?php
namespace MomoWebdevelopment\MomoPreciousmetal\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Masod Mohmand <masod@momo-webdevelopment.de>
 */
class PmControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \MomoWebdevelopment\MomoPreciousmetal\Controller\PmController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\MomoWebdevelopment\MomoPreciousmetal\Controller\PmController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllPmsFromRepositoryAndAssignsThemToView()
    {

        $allPms = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $pmRepository = $this->getMockBuilder(\MomoWebdevelopment\MomoPreciousmetal\Domain\Repository\PmRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $pmRepository->expects(self::once())->method('findAll')->will(self::returnValue($allPms));
        $this->inject($this->subject, 'pmRepository', $pmRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('pms', $allPms);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }
}
