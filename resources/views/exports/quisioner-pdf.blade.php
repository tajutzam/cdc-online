<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            /* Lebar tabel 100% dari halaman */
            border-collapse: collapse;
            /* Menggabungkan garis tepi */
        }

        th,
        td {
            border: 1px solid #000;
            /* Garis tepi untuk sel header dan sel data */
            padding: 8px;
            /* Ruang padding di dalam sel */
        }

        th {
            background-color: #f2f2f2;
            /* Warna latar belakang untuk sel header */
            font-weight: bold;
            /* Teks header tebal */
            text-align: center;
            /* Pusatkan teks di sel header */
        }

        td {
            text-align: center;
            /* Pusatkan teks di sel data */
        }

        .header {
            text-align: center;
        }

        .prodi {
            font-size: 18px;
            font-weight: bold;
        }

        .jurusan {
            font-size: 16px;
        }

        .politeknik {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <p class="prodi">Prodi Teknik Informatika</p>
        <p class="jurusan">Jurusan Teknologi Informasi</p>
        <p class="politeknik">Politeknik Negeri Jember</p>
    </div>
    <h1>Quisioner Identitas</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode PT</th>
                <th>Kode Prodi</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>HP</th>
                <th>Tahun Lulus</th>
                <th>NPWP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['quisioner'][0]['identity']['kdptimsmh'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['identity']['kdpstmsmh'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['identity']['nimhsmsmh'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['identity']['nmmhsmsmh'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['identity']['telpomsmh'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['identity']['tahun_lulus'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['identity']['npwp'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Quisioner Main</h1>
    <table>
        <thead>
            <tr>
                <th>F8</th>
                <th>F502</th>
                <th>F504</th>
                <th>F1101</th>
                <th>F5b</th>
                <th>F5c</th>
                <th>F5d</th>
                <th>F505</th>
                <th>F5A1</th>
                <th>F5A2</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['quisioner'][0]['main']['f8'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['main']['f502'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['main']['f504'] ?? false }}</td>
                    <td>{{ $item['quisioner'][0]['main']['f1101'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['main']['f5b'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['main']['f5c'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['main']['f5d'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['main']['f505'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['main']['f5a1'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['main']['f5a2'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Quisioner Study Lanjut </h1>
    <table>
        <thead>
            <tr>
                <th>F18A</th>
                <th>F18B</th>
                <th>F18C</th>
                <th>F18D</th>
                <th>F1201</th>
                <th>F1202</th>
                <th>F14</th>
                <th>F15</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['quisioner'][0]['furthe_study']['f18a'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['furthe_study']['f18b'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['furthe_study']['f18c'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['furthe_study']['f18d'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['furthe_study']['f1201'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['furthe_study']['f1202'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['furthe_study']['f14'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['furthe_study']['f15'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Quisioner Mulai Mencari Pekerjaan</h1>
    <table>
        <thead>
            <tr>
                <th>F301</th>
                <th>F302</th>
                <th>F303</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['quisioner'][0]['startsearchjobs']['f301'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['startsearchjobs']['f302'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['startsearchjobs']['f303'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Quisioner Bagaimana Mencari Pekerjaan</h1>
    <table>
        <thead>
            <tr>
                <th>F401</th>
                <th>F402</th>
                <th>F403</th>
                <th>F404</th>
                <th>F405</th>
                <th>F406</th>
                <th>F407</th>
                <th>F408</th>
                <th>F409</th>
                <th>F410</th>
                <th>F411</th>
                <th>F412</th>
                <th>F413</th>
                <th>F414</th>
                <th>F415</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f401'] ? $item['quisioner'][0]['howtofindjobs']['f401'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f402'] ? $item['quisioner'][0]['howtofindjobs']['f402'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f403'] ? $item['quisioner'][0]['howtofindjobs']['f403'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f404'] ? $item['quisioner'][0]['howtofindjobs']['f404'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f405'] ? $item['quisioner'][0]['howtofindjobs']['f405'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f406'] ? $item['quisioner'][0]['howtofindjobs']['f406'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f407'] ? $item['quisioner'][0]['howtofindjobs']['f407'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f408'] ? $item['quisioner'][0]['howtofindjobs']['f408'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f409'] ? $item['quisioner'][0]['howtofindjobs']['f409'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f410'] ? $item['quisioner'][0]['howtofindjobs']['f410'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f411'] ? $item['quisioner'][0]['howtofindjobs']['f411'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f412'] ? $item['quisioner'][0]['howtofindjobs']['f412'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f413'] ? $item['quisioner'][0]['howtofindjobs']['f413'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f414'] ? $item['quisioner'][0]['howtofindjobs']['f414'] : 0 }}
                    </td>
                    <td>{{ $item['quisioner'][0]['howtofindjobs']['f415'] ? $item['quisioner'][0]['howtofindjobs']['f415'] : 0 }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Quisioner Persusahaan Dilamar</h1>
    <table>
        <thead>
            <tr>
                <th>F6</th>
                <th>F7</th>
                <th>F7A</th>
                <th>F1001</th>
                <th>F1002</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['quisioner'][0]['companyapplied']['f6'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['companyapplied']['f7'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['companyapplied']['f7a'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['companyapplied']['f1001'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['companyapplied']['f1002'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Quisioner kesesuaian pekerjaan</h1>
    <table>
        <thead>
            <tr>
                <th>F1601</th>
                <th>F1602</th>
                <th>F1603</th>
                <th>F1604</th>
                <th>F1605</th>
                <th>F1606</th>
                <th>F1607</th>
                <th>F1608</th>
                <th>F1609</th>
                <th>F1610</th>
                <th>F1611</th>
                <th>F1612</th>
                <th>F1613</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1601'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1602'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1603'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1604'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1605'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1606'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1607'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1608'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1609'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1610'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1611'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1612'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['jobsuitability']['f1613'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Quisioner Metode Belajar</h1>
    <table>
        <thead>
            <tr>
                <th>F21</th>
                <th>F22</th>
                <th>F23</th>
                <th>F24</th>
                <th>F25</th>
                <th>F26</th>
                <th>F27</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['quisioner'][0]['studymethod']['f21'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['studymethod']['f22'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['studymethod']['f23'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['studymethod']['f24'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['studymethod']['f25'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['studymethod']['f26'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['studymethod']['f27'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Quisioner Kompeten</h1>
    <table>
        <thead>
            <tr>
                <th>f1761</th>
                <th>f1762</th>
                <th>F1763</th>
                <th>F1764</th>
                <th>F1765</th>
                <th>F1766</th>
                <th>F1767</th>
                <th>F1768</th>
                <th>f1769</th>
                <th>F1770</th>
                <th>F1771</th>
                <th>F1772</th>
                <th>F1773</th>
                <th>F1774</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['quisioner'][0]['competence']['f1761'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1762'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1763'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1764'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1765'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1766'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1767'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1768'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1769'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1770'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1771'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1772'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1773'] ?? '' }}</td>
                    <td>{{ $item['quisioner'][0]['competence']['f1774'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
