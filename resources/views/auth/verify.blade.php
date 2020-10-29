@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica el teu correu electrònic') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un enllaç per a la verificació ha sigut enviat al teu correu.') }}
                        </div>
                    @endif

                    {{ __('Abans de continuar, comproba el teu correu electrònic si us plau.') }}
                    {{ __('Si no has rebut el correu') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Prem aquí per solicitar un altre enllaç') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
