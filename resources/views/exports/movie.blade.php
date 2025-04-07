<table>
    <thead>
        <tr>
            <td colspan="5" style="font-weight: bold;">Eternal Cinema</td>
        </tr>
        <tr>
            <td colspan="5" style="color: blue;">បញ្ជីភាពយន្ត</td>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th style="width: 50px;">No</th>
            <th style="width: 300px;">Title</th>
            <th style="width: 500px;">Description</th>
            <th style="width: 500px;">Duration</th>
            <th style="width: 300px;">Rating</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movies as $index => $movie)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $movie['title']?? 'មិនមាន' }}</td>
                <td>{{ $movie['description'] ?? 'មិនមាន'}}</td>
                <td>{{ $movie['duration']?? 'មិនមាន' }}</td>
                <td>{{ $movie['rating'] ?? 'មិនមាន'}}</td>
            </tr>
        @endforeach
    </tbody>
</table>


