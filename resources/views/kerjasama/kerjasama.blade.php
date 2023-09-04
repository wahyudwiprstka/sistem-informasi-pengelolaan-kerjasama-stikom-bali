@extends('layout.main')

@section('content')
    @can('admin')
        <div class="flex justify-between items-center mb-2">
            <form class="flex gap-2" action="/kerjasama" method="get">
                @csrf
                <input class="rounded" type="text" name="search" id="search">
                <button type="submit"
                    class="hover:bg-sky-800 duration-200 transition-all flex items-center gap-2 bg-sky-700 rounded text-white px-2 text-sm">Search</button>
            </form>
            <form action="/kerjasama/create" method="get">
                @csrf
                <button type="submit"
                    class="hover:bg-green-700 duration-200 transition-all flex items-center gap-2 bg-green-600 rounded text-white py-2 px-2 text-sm"><img
                        src="/svg/plus.svg" alt="plus image" width="10px" height="10px" /><span>Tambah
                        Dokumen</span></button>
            </form>
        </div>
    @endcan
    @if (session()->has('success'))
        <div class="shadow p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 p-2 border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        @if ($orderby != 'id')
                            <a href="/kerjasama?orderby=id&order=asc">
                            @elseif ($orderby == 'id' && $order == 'asc')
                                <a href="/kerjasama?orderby=id&order=desc">
                                @else
                                    <a href="/kerjasama">
                        @endif
                        <div class="flex items-center justify-center">
                            <h3 class="mr-2">No</h3>
                            @if ($orderby != 'id')
                                <i class="fa-sharp fa-solid fa-sort"></i>
                            @elseif($orderby == 'id' && $order == 'asc')
                                <i class="fa-sharp fa-solid fa-sort-up"></i>
                            @else
                                <i class="fa-sharp fa-solid fa-sort-down"></i>
                            @endif
                        </div>
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        @if ($orderby != 'judul')
                            <a href="/kerjasama?orderby=judul&order=asc">
                            @elseif ($orderby == 'judul' && $order == 'asc')
                                <a href="/kerjasama?orderby=judul&order=desc">
                                @else
                                    <a href="/kerjasama">
                        @endif
                        <div class="flex items-center justify-center">
                            <h3 class="mr-2">Judul</h3>
                            @if ($orderby != 'judul')
                                <i class="fa-sharp fa-solid fa-sort"></i>
                            @elseif($orderby == 'judul' && $order == 'asc')
                                <i class="fa-sharp fa-solid fa-sort-up"></i>
                            @else
                                <i class="fa-sharp fa-solid fa-sort-down"></i>
                            @endif
                        </div>
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        @if ($orderby != 'jenis')
                            <a href="/kerjasama?orderby=jenis&order=asc">
                            @elseif ($orderby == 'jenis' && $order == 'asc')
                                <a href="/kerjasama?orderby=jenis&order=desc">
                                @else
                                    <a href="/kerjasama">
                        @endif
                        <div class="flex items-center justify-center">
                            <h3 class="mr-2">Jenis</h3>
                            @if ($orderby != 'jenis')
                                <i class="fa-sharp fa-solid fa-sort"></i>
                            @elseif($orderby == 'jenis' && $order == 'asc')
                                <i class="fa-sharp fa-solid fa-sort-up"></i>
                            @else
                                <i class="fa-sharp fa-solid fa-sort-down"></i>
                            @endif
                        </div>
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        @if ($orderby != 'status')
                            <a href="/kerjasama?orderby=status&order=asc">
                            @elseif ($orderby == 'status' && $order == 'asc')
                                <a href="/kerjasama?orderby=status&order=desc">
                                @else
                                    <a href="/kerjasama">
                        @endif
                        <div class="flex items-center justify-center">
                            <h3 class="mr-2">Status</h3>
                            @if ($orderby != 'status')
                                <i class="fa-sharp fa-solid fa-sort"></i>
                            @elseif($orderby == 'status' && $order == 'asc')
                                <i class="fa-sharp fa-solid fa-sort-up"></i>
                            @else
                                <i class="fa-sharp fa-solid fa-sort-down"></i>
                            @endif
                        </div>
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        @if ($orderby != 'durasi')
                            <a href="/kerjasama?orderby=durasi&order=asc">
                            @elseif ($orderby == 'durasi' && $order == 'asc')
                                <a href="/kerjasama?orderby=durasi&order=desc">
                                @else
                                    <a href="/kerjasama">
                        @endif
                        <div class="flex items-center justify-center">
                            <h3 class="mr-2">Durasi</h3>
                            @if ($orderby != 'durasi')
                                <i class="fa-sharp fa-solid fa-sort"></i>
                            @elseif($orderby == 'durasi' && $order == 'asc')
                                <i class="fa-sharp fa-solid fa-sort-up"></i>
                            @else
                                <i class="fa-sharp fa-solid fa-sort-down"></i>
                            @endif
                        </div>
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        @if ($orderby != 'tanggal_awal')
                            <a href="/kerjasama?orderby=tanggal_awal&order=asc">
                            @elseif ($orderby == 'tanggal_awal' && $order == 'asc')
                                <a href="/kerjasama?orderby=tanggal_awal&order=desc">
                                @else
                                    <a href="/kerjasama">
                        @endif
                        <div class="flex items-center justify-center">
                            <h3 class="mr-2">Masa Berlaku</h3>
                            @if ($orderby != 'tanggal_awal')
                                <i class="fa-sharp fa-solid fa-sort"></i>
                            @elseif($orderby == 'tanggal_awal' && $order == 'asc')
                                <i class="fa-sharp fa-solid fa-sort-up"></i>
                            @else
                                <i class="fa-sharp fa-solid fa-sort-down"></i>
                            @endif
                        </div>
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Mitra
                    </th>
                    </th>
                    @can('admin')
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $index => $dokumen)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="p-4 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{ $documents->firstItem() + $index }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{ $dokumen->judul }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ Str::upper($dokumen->jenis) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $dokumen->status }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $dokumen->durasi }} Tahun
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($dokumen->tanggal_awal != null && $dokumen->tanggal_berakhir != null)
                                {{ \Carbon\Carbon::parse($dokumen->tanggal_awal)->format('d F Y') }} ~
                                {{ \Carbon\Carbon::parse($dokumen->tanggal_berakhir)->format('d F Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $dokumen->mitra->nama }}
                        </td>
                        </td>
                        @can('admin')
                            <td class="px-6 py-4 text-center flex justify-center">
                                <a href="/kerjasama/{{ $dokumen->id }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <img src="svg/detail.svg" alt="Detail" class="rounded" />
                                </a>
                                <a href="/kerjasama/{{ $dokumen->id }}/edit"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <img src="svg/edit.svg" alt="Detail" class="rounded" />
                                </a>
                                <form action="/kerjasama/{{ $dokumen->id }}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <img src="svg/delete.svg" alt="Detail" class="rounde" />
                                    </button>
                                </form>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav class="p-4" aria-label="Table navigation">
            {{ $documents->links() }}
        </nav>
    </div>
@endsection
