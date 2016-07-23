@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body  fa-4x"><span class="fa fa-users"></span>  {{ trans('pagination.users') }}</div>

                    <div class="panel-body">
                        <div class="form-group">
                            <button id="BtnAdd" type="button" class="btn btn-info btn-lg">
                                <span class="fa fa-plus"></span>
                            </button>
                            <button id="BtnEdit" type="button" class="btn btn-default btn-lg" >
                                <span class="fa fa-pencil-square-o"></span>
                            </button>
                        </div>

                            <div class="row">

                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Search">
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group pull-right">
                                        <button class="btn btn-default" title="Refrescar">
                                            <span class="fa fa-refresh "></span>
                                        </button>
                                        <button class="btn btn-default" title="Columnas">
                                            <span class="fa fa-columns"></span>
                                        </button>
                                        <button class="btn btn-default" title="Columnas">
                                            <span class="fa fa-download"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>{{ trans('auth.user') }}</td>
                                        <td>{{ trans('auth.name') }}s</td>
                                        <td>{{ trans('auth.role') }}</td>
                                        <td>{{ trans('auth.statu') }}</td>
                                    </tr>
                                </thead>
                                <tbody id="users-list" name="users-list">

                                @foreach ($users as $user)
                                    <tr id="{{ $user->id  }}" class="clickable-row">
                                        <td id="id{{ $user->id }}">{{ $user->id }}</td>
                                        <td id="user{{ $user->id }}">{{ $user->user }}</td>
                                        <td id="name{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}</td>
                                        <td id="role{{ $user->id }}">{{ $user->roles->descripcion }}</td>
                                        <td id="estado{{ $user->id }}">{{ $user->estados->descripcion }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div >

                                <nav class="col-md-12">
                                    <div class="col-md-4">
                                        <label>Pagina 1 de 5</label>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <ul class="pagination" style="margin: 0px;">
                                            <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                            <li class="active"><a href="#">2 <span class="sr-only">(current)</span></a></li>
                                            <li ><a href="#">3 <span class="sr-only">(current)</span></a></li>
                                        </ul>
                                        </center>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group pull-right">
                                            <select class="form-control">
                                                <option>10</option>
                                                <option>20</option>
                                                <option>30</option>
                                                <option>40</option>
                                                <option>50</option>
                                            </select>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header fa-3x">
                    <button id="close" type="button" class="close" data-dismiss="modal">&times;</button>
                    <span id="logoEncabezado"></span>
                    <span id="encabezado" class="modal-title"></span>
                </div>
                <div class="modal-body" style="max-height: 400px; overflow: auto;">
                    <form id="frmusers" name="frmusers" class="form-horizontal" novalidate="">
                    <div class="col-md-4 col-md-offset-1">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">{{ trans('auth.name') }}</label>
                            <input id="name" type="text" class="form-control" placeholder='{{ trans('auth.name') }}' name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4 col-md-offset-2">
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="control-label">{{ trans('auth.last_name') }}</label>
                            <input id="last_name" type="text" class="form-control" placeholder='{{ trans('auth.last_name') }}' name="last_name" value="{{ old('last_name') }}">
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                            <label for="estado" class="control-label">{{ trans('auth.statu') }}</label>
                            <select  id="estado" name="estado" class="form-control" placeholder="Seleccione" value="{{ old('estado') }}">
                                <option disabled selected value> -- {{ trans('auth.selectOption') }} -- </option>
                                @foreach ($status as $statu)
                                    <option value="{{ $statu->id }}">{{ $statu->descripcion }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('estado'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('estado') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="control-label">{{ trans('auth.role') }}</label>
                            <select  id="role" name="role" class="form-control" placeholder="Seleccione" value="{{ old('role') }}">
                                <option disabled selected value> -- {{ trans('auth.selectOption') }} -- </option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->descripcion }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('role'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">{{ trans('auth.email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" placeholder="{{ trans('auth.email') }}" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="control-label">{{ trans('auth.user') }}</label>
                            <input id="username" type="text" class="form-control" name="username"  placeholder="{{ trans('auth.user') }}" value="{{ old('username') }}">
                            @if ($errors->has('username'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">{{ trans('auth.password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="{{ trans('auth.password') }}">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="control-label">{{ trans('auth.password_confirm') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('auth.password_confirm') }}">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-md-6 col-md-offset-5">
                        <button id="BtnSave" type="submit" class="btn btn-primary btn-lg btn-block">
                            <i class="fa fa-btn fa-user"></i> {{ trans('auth.register') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
@endsection
@section('scripts')
    <script>
        $('#name').val('');
        $(document).ready(function () {
            //Validación de vistas
            document.getElementById("BtnEdit").disabled = true;
            $('#table').on('click', '.clickable-row', function(event) {
                if($(this).hasClass('active')){
                    $(this).removeClass('active');
                    document.getElementById("BtnAdd").disabled = false;
                    document.getElementById("BtnEdit").disabled = true;
                } else {
                    $(this).addClass('active').siblings().removeClass('active');
                    document.getElementById("BtnAdd").disabled = true;
                    document.getElementById("BtnEdit").disabled = false;
                }
            });

            var url = 'usuario';
            var id_user = '';
            //Manda a llamar los datos del usuario seleccionado para editarlo
            $('#BtnEdit').click(function () {
                var row = $('.active');
                var id_user = row.attr("id");
                $.get(url + '/' + id_user , function(data){
                    $('#name').val(data.name);
                    $('#last_name').val(data.last_name);
                    $('#estado').val(data.estado_id);
                    $('#role').val(data.role);
                    $('#email').val(data.email);
                    $('#username').val(data.user);
                    document.getElementById('encabezado').innerHTML = ' {{ trans('auth.editUser') }}';
                    document.getElementById('logoEncabezado').className = 'fa fa-user';
                    document.getElementById('BtnSave').innerHTML = '{{ trans('auth.SaveUser') }}';
                    $('#BtnSave').val('update');
                    $('#myModal').modal('show');
                })
            });
            //Para resetear todos los campos del modal
            $('#close').click(function () {
                $('#frmusers').trigger("reset");
            });

            $('#BtnAdd').click(function () {
                document.getElementById('encabezado').innerHTML = ' {{ trans('auth.addUser') }}';
                document.getElementById('logoEncabezado').className = 'fa fa-user-plus';
                document.getElementById('BtnSave').innerHTML = '{{ trans('auth.registerUser') }}';
                $('#frmusers').trigger("reset");
                $('#BtnSave').val('save');
                $('#myModal').modal('show');
            });

            $('#BtnSave').click(function (e) {
                var row = $('.active');
                var id_user = row.attr("id");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })

                e.preventDefault();

                var formData = {
                    name: $('#name').val(),
                    last_name: $('#last_name').val(),
                    estado_id: $('#estado').val(),
                    role: $('#role').val(),
                    email: $('#email').val(),
                    user: $('#username').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val(),
                }

                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('#BtnSave').val();

                var type = 'POST'; //para crear un nuevo recurso
                var my_url = url;

                if (state == 'update'){
                    type = 'PUT'; //for updating existing resource
                    my_url += '/' + id_user;
                }
                $.ajax({
                    'type': type,
                    'url': my_url,
                    'data': formData,
                    dataType: 'json',
                    success: function (data) {
                        var user = '<tr  class="clickable-row" id="' + data.datos.id + '">' +
                                '<td id="id'+data.datos.id+'">' + data.datos.id + '</td>' +
                                '<td id="user'+data.datos.id+'">' + data.datos.user + '</td>' +
                                '<td id="name'+data.datos.id+'">' + data.datos.name + ' ' +data.datos.last_name +  '</td>' +
                                '<td id="role'+data.datos.id+'">' + data.datos.roles.descripcion + '</td>' +
                                '<td id="estado'+data.datos.id+'">' + data.datos.estados.descripcion + '</td>' +
                                '</tr>';
                        if (state == "save") { //if user added a new record
                            $('#users-list').append(user);
                        } else { //if user updated an existing record
                            $('#'+id_user).replaceWith(user);
                        }

                        $('#frmusers').trigger("reset");

                        $('#myModal').modal('hide');

                        if (state == 'update'){
                            $.growl.notice({ title: data.response.title, message: data.response.message });
                        }else{
                            $.growl({ title: data.response.title, message: data.response.message });
                        }
                    },
                    error: function(data) {
                        $.growl.error({ title: data.response.title, message: data.response.message });
                    }
                });
            });
        })
    </script>

@endsection