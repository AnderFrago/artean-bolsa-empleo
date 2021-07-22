<?php


namespace App\Entity\UserMgr;


abstract class StudentState
{
    const WaitingValidation = 0;
    const Validated = 1;
    const Rejected = 2;
}