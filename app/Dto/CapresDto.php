<?php

namespace App\Dto;

use App\Enums\Posisi;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class CapresDto extends Data
{
    /** @var KarirDto[] */
    public $karir;
    public function __construct(
        public int $nomorUrut,
        public string $posisi,
        public string $namaLengkap,
        public string $tempatLahir,
        public Carbon $tanggalLahir,
        public int $usia,
        public array $karirs,
    ) {
        $this->karir = $karirs;
    }
}
