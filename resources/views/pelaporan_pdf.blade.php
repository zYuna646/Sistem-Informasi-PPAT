<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px; /* Adjust font size for better fitting */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Fix table layout to prevent overflowing columns */
            word-wrap: break-word; /* Ensure long words break to fit into the cell */
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 4px; /* Reduce padding for better fitting */
            text-align: left;
        }

        h1 {
            text-align: center;
            font-size: 14px; /* Adjust title font size */
        }

        /* Ensure the table fits the page and the layout works in the PDF */
        @page {
            size: A4 landscape; /* Ensure landscape orientation for better width */
            margin: 10mm; /* Adjust margins */
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
