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
            'type' => $row[1],
            'platform' => $row[2],
            'paid' => $row[3],
            'link' => $row[4],
            'note' => $row[5]
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
