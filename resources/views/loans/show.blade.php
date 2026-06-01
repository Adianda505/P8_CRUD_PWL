<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Daftar Buku</h2>
    @forelse ($bookshelves->books as $book)
        <div>
            ID: {{ $book->id }} <br>
            Judul: {{ $book->title }} <br>
            Pengarang: {{ $book->author }} <br>
        </div>
    @empty
        <p>Rak Buku Kosong</p>
    @endforelse
</body>
</html>