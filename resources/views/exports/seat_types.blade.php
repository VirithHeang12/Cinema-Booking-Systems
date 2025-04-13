<table>
    <thead>
        <tr>
            <td colspan="5" style="font-weight: bold;">Eternal Cinema</td>
        </tr>
        <tr>
            <td colspan="5" style="color: blue;">បញ្ជីប្រភេទកៅអី</td>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th style="width: 50px;">No</th>
            <th style="width: 300px;">Name</th>
            <th style="width: 500px;">Description</th>
            <th style="width: 500px;">Price</th>
            <th style="width: 300px;">Seats</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($seat_types as $index => $seat_type)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $seat_type['name']?? 'មិនមាន' }}</td>
                <td>{{ $seat_type['description'] ?? 'មិនមាន'}}</td>
                <td>{{ $seat_type['price']?? 'មិនមាន' }}</td>
                <td>{{ $seat_type['seats_count'] ?? 'មិនមាន'}}</td>
            </tr>
        @endforeach
    </tbody>
</table>


