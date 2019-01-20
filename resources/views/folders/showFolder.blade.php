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
                                <p class="text-center"><strong>Informations</strong></p>
                                <p><strong>Identifiant :</strong> #{{ $folder->id }}</p>
                                <p><strong>Nom :</strong> {{ $folder->title }}</p>
                                <p><strong>Utilisateur :</strong> {{ $folder->user->userinfo->firstName }} {{ $folder->user->userinfo->lastName }}</p>
                                <p class="text-center"><strong>Fichiers :</strong></p>
                                @foreach ($folder->files as $file)
                                <p><strong> • {!! $file->file_type->title !!} </strong> ( {!! $file->file_type->folder_categorie->title !!} )</p>
                                @endforeach

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
