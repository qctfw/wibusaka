<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AnimeResourcesImport implements WithMapping, WithStartRow
{
    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        return [
            'mal_id' => $row[0],
            'platform' => $row[1],
            'paid' => $row[2],
            'link' => $row[3],
            'note' => $row[4]
        ];
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
