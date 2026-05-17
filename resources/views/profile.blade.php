<h1>Data Diri</h1>
<h2>Nama: John Doe</h2>
<h2>Email: johndoe@example.com</h2>

{{-- @route('profile') --}}
<a href="<?=route('profile')?>">Menuju Profile</a>

<form method="POST">
    <input type="text" name="_method" value="$name">
</form>
