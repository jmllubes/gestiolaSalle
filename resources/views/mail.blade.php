@extends('layouts.mails')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <p class="h5 mb-0 text-gray-800">S'ha creat una nova incidència, prem <strong><a href="{{route('showinc',$id)}}">aquí</a></strong> per accedir a l'incidència.</p>
    <br>
</div>
<p style="font-size: 12px;">Més informació:</p>

<h5 class='card-title mt-5'>{{ $subject }}</h5>
<div class="form-row">
    <div class="ml-1">
        <p>Categoria:<span style="font-weight: bold;"> {{ $categoryname }}</span></p>
    </div>
</div>
<div class="form-row">
    <div class="ml-1">
        <p>Estat: <span style="font-weight: bold; color: #ffcc00">{{ $status }}</span></p>
    </div>
</div>
<span><strong>Descripció: </strong></span>
<div class="mt-2">
    <p class='card-text'>{{ $description }}</p>
</div>
@endsection