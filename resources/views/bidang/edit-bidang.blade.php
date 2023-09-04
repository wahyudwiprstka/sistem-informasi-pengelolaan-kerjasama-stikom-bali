@extends('layout.main')

@section('content')
    <section class="bg-white lg:mt-2 rounded shadow m-auto mt-0 lg:w-2/3 w-full">
        <div class="py-8 px-4 mx-auto max-w-2xl">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Bidang</h2>
            <form action="/bidang/{{ $bidang->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT" />
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="nama_bidang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Bidang</label>
                        <input type="text" name="nama_bidang" id="nama_bidang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Masukkan nama bidang" required value="{{ $bidang->nama_bidang }}">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="klasifikasi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klasifikasi
                            Bidang</label>
                        <select
                            class="dropdown-with-search bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="klasifikasi" id="klasifikasi">
                            <option value="{{ $bidang->klasifikasi }}" class="hover:bg-black" selected hidden>
                                {{ $bidang->klasifikasi }}</option>
                            <option value="Fakultas">Fakultas</option>
                            <option value="Laboratorium">Laboratorium
                            </option>
                            <option value="UPT">UPT</option>
                            <option value="Jurusan">Jurusan</option>
                            <option value="Rektorat">Rektorat</option>
                            <option value="Unit Kerja">Unit Kerja
                            </option>
                            <option value="Penyelenggara MKU">Penyelenggara MKU</option>
                            <option value="Program Studi">Program Studi</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="pic"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PIC</label>
                        <input type="text" name="pic" id="pic"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Masukkan Penanggungjawab (PIC)" required value="{{ $bidang->pic }}">
                    </div>
                </div>
                <button type="submit"
                    class="w-full px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                    Submit
                </button>
            </form>
        </div>
    </section>
@endsection
