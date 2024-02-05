<?php

use App\Dto\KarirDto;
use App\Enums\Posisi;
use App\Enums\PosisiEnum;
use App\Helpers\CapresHelper;
use App\Helpers\DateHelper;
use App\Http\Controllers\CapresController;
use App\Http\Controllers\PaslonController;
use App\Services\CapresService;
use App\Services\PaslonService;
use Illuminate\Support\Facades\Http;

// positif case
it("can parse date from locale to d-m-Y format", function () {
    $result = DateHelper::parseTanggalLahir('14 Februari 2023');
    $expectedResult = '14-02-2023';
    expect($result)->toBe($expectedResult);

});

it("can return age from date of birth given", function () {
    $result = CapresHelper::hitungUmur('12-04-2001');
    $expectedResult = 22;

    expect($result)->toBe($expectedResult);
});

it("can return array on given data parseKarir", function () {
    $karir = [
        "Anggota DPR RI Fraksi PDI Perjuangan (2004-2009 dan 2009-2013)",
        "Gubernur Jawa Tengah(2013-2023)"
    ];
    $result = CapresHelper::parseKarirToArray($karir);

    expect($result)->toBeArray();
});


// negative case
it("can return null if data capres parsed is null", function () {
    $posisi = Posisi::PRESIDEN->value;

    $result = CapresHelper::parseCapres(null, $posisi);

    expect($result)->toBeNull();
});

it("can return null if fetching data from API fails", function () {
    Http::fake([
        'https://mocki.io/v1/92a1f2ef-bef2-4f84-8f06-1965f0fca1a7' => Http::response([], 500),
    ]);

    $service = new CapresService();

    $result = $service->fetch();
    expect($result)->toBeNull();
});

it("can return TTL Tidak Valid on not valid date of birth given", function () {
    $result = DateHelper::parseTanggalLahir('Bukan Tanggal Lahir');
    $expectedResult = 'TTL tidak valid!';

    expect($result)->toBe($expectedResult);
});

it("can return 0 on invalid date", function () {
    $result = CapresHelper::hitungUmur('Bukan Tanggal Lahir');

    expect($result)->toBe(0);
});

it("can return null on null karir given on parseKarir", function () {
    $result = CapresHelper::parseKarirToArray(null);

    expect($result)->toBeNull();
});


