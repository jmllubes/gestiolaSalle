@extends('layouts.app')
<title>La Salle - Inici</title>
@section('content')
<div class="container-fluid">
    <!-- DASHBOARD -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">PÀGINA PRINCIPAL</h1>
        <a href="{{url('/incidence')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> @lang('log.create_incidence_button')</a>
    </div>
    @if(Auth::user()->unsuscribe === 1)
    <div class="col-8">
        <p class="text-justify">
            <b>ATENCIÓ: </b> El teu compte està donat de baixa, això significa que tan sols tindras accés en la pàgina principal i dirigirte al teu perfil.
            Per a ser donat d'alta, contacta amb un administrador per a més informació.
        </p>
    </div>
    @endif
    <div class="row mt-5">
        <!-- categories -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Categories</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $category ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-align-left fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- usuaris -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Usuaris creats</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $users ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- incidencies creades -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Incidències creades</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $incidence ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- incidencies pendents -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Incidències pendents</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($inc_pend as $inc): ?>
                                    <?= $inc->inc_count ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sticky-note fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- incidencies en procés -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Incidències en procés</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($inc_process as $inc): ?>
                                    <?= $inc->inc_count ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comment-dots fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- incidencies resoltes -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Incidències resoltes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($inc_succ as $inc): ?>
                                    <?= $inc->inc_count ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 mb-5">
        <img src="{{asset('images/lasalle_lema.jpg')}}" class="rounded mx-auto d-block"/>
    </div>
</div>
@endsection
