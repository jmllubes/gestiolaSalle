@extends('layouts.app')
<title>La Salle - @lang('log.create_incidence_button')</title>
@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Crear usuaris</h1>
    </div>
    <hr></hr>
    <div>
        <script type="text/javascript">
            function onValidateManual() {
                if (create_manual.checked == 1) {
                    $("#form_manual").show();
                } else {
                    $("#form_manual").hide();
                }
            }
            function onValidateImport() {
                if (import_file.checked == 1) {
                    $("#form_import").show();
                } else {
                    $("#form_import").hide();
                }
            }
        </script>
        <div class="form-group">
            <input id="import_file" type="checkbox" onclick="onValidateImport()"> Importar usuaris amb arxiu CSV
        </div>
        <form id="form_import" class="form-horizontal" method="POST" action="{{url('/uploadFile')}}" enctype="multipart/form-data" style="display: none;">
            @csrf
            <hr></hr>
            <div class="input-group col-lg-4">
                  <div class="custom-file">
                      <input type="file" name="file" class="custom-file-input" id="customFileLang" lang="ca"  style="cursor: pointer;">
                      <label class="custom-file-label" for="customFileLang"  style="cursor: pointer;">Seleccionar arxiu</label>
                  </div>
              </div>
            <input type='submit' class='btn btn-primary btn-user btn-block col-lg-4 mt-3' name='submit' value='Importar usuaris'>
        </form>

        <div class="form-group">
            <input id="create_manual" type="checkbox" onclick="onValidateManual()"> Crear usuari manualment
        </div>
        <form id="form_manual" class="form-horizontal" method="POST" action="{{url('/insertmanual')}}" style="display: none;">
            @csrf
            <hr></hr>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail">@lang('log.email')</label>
                    <input name="email" type="email" class="form-control" id="inputEmail" placeholder="@lang('log.email')">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPass">@lang('log.pass')</label>
                    <input name="password" type="password" class="form-control" id="inputPass" placeholder="@lang('log.pass')">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputName">Nom</label>
                    <input name="name" type="text" class="form-control" id="inputName" placeholder="Nom">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputUserName">Nom d'usuari</label>
                    <input name="username" type="text" class="form-control" id="inputUserName" placeholder="Nom d'usuari">
                </div>
                <div class="form-group">
                    <input id="role" type="checkbox" name="role"> Administrador
                </div>
            </div>
            <hr>
            <input type="submit" value="Crear" class="btn btn-primary btn-user btn-block"/>
        </form>
    </div>
</div>
@endsection