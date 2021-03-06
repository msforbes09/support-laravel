@extends('shared.layout')

@section('content')
	<section class="section">
	    <div class="container">
	        <article class="message">
	            <div class="message-header">
	                <p>Document</p>
	        		
					<div class="buttons">
						<button class="button is-primary is-rounded " :class="{ 'is-loading': isLoading }" title="Upload New"
							onclick="document.getElementById('file').click();">
							<span class="fas fa-plus"></span>
						</button>
						
		        		<my-link class="is-warning is-rounded" lined="true" title="Update" href="{{ route('documents.edit', $document->id) }}">
							<span class="fas fa-edit"></span>
		        		</my-link>

		        		<my-link class="is-success is-rounded" lined="true" title="Go Back" href="{{ route('documents.index') }}">
							<span class="fas fa-arrow-left"></span>
		        		</my-link>
					</div>
	            </div><!-- message-header -->

	        
	            <div class="message-body">
					@include ('shared.bulma-status')
					@include ('shared.bulma-error')

	            	<div class="content">
	            		<info attr="Title">{{ $document->title }}</info>

	            		<info attr="Category">{{ $document->category->categoryName }}</info>

	            		<info attr="Description">{{ $document->description }}</info>
	            	</div>{{-- content --}}
					
					<table class="table is-fullwidth is-bordered is-hoverable">
					    <thead>
					        <tr class="has-background-grey-light">
					            <th class="has-text-centered">File Name</th>
					            <th class="has-text-centered">Date</th>
					            <th class="has-text-centered">Time</th>
					        </tr>
					    </thead>
					
					    <tbody>
					    	@foreach ($document->files->reverse() as $file)
						        <tr>
						            <td class="has-text-centered">
										<a href="/storage/documents/{{ $file->filename }}" target="_blank">{{ $file->filename }}</a>
						            </td>

						            <td class="has-text-centered">{{ date('M d, Y', strtotime($file->created_at)) }}</td>
						            <td class="has-text-centered">{{ date('h:i A', strtotime($file->created_at)) }}</td>
						        </tr>
							@endforeach{{-- $document->files->reverse() as $file --}}
					    </tbody>
					</table>

	            	
	            </div><!-- message-body -->
	        </article><!-- message -->

            <form  method="post" action="{{ route('documents.addFile', $document->id) }}" enctype="multipart/form-data">
				@csrf
				@method ('patch')

				<input type="file" id="file" name="file" style="display: none;" onchange="this.form.submit();" @change="submit"/>
			</form>
	    </div><!-- container -->
	</section><!-- section -->
@endsection
