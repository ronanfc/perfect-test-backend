@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

@if(Session::has('error'))
    <ul class="alert alert-danger">
            <li>{{Session::get('error')}}</li>
    </ul>
@endif
