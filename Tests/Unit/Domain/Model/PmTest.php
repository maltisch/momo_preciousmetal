<?php
namespace MomoWebdevelopment\MomoPreciousmetal\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Masod Mohmand <masod@momo-webdevelopment.de>
 */
class PmTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \MomoWebdevelopment\MomoPreciousmetal\Domain\Model\Pm
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \MomoWebdevelopment\MomoPreciousmetal\Domain\Model\Pm();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getDateReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getDate()
        );
    }

    /**
     * @test
     */
    public function setDateForDateTimeSetsDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setDate($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'date',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCurrencyReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCurrency()
        );
    }

    /**
     * @test
     */
    public function setCurrencyForStringSetsCurrency()
    {
        $this->subject->setCurrency('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'currency',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getXauPriceReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getXauPrice()
        );
    }

    /**
     * @test
     */
    public function setXauPriceForFloatSetsXauPrice()
    {
        $this->subject->setXauPrice(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'xauPrice',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getXauCloseReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getXauClose()
        );
    }

    /**
     * @test
     */
    public function setXauCloseForFloatSetsXauClose()
    {
        $this->subject->setXauClose(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'xauClose',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getXagPriceReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getXagPrice()
        );
    }

    /**
     * @test
     */
    public function setXagPriceForFloatSetsXagPrice()
    {
        $this->subject->setXagPrice(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'xagPrice',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getXagCloseReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getXagClose()
        );
    }

    /**
     * @test
     */
    public function setXagCloseForFloatSetsXagClose()
    {
        $this->subject->setXagClose(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'xagClose',
            $this->subject,
            '',
            0.000000001
        );
    }
}
