@extends('layouts.fullwidth')

@section('content')
<div id="userlist-adder" class="well">
    <form id="new-user-add-form">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <input type="text" value="" placeholder="Name" class="form-control" name="name" id="name">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <input type="text" value="" placeholder="E-Mail" class="form-control" name="email" id="email">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <input type="password" value="" placeholder="Passwort" class="form-control" name="password" id="password">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <input type="password" value="" placeholder="Passwort (Wdh.)" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>    
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <select class="form-control" name="group_id" id="group_id">
                        <option value="0">Gruppe wählen</option>
                        @foreach($grouplist as $group)
                        <option value="{{$group->id}}">{{$group->full_name}}</option>
                        @endforeach
                    </select>
                </div>    
            </div>

            <div class="col-lg-2">
                <button id="add-user" class="btn btn-success"><i class="fa fa-plus"></i> Nutzer anlegen</button>
            </div>
        </div>
    </form>
</div>

@if(count($userlist->count()>0))

<div id="user-panel" class="panel panel-default">

    <div class="table-responsive">
        <table id="user-table" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nutzername</th>
                    <th>Projekte</th>
                    <th>E-Mail-Adresse</th>
                    <th>Gruppe</th>
                    <th>Notiz</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @each('partials.users.users-tr', $userlist,'user')
            </tbody>
        </table>
    </div>

</div>

@else

@include('partials.users.empty')

@endif
<div id="message" class="alert"></div>

@endsection

@section('js.files')
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="/js/users/add.js"></script>
<script src="/js/users/editables.js"></script>
<script src="/js/users/delete.js"></script>
@endsection

@section('css.files')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

@endsection

@section('js.inline.code') 

@endsection


@section('page.title')
Nutzer - Einstellungen
@endsection