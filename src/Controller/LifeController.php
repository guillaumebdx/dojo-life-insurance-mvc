<?php

namespace App\Controller;

use App\Service\LifeInsurance;
use App\Service\Withdrawal;

class LifeController extends AbstractController
{
    public function simulation()
    {
        $lifeInsurance = new LifeInsurance(10000, 15000, '2015-02-02');
        $withdrawal = new Withdrawal($lifeInsurance, '41');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $openAmount = $_POST['open-amount'];
            $withdrawalAmount = $_POST['withdrawal-amount'];
            $openingDate = $_POST['open-date'];

            $lifeInsurance = new LifeInsurance($openAmount, $withdrawalAmount, $openingDate);
            $lifeInsurance->calculateInterest();
            $lifeInsurance->calculateDuration();

            $withdrawal = new Withdrawal($lifeInsurance, $_POST['tmi']);
        }


        return $this->twig->render('Life/index.html.twig', [
            'life_insurance' => $lifeInsurance,
            'withdrawal'     => $withdrawal,
        ]);
    }
}
