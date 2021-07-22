<?php


namespace App\Entity\OffersMgr;


abstract class ApplymentsStates
{
    const NoApplied = 0;
    const Applied = 1;
    const WaitingResponse = 2;
    const Discard = 3;
    const Selected = 4;
}