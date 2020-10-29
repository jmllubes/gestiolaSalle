@extends('layouts.app')
<title>La Salle - Editar incidència</title>
@section('content')

<div class='container'>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 mt-3">Editar incidència</h1>
        </div>
        <form class="form-horizontal" method="POST" action="{{url('/edit')}}<?= "/" . $id ?>">
            @csrf
            <div class="form-group">
                <span>Assumpte</span>
                <input class="form-control mt-2 col-lg-3" type="text" id="subject" name="subject" value="<?= $subject ?>">
            </div>
            <div class="form-group">
                <span>Categoria</span>
                <select class="form-control mt-2 col-lg-3" name="category">
                    <?php foreach ($category as $categories) : ?>
                        <?php if ($categories->id == $cat): ?>
                            <option value="<?= $categories->id ?>" selected="selected"><?= $categories->description ?></option>
                        <?php else: ?>
                            <option value="<?= $categories->id ?>"><?= $categories->description ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <span>Descripció</span>
                <textarea class="form-control textinput mt-2" rows="10" style="width:100%;" name="desc" required><?= $description ?></textarea>
            </div>
            <hr>
            <input type="submit" value="Crear" class="btn btn-primary btn-user btn-block"/>
        </form>
    </div>
</div>
@endsection
