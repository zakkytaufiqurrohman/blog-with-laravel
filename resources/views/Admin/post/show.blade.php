@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.post.index')}}">post</a>
      </li>
      <li class="breadcrumb-item active">Show Detail</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            User Detail : {{ $data->title }}
          </div>
          <div class="card-body">
              <table class="table table-striped">
                  <tr>
                      <th>ID</th>
                      <td>{{ $data->title }}</td>
                  </tr>
                  <tr>
                      <th>author</th>
                      <td>{{ $data->user->name }}</td>
                  </tr>
                  <tr>
                      <th>category</th>
                      <td>{{ $data->category->title}}</td>
                  </tr>
                  <tr>
                      <th>slug</th>
                      <td>{{ $data->slug }}</td>
                  </tr>
                  <tr>
                      <th>isi</th>
                      <td>{!! $data->body !!}</td>
                  </tr>
                  <tr>
                      <th>images</th>
                      <td><img src="{{ $data->featured}}" alt="image post "></td>
                  </tr>
                  
              </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection