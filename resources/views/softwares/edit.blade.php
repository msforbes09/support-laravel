@extends('shared.layout')

@section('content')
	<div class="modal is-active">
	    <div class="modal-background"></div>
	    
	    <div class="modal-card">
	        <header class="modal-card-head">
	            <p class="modal-card-title">Edit Software</p>
	            <a class="delete" href="{{ route('softwares.show', $software->id) }}" aria-label="close"></a>
	        </header><!-- modal-card-head -->
	
			<form method="post" @submit="submit" action="{{ route('softwares.update', $software->id) }}">
				@csrf
				@method ('patch')
		        
		        <section class="modal-card-body">
		        	<div class="field">
		        	        <label class="label" for="softwareName">Software Name:</label>
		        	    
		        	        <div class="control has-icons-right">
		        	            <input type="text" id="softwareName" name="softwareName" placeholder="Software Name"
		        	                class="input {{ $errors->has('softwareName') ? ' is-danger' : '' }}"
		        	                value="{{ $software->softwareName }}" autofocus required>
		        	    
		        	            <span class="icon is-small is-right">
		        	                <i class="fas fa-compact-disc"></i>
		        	            </span><!-- icon -->
		        	        </div><!-- control -->
		        	    
		        	        <p class="help is-danger">{{ $errors->first('softwareName') }}</p>
		        	    </div><!-- field -->    

		        	    <div class="field">
		        	        <p class="help is-info has-text-weight-bold is-pulled-right">*Separate each specs using Spacebar</p>

		        	        <label class="label" for="specList">Spec List:</label>
		        	    
		        	        <div class="control has-icons-right">
		        	            <input type="text" id="specList" name="specList"
		        	                class="input {{ $errors->has('specList') ? ' is-danger' : '' }}"
		        	                value="{{ implode(' ', $software->specList) }}">
		        	    
		        	            <span class="icon is-small is-right">
		        	                <i class="fas fa-list"></i>
		        	            </span><!-- icon -->
		        	        </div><!-- control -->
		        	    
		        	        <p class="help is-danger">{{ $errors->first('specList') }}</p>
		        	    </div><!-- field -->
		        </section><!-- modal-card-body -->
		        
		        <footer class="modal-card-foot">
		        	<button class="button is-primary" :class="{ 'is-loading': isLoading }">Save Record</button>
		            <my-link href="{{ route('softwares.show', $software->id) }}">Go Back</my-link>
		        </footer><!-- modal-card-foot -->
		    </form>
	    </div><!-- modal-card -->
	</div><!-- modal -->
@endsection
