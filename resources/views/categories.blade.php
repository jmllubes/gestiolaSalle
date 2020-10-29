@extends('layouts.app')
<title>La Salle - Gestió d'incidencies</title>
@section('content')
<div class='container'>
    <!-- AJAX request on create new category -->
    <script type="text/javascript">
        $(document).ready(function () {
            $(".onCreateCat").on("click", function (e) {
                e.preventDefault();
                var category = $('#cat_desc').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '<?= url('create-category') ?>',
                    data: {
                        category: category
                    },
                    success: function (data) {
                        var dataResult = JSON.parse(data);
                        $('#success-message').show(600).delay(2000).fadeOut(1000);
                        $('#cat_desc').val("");
                    },
                    error: function (e) {
                        console.log(e);
                        $('#error-message').show(600).delay(2000).fadeOut(1000);
                    }
                }).done(function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'GET',
                        url: '<?= url('fetch-last-category') ?>',
                        datatype: 'json',
                        success: function (data) {
                            var cat = JSON.parse(data);
                            var id = cat.category.id;
                            var desc = cat.category.description;
                            var column1 = "<td class='text-dark' id=" + id + ">" + desc + "</td>";
                            var column2 = "<td class='text-dark' style='font-weight: bold'><a id='btn1' class='btn btn-warning' onclick='onUpdateCategory(" + id + ", \"" + desc + "\")' role='button' style='font-weight: bold;' data-toggle='modal' data-target='#ModifyCat'>Modificar</a></td>";
                            var column3 = "<td class='text-white'><a class='btn btn-danger' role='button' style='font-weight: bold;'>Borrar</a></td>";
                            var row = "<tr id=" + id + ">" + column1 + column2 + column3 + "</tr>";
                            var column2 = "<td class='text-white' style='font-weight: bold'><a id='btn1' class='btn btn-warning' onclick='onUpdateCategory(" + id + ", \"" + desc + "\")' role='button' style='font-weight: bold;' data-toggle='modal' data-target='#ModifyCat'>Modificar</a></td>";
                            var column3 = "<td class='text-white'><a class='btn btn-danger' role='button' style='font-weight: bold;' onclick=delete_row(" + id + ")>Borrar</a></td>";
                            var row = "<tr id=row" + id + ">" + column1 + column2 + column3 + "</tr>";
                            $('#elements tbody').append(row);
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                });
            });
        });

        function update_category() {
            var desc = $('#name-category-field').val();
            var id = $('#id-category-field').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?= url('update-category') ?>',
                data: {description: desc, id: id},
                success: function (data) {
                    $('#column'+id).html(desc);
                    $('#success-message-updated').show(600).delay(2000).fadeOut(1000);
                },
                error: function (e) {
                    $('#error-message-not-updated').show(600).delay(2000).fadeOut(1000);

                    console.log(e);
                }
            });
        }

        function onUpdateCategory(id, desc) {
            $('#name-category-field').val(desc);
            $('#id-category-field').val(id);
        }
    </script>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Crear nova categoria</h1>
        </div>
        <div id="error-messages">
            <div id="success-message" class="alert alert-success" role="alert" style="display: none;">
                Categoria creada correctament.
            </div>
            <div id="success-message-updated" class="alert alert-success" role="alert" style="display: none;">
                Categoria actualitzada correctament.
            </div>
            <div id="error-message" class="alert alert-danger" role="alert"  style="display: none;">
                Hi ha hagut un problema en la creació de la nova categoria.
            </div>
            <div id="error-message-not-updated" class="alert alert-danger" role="alert"  style="display: none;">
                Hi ha hagut un problema en la actualització de la categoria.
            </div>
        </div>
        <div name="create_new_category">
            <span>Descripció</span>
            <div class="form-row">
                <input class="form-control mt-2 col-lg-3" type="text" id="cat_desc">
                <input type="submit" value="Crear" class=" onCreateCat btn btn-primary btn-user btn-block col-lg-2 ml-5 mt-2"/>
            </div>
        </div>
    </div>
    <hr></hr>
    <div>
        <table class="table" id="elements">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Descripció</th>
                    <th id='borrar'></th>
                    <th id='modificar'></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($category as $categories) {
                    echo "<tr id='row" . $categories->id . "'>";
                    echo "<td class='text-dark' id=column" . $categories->id . ">" . $categories->description . "</td>";
                    echo "<td class='text-white' style='font-weight: bold'><a id='btn1' class='btn btn-warning' onclick='onUpdateCategory(" . $categories->id . ", \"" . $categories->description . "\")' role='button' style='font-weight: bold;' data-toggle='modal' data-target='#ModifyCat'>Modificar</a></td>";
                    echo "</tr>";
                }
                ?>
        </table>
    </div>
    
    <div class="modal fade" id="ModifyCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modificar categoria</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="name-category-field" class="form-control" value="">
                    <input type="hidden" id="id-category-field" class="form-control" value="">
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('log.cancel')</button>
                        <input data-dismiss="modal" class="btn btn-primary" type="submit" value="Modificar" onclick="update_category()">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection