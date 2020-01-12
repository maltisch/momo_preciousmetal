<?php
namespace MomoWebdevelopment\MomoPreciousmetal\Domain\Model;


/***
 *
 * This file is part of the "Precious metal" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Masod Mohmand <masod@momo-webdevelopment.de>
 *
 ***/
/**
 * Pm
 */
class Pm extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * date
     *
     * @var int
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $date = null;

    /**
     * currency
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $currency = '';

    /**
     * xauPrice
     *
     * @var float
     */
    protected $xauPrice = 0.0;

    /**
     * xauClose
     *
     * @var float
     */
    protected $xauClose = 0.0;

    /**
     * xauOpen
     *
     * @var float
     */
    protected $xauOpen = 0.0;

    /**
     * xauChange
     *
     * @var string
     */
    protected $xauChange = '';

    /**
     * xagPrice
     *
     * @var float
     */
    protected $xagPrice = 0.0;

    /**
     * xagClose
     *
     * @var float
     */
    protected $xagClose = 0.0;

    /**
     * Returns the date
     *
     * @return int $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the date
     *
     * @param int $date
     * @return void
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Returns the currency
     *
     * @return string $currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Sets the currency
     *
     * @param string $currency
     * @return void
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * Returns the xauPrice
     *
     * @return float $xauPrice
     */
    public function getXauPrice()
    {
        return $this->xauPrice;
    }

    /**
     * Sets the xauPrice
     *
     * @param float $xauPrice
     * @return void
     */
    public function setXauPrice($xauPrice)
    {
        $this->xauPrice = $xauPrice;
    }

    /**
     * Returns the xauClose
     *
     * @return float $xauClose
     */
    public function getXauClose()
    {
        return $this->xauClose;
    }

    /**
     * Sets the xauClose
     *
     * @param float $xauClose
     * @return void
     */
    public function setXauClose($xauClose)
    {
        $this->xauClose = $xauClose;
    }

    /**
     * Returns the xauClose
     *
     * @return float $xauOpen
     */
    public function getXauOpen()
    {
        return $this->xauOpen;
    }

    /**
     * Sets the xauOpen
     *
     * @param float $xauOpen
     * @return void
     */
    public function setXauOpen($xauOpen)
    {
        $this->xauOpen = $xauOpen;
    }

    /**
     * Returns the xauChange
     *
     * @return string $xauChange
     */
    public function getXauChange()
    {
        return $this->xauChange;
    }

    /**
     * Sets the xauChange
     *
     * @param string xauChange
     * @return void
     */
    public function setXauChange($xauChange)
    {
        $this->xauChange = $xauChange;
    }

    /**
     * Returns the xagPrice
     *
     * @return float $xagPrice
     */
    public function getXagPrice()
    {
        return $this->xagPrice;
    }

    /**
     * Sets the xagPrice
     *
     * @param float $xagPrice
     * @return void
     */
    public function setXagPrice($xagPrice)
    {
        $this->xagPrice = $xagPrice;
    }

    /**
     * Returns the xagClose
     *
     * @return float $xagClose
     */
    public function getXagClose()
    {
        return $this->xagClose;
    }

    /**
     * Sets the xagClose
     *
     * @param float $xagClose
     * @return void
     */
    public function setXagClose($xagClose)
    {
        $this->xagClose = $xagClose;
    }
}
