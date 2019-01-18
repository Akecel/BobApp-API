@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Fiche d'un dossier</div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="panel panel-primary">   
                            <div class="panel-body"> 
                                <p><strong>Identifiant :</strong> #{!! $folder->id !!}</p>
                                <p><strong>Nom :</strong> {{ $folder->name }}</p>
                                <p><strong>Utilisateur :</strong> {{ $folder->user->userinfo->firstName }} {{ $folder->user->userinfo->lastName }}</p>


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
