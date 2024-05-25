<?php

namespace App\Imports;

use App\Models\HangSanXuat;
use Maatwebsite\Excel\Concerns\ToModel;

class HangSanXuatImport implements ToModel
{
    public function model(array $row)
    {
        return new HangSanXuat([
            'tenhang' => $row[0],
            'tenhang_slug' => $row[1],
            'hinhanh' => $row[2],
        ]);
    }
}
