@extends('layouts.app')
<title>La Salle - Incidència</title>
@section('content')

<div class="container">
    
    <?php foreach ($incidences as $incidence) : ?>
        <?php
        $id = $incidence->id;
        $num = 0
        ?>
        <div class='card mt-2 mb-5'>
            <div class='card-body'>
                <h5 class='card-title'>#<?= $incidence->id ?> - <?= $incidence->subject ?></h5>
                <h6 class='card-title'><?= date('d/m/Y - H:i:s', strtotime($incidence->created_at)) ?></h6>
                <div class="form-row">
                    <div class="ml-1">
                        <span>Categoria:</span>
                    </div>
                    <div class="ml-2 mt-0"><p style="font-weight: bold;"> <?= $incidence->desc ?></p></div>
                </div>
                <div class="form-row">
                    <div class="ml-1">
                        <span>Incidència creada per:</span>
                    </div>
                    <div class="ml-2 mt-0"><p style="font-weight: bold;"> <?= $incidence->created_by ?></p></div>
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
                    <p class='card-text' style="text-align: justify"><?= $incidence->inc ?></p>
                </div>
                @if (Auth::user()->type === "Admin" || $rol == 1)
                <div class="d-flex flex-row-reverse mt-5">
                    <a href=" {{ url('status') }}<?="/" . $incidence->id . "/1"?>"><div class="mr-lg-4 btn btn-success font-weight-bold">Resoldre</div></a>
                    <a href=" {{ url('status') }}<?="/" . $incidence->id . "/2"?>"><div class="mr-lg-4 btn btn-primary font-weight-bold">En procés</div></a>
                    <a href=" {{ url('status') }}<?="/" . $incidence->id . "/3"?>"><div class="mr-lg-4 btn btn-warning text-white font-weight-bold">Desatendre</div></a>
                </div>
                @endif
                <hr></hr>
            <?php endforeach; ?>

            <!-- foreach comments -->

            <?php foreach ($comments as $comment) : ?>
                <div>
                    <?php $num++ ?>
                    <?= "<p style='font-weight: bold'>#" . $num . " - Comentari</p>" ?>
                    <div>
                        <div class="mt-1">
                            <div class="form-row">
                                <div class="ml-1">
                                    <span>Fet per: </span>
                                </div>
                                <div class="ml-2 mt-0">
                                    <p style="font-weight: bold"><?= $comment->user ?></p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="ml-1">
                                    <span>Data: </span>
                                </div>
                                <div class="ml-2 mt-0">
                                    <p style="font-weight: bold"><?= date('d/m/Y H:i:s', strtotime($comment->date)) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 class="card-title">Comentari</h5>
                    <div class="card mt-2">
                        <div class="ml-2 mt-2 mb-2">
                            <?= $comment->desc ?>
                        </div>
                    </div>
                </div>
                <hr></hr>
            <?php endforeach; ?>
        </div>
    </div>
    @if ((Auth::user()->username === $incidence->created_by) || (Auth::user()->type === "Admin"))
    <form class="form-horizontal" method="post" action="{{ url('addComment') }}<?= "/" . $id ?>">
        @csrf
        <div class="container" style="margin-top: -25px;">
            <div>
                <span>Escriu un comentari:</span>
            </div>
            <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea3" rows="5" name="comment"></textarea>
            </div>
            <input type='submit' class='btn btn-primary btn-user btn-block col-lg-4 mt-3' value='Enviar comentari' style="align-items: center">
        </div>
    </form>
    @endif
</div>
@endsection