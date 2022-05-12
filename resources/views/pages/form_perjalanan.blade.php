@extends('layouts.master')

@section('title', 'Tambah Data')
@section('judul', 'Tambah Data')

@section('content')

    <div class="card">
        <form action="/perjalanan/simpanperjalanan" method="POST" id="form" novalidate>
            @csrf
            @if (session('message'))
                <div class="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="form" id="form-unhide" style="display: none">
                <div class="alert-2" id="error" style="display: none"></div>
            </div>
            <div class="form">
                <input type="date" id="tanggal" name="tanggal" autocomplete="off" class="form-input" placeholder=" ">
                <label for="tanggal" class="form-label">Tanggal</label>
            </div>
            <div class="form">
                <input type="time" id="waktu" name="waktu" autocomplete="off" class="form-input" placeholder=" ">
                <label for="waktu" class="form-label">Waktu</label>
            </div>
            <div class="form">
                <input type="text" id="suhu" name="suhu" autocomplete="off" class="form-input" placeholder=" ">
                <label for="suhu" class="form-label">Suhu</label>
            </div>
            <div class="form">
                <input type="text" id="lokasi" name="lokasi" autocomplete="off" class="form-input" placeholder=" ">
                <label for="lokasi" class="form-label">Lokasi Yang Dikunjungi</label>
            </div>
            <div class="form">
                <button type="submit" class="button-1">
                    KIRIM
                </button>
            </div>
        </form>
    </div>

    <script>
        const tanggal = document.getElementById('tanggal')
        const lokasi = document.getElementById('lokasi')
        const waktu = document.getElementById('waktu')
        const suhu = document.getElementById('suhu')

        const form = document.getElementById('form')

        const unhide = document.getElementById('form-unhide')
        const errorElement = document.getElementById('error')

        form.addEventListener('submit', (e) => {
            let messages = []
            if (tanggal.value.length < 1) {
                errorElement.style.display = "block";
                unhide.style.display = "block";
                messages.push('Tanggal harus diisi')
            }
            if (waktu.value.length < 1) {
                errorElement.style.display = "block";
                unhide.style.display = "block";
                messages.push('Waktu harus diisi')
            }
            if (suhu.value.length < 1) {
                errorElement.style.display = "block";
                unhide.style.display = "block";
                messages.push('Suhu harus diisi')
            }
            if (lokasi.value < 1) {
                errorElement.style.display = "block";
                unhide.style.display = "block";
                messages.push('Lokasi harus diisi')
            }
            if (messages.length > 0) {
                e.preventDefault()
                errorElement.innerText = messages.join(', ')
            }
        })
    </script>

@endsection
