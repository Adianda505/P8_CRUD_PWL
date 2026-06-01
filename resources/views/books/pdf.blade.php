<h2>Data Buku</h2>

<table border="1" width="100%">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Penulis</th>
    </tr>

    @foreach($books as $book)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
    </tr>
    @endforeach
</table>