@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Création d'un utilisateur</div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div class="panel panel-primary">   
                                <div class="panel-body"> 
                                    <div class="col-sm-12">
                                        {!! Form::open(['route' => 'user.store', 'class' => 'form-horizontal panel']) !!}   
                                        <div class="form-group {!! $errors->has('lastName') ? 'has-error' : '' !!}">
                                            {!! Form::text('lastName', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                                            {!! $errors->first('lastName', '<small class="help-block">:message</small>') !!}
                                        </div>
                                        <div class="form-group {!! $errors->has('firstName') ? 'has-error' : '' !!}">
                                            {!! Form::text('firstName', null, ['class' => 'form-control', 'placeholder' => 'Prénom']) !!}
                                            {!! $errors->first('firstName', '<small class="help-block">:message</small>') !!}
                                        </div>
                                        <div class="form-group {!! $errors->has('phone_number') ? 'has-error' : '' !!}">
                                            {!! Form::text('phone_number', null, ['class' => 'form-control required', 'placeholder' => 'Téléphone *']) !!}
                                            {!! $errors->first('phone_number', '<small class="help-block">:message</small>') !!}
                                        </div>
                                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                            {!! Form::email('email', null, ['class' => 'form-control required', 'placeholder' => 'Email *']) !!}
                                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                                        </div>
                                        <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de passe']) !!}
                                            {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group {!! $errors->has('birthdate') ? 'has-error' : '' !!}">
                                            {!! Form::date('birthdate', null, ['class' => 'form-control required', 'placeholder' => 'Date de Naissance']) !!}
                                            {!! $errors->first('birthdate', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group {!! $errors->has('address') ? 'has-error' : '' !!}">
                                            {!! Form::text('address', null, ['class' => 'form-control required', 'placeholder' => 'Adresse']) !!}
                                            {!! $errors->first('address', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group {!! $errors->has('postal_code') ? 'has-error' : '' !!}">
                                            {!! Form::text('postal_code', null, ['class' => 'form-control required', 'placeholder' => 'Code Postal']) !!}
                                            {!! $errors->first('postal_code', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group {!! $errors->has('city') ? 'has-error' : '' !!}">
                                            {!! Form::text('city', null, ['class' => 'form-control required', 'placeholder' => 'Ville']) !!}
                                            {!! $errors->first('city', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group {!! $errors->has('country') ? 'has-error' : '' !!}">
                                            {!! Form::text('country', null, ['class' => 'form-control required', 'placeholder' => 'Pays']) !!}
                                            {!! $errors->first('country', '<small class="help-block">:message</small>') !!}
                                        </div>




                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    {!! Form::checkbox('admin', 1, null) !!} Administrateur
                                                </label>
                                            </div>
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
