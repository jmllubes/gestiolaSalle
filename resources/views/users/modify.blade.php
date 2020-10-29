@extends('layouts.app')
<title>La Salle - Modificar usuaris</title>
@section('content')
<div class="container">
    <!-- DASHBOARD -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Modificar usuaris</h1>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btn_mod").on("click", function (e) {
                e.preventDefault();
                if (confirm("Estás segur que vols canviar l'estat d'administrador d'aquest usuari? ")) {
                    var username = $('#username-field').val();
                    var email = $('#email-field').val();
                    var id = $('#idUser-field').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '<?= url('edit-user') ?>',
                        data: {
                            username: username,
                            email: email,
                            id: id
                        },
                        success: function (data) {
                            var dataResult = JSON.parse(data);
                            $('#username' + id).html(username);
                            $('#email' + id).html(email);
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    })
                }
            });
        });

        function unsuscribe_user(id) {

            if (confirm("Estás segur que vols donar de baixa aquest usuari?")) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '<?= url('delete-user') ?>',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        var dataResult = JSON.parse(data);
                        $('#success-message-unsus').show(600).delay(2000).fadeOut(1000);
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }
        }

        function suscribe_user(id) {

            if (confirm("Estás segur que vols donar de alta aquest usuari?")) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '<?= url('suscribe-user') ?>',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        var dataResult = JSON.parse(data);
                        $('#success-message-sus').show(600).delay(2000).fadeOut(1000);
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }
        }

        function checkAdmin(id, username) {
            const cb = document.getElementById('admin' + id);
            var check = cb.checked;
            if (check) {
                var message = "Estás segur que vols donar permisos d'administrador a l'usuari " + username + "?";
            } else if (!check) {
                var message = "Estás segur que vols eliminar els permisos d'administrador a l'usuari " + username + "?";
            }

            if (confirm(message)) {

                var type = "";
                if (check) {
                    type = "Admin";
                } else if (!check) {
                    type = "Professor";
                }

                console.log("Check: " + check);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '<?= url('checkAdmin') ?>',
                    data: {
                        id: id,
                        type: type
                    },
                    success: function (data) {
                        var dataResult = JSON.parse(data);

                        location.reload();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }
        }

        function onModelOpen(id, username, email) {
            $('#idUser-field').val(id);
            $('#username-field').val(username);
            $('#email-field').val(email);
        }
    </script>
    <div id='messages'>
        <div id="success-message-sus" class="alert alert-success" role="alert" style="display: none;">
            Usuari donat d'alta correctament.
        </div>
        <div id="success-message-unsus" class="alert alert-success" role="alert" style="display: none;">
            Usuari donat de baixa correctament.
        </div>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#SQLID</th>
                <th scope="col">Rol</th>
                <th scope="col">E-mail</th>
                <th scope="col">Nom d'usuari</th>
                <th scope="col">Registre</th>
                <th scope="col">Accions</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($users as $user) : ?>
                <tr id="user<?= $user->id ?>">
                    <td class="text-dark"> <?= $user->id ?></td>
                    <td class="text-dark"> <?= $user->type ?></td>
                    <td id="email<?= $user->id ?>" class="text-dark"> <?= $user->email ?></td>
                    <td id="username<?= $user->id ?>" class="text-dark"><?= $user->username ?></td>
                    <td class="text-dark"><?= date('d/m/Y - H:i:s', strtotime($user->created_at)) ?></td>
                    <td>
                        <?php if ($user->unsuscribe === 0): ?>
                            <a onclick="unsuscribe_user(<?= $user->id ?>)" id="btn_del">
                                <div class="btn btn-danger"><i class="fas fa-arrow-alt-circle-down"></i></div>
                            </a>
                        <?php endif; ?>
                        <?php if ($user->unsuscribe === 1): ?>
                            <a onclick="suscribe_user(<?= $user->id ?>)" id="btn_sus">
                                <div class="btn btn-success"><i class="fas fa-arrow-alt-circle-up"></i></div>
                            </a>
                        <?php endif; ?>
                        <a onclick="onModelOpen(<?= $user->id ?>, '<?= $user->username ?>', '<?= $user->email ?>')" data-toggle="modal" data-target="#ModifyUser">
                            <div class="btn btn-warning"><i class="far fa-edit"></i></div>
                        </a>
                        <a href="{{url('rol')}}<?= "/" . $user->id ?>">
                            <div class="btn btn-info"><i class="fas fa-user-cog"></i></div>
                        </a>
                        <a onclick="checkAdmin(<?= $user->id ?>, '<?= $user->username ?>')">
                            <div class="form-group mt-2">
                                <?php if ($user->type === "Admin") : ?>
                                    <input id="admin<?= $user->id ?>" class="adminCheck" type="checkbox" name="admin<?= $user->id ?>" checked> Administrador
                                <?php else: ?>
                                    <input id="admin<?= $user->id ?>" class="adminCheck" type="checkbox" name="admin<?= $user->id ?>"> Administrador
                                <?php endif; ?>
                            </div>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
    <hr>
    <!-- Modal to modify user -->
    <div class="modal fade" id="ModifyUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modificar usuari</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label class="mt-2">Nom d'usuari</label>
                    <input type="text" id="username-field" class="form-control">
                    <label class="mt-2">Correu electrònic</label>
                    <input type="text" id="email-field" class="form-control">
                    <input type="hidden" id="idUser-field" class="form-control" value="">
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('log.cancel')</button>
                        <input id="btn_mod" data-dismiss="modal" class="btn btn-primary" type="submit" value="Modificar">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection