@extends('layouts.success')

@section('title')
    Halaman Transaksi
@endsection

@section('content')
    <div class="page-content page-success">
      <div class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-items-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
              <img src="/images/success.svg" alt="" class="mb-4" />
              <h2>
                Transaksi sedang di proses!
              </h2>
              <p>
                Silahkan tunggu konfirmasi email dari kami dan kami akan
                menginformasikan resi secept mungkin!
              </p>
              <div>
                <a href="{{ route('dashboard') }}" class="btn btn-success w-50 mt-4">
                  Dashboard Saya
                </a>
                <a href="{{ route('home') }}" class="btn btn-signup w-50 mt-2">
                  Kembali berbelanja
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection