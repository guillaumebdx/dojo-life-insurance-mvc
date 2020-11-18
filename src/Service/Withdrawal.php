<?php

namespace App\Service;

class Withdrawal
{

    private $lifeInsurance;

    private $socialTaxAmount;

    private $taxAmount;

    private $taxChoosen;

    private $tmi;

    private $taxForfait;

    private $interestBase;

    public const SOCIAL_TAX_RATE = 17.2;


    public function __construct($lifeInsurance, $tmi)
    {
        $this->lifeInsurance = $lifeInsurance;
        $this->tmi = $tmi;
        $this->handleAllowance();
        $this->calculateTaxForfait();
        $this->chooseTaxRate();
        $this->calculateTax();
        $this->calculateSocialTax();
    }

    public function calculateTaxForfait()
    {
        $taxForfait = 0;
        if ($this->lifeInsurance->getDuration() < 4) {
            $taxForfait = 35;
        } elseif ($this->lifeInsurance->getDuration() < 8) {
            $taxForfait = 15;
        } else {
            $taxForfait = 7.5;
        }
        $this->taxForfait = $taxForfait;
    }

    public function handleAllowance()
    {
        if ($this->lifeInsurance->getDuration() > 8) {
            $interest = $this->lifeInsurance->getInterest();
            $this->interestBase = $interest - 9200 > 0 ? $interest - 9200 : 0;
        } else {
            $this->interestBase = $this->lifeInsurance->getInterest();
        }
    }

    public function setInterestBase($interestBase)
    {
        $this->interestBase = $interestBase;
    }

    public function getInterestBase()
    {
        return $this->interestBase;
    }

    public function chooseTaxRate()
    {
        $taxRate = $this->taxForfait;
        if ($this->tmi < $this->taxForfait) {
            $taxRate = $this->tmi;
        }
        $this->taxChoosen = $taxRate;
    }

    public function calculateTax()
    {
        $interest = $this->interestBase;
        $this->taxAmount = ($interest * $this->taxChoosen) / 100;
    }

    public function calculateSocialTax()
    {
        $interest = $this->interestBase;
        $this->socialTaxAmount = ($interest * self::SOCIAL_TAX_RATE) / 100;
    }

    /**
     * @return mixed
     */
    public function getLifeInsurance()
    {
        return $this->lifeInsurance;
    }

    /**
     * @param mixed $lifeInsurance
     */
    public function setLifeInsurance($lifeInsurance): void
    {
        $this->lifeInsurance = $lifeInsurance;
    }

    /**
     * @return mixed
     */
    public function getSocialTaxAmount()
    {
        return $this->socialTaxAmount;
    }

    /**
     * @param mixed $socialTaxAmount
     */
    public function setSocialTaxAmount($socialTaxAmount): void
    {
        $this->socialTaxAmount = $socialTaxAmount;
    }

    /**
     * @return mixed
     */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    /**
     * @param mixed $taxAmount
     */
    public function setTaxAmount($taxAmount): void
    {
        $this->taxAmount = $taxAmount;
    }

    /**
     * @return mixed
     */
    public function getTaxChoosen()
    {
        return $this->taxChoosen;
    }

    /**
     * @param mixed $taxChoosen
     */
    public function setTaxChoosen($taxChoosen): void
    {
        $this->taxChoosen = $taxChoosen;
    }

    /**
     * @return mixed
     */
    public function getTmi()
    {
        return $this->tmi;
    }

    /**
     * @param mixed $tmi
     */
    public function setTmi($tmi): void
    {
        $this->tmi = $tmi;
    }

    public function getTaxForfait()
    {
        return $this->taxForfait;
    }

    public function setTaxForfait($taxForfait)
    {
        $this->taxForfait = $taxForfait;
    }
}
