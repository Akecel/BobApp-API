@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Création d'un dossier</div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div class="panel panel-primary">   
                                <div class="panel-body"> 
                                    <div class="col-sm-12">
                                        {!! Form::open(['route' => 'folder.store', 'class' => 'form-horizontal panel']) !!}   
                                        <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                            {!! Form::text('name', null, ['class' => 'form-control ','required', 'placeholder' => 'Nom du dossier']) !!}
                                            {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                        </div>
                                        <div class="form-group {!! $errors->has('user_id') ? 'has-error' : '' !!}">
                                            {!! Form::select('user_id',['' => 'Selectionnez un utilisateur']+ $users, null, ['class' => 'form-control','required']) !!}
                                            {!! $errors->first('user_id', '<small class="help-block">:message</small>') !!}
                                        </div>
                                        


                                        <a href="javascript:history.back()" class="btn btn-secondary">
                                            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
                                        </a>
                                        {!! Form::submit('Envoyer', ['class' => 'btn btn-secondary pull-right']) !!}
                                        {!! Form::close() !!}
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
