<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 20px;
        }

        .stamp {
            display: flex;
            text-align: center;
            border-bottom: 2px solid black;
            padding: 20px;
            margin: 0 auto;
        }

        .stamp img {
            width: 150px;
            height: auto;
        }
        .company{
            justify-content: center;
            margin:auto;
        }

        .company-name {
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0;
        }

        .company-address {
            font-size: 14px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .column {
            float: left;
            padding-top: 10%;
            width: 33.33%;
        }

        .column1 {
            margin: 0%;
            text-align: center;
            float: left;
            width: 75%;
        }
        .parafrase {
            text-align: center;
            float: left;
            width: 75%;
            margin: 0%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        h4 {
            margin-left: 22%;
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="stamp">
            <div>
                <img src="{{ asset('templates') }}/src/assets/images/logos/logoRJ.png" alt="Logo Perusahaan">
            </div>
            <div class="company">
                <div class="company-name">PT ERJE LONDON CHEMICAL</div>
                <div class="company-address">Jl. Padat Karya Km. 1,9 Cukanggalih - Curug, Tangerang 15810 <br> Tel. 021 - 598 5123 Fax. 021 5984750</div>
            </div>
        </div>
        <h1>Detail Laporan</h1>
        <h2>{{ $laporans->jenislaporan }}</h2>
        <h5>TANGGAL : {{ \Carbon\Carbon::parse($laporans->tanggal_pengajuan)->translatedFormat('d F Y') }}</h5>
        <h5>DEPARTEMEN : MEKANIK</h5>
        <h3>Daftar Komponen</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Komponen</th>
                    <th>Jumlah</th>
                    <th>keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporans->komponens as $index => $komponen)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $komponen->komponen }}</td>
                        <td>{{ $komponen->jumlah }} {{ $komponen->satuan }}</td>
                        <td>{{ $komponen->keterangan }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>{{ $index + 2 }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{ $index + 3 }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>{{ $index + 4 }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="row">
            <div class="column">
                <p class="column1"></p>
                <h4></h4>
            </div>
            <div class="column">
                <p class="parafrase"><strong>Disetujui Oleh,</strong></p>
                <p class="column1"><strong>Kepala Bagian :</strong></p>
                <h4>( {{ $laporans->kepalabagian }} )</h4>
            </div>
            <div class="column">
                <p class="parafrase"><strong>Diterima Oleh,</strong></p>
                <p class="column1"><strong>HRD :</strong></p>
                <h4>( {{ $laporans->hrd }} )</h4>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print(); // Jalankan fungsi cetak
            setTimeout(() => {
                window.location.href = document.referrer; // Redirect ke halaman sebelumnya
            }, 100); // Tunggu 100ms sebelum redirect
        };
    </script>
</body>

</html>
