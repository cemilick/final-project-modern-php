<?php


namespace App\Services;

use App\Enums\Posisi;
use App\Helpers\CapresHelper;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class CapresService
{

    public function index()
    {
        $data = $this->fetch();
        if ($data) {
            $capres = CapresHelper::parseCapres($data['calon_presiden'], Posisi::PRESIDEN->value);
            $cawapres = CapresHelper::parseCapres($data['calon_wakil_presiden'], Posisi::WAKIL_PRESIDEN->value);

            usort($capres, function ($a, $b) {
                return $a->nomorUrut - $b->nomorUrut;
            });

            usort($cawapres, function ($a, $b) {
                return $a->nomorUrut - $b->nomorUrut;
            });

            return [
                'capres' => $capres,
                'cawapres' => $cawapres
            ];
        }
    }

    public function fetch(): ?array
    {
        try {
            $response = Http::get('https://mocki.io/v1/92a1f2ef-bef2-4f84-8f06-1965f0fca1a7');
            if ($response->successful()) {
                return $response->json();
            }
        } catch (ConnectionException $e) {
            report($e->getMessage());
        }

        return null;
    }
}
