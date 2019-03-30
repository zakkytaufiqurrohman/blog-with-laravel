@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Users</a>
      </li>
      <li class="breadcrumb-item active">Edit</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            Edit User
          </div>
          {!! Form::model($data, ['route' => ['admin.categories.update', $data->id], 'method' => 'PUT']) !!}
            @include('admin.categories._form')
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
@endsection
