
@extends('layouts.app')

@section('title')
Home
@endsection

    @section('content')
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
            <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6"><h3 class="mb-0">
                            Dashboard</h3>
                        </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </div>
                    </div>
                    <div class="col-sm-12">
                        <h5 class="mb-2">Selamat datang, {{ Auth::user()->username }}</h5>
                    </div>
                    <!--end::Row-->
                </div>
            <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                <!--begin::Col-->
                    <div class="col-lg-3 col-6">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box text-bg-primary">
                            <div class="inner">
                                <h3>{{ $jumlahSantri }}</h3>
                                <p>Jumlah Santri</p>
                            </div>
                            <div class="small-box-icon d-flex align-items-center justify-content-center">
                                <i class="bi bi-people fs-1 text-white"></i>
                            </div>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->
                    <div class="col-lg-3 col-6">
                        <!--begin::Small Box Widget 2-->
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                <h3>{{ $jumlahGuru }}</h3>
                                <p>Jumlah Guru</p>
                            </div>
                            <div class="small-box-icon d-flex align-items-center justify-content-center">
                                <i class="bi bi-people fs-1 text-white"></i>
                            </div>
                        </div>
                        <!--end::Small Box Widget 2-->
                    </div>
                    <!--end::Col-->
                    <div class="col-lg-3 col-6">
                        <!--begin::Small Box Widget 3-->
                        <div class="small-box text-bg-warning">
                            <div class="inner">
                                <h3>{{ $jumlahDonatur }}</h3>
                                <p>Jumlah Donatur</p>
                            </div>
                            <div class="small-box-icon d-flex align-items-center justify-content-center">
                                <i class="bi bi-people fs-1 text-white"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!--begin::Small Box Widget 3-->
                        <div class="small-box text-bg-danger">
                            <div class="inner">
                                <h3>{{ $jumlahPengurus }}</h3>
                                <p>Jumlah Pengurus</p>
                            </div>
                            <div class="small-box-icon d-flex align-items-center justify-content-center">
                                <i class="bi bi-people fs-1 text-white"></i>
                            </div>
                        </div>
                    </div>
                <!--end::Col-->
                </div>
            </div>
            <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
@endsection


