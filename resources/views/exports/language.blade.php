<table>
    <thead>
        <tr>
            <td colspan="2" style="font-weight: bold;">Eternal Cinema</td>
        </tr>
        <tr>
            <td colspan="2" style="color: blue;">បញ្ជីភាសា</td>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th style="width: 300px;">Name</th>
            <th style="width: 500px;">Code</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($languages as $index => $language)
            <tr>
                <td>{{ $language['name']?? 'មិនមាន' }}</td>
                <td>{{ $language['code'] ?? 'មិនមាន'}}</td>
            </tr>
        @endforeach
    </tbody>
</table>


