<?php

namespace App\Service;

use DateTime;

class LifeInsurance
{
    private $openAmount;

    private $withdrawalAmount;

    private $openingDate;

    private $interest;

    private $duration;

    public function __construct($openAmount, $withdrawalAmount, $openingDate)
    {
        $this->openAmount = $openAmount;
        $this->withdrawalAmount = $withdrawalAmount;
        $this->openingDate = $openingDate;
    }

    public function calculateInterest()
    {
        $this->interest = $this->withdrawalAmount - $this->openAmount;
    }

    public function calculateDuration()
    {
        $origin = new DateTime();
        $target = new DateTime($this->openingDate);
        $interval = $origin->diff($target);
        $this->duration = (int)$interval->format('%Y');
    }

    public function getOpenAmount()
    {
        return $this->openAmount;
    }

    public function setOpenAmount($amount)
    {
        $this->openAmount = $amount;
        return $this;
    }

    public function getWithdrawalAmount()
    {
        return $this->withdrawalAmount;
    }

    public function setWithdrawalAmount($amount)
    {
        $this->withdrawalAmount = $amount;
        return $this;
    }

    public function getOpeningDate()
    {
        return $this->openingDate;
    }

    public function setOpeningDate($date)
    {
        $this->openingDate = $date;
        return $this;
    }

    public function getInterest()
    {
        return $this->interest;
    }

    public function setInterest($interest)
    {
        $this->interest = $interest;
        return $this;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }
}
