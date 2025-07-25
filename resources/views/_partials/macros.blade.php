@php
$width = $width ?? '25';
$withbg = $withbg ?? '#666cff';
@endphp
<span>
  <img src="{{ asset('public/images/logo_ponpes.png') }}" alt="Logo Ponpes" style="height: {{ $width }}px; width: auto;">
</span>
