@extends('layouts.app')
<title>La Salle - @lang('log.create_incidence_button')</title>
@section('content')
<div class="container">
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 mt-3">@lang('log.create_incidence_button')</h1>
        </div>
        <form class="form-horizontal" method="POST" action="{{url('/create')}}">
            @csrf
            <div class="form-group">
                <span>Assumpte</span>
                <input class="form-control mt-2 col-lg-3" type="text" id="subject" name="subject">
            </div>
            <div class="form-group">
                <span>@lang('incidence.category')</span>
                <select class="form-control mt-2 col-lg-3" name="category">
                    <?php foreach ($category as $categories) : ?>
                        <option value="<?= $categories->id ?>"><?= $categories->description ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <span>@lang('incidence.description')</span>
                <textarea class="form-control textinput mt-2" rows="10" style="width:100%;" name="desc" required></textarea>
            </div>
            <hr>
            <input type="submit" value="Crear" class="btn btn-primary btn-user btn-block"/>
        </form>
    </div>
</div>
@endsection
