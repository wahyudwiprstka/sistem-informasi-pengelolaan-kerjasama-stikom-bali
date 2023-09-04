@extends('layout.main')

@section('content')
    <section>
        @if ($documentsHampirKadaluarsa->count() != 0 || $documentslewat->count() != 0)
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                Ada kerjasama yang hampir kadaluarsa atau sudah lewat dari tanggal berakhir! <a
                    href="/kerjasama/hampir-kadaluarsa" class="font-medium">Klik disini untuk melihat</a>
            </div>
        @endif
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 px-4">
            <div class="shadow flex gap-2 items-center pl-6 py-4 bg-cyan-800 text-white rounded">
                <img src="/img/document.png" width="80" height="80" />
                <div class="ml-2">
                    <h3 class="text-lg font-semibold">MOU</h3>
                    <p>{{ $mou->count() }}</p>
                </div>
            </div>
            <div class="shadow flex gap-2 items-center pl-6 py-4 bg-sky-800 text-white rounded">
                <img src="/img/document.png" width="80" height="80" />
                <div class="ml-2">
                    <h3 class="text-lg font-semibold">MOA</h3>
                    <p>{{ $moa->count() }}</p>
                </div>
            </div>
            <div class="shadow flex gap-2 items-center pl-6 py-4 bg-blue-800 text-white rounded">
                <img src="/img/document.png" width="80" height="80" />
                <div class="ml-2">
                    <h3 class="text-lg font-semibold">Realisasi</h3>
                    <p>{{ $realisasi->count() }}</p>
                </div>
            </div>
            <div class="shadow flex gap-2 items-center pl-6 py-4 bg-indigo-800 text-white rounded">
                <img src="/svg/handshake.svg" width="80" height="80" />
                <div class="ml-2">
                    <h3 class="text-lg font-semibold">Total Kerjasama</h3>
                    <p>{{ $allkerjasama->count() }}</p>
                </div>
            </div>
            <div class="shadow flex gap-2 items-center pl-6 py-4 bg-violet-800 text-white rounded">
                <img src="/svg/mitra.svg" width="80" height="80" />
                <div class="ml-2">
                    <h3 class="text-lg font-semibold">Mitra</h3>
                    <p>{{ $mitra->count() }}</p>
                </div>
            </div>
            <div class="shadow flex gap-2 items-center pl-6 py-4 bg-purple-800 text-white rounded">
                <img src="/img/user.png" width="80" height="80" />
                <div class="ml-2">
                    <h3 class="text-lg font-semibold">User</h3>
                    <p>{{ $user->count() }}</p>
                </div>
            </div>
        </div>

        {{-- Table Kerjasama --}}
        <div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 bg-white border">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Judul
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jenis
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Masa Berlaku
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Mitra
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kerjasama as $index => $kerjasama)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 text-center">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $index + 1 }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $kerjasama->judul }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ Str::upper($kerjasama->jenis) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ Str::ucfirst($kerjasama->status) }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($kerjasama->tanggal_awal != null && $kerjasama->tanggal_berakhir != null)
                                        {{ \Carbon\Carbon::parse($kerjasama->tanggal_awal)->format('d F Y') }} -
                                        {{ \Carbon\Carbon::parse($kerjasama->tanggal_berakhir)->format('d F Y') }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $kerjasama->mitra->nama }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end mb-2">
                <button class="shadow border bg-white px-2 py-1 mt-2 rounded text-blue-600 hover:shadow-lg"><a
                        href="kerjasama">See
                        All</a></button>
            </div>

        </div>

        <div id="myChart" style="max-width:100vw; height:400px"></div>
    </section>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        var kerjasama = @json($yearcount);
        console.log(kerjasama[0].count);
        console.log(kerjasama);
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Set Data
            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Year');
            data.addColumn('number', 'Kerjasama');

            for (var i = 0; i < kerjasama.length; i++) {
                if (kerjasama[i].date != null) {
                    data.addRow([String(kerjasama[i].date), kerjasama[i].count]);
                }
            }
            // Set Options
            const options = {
                title: 'Tahun vs. Kerjasama',
                hAxis: {
                    title: 'Tahun'
                },
                vAxis: {
                    title: 'Kerjasama'
                },
                legend: 'none'
            };
            // Draw
            const chart = new google.visualization.LineChart(document.getElementById('myChart'));
            chart.draw(data, options);
        }
    </script>
@endsection
