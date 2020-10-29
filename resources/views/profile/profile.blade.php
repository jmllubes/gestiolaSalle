@extends('layouts.app')
<title>La Salle - El meu perfil</title>
@section('content')
<div class="container mb-5">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mt-3">El meu perfil</h1>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div>
                <span class="h6">• <em>Dades personals</em></span>
                <hr>
                <div class="form-row ml-1">
                    <span>Nom: <b>{{ Auth::user()->username}}</b></span>
                </div>
                <div class="form-row ml-1">
                    <span>Correu electrònic: <b>{{ Auth::user()->email}}</b></span>
                </div>
                <div class="form-row ml-1">
                    @if(Auth::user()->unsuscribe === 0)
                    <span>Estat del compte: <b>Donat d'alta</b></span>
                    @else
                    <span>Estat del compte: <b>Donat de baixa</b></span>
                    @endif
                </div>
                <div class="form-row ml-1">
                    <span>Tipus d'usuari: <b>{{ Auth::user()->type}}</b></span>
                </div>
            </div>
            <hr>
            <div class="mt-3">
                <div>
                    <span class="h6">• <em>Rols assignats</em></span>
                </div>
                <div class="col-8 mt-3">
                    <p class="text-justify">
                        Estàs encarregat de les següents categories: 
                    </p>
                </div>
                <table class="table mb-5 mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Rol</th>
                            <th scope="col">Rol creat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rol as $rol): ?>
                            <tr id="row<?= $rol->id ?>">
                                <td class="text-dark"><?= $rol->desc ?></td>
                                <td class="text-dark"><?= date('d/m/Y - H:i:s', strtotime($rol->created_at)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="mt-4">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"> • Editar el meu perfil • </h1>
                </div>
                <div id="success-message" class="alert alert-success" role="alert" style="display: none;">
                    Dades canviades correctament.
                </div>
                <div id="error1" class="alert alert-danger" role="alert" style="display: none;">
                    Hi ha un o més camps buits, asegurat d'omplir-los abans de guardar les dades.
                </div>
                <div  id="error2" class="alert alert-danger" role="alert" style="display: none;">
                    La contrasenya ha de tenir com a menys 8 caracters. Escriu la contrasenya actual en cas de no voler canviar la contrasenya.
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputUserName">Nom d'usuari</label>
                        <input name="username" type="text" class="form-control" id="inputUserName" placeholder="Nom d'usuari" value="{{Auth::user()->username}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail">@lang('log.email')</label>
                        <input name="email" type="email" class="form-control" id="inputEmail" placeholder="@lang('log.email')" value="{{Auth::user()->email}}">
                    </div>
                    <!-- Password field + toggle button -->
                    <div class="form-group col-md-6">
                        <label for="inputPass">@lang('log.pass')</label>
                        <div class="form-row">
                            <div class="form-group cold-lg-12">
                                <input type="password" id="password" name="password" class="form-control" data-toggle="password">
                            </div>
                            <div class="showPassword form-group btn btn-info ml-2">
                                <i id="eyeCheck" class="fa fa-eye-slash mt-1"></i>
                            </div>
                        </div>
                    </div>
                    <!-- End of password + toggle button -->
                </div>
                <div class="changeValues mt-5 col-lg-6">
                    <input type="submit" value="GUARDAR" class="btn btn-info btn-user btn-block"/>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".showPassword").on("click", function (e) {
            e.preventDefault();

            var check = document.getElementById("password");

            if (check.type === "password") {
                check.type = "text";
                document.getElementById("eyeCheck").className = "fa fa-eye mt-1";
            } else {
                check.type = "password";
                document.getElementById("eyeCheck").className = "fa fa-eye-slash mt-1";
            }
        });
        $(".changeValues").on("click", function (e) {
            e.preventDefault();

            var username = $('#inputUserName').val();
            var email = $('#inputEmail').val();
            var password = $('#password').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?= url('/profile/edit') ?>',
                data: {username: username, email: email, password: password},
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.status === 401) {
                        if (response.errors.length === 2) {
                            $('#error1').show(600).delay(2000).fadeOut(1000);
                            $('#error2').show(600).delay(4000).fadeOut(1000);
                        } else if (response.errors[0].empty === 1) {
                            $('#error1').show(600).delay(2000).fadeOut(1000);
                        } else if (response.errors[0].length === 1) {
                            $('#error2').show(600).delay(4000).fadeOut(1000);
                        }
                    } else {
                        $('#success-message').show(600).delay(2000).fadeOut(1000);
                        setTimeout(function() { location.reload(); }, 2000);
                    }
                },
                error: function (e) {
                    alert("Algo ha anat malament en la connexió amb el servidor.");
                }
            });
        });
    });
</script>
@endsection
