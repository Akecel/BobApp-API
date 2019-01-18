@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Fiche d'utilisateur</div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="panel panel-primary">   
                            <div class="panel-body"> 
                                <p><strong>Identifiant :</strong> #{!! $user->id !!}</p>
                                <p><strong>Nom :</strong> {{ $user->userinfo->lastName }}</p>
                                <p><strong>Prénom :</strong> {{ $user->userinfo->firstName }}</p>
                                <p><strong>Email :</strong> {{ $user->email }}</p>
                                <p><strong>Téléphone :</strong> {{ $user->phone_number }}</p>
                                <p><strong>Date de naissance :</strong> {{ $user->userinfo->birthdate }}</p>
                                <p><strong>Adresse :</strong> {{ $user->address->address }} / {{ $user->address->postal_code }} {{ $user->address->city }} / {{ $user->address->country }}</p>
                                <p> <strong>Rôle :</strong>
                                @if($user->admin == 1)
                                    Administrateur
                                @else
                                    Utilisateur
                                @endif
                                </p>


                            </div>
                        </div>
                        <a href="javascript:history.back()" class="btn btn-secondary">
                            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
