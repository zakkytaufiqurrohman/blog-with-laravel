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
            User Detail : {{ $data->title }}
          </div>
          <div class="card-body">
              <table class="table table-striped">
                  <tr>
                      <th>ID</th>
                      <td>{{ $data->id }}</td>
                  </tr>
                  <tr>
                      <th>slug</th>
                      <td>{{ $data->slug }}</td>
                  </tr>
                  <tr>
                      <th>title</th>
                      <td>{{ $data->title }}</td>
                  </tr>
                  
              </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection