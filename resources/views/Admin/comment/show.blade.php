@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.categories.index')}}">category</a>
      </li>
      <li class="breadcrumb-item active">Show Detail</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            User Detail : {{ $comment->post->title }}
          </div>
          <div class="card-body">
              <table class="table table-striped">
                  <tr>
                      <th>ID</th>
                      <td>{{ $comment->id }}</td>
                  </tr>
                  <tr>
                      <th>name</th>
                      <td>{{ $comment->name }}</td>
                  </tr>
                  <tr>
                      <th>email</th>
                      <td>{{ $comment->email }}</td>
                  </tr>
                  <tr>
                      <th>created at</th>
                      <td>{{ $comment->created_at }}</td>
                  </tr>
                  <tr>
                      <th>status</th>
                      <td>{{ $comment->status==1 ?'published' :'hide' }}</td>
                  </tr>
                  
              </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection