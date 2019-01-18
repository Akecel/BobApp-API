@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modification d'un utilisateur</div>
					<div class="card-body">
						<div class="col-sm-12">
							<div class="panel panel-primary">	
								<div class="panel-body"> 
									<div class="col-sm-12">
											{!! Form::model($folder, ['route' => ['folder.update', $folder->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}

											<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
											<input type="text" name="name" class="form-control" placeholder="Nom" value="{{ $folder->name }}"/>
											{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
											</div>

											<div class="form-group {!! $errors->has('user_id') ? 'has-error' : '' !!}">
											{!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
											{!! $errors->first('user_id', '<small class="help-block">:message</small>') !!}
											</div>


								
											<br />
											<a href="javascript:history.back()" class="btn btn-secondary">
												<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
											</a>
											{!! Form::submit('Envoyer', ['class' => 'btn btn-secondary']) !!}
											{!! Form::close() !!}
											<br />
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
