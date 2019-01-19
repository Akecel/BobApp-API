@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Liste des fichiers</div>
                <div class="card-body">
                    <br>
                    <div class="col-sm-12">
                        @if(session()->has('ok'))
                            <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
                        @endif
                        <div class="panel panel-primary">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Catégorie</th>
                                        <th>Utilisateur</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                        <tr>
                                            <td>{!! $file->id !!}</td>
                                            <td class="text-dark"><strong>{!! $file->filetype->name !!}</strong></td> 
                                            <td class="text-dark"><strong>{!! $file->filetype->folder_categorie->name !!}</strong></td> 
                                            <td class="text-dark"><strong>{!! $file->user->userinfo->firstName !!} {!! $file->user->userinfo->lastName !!}</strong></td>                                           
                                            <td></td>
                                            <td>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['file.destroy', $file->id]]) !!}
                                                {!! Form::submit('Supprimer', ['class' => 'btn btn-secondary btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer ce dossier ?\')']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
