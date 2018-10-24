@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="card red lighten-4 red-text">
            <div class="card-content">
                {{$error}}
            </div>
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="card green lighten-4 green-text">
        <div class="card-content">
            {{session('success')}}
        </div>  
    </div>
@endif

@if(session('error'))
    <div class="card red lighten-4 red-text">
        <div class="card-content">
            {{session('error')}}
        </div>  
    </div>
@endif