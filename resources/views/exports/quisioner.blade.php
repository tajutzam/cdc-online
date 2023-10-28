@dd($data)

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>ID USER</th>
            <th>Kode PT</th>
            <th>Kode Prodi</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>HP</th>
            <th>Tahun Lulus</th>
            <th>NPWP</th>
            <th>F8</th>
            <th>F502</th>
            <th>F504</th>
            <th>F1101</th>
            <th>F5b</th>
            <th>F5c</th>
            <th>F5d</th>
            
            <th>F18a</th>
            <th>F18b</th>
            <th>F18c</th>
            <th>F18d</th>
            <th>F1201</th>
            <th>F14</th>
            <th>F15</th>
            <th>F301</th>
            <th>F302</th>
            <th>F303</th>
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
            <th>F6</th>
            <th>F7</th>
            <th>F7a</th>
            <th>F1001</th>
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
            <th>F505</th>
            <th>F5a1</th>
            <th>F5a2</th>
            <th>F1761</th>
            <th>F1762</th>
            <th>F1763</th>
            <th>F1764</th>
            <th>F1765</th>
            <th>F1766</th>
            <th>F1767</th>
            <th>F1768</th>
            <th>F1769</th>
            <th>F1770</th>
            <th>F1771</th>
            <th>F1772</th>
            <th>F1773</th>
            <th>F1774</th>
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
            <td>{{ $loop - iteration }}</td>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['identity_quisioner'][0]['kdptimsmh'] }}</td>
            <td>{{ $item['identity_quisioner'][0]['kdpstmsmh'] }}</td>
            <td>{{ $item['identity_quisioner'][0]['nimhsmsmh'] }}</td>
            <td>{{ $item['identity_quisioner'][0]['nmmhsmsmh'] }}</td>
            <td>{{ $item['identity_quisioner'][0]['telpomsmh'] }}</td>
            <td>{{ $item['identity_quisioner'][0]['tahun_lulus'] }}</td>
            <td>{{ $item['identity_quisioner'][0]['tahun_lulus'] }}</td>
            <td>{{ $item['identity_quisioner'][0]['npwp'] }}</td>
            <td>{{ $item['identity_quisioner'][0]['npwp'] }}</td>
            <td>{{ $item['main_quisioner'][0]['f8'] }}</td>
            <td>{{ $item['main_quisioner'][0]['f502'] }}</td>
            <td>{{ $item['main_quisioner'][0]['f504'] }}</td>
            <td>{{ $item['main_quisioner'][0]['f1101'] }}</td>
            <td>{{ $item['main_quisioner'][0]['f1101'] }}</td>
            <td>{{ $item['main_quisioner'][0]['f5b'] }}</td>
            <td>{{ $item['main_quisioner'][0]['f5c'] }}</td>
            <td>{{ $item['main_quisioner'][0]['f5d'] }}</td>
            <td>{{ $item['furthe_study_quisioner'][0]['f5d'] }}</td>
        @endforeach
    </tbody>

</table>
