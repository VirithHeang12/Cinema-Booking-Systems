<table>
    <thead>
        <tr>
            <td colspan="4" style="font-weight: bold;">Eternal Cinema</td>
        </tr>
        <tr>
            <td colspan="4" style="color: blue; font-weight: bold; font-size: 32px;">បញ្ជីប្រទេស</td>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th style="width: 100px; height: 40px; font-weight: semibold;">លេខរៀង</th>
            <th style="width: 300px; height: 40px; font-weight: semibold;">ឈ្មោះប្រទេស</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($countries as $index => $country)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $country->name ?? 'មិនមាន' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
