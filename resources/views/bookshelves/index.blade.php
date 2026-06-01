<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Rak Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <x-primary-button tag="a" href="{{ route('bookshelves.create') }}">
                    Tambah Rak Buku
                </x-primary-button>
            </div>

            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>Kode Rak</th>
                        <th>Nama Rak</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>

                @php $num = 1; @endphp

                @foreach($bookshelves as $bookshelf)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $bookshelf->code }}</td>
                        <td>{{ $bookshelf->name }}</td>
                        <td>
                            <x-primary-button
                                tag="a"
                                href="{{ route('bookshelves.edit', $bookshelf->id) }}">
                                Edit
                            </x-primary-button>

                            <form action="{{ route('bookshelves.destroy', $bookshelf->id) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Apakah anda yakin?');">
                                @csrf
                                @method('DELETE')

                                <x-danger-button type="submit">
                                    Hapus
                                </x-danger-button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </x-table>

        </div>
    </div>
</x-app-layout>