@extends('layouts.app')
<title>La Salle - Buscar incidència</title>
@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mt-3">Buscar incidències</h1>
    </div>
    <div class="form-row mb-5">
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="fetchall" name="status" checked onclick="fetchAll()">
            <label class="custom-control-label" for="fetchall"><span class="ml-4">Mostrar tots</span></label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="s_pendent" name="status" onclick="fetchPendent()">
            <label class="custom-control-label" for="s_pendent"><span class="ml-4">Estat: </span><span style="font-weight: bold; color: #ffcc00">Pendent</span></label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="s_proces" name="status" onclick="fetchProces()">
            <label class="custom-control-label" for="s_proces"><span class="ml-4">Estat: </span><span style="font-weight: bold; color: #0099ff">En procés</span></label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="s_resolta" name="status" onclick="fetchResolt()">
            <label class="custom-control-label" for="s_resolta"><span class="ml-4">Estat:</span><span class="ml-2" style="font-weight: bold; color: #33cc33">Resolta</span></label>
        </div>
    </div>
    <table id="tableIncidence" class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Feta per</th>
                <th scope="col">Assumpte</th>
                <th scope="col">Categoria</th>
                <th scope="col">Estat</th>
                <th scope="col">Data</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($incidences as $inc) : ?>
                <tr>
                    <td class="text-dark"><?= $inc->created_by ?></td>
                    <td class="text-dark"><a href="{{url('incidence', $inc->id)}}"><?= $inc->subject ?></a></td>
                    <td class="text-dark"><?= $inc->desc ?></td>
                    <td class="text-dark"><?= $inc->status ?></td>
                    <td class="text-dark"><?= date('d/m/Y - H:i:s', strtotime($inc->created_at)) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function fetchAll() {
        if (fetchall.checked == 1) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: '<?= url('fetchall') ?>',
                success: function (data) {
                    var response = JSON.parse(data);
                    var url = '<?= url('incidence') ?>';
                    var incidences = response.incidences;
                    var tr = "";
                    $("#tableIncidence").find("tbody").empty();

                    for (i in incidences) {
                        var str = incidences[i].created_at;
                        var result = str.split(" ");

                        var temp = result[0];
                        var today = new Date(temp);
                        var day = today.getDate();
                        if (day < 10)
                            day = "0" + day;
                        var date = day + "/" + (today.getMonth() + 1) + "/" + today.getFullYear();
                        var hour = result[1];

                        var final_date = date + " - " + hour;

                        tr = "<tr><td class='text-dark'>" + incidences[i].created_by + "</td><td class='text-dark'><a href='" + url + "/" + incidences[i].id + "'>" + incidences[i].subject + "</a></td><td class='text-dark'>" + incidences[i].desc + "</td><td class='text-dark'>" + incidences[i].status + "</td><td class='text-dark'>" + final_date + "</td>";
                        $("#tableIncidence").find("tbody").append(tr);
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }
    }
    function fetchPendent() {
        if (s_pendent.checked == 1) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: '<?= url('fetchpendent') ?>',
                success: function (data) {
                    var response = JSON.parse(data);
                    var url = '<?= url('incidence') ?>';
                    var incidences = response.incidences;
                    var tr = "";
                    $("#tableIncidence").find("tbody").empty();

                    for (i in incidences) {
                        var str = incidences[i].created_at;
                        var result = str.split(" ");

                        var temp = result[0];
                        var today = new Date(temp);
                        var day = today.getDate();
                        if (day < 10)
                            day = "0" + day;
                        var date = day + "/" + (today.getMonth() + 1) + "/" + today.getFullYear();
                        var hour = result[1];

                        var final_date = date + " - " + hour;

                        tr = "<tr><td class='text-dark'>" + incidences[i].created_by + "</td><td class='text-dark'><a href='" + url + "/" + incidences[i].id + "'>" + incidences[i].subject + "</a></td><td class='text-dark'>" + incidences[i].desc + "</td><td class='text-dark'>" + incidences[i].status + "</td><td class='text-dark'>" + final_date + "</td>";
                        $("#tableIncidence").find("tbody").append(tr);
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }
    }
    function fetchProces() {
        if (s_proces.checked == 1) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: '<?= url('fetchproces') ?>',
                success: function (data) {
                    var response = JSON.parse(data);
                    var url = '<?= url('incidence') ?>';
                    var incidences = response.incidences;
                    var tr = "";
                    $("#tableIncidence").find("tbody").empty();

                    for (i in incidences) {
                        var str = incidences[i].created_at;
                        var result = str.split(" ");

                        var temp = result[0];
                        var today = new Date(temp);
                        var day = today.getDate();
                        if (day < 10)
                            day = "0" + day;
                        var date = day + "/" + (today.getMonth() + 1) + "/" + today.getFullYear();
                        var hour = result[1];

                        var final_date = date + " - " + hour;

                        tr = "<tr><td class='text-dark'>" + incidences[i].created_by + "</td><td class='text-dark'><a href='" + url + "/" + incidences[i].id + "'>" + incidences[i].subject + "</a></td><td class='text-dark'>" + incidences[i].desc + "</td><td class='text-dark'>" + incidences[i].status + "</td><td class='text-dark'>" + final_date + "</td>";
                        $("#tableIncidence").find("tbody").append(tr);
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }
    }
    function fetchResolt() {
        if (s_resolta.checked == 1) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: '<?= url('fetchresolta') ?>',
                success: function (data) {
                    var response = JSON.parse(data);
                    var url = '<?= url('incidence') ?>';
                    var incidences = response.incidences;
                    var tr = "";
                    $("#tableIncidence").find("tbody").empty();

                    for (i in incidences) {
                        var str = incidences[i].created_at;
                        var result = str.split(" ");

                        var temp = result[0];
                        var today = new Date(temp);
                        var day = today.getDate();
                        if (day < 10)
                            day = "0" + day;
                        var date = day + "/" + (today.getMonth() + 1) + "/" + today.getFullYear();
                        var hour = result[1];

                        var final_date = date + " - " + hour;

                        tr = "<tr><td class='text-dark'>" + incidences[i].created_by + "</td><td class='text-dark'><a href='" + url + "/" + incidences[i].id + "'>" + incidences[i].subject + "</a></td><td class='text-dark'>" + incidences[i].desc + "</td><td class='text-dark'>" + incidences[i].status + "</td><td class='text-dark'>" + final_date + "</td>";
                        $("#tableIncidence").find("tbody").append(tr);
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }
    }
</script>
@endsection