<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $invoice)
            <tr>
                <td>{{ $invoice['fullname'] }}</td>
                <td>{{ $invoice['email'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
