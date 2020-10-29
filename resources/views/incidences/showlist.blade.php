@extends('layouts.app')
<title>La Salle - Llistat de incidències</title>
@section('content')

<div class="container">
    <div class="col-8">
        <p class="text-justify">
            <b>Breu explicació: </b> A continuació, en aquesta pàgina es troben les teves incidències.
            Selecciona qualsevol d'elles per a dirigirte a la següent pàgina, la qual, et deixarà editar els seus camps.
        </p>
    </div>
    <hr>
    <?php foreach ($incidences as $incidence) : ?>
        <div class='card mt-2 mb-5'>
            <div class='card-body'>
                <a href="{{url('edit-incidence')}}<?= "/" . $incidence->id ?>"><h5 class='card-title'>#<?= $incidence->id ?> - <?= $incidence->subject ?></h5></a>
                <h6 class='card-title'><?= date('d/m/Y - H:i:s', strtotime($incidence->created_at)) ?></h6>
                <div class="form-row">
                    <div class="ml-1">
                        <span>Categoria:</span>
                    </div>
                    <div class="ml-2 mt-0"><p style="font-weight: bold;"> <?= $incidence->cat ?></p></div>
                </div>
                <div class="form-row mb-2">
                    <div class="ml-1">
                        <span>Estat: </span>
                    </div>
                    <div class="ml-2 mt-0">
                        <?php
                        if ($incidence->status === "Pendent") {
                            echo "<p style=\"font-weight: bold; color: #ffcc00\">Pendent</p>";
                        } else if ($incidence->status === "Resolta") {
                            echo "<p style=\"font-weight: bold; color: #33cc33\">Resolta</p>";
                        } else if ($incidence->status === "En procés") {
                            echo "<p style=\"font-weight: bold; color: #0099ff\">En procés</p>";
                        }
                        ?>
                    </div>
                </div>
                <span><strong>Descripció: </strong></span>
                <div class="mt-2">
                    <p class='card-text'><?= $incidence->inc ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

@endsection
