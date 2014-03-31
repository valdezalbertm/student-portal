@if ($errors->any())
	<ul>
		<div class="alert alert-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Errors</b>
			<ul>
				{{ implode('', $errors->all('<li>:message</li>')) }}          
			</ul>
        </div>
	</ul>
@endif