@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Liste des dossiers</div>
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
                                        <th>Nom</th>
                                        <th>Utilisateur</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($folders as $folder)
                                        <tr>
                                            <td>{!! $folder->id !!}</td>
                                            <td class="text-dark"><strong>{!! $folder->title !!}</strong></td> 
                                            <td class="text-dark"><strong>{!! $folder->user->firstName !!} {!! $folder->user->lastName !!}</strong></td>                                           
                                            <td>{!! link_to_route('folder.show', 'Voir', [$folder->id], ['class' => 'btn btn-secondary btn-block']) !!}</td>
                                            <td>{!! link_to_route('folder.edit', 'Modifier', [$folder->id], ['class' => 'btn btn-secondary btn-block']) !!}</td>
                                            <td>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['folder.destroy', $folder->id]]) !!}
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
                        {!! link_to_route('folder.create', 'Créer un dossier', [], ['class' => 'btn btn-secondary pull-right']) !!}
                        {!! $links !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
