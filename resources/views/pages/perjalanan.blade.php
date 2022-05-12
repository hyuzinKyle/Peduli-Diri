@extends('layouts.master')

@section('title', 'Dashboard')
@section('judul', 'Dashboard')

@section('content')

    <div class="form-between">
        <form class="form-select" method="GET" action="/perjalanan/sortPerjalanan">
            <div class="row">
                {{-- SORT --}}
                <select onchange="sortByCheck(this)" class="minimal" name="orderBy">
                    <option value="lokasi">Lokasi</option>
                    <option value="suhu">Suhu</option>
                    <option value="tanggal">Tanggal</option>
                    <option value="waktu">Waktu</option>
                </select>
                <select onchange="sortByCheck(this)" class="minimal" name="sortBy">
                    <option value="asc" id="sortByAsc">A - Z</option>
                    <option value="desc" id="sortByDesc">Z - A</option>
                </select>
                <button type="submit" class="button-1">
                    Sort
                    <i class="fas fa-search pl-2"></i>
                </button>
            </div>
        </form>

        <form class="form-select" action="/perjalanan/cariPerjalanan" method="GET">
            <div class="row">
                <select onchange="yesnoCheck(this)" class="minimal" type="search">
                    <option value="lokasi">Lokasi</option>
                    <option value="tanggal">Tanggal</option>
                    <option value="jam">Jam</option>
                    <option value="suhu">Suhu</option>
                </select>

                <div class="search">
                    <input name="lokasi" id="iflok" class="searchTerm" type="search" placeholder="Cari Lokasi"
                        aria-label="search">
                    <button id="iflokbtn" class="searchButton" type="submit"><i class="bx bx-search icon"></i></button>
                </div>
                <div class="search">
                    <input name="tanggal" id="iftgl" style="display: none;" class="searchTerm" type="date"
                        placeholder="Cari Tanggal">
                    <button id="iftglbtn" style="display:none" class="searchButton" type="submit"><i
                            class="bx bx-search icon"></i></button>
                </div>
                <div class="search">
                    <input name="waktu" id="ifjam" style="display: none;" class="searchTerm" type="time"
                        placeholder="Cari Jam">
                    <button id="ifjambtn" style="display:none" class="searchButton" type="submit"><i
                            class="bx bx-search icon"></i></button>
                </div>
                <div class="search">
                    <input name="suhu" id="ifsuhu" style="display: none;" class="searchTerm" type="search"
                        placeholder="Cari Suhu">
                    <button id="ifsuhubtn" style="display:none" class="searchButton" type="submit"><i
                            class="bx bx-search icon"></i></button>
                </div>
            </div>
        </form>
    </div>

    @if (session('message'))
        <div class="alert-success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{ session('message') }}
        </div>
    @endif

    <div class="card-table">
        <div class="container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">SUHU</th>
                        <th scope="col">TANGGAL</th>
                        <th scope="col">WAKTU</th>
                        <th scope="col">LOKASI</th>
                        <th scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_perjalanan as $dataperjalanan => $perjalanan)
                        <tr>
                            <td scope="row">{{ $dataperjalanan + $data_perjalanan->firstItem() }}</td>
                            <td>{{ $perjalanan->suhu }}</td>
                            <td>{{ $perjalanan->tanggal }}</td>
                            <td>{{ $perjalanan->waktu }}</td>
                            <td>{{ $perjalanan->lokasi }}</td>
                            <td>
                                <a class="button-table-danger delete-confirm"
                                    href="/perjalanan/{{ $perjalanan->id }}/delete" onclick="return confirm('Anda yakin hapus data perjalanan no {{ $dataperjalanan + $data_perjalanan->firstItem() }} ?')">
                                    <i class='bx bx-trash'></i>
                                </a>
                                <a href="/perjalanan/{{ $perjalanan->id }}/edit" class="button-table-warning">
                                    <i class='bx bx-edit'></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-end">
                {{ $data_perjalanan->appends($_GET)->links('layouts.pagination') }}
            </div>
            {{-- <div class="pagination">
                <a href="#">&laquo;</a>
                <a href="#">1</a>
                <a href="#" class="active">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">&raquo;</a>
            </div> --}}
        </div>
    </div>

    <script>
        function sortByCheck(that) {
            let value = that.value;
            let sortByAsc = document.getElementById('sortByAsc');
            let sortByDesc = document.getElementById('sortByDesc');

            if (that.value == "suhu") {
                sortByAsc.innerHTML = "Terkecil";
                sortByDesc.innerHTML = "Terbesar";
            } else if (that.value == "tanggal") {
                sortByAsc.innerHTML = "Terlama";
                sortByDesc.innerHTML = "Terbaru";
            } else if (that.value == "waktu") {
                sortByAsc.innerHTML = "Terlama";
                sortByDesc.innerHTML = "Terbaru";
            } else if (that.value == "lokasi") {
                sortByAsc.innerHTML = "A - Z";
                sortByDesc.innerHTML = "Z - A";
            }
        }

        function yesnoCheck(that) {
            if (that.value == 'lokasi') {
                document.getElementById("iflok").style.display = "block";
                document.getElementById("iflokbtn").style.display = "block";

                document.getElementById("iftgl").style.display = "none";
                document.getElementById("iftglbtn").style.display = "none";

                document.getElementById("ifjam").style.display = "none";
                document.getElementById("ifjambtn").style.display = "none";

                document.getElementById("ifsuhu").style.display = "none";
                document.getElementById("ifsuhubtn").style.display = "none";

            } else if (that.value == 'tanggal') {
                document.getElementById("iflok").style.display = "none";
                document.getElementById("iflokbtn").style.display = "none";

                document.getElementById("iftgl").style.display = "block";
                document.getElementById("iftglbtn").style.display = "block";

                document.getElementById("ifjam").style.display = "none";
                document.getElementById("ifjambtn").style.display = "none";

                document.getElementById("ifsuhu").style.display = "none";
                document.getElementById("ifsuhubtn").style.display = "none";

            } else if (that.value == "jam") {
                document.getElementById("iflok").style.display = "none";
                document.getElementById("iflokbtn").style.display = "none";

                document.getElementById("iftgl").style.display = "none";
                document.getElementById("iftglbtn").style.display = "none";

                document.getElementById("ifjam").style.display = "block";
                document.getElementById("ifjambtn").style.display = "block";

                document.getElementById("ifsuhu").style.display = "none";
                document.getElementById("ifsuhubtn").style.display = "none";

            } else {
                document.getElementById("iflok").style.display = "none";
                document.getElementById("iflokbtn").style.display = "none";

                document.getElementById("iftgl").style.display = "none";
                document.getElementById("iftglbtn").style.display = "none";

                document.getElementById("ifjam").style.display = "none";
                document.getElementById("ifjambtn").style.display = "none";

                document.getElementById("ifsuhu").style.display = "block";
                document.getElementById("ifsuhubtn").style.display = "block";
            }
        }
        var close = document.getElementsByClassName("closebtn");
        var i;

        // Loop through all close buttons
        for (i = 0; i < close.length; i++) {
            // When someone clicks on a close button
            close[i].onclick = function() {

                // Get the parent of <span class="closebtn"> (<div class="alert">)
                var div = this.parentElement;

                // Set the opacity of div to 0 (transparent)
                div.style.opacity = "0";

                // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
                setTimeout(function() {
                    div.style.display = "none";
                }, 300);
            }
        }
    </script>

@endsection
