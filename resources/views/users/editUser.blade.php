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
											{!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put', 'class' => 'form-horizontal panel required']) !!}

											<div class="form-group {!! $errors->has('lastName') ? 'has-error' : '' !!}">
											<input type="text" name="lastName" class="form-control" required placeholder="Nom" value="{{ $user->userinfo->lastName }}"/>
											{!! $errors->first('lastName', '<small class="help-block">:message</small>') !!}
											</div>

											<div class="form-group {!! $errors->has('firstName') ? 'has-error' : '' !!}">
											<input type="text" name="firstName" class="form-control" required placeholder="Prénom" value="{{ $user->userinfo->firstName }}"/>
											{!! $errors->first('firstName', '<small class="help-block">:message</small>') !!}
											</div>

											<div class="form-group {!! $errors->has('phone_number') ? 'has-error' : '' !!}">
											<input type="text" name="phone_number" class="form-control" required placeholder="Téléphone" value="{{ $user->phone_number }}"/>
											{!! $errors->first('phone_number', '<small class="help-block">:message</small>') !!}
											</div>

											<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
											<input type="email" name="email" class="form-control" required placeholder="Email" value="{{ $user->email }}"/>
											{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
											</div>

											<div class="form-group {!! $errors->has('birthdate') ? 'has-error' : '' !!}">
											<input type="date" name="birthdate" class="form-control" required placeholder="Date de naissance" value="{{ $user->userinfo->birthdate }}"/>
											{!! $errors->first('birthdate', '<small class="help-block">:message</small>') !!}
											</div>

											<div class="form-group {!! $errors->has('address') ? 'has-error' : '' !!}">
											<input type="text" name="address" class="form-control" required placeholder="Adresse" value="{{ $user->address->address }}"/>
											{!! $errors->first('address', '<small class="help-block">:message</small>') !!}
											</div>

											<div class="form-group {!! $errors->has('postal_code') ? 'has-error' : '' !!}">
											<input type="text" name="postal_code" class="form-control" required placeholder="Code postal" value="{{ $user->address->postal_code }}"/>
											{!! $errors->first('postal_code', '<small class="help-block">:message</small>') !!}
											</div>

											<div class="form-group {!! $errors->has('city') ? 'has-error' : '' !!}">
											<input type="text" name="city" class="form-control" placeholder="Ville" required value="{{ $user->address->city }}"/>
											{!! $errors->first('city', '<small class="help-block">:message</small>') !!}
											</div>

											<div class="form-group {!! $errors->has('country') ? 'has-error' : '' !!}">
											<input type="text" name="country" class="form-control" placeholder="Pays" required value="{{ $user->address->country }}"/>
											{!! $errors->first('country', '<small class="help-block">:message</small>') !!}
											</div>

											
											<div class="form-group">
												<div class="checkbox">
													<label>
														{!! Form::checkbox('admin', 1, null) !!}  Administrateur
													</label>
												</div>
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
