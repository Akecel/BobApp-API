@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Liste des catégories</div>
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
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{!! $category->id !!}</td>
                                            <td class="text-dark"><strong>{!! $category->title !!}</strong></td> 
                                            <td></td>                                           
                                            <td></td>
                                            <td></td>
                                            <td>
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
