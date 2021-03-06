@extends('layouts.admin')
@section('content')
{{ Form::open(array('route' => array('admin.user.update', $user->id), 'method' => 'PUT')) }}

<div class="form-group">
	{{ Form::label('firstname', 'Firstname', ['class'=>'control-label']); }}
	{{ Form::input('text', 'firstname', $user->firstname, ['class'=>'form-control', 'id'=>'firstname']) }}
</div>

<div class="form-group">
	{{ Form::label('lastname', 'Lastname', ['class'=>'control-label']); }}
	{{ Form::input('text', 'lastname', $user->lastname, ['class'=>'form-control', 'id'=>'lastname']) }}
</div>

<div class="form-group">
	{{ Form::label('email', 'E-mail', ['class'=>'control-label']); }}
	{{ Form::input('text', 'email', $user->email, ['class'=>'form-control', 'id'=>'email']) }}
</div>

<div class="form-group">
	{{ Form::label('password', 'Password', ['class'=>'control-label']); }}
	{{ Form::input('password', 'password', '', ['class'=>'form-control', 'id'=>'password']) }}
</div>
<div class="form-group">
	{{ Form::label('gender', 'Gender', ['class'=>'control-label']); }}
	{{ Form::select('gender', [0=>'Female', 1=>'Male'], $user->gender, ['class'=>'form-control', 'id'=>'gender']); }}
</div>

<div class="form-group">
	<h4>skills</h4>
	<?php
		
	?>
	@foreach($skills as $skill)

	{{$checked = false; $disabled='disabled'; $sklevel='';}}
	@foreach($user->skills as $user_skill)
	@if($skill->id==$user_skill->id)
	<?php 
		$checked = true; 
		$disabled='';
		$sklevel = $user_skill->pivot->level; 
	 ?> 
	@endif
	@endforeach
	<div class="col-md-4">
		{{ Form::checkbox('skill[]',$skill->id,$checked,array('id' => $skill->id)) }}
		{{ Form::label($skill->id,$skill->name , ['class'=>'control-label']) }}
		{{ Form::input('text', 'level['.$skill->id.']', $sklevel, 
		['class'=>'form-control','id' => 'for_'.$skill->id, $disabled] ) }}
	</div>
	@endforeach
</div>


{{ Form::submit('Save', ['class'=>'btn btn-primary pull-right'])}}

{{ Form::close(); }}

<script type="text/javascript">
	$('input[type="checkbox"]').change(function() {
		var inpId = 'for_'+this.id;
		if(this.checked) {
			$("#"+inpId).prop('disabled', false);
		}
		else{
			$("#"+inpId).prop('disabled', true);
		}
	});
</script>


@stop