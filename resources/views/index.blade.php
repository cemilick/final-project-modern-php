<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paslon</title>
    @vite('resources/css/app.css')
</head>
<body class="font-comic antialiased bg-gray-100">
    <div class="font-comic container mx-auto px-4 py-8">
        <h1 class="font-comic text-4xl font-bold mb-8 text-center">
            Profil Calon Presiden dan Calon Wakil Presiden 2024
        </h1>
        @foreach($capres as $index => $calon)
        @php
            $color = [
                'white',
                'blue',
                'yellow',
                'red'
            ];
        @endphp
        <div
            class="font-comic bg-{{$color[$calon->nomorUrut] ?? 'black'}}-500 text-white rounded-full
            h-16 w-16 flex items-center justify-center mx-auto my-4">
            <h1 class="font-comic text-4xl font-bold mb-2 text-center p-4">{{ $calon->nomorUrut }}</h1>
        </div>
        <div class="font-comic grid grid-cols-1 md:grid-cols-2 gap-2 mb-8">
            <div class="font-comic bg-white rounded-lg shadow-md p-6">
                <div class="font-comic text-center mb-2 p-2">
                    <h2 class="font-comic text-2xl font-semibold mb-2">{{ $calon->namaLengkap }}</h2>
                    <h2 class="font-comic text-xl font-medium mb-2">
                        {{ $calon->tempatLahir }},
                        {{ \Carbon\Carbon::parse($calon->tanggalLahir)->translatedFormat('d F Y') }}
                    </h2>
                    <h2 class="font-comic text-xl font-medium mb-2">{{ $calon->usia }} Tahun</h2>
                </div>
                <h2 class="font-comic text-lg font-semibold mb-2">Karir</h2>
                <div class="font-comic space-y-4">
                    <div class="font-comic bg-gray-100 rounded-md">
                        @foreach($calon->karir as $karir)
                        <div class="font-comic p-2 @if(!$loop->last) border-b-2 @endif">
                            <p>
                                <span class="font-comic font-semibold">{{ $karir->jabatan }}</span>
                                @if ($karir->tahunMulai === $karir->tahunSelesai)
                                    ( {{ $karir->tahunMulai }} )
                                @else
                                    ( {{ $karir->tahunMulai }} - {{ $karir->tahunSelesai ?: 'Sekarang' }} )
                                @endif
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="font-comic bg-white rounded-lg shadow-md p-6">
                <div class="font-comic text-center mb-2 p-2">
                    <h2 class="font-comic text-2xl font-semibold mb-2">{{ $cawapres[$index]->namaLengkap }}</h2>
                    <h2 class="font-comic text-xl font-medium mb-2">
                        {{ $cawapres[$index]->tempatLahir }},
                        {{ \Carbon\Carbon::parse($cawapres[$index]->tanggalLahir)->translatedFormat('d F Y') }}
                    </h2>
                    <h2 class="font-comic text-xl font-medium mb-2">{{ $cawapres[$index]->usia }} Tahun</h2>
                </div>
                <h2 class="font-comic text-lg font-semibold mb-2">Karir</h2>
                <div class="font-comic space-y-4">
                    <div class="font-comic bg-gray-100 rounded-md">
                        @foreach($cawapres[$index]->karir as $karir)
                        <div class="font-comic p-2 @if(!$loop->last) border-b-2 @endif">
                            <p>
                                <span class="font-comic font-semibold">{{ $karir->jabatan }}</span>
                                ( {{ $karir->tahunMulai }} - {{ $karir->tahunSelesai ?: 'Sekarang' }} )
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>
