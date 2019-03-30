    @extends('layouts.admin.app');

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
                error dashboard
            </li>
            <li class="breadcrumb-item-active">
                error
            </li>
        
        </ol> 
        <div class="row">
            <div class="col-md-12">
                <h1>error</h1>
                @yield('error')
                <a href="{{ url()->previous()}}" class="btn btn-primary" >back</a>
            </div>
        </div>
    

    </div>

@endsection
