@extends('layouts.app')

@section('title', 'Tentang Kami - DanaBijak')

@push('custom-css')
<link rel="stylesheet" href="{{ asset('css/style-about.css') }}">
@endpush

@section('content')
<div class="container">
  <h1>Tentang Kami</h1>
  <p>DanaBijak adalah platform manajemen keuangan yang dirancang untuk membantu Anda mengatur pemasukan dan pengeluaran secara lebih bijak dan efektif.</p>

  <p>Dengan DanaBijak, Anda dapat mencatat semua transaksi pemasukan dan pengeluaran, melacak saldo keuangan, serta mengelola berbagai kategori pengeluaran. Kami menyediakan antarmuka yang mudah digunakan untuk membantu Anda merencanakan keuangan dengan lebih baik, baik untuk kebutuhan sehari-hari maupun tujuan jangka panjang.</p>

  <h3>Misi Kami</h3>
  <p>Misi DanaBijak adalah membantu setiap individu dan keluarga mencapai keseimbangan keuangan yang lebih baik. Kami percaya bahwa dengan perencanaan yang tepat, semua orang dapat mencapai tujuan finansial mereka.</p>

  <!-- Carousel Section -->
  <div id="carouselTentang" class="carousel slide" data-bs-ride="false">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('img/slide1.JPG') }}" class="d-block w-100" alt="Danabijak" style="object-fit: cover; height: 500px;">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('img/slide2.JPG') }}" class="d-block w-100" alt="Danabijak" style="object-fit: cover; height: 500px;">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('img/slide3.JPG') }}" class="d-block w-100" alt="Danabijak" style="object-fit: cover; height: 500px;">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselTentang" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselTentang" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden"></span>
    </button>
  </div>

@push('custom-js')
<script>
    // Menonaktifkan auto-slide pada carousel
    document.addEventListener('DOMContentLoaded', function () {
        var myCarousel = document.getElementById('carouselTentang');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: false,  // Menonaktifkan auto-slide
        });
    });
</script>
@endpush


  <p>Dengan DanaBijak, kami berharap dapat memberikan solusi pengaturan keuangan yang praktis dan terjangkau untuk semua orang.</p>
</div>
@endsection