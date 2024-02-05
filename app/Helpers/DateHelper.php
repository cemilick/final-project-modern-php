<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class DateHelper
{
    public static function parseTanggalLahir(?string $tanggalLahir): string
    {
        try {
            $month = [
                'Januari' => '01',
                'Februari' => '02',
                'Maret' => '03',
                'April' => '04',
                'Mei' => '05',
                'Juni' => '06',
                'Juli' => '07',
                'Agustus' => '08',
                'September' => '09',
                'Oktober' => '10',
                'November' => '11',
                'Desember' => '12',
            ];

            $arrDate = explode(' ', $tanggalLahir);
            $tgl = Arr::first($arrDate) . '-';
            $bln = $month[Arr::get($arrDate, 1)] . '-';
            $thn = Arr::get($arrDate, 2);

            return $tgl . $bln . $thn;
        } catch (\Throwable $err) {
            return 'TTL tidak valid!';
        }
    }

}

