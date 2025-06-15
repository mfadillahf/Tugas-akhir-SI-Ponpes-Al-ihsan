@extends('layouts.landing')

@section('title', 'Kalender')

@section('content')
<!-- Section: Page Title -->
<section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" style="padding-top: 120px;" data-tm-bg-img="{{ asset('LandingPage/studypress/images/bg/bg1.jpg') }}">
    <div class="container pt-50 pb-50">
        <div class="section-content">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <h2 class="title">Kalender</h2>
                </div>
                <div class="col-md-6 text-end">
                    <nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
                        <div class="breadcrumbs">
                            <span><a href="{{ route('landing') }}">Beranda</a></span>
                            <span><i class="fa fa-angle-right mx-2"></i></span>
                            <span class="active">Kalender</span>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section: Kalender -->
<section class="py-5">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-md-12">
                    <div id="full-event-calendar"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<!-- FullCalendar CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
@endpush

@push('scripts')
<!-- FullCalendar JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('full-event-calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id',
            height: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            events: [
                @foreach ($agenda as $item)
                {
                    title: '{{ $item->judul }}',
                    start: '{{ $item->tanggal_mulai }}',
                    @if($item->tanggal_selesai && $item->tanggal_mulai != $item->tanggal_selesai)
                    end: '{{ \Carbon\Carbon::parse($item->tanggal_selesai)->addDay()->format('Y-m-d') }}',
                    @endif
                },
                @endforeach
            ]
        });
        calendar.render();
    });
</script>
@endpush
