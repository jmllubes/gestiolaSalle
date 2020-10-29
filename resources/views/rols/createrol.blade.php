@extends('layouts.app')
<title>La Salle - Crear rol</title>
@section('content')
<script type="text/javascript">
    function onValidateManual() {
        if (create_rol.checked == 1) {
            $("#form_rol").show();
        } else {
            $("#form_rol").hide();
        }
    }

    function delete_row(id) {
        if (confirm("Estàs segur que vols eliminar aquest rol? L'usuari elegit no tindrà més accés en aquesta categoria.")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?= url('deleterol') ?>',
                data: {id: id},
                success: function (data) {
                    $('#row' + id).fadeOut(1000, function () {
                        $('#row' + id).remove();
                    });
                },
                error: function () {
                    alert('Algo ha anat malament.');
                }
            });
        }
    }
</script>
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Esteu editant l'usuari: <strong><?= $user ?></strong></h1>
    </div>

    <div class="col-8">
        <p class="text-justify">
            <b>Breu explicació: </b> En la taula que hi ha a continuació es mostra els permisos que té l'usuari.
            En aquest panell podràs eliminar els rols necessaris o afegir nous rols per a que l'usuari pugui
            atendre i desatendre incidències d'aquella categoria seleccionada. 
        </p>
    </div>
    <hr>

    <form id="form_delete" method="POST">
        @csrf
        <table class="table mb-5">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Rol</th>
                    <th scope="col">Rol creat</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rol as $rol): ?>
                    <tr id="row<?= $rol->id ?>">
                        <td class="text-dark"><?= $rol->desc ?></td>
                        <td class="text-dark"><?= date('d/m/Y - H:i:s', strtotime($rol->created_at)) ?></td>
                        <td>
                            <a role="button" id="btn_del" onclick="delete_row(<?= $rol->id ?>)">
                                <div class="btn btn-danger"><i class="fas fa-trash"></i></div>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="create_rol" onclick="onValidateManual()">
        <label class="custom-control-label" for="create_rol"><span class="ml-4">Click per afegir un permís nou</span></label>
    </div>

    <form id="form_rol" method="POST" action="{{url('/createrol')}}<?= "/" . $userId ?>" style="display: none;">
        @csrf
        <div class="form-row col-lg-6">
            <select class="form-control mt-5 col-lg-6" name="category" style="margin-left: 440px;">
                <?php foreach ($category as $category): ?>
                    <option value="<?= $category->id ?>"><?= $category->description ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mt-5 col-lg-6" style="margin-left: 300px;">
            <input type="submit" value="GUARDAR" class="btn btn-primary btn-user btn-block"/>
        </div>
    </form>

</div>
@endsection