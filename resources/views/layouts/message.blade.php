@if (session('error') or $errors->has('error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        {!! session('error') !!} {!! $errors->first('error') !!}
    </div>
@elseif (session('success'))
    <div class="alert alert-success">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        {!! session('success') !!}
    </div>


@elseif (session('warning'))
    <div class="alert alert-warning">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        {!! session('warning') !!}
    </div>


@elseif (session('status'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        {!! session('status') !!}
    </div>
@endif