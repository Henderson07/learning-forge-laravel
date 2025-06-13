<?php

namespace App\Enums;

class PersonEnum
{
    const TYPE_FISIC = 0;
    const TYPE_JURIDIC = 1;

    // Mapeamento de índices para valores
    private static $indexMap = [
        0 => self::TYPE_FISIC,
        1 => self::TYPE_JURIDIC,
    ];

    // Mapeamento de valores para índices
    private static $valueMap = [
        self::TYPE_FISIC => 0,
        self::TYPE_JURIDIC => 1,
    ];

    // Método para obter o valor pelo índice
    public static function getValueByIndex(int $index): ?string
    {
        return self::$indexMap[$index] ?? null;
    }

    // Método para obter o índice pelo valor
    public static function getIndexByValue(string $value): ?int
    {
        return self::$valueMap[$value] ?? null;
    }

    // Método para retornar todos os valores possíveis
    public static function values(): array
    {
        return [
            self::TYPE_FISIC,
            self::TYPE_JURIDIC,
        ];
    }
}
