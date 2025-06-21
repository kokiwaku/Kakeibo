<?php

namespace App\Domain\Category\Model\Value;

enum TransactionType: string
{
    case EXPENSE = 'expense';
    case INCOME = 'income';
}