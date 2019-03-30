@extends('layouts.admin.app')


@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Posts</a>
            </li>
            <li class="breadcrumb-item active">Add New</li>
        </ol>
        {!! Form::open(['route' => 'admin.post.store', 'method' => 'POST']) !!}
            @include('admin.post._form')
        {!! Form::close() !!}
    </div>
@endsection

