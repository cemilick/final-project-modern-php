<?php

namespace App\Helpers;

use App\Dto\CapresDto;
use App\Dto\KarirDto;
use App\Enums\Posisi;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class CapresHelper
{
    protected static function parseKarir(string $stringKarir): ?KarirDto
    {
        $jabatan = Str::of($stringKarir)->beforeLast('(');
        $tahunMulai = Str::of($stringKarir)->afterLast('(')->beforeLast('-')->toInteger();

        if (Str::of($stringKarir)->contains('-')) {
            $tahunSelesai = Str::of($stringKarir)->after('-')->beforeLast(')')->toInteger();
            if ($tahunSelesai === 'Sekarang') {
                $tahunSelesai = null;
            }
        } else {
            $tahunSelesai = $tahunMulai;
        }

        return new KarirDto($jabatan, $tahunMulai, $tahunSelesai);
    }

    public static function parseKarirToArray(?array $arrKarir): ?array
    {
        try {
            $careers = [];
            foreach ($arrKarir as $k) {
                $career = CapresHelper::parseKarir($k);
                if ($career) {
                    $careers[] = $career;
                }
            }

            return $careers;
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }

    public static function hitungUmur(?string $tanggalLahir): int
    {
        try {
            $tgl_lahir = Carbon::createFromFormat('d-m-Y', $tanggalLahir);

            return $tgl_lahir->diffInYears(Carbon::now());
        } catch (\Exception $e) {
            report($e);
            return 0;
        }
    }

    public static function parseCapres(?array $dataCapres, string $type): ?array
    {
        if (!$dataCapres) {
            return null;
        }
        $posisi = [
            Posisi::PRESIDEN->value => Posisi::PRESIDEN->value,
            Posisi::WAKIL_PRESIDEN->value => Posisi::WAKIL_PRESIDEN->value,
        ];

        $result = [];

        foreach ($dataCapres as $capres) {
            $arrDOB = explode(', ', $capres['tempat_tanggal_lahir']);
            $tempatLahir = Arr::first($arrDOB);
            $tanggalLahir = DateHelper::parseTanggalLahir(Arr::get($arrDOB, 1));
            $umur = CapresHelper::hitungUmur($tanggalLahir);
            $karir = CapresHelper::parseKarirToArray(Arr::get($capres, 'karir'));

            $result[] = new CapresDto(
                Arr::get($capres, 'nomor_urut'),
                Arr::get($posisi, $type),
                Arr::get($capres, 'nama_lengkap'),
                $tempatLahir,
                Carbon::createFromFormat('d-m-Y', $tanggalLahir),
                $umur,
                $karir
            );
        }

        return $result;
    }
}
