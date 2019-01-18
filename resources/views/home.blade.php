@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bob Dashboard</div>

                <div class="card-body">


                    <div class="row">
                        <div class="col-xl-4 col-sm-6 mb-4">
                            <div class="card text-dark bg-light o-hidden h-100">
                                <div class="card-body">
                                    <div class="mr-12 text-center">Utilisateurs</div>
                                </div>
                                <a class="card-footer text-dark clearfix small z-1" href="{!! url('user') !!}">
                                    <span class="text-center">Voir tous</span>
                                    <span class="float-right">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6 mb-4">
                            <div class="card text-dark bg-light o-hidden h-100">
                                <div class="card-body">
                                    <div class="mr-12 text-center">Dossiers</div>
                                </div>
                                <a class="card-footer text-dark clearfix small z-1" href="{!! url('folder') !!}">
                                    <span class="text-center">Voir tous</span>
                                    <span class="float-right">
                                        <i class="fas fa-angle-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6 mb-4">
                            <div class="card text-dark bg-light o-hidden h-100">
                                <div class="card-body">
                                    <div class="mr-12 text-center">Fichiers</div>
                                </div>
                                <a class="card-footer text-dark clearfix small z-1" href="{!! url('file') !!}">
                                    <span class="text-center">Voir tous</span>
                                    <span class="float-right">
                                        <i class="fas fa-angle-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>




                    </div>
 

                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
