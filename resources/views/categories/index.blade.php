<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <x-primary-button tag="a" href="{{ route('categories.create') }}">
                    Tambah Kategori
                </x-primary-button>
            </div>

            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>

                @php $num = 1; @endphp

                @foreach($categories as $category)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $category->category }}</td>
                        <td>
                            <x-primary-button
                                tag="a"
                                href="{{ route('categories.edit', $category->id) }}">
                                Edit
                            </x-primary-button>

                            <form action="{{ route('categories.destroy', $category->id) }}"
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