@extends('layout.main')

@section('content')
    @can('admin')
        <div class="flex justify-between items-center mb-2">
            <form class="flex gap-2" action="/bidang" method="get">
                @csrf
                <input class="rounded" type="text" name="search" id="search">
                <button type="submit"
                    class="hover:bg-sky-800 duration-200 transition-all flex items-center gap-2 bg-sky-700 rounded text-white px-2 text-sm">Search</button>
            </form>
            <form action="/bidang/create" method="get">
                @csrf
                <button type="submit"
                    class="hover:bg-green-700 duration-200 transition-all flex items-center gap-2 bg-green-600 rounded text-white py-2 px-2 text-sm"><img
                        src="/svg/plus.svg" alt="plus image" width="10px" height="10px" /><span>Tambah
                        Bidang</span></button>
            </form>
        </div>
    @endcan
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 shadow"
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
                            <a href="/bidang?orderby=id&order=asc">
                            @elseif ($orderby == 'id' && $order == 'asc')
                                <a href="/bidang?orderby=id&order=desc">
                                @else
                                    <a href="/bidang">
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
                        @if ($orderby != 'nama_bidang')
                            <a href="/bidang?orderby=nama_bidang&order=asc">
                            @elseif ($orderby == 'nama_bidang' && $order == 'asc')
                                <a href="/bidang?orderby=nama_bidang&order=desc">
                                @else
                                    <a href="/bidang">
                        @endif
                        <div class="flex items-center justify-center">
                            <h3 class="mr-2">Nama Bidang</h3>
                            @if ($orderby != 'nama_bidang')
                                <i class="fa-sharp fa-solid fa-sort"></i>
                            @elseif($orderby == 'nama_bidang' && $order == 'asc')
                                <i class="fa-sharp fa-solid fa-sort-up"></i>
                            @else
                                <i class="fa-sharp fa-solid fa-sort-down"></i>
                            @endif
                        </div>
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        @if ($orderby != 'klasifikasi')
                            <a href="/bidang?orderby=klasifikasi&order=asc">
                            @elseif ($orderby == 'klasifikasi' && $order == 'asc')
                                <a href="/bidang?orderby=klasifikasi&order=desc">
                                @else
                                    <a href="/bidang">
                        @endif
                        <div class="flex items-center justify-center">
                            <h3 class="mr-2">Klasifikasi</h3>
                            @if ($orderby != 'klasifikasi')
                                <i class="fa-sharp fa-solid fa-sort"></i>
                            @elseif($orderby == 'klasifikasi' && $order == 'asc')
                                <i class="fa-sharp fa-solid fa-sort-up"></i>
                            @else
                                <i class="fa-sharp fa-solid fa-sort-down"></i>
                            @endif
                        </div>
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        @if ($orderby != 'pic')
                            <a href="/bidang?orderby=pic&order=asc">
                            @elseif ($orderby == 'pic' && $order == 'asc')
                                <a href="/bidang?orderby=pic&order=desc">
                                @else
                                    <a href="/bidang">
                        @endif
                        <div class="flex items-center justify-center">
                            <h3 class="mr-2">PIC</h3>
                            @if ($orderby != 'pic')
                                <i class="fa-sharp fa-solid fa-sort"></i>
                            @elseif($orderby == 'pic' && $order == 'asc')
                                <i class="fa-sharp fa-solid fa-sort-up"></i>
                            @else
                                <i class="fa-sharp fa-solid fa-sort-down"></i>
                            @endif
                        </div>
                        </a>
                    </th>
                    @can('admin')
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($bidangs as $index => $bidang)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="p-4 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{ $bidangs->firstItem() + $index }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{ $bidang->nama_bidang }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ $bidang->klasifikasi }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $bidang->pic }}
                        </td>
                        @can('admin')
                            <td class="px-6 py-4 text-center flex justify-center">
                                <a href="/bidang/{{ $bidang->id }}/edit"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <img src="svg/edit.svg" alt="Detail" class="rounded" />
                                </a>
                                <form action="/bidang/{{ $bidang->id }}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
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
            {{ $bidangs->links() }}
        </nav>
    </div>
@endsection
