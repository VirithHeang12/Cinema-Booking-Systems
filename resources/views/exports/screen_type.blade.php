<table>
    <thead>
        <tr>
            <td colspan="5" style="font-weight: bold;">Eternal Cinema</td>
        </tr>
        <tr>
            <td colspan="5" style="color: blue;">បញ្ជីអេក្រង់</td>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th style="width: 50px;">No</th>
            <th style="width: 300px;">Name</th>
            <th style="width: 500px;">Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($screenTypes as $index => $screenType)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $screenType['name']?? 'មិនមាន' }}</td>
                <td>{{ $screenType['description'] ?? 'មិនមាន'}}</td>
            </tr>
        @endforeach
    </tbody>
</table>


