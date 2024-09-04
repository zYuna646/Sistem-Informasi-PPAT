<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 5px; /* Kurangi padding untuk membuat tabel lebih kecil */
            font-size: 12px; /* Kurangi ukuran font */
            text-align: left;
        }

        /* Responsive styling */
        @media screen and (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                display: none; /* Hide headers on small screens */
            }

            td {
                position: relative;
                padding-left: 50%;
                white-space: nowrap;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                top: 0;
                padding-left: 10px;
                font-weight: bold;
            }
        }

        /* Untuk tampilan di layar lebar agar tabel lebih kecil */
        @media screen and (min-width: 600px) {
            table {
                width: 90%; /* Kurangi lebar tabel menjadi 90% */
                margin: 0 auto; /* Pusatkan tabel */
            }
        }
    </style>
</head>
<body>
    <h1>Data Laporan</h1>

    <table>
        <thead>
            <tr>
                <th>No. Akta</th>
                <th>Tanggal Akta</th>
                <th>Pihak Menerima (NPWP)</th>
                <th>Pihak Memberikan (NPWP)</th>
                <th>Bentuk Perbuatan Hukum</th>
                <th>Letak Tanah</th>
                <th>Harga Transaksi</th>
                <th>NJOP (SPPT)</th>
                <th>NOP Tahun (SPPT)</th>
                <th>Harga SSP</th>
                <th>Tanggal SSP</th>
                <th>Harga SSB</th>
                <th>Tanggal SSB</th>
                <th>Luas Tanah</th>
                <th>Luas Bangunan</th>
                <th>Jenis Nomor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $data)
            <tr>
                @php
                    $akta = json_decode($data['akta'], true);
                    $npwp = json_decode($data['npwp'], true);
                    $sppt = json_decode($data['sppt'], true);
                    $ssp = json_decode($data['ssp'], true);
                    $ssb = json_decode($data['ssb'], true);
                    $luas = json_decode($data['luas'], true);
                @endphp

                <td data-label="No. Akta">{{ $akta['no'] ?? '' }}</td>
                <td data-label="Tanggal Akta">{{ $akta['tanggal_akta'] ?? '' }}</td>
                <td data-label="Pihak Menerima">{{ $npwp['pihak_menerima'] ?? '' }}</td>
                <td data-label="Pihak Memberikan">{{ $npwp['pihak_memberikan'] ?? '' }}</td>
                <td data-label="Bentuk Perbuatan Hukum">{{ $data['bentuk_perbuatan_hukum'] }}</td>
                <td data-label="Letak Tanah">{{ $data['letak_tanah'] }}</td>
                <td data-label="Harga Transaksi">{{ $data['harga_transaksi'] }}</td>
                <td data-label="NJOP (SPPT)">{{ $sppt['njop'] ?? '' }}</td>
                <td data-label="NOP Tahun (SPPT)">{{ $sppt['nop_tahun'] ?? '' }}</td>
                <td data-label="Harga SSP">{{ $ssp['harga_ssp'] ?? '' }}</td>
                <td data-label="Tanggal SSP">{{ $ssp['tanggal_ssp'] ?? '' }}</td>
                <td data-label="Harga SSB">{{ $ssb['harga_ssb'] ?? '' }}</td>
                <td data-label="Tanggal SSB">{{ $ssb['tanggal_ssb'] ?? '' }}</td>
                <td data-label="Luas Tanah">{{ $luas['luas_tanah'] ?? '' }}</td>
                <td data-label="Luas Bangunan">{{ $luas['luas_bangunan'] ?? '' }}</td>
                <td data-label="Jenis Nomor">{{ $data['jenis_nomor'] }}</td>
            </tr>
            
            @endforeach
        </tbody>
    </table>
</body>
</html>
