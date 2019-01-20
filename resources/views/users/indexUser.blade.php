@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Liste des utilisateurs</div>
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
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{!! $user->id !!}</td>
                                            @if (isset($user->lastName) && isset($user->firstName))
                                            <td class="text-dark"><strong>{!! $user->firstName !!} {!! $user->lastName !!}</strong></td>
                                            @else
                                            <td class="text-dark"><strong>Utilisateur Anonyme</strong></td>
                                            @endif
                                            
                                            <td>{!! link_to_route('user.show', 'Voir', [$user->id], ['class' => 'btn btn-secondary btn-block']) !!}</td>
                                            <td>{!! link_to_route('user.edit', 'Modifier', [$user->id], ['class' => 'btn btn-secondary btn-block']) !!}</td>
                                            <td>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
                                                {!! Form::submit('Supprimer', ['class' => 'btn btn-secondary btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
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
                        {!! link_to_route('user.create', 'Ajouter un utilisateur', [], ['class' => 'btn btn-secondary pull-right']) !!}
                        {!! $links !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
