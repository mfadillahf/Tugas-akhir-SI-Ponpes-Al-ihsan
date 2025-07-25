@extends('layouts.landing')

@section('title', 'Kalender')

@section('content')
<!-- Section: Page Title -->
<section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" style="padding-top: 120px;" data-tm-bg-img="{{ asset('LandingPage/studypress/images/bg/bg1.jpg') }}">
    <div class="container pt-50 pb-50">
        <div class="section-content">
            <div class="row">
			  <div class="col-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
				<h2 class="title mb-2">Kalender</h2>
			  </div>
			  <div class="col-12 col-md-6 text-center text-md-end">
				<nav class="breadcrumbs d-inline-block" role="navigation" aria-label="Breadcrumbs">
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
                <div style="overflow-x:auto;">
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
<style>
  @media (max-width: 767.98px) {
    .fc .fc-toolbar {
      flex-direction: column;
      gap: 0.5rem;
      align-items: stretch;
      text-align: center;
    }

    .fc-toolbar-chunk {
      width: 100%;
      justify-content: center;
    }

    .fc-button {
      font-size: 0.75rem !important;
      padding: 0.3rem 0.5rem !important;
    }

    .fc .fc-button-group {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
    }

    .fc-toolbar-title {
      font-size: 1.2rem !important;
    }

    .fc .fc-daygrid-day-frame {
      padding: 4px;
    }

    .fc .fc-daygrid-day-events {
      font-size: 0.7rem;
      white-space: normal !important;
    }

    .fc .fc-event {
      font-size: 0.65rem;
      padding: 1px 2px;
    }
  }
</style>
@endpush

@push('scripts')
<!-- FullCalendar JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('full-event-calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
		initialView: 'dayGridMonth',
		locale: 'id',
		aspectRatio: window.innerWidth <= 767 ? 0.8 : 1.35,
		contentHeight: 'auto',
		headerToolbar: {
			left: 'prev,next today',
			center: 'title',
			right: 'dayGridMonth,timeGridWeek,listWeek'
		},
		events: @json($events)
	});
    calendar.render();
});
</script>
@endpush