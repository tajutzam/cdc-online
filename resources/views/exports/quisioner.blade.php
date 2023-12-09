<table>
    <thead>
        <tr>
            <th>kdptimsmh</th>
            <th>kdpstmsmh</th>
            <th>nimhsmsmh</th>
            <th>nmmhsmsmh</th>
            <th>telpomsmh</th>
            <th>emailmsmh</th>
            <th>tahun_lulus</th>
            <th>nik</th>
            <th>npwp</th>
            <th>f8</th>
            <th>f504</th>
            <th>f502</th>
            <th>f505</th>
            <th>f506</th>
            <th>f5a1</th>
            <th>f5a2</th>
            <th>f1101</th>
            <th>f1102</th>
            <th>f5b</th>
            <th>f5c</th>
            <th>f5d</th>
            <th>f18a</th>
            <th>f18b</th>
            <th>f18c</th>
            <th>f18d</th>
            <th>f1201</th>
            <th>f1202</th>
            <th>f14</th>
            <th>f15</th>
            <th>f1761</th>
            <th>f1762</th>
            <th>f1763</th>
            <th>f1764</th>
            <th>f1765</th>
            <th>f1766</th>
            <th>f1767</th>
            <th>f1768</th>
            <th>f1769</th>
            <th>f1770</th>
            <th>f1771</th>
            <th>f1772</th>
            <th>f1773</th>
            <th>f1774</th>
            <th>f21</th>
            <th>f22</th>
            <th>f23</th>
            <th>f24</th>
            <th>f25</th>
            <th>f26</th>
            <th>f27</th>
            <th>f301</th>
            <th>f302</th>
            <th>f303</th>
            <th>f401</th>
            <th>f402</th>
            <th>f403</th>
            <th>f404</th>
            <th>f405</th>
            <th>f406</th>
            <th>f407</th>
            <th>f408</th>
            <th>f409</th>
            <th>f410</th>
            <th>f411</th>
            <th>f412</th>
            <th>f413</th>
            <th>f414</th>
            <th>f415</th>
            <th>f416</th>
            <th>f6</th>
            <th>f7</th>
            <th>f7a</th>
            <th>f1001</th>
            <th>f1002</th>
            <th>f1601</th>
            <th>f1602</th>
            <th>f1603</th>
            <th>f1604</th>
            <th>f1605</th>
            <th>f1606</th>
            <th>f1607</th>
            <th>f1608</th>
            <th>f1609</th>
            <th>f1610</th>
            <th>f1611</th>
            <th>f1612</th>
            <th>f1613</th>
            <th>f1614</th>
            <th style="background-color: salmon">Level</th>
            <th style="background-color: salmon">ID User</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item['quisioner'][0]['identity']['kdptimsmh'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['identity']['kdpstmsmh'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['identity']['nimhsmsmh'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['identity']['nmmhsmsmh'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['identity']['telpomsmh'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['identity']['emailmsmh'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['identity']['tahun_lulus'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['identity']['nik'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['identity']['npwp'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['main']['f8'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['main']['f504'] ?? false }}</td>
                <td>{{ $item['quisioner'][0]['main']['f502'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['main']['f505'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['main']['f506'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['main']['province']['nama_provinsi'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['main']['regency']['nama_kabupaten'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['main']['f1101'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['main']['f1102'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['main']['f5b'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['main']['f5c'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['main']['f5d'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['furthe_study']['f18a'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['furthe_study']['f18b'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['furthe_study']['f18c'] ?? '' }}</td>
                <td>{{ \Carbon\Carbon::parse($item['quisioner'][0]['furthe_study']['f18d'])->format('d-m-y') ?? '' }}
                </td>
                <td>{{ $item['quisioner'][0]['furthe_study']['f1201'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['furthe_study']['f1202'] ?? '' }}</td>

                <td>{{ $item['quisioner'][0]['furthe_study']['f14'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['furthe_study']['f15'] ?? '' }}</td>
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

                <td>{{ $item['quisioner'][0]['studymethod']['f21'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['studymethod']['f22'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['studymethod']['f23'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['studymethod']['f24'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['studymethod']['f25'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['studymethod']['f26'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['studymethod']['f27'] ?? '' }}</td>

                <td>{{ $item['quisioner'][0]['startsearchjobs']['f301'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['startsearchjobs']['f302'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['startsearchjobs']['f303'] ?? '' }}</td>
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
                <td>{{ $item['quisioner'][0]['howtofindjobs']['f416'] ? $item['quisioner'][0]['howtofindjobs']['f415'] : 0 }}
                </td>

                <td>{{ $item['quisioner'][0]['companyapplied']['f6'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['companyapplied']['f7'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['companyapplied']['f7a'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['companyapplied']['f1001'] ?? '' }}</td>
                <td>{{ $item['quisioner'][0]['companyapplied']['f1002'] ?? '' }}</td>

                <td>{{ $item['quisioner'][0]['jobsuitability']['f1601'] ?? false }}</td>
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
                <td>{{ $item['quisioner'][0]['jobsuitability']['f1614'] ?? '' }}</td>

                <td style="background-color: salmon">{{ $item['quisioner'][0]['level'] }}</td>
                <td style="background-color: salmon">{{ $item['id'] }}</td>
            </tr>
        @endforeach
    </tbody>

</table>
