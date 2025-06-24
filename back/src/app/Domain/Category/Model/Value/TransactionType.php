<?php

namespace App\Domain\Category\Model\Value;

enum TransactionType
{
    case EXPENSE;
    case INCOME;

    /**
     * 小文字の文字列からTransactionTypeを取得
     */
    public static function fromString(string $value): self
    {
        return match (strtolower($value)) {
            'expense' => self::EXPENSE,
            'income' => self::INCOME,
            default => throw new \InvalidArgumentException("Invalid transaction type: $value")
        };
    }

    /**
     * TransactionTypeを小文字の文字列に変換
     */
    public function toString(): string
    {
        return match ($this) {
            self::EXPENSE => 'expense',
            self::INCOME => 'income',
        };
    }

    public static function strToLowerValues(): array
    {
        return array_map(fn (TransactionType $type) => strtolower($type->toString()), self::cases());
    }
}