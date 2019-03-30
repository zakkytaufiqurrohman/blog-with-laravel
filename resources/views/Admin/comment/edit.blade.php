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
          <!-- <div class="card-header text-white bg-primary">
            Edit User
          </div> -->
          {!! Form::model($comment, ['route' => ['admin.Comment.update', $comment->id], 'method' => 'PUT']) !!}
            <div class="card-body">
              <div class="form-group">
                <lable>full name</lable>
                <input type="text" name="name" value="{{$comment->name}}" class="form-control" readonly>
              </div>

              <div class="form-group">
                <label for="email">email</label>
                <input type="email" name="email" value="{{$comment->email}}" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label for="comment">commment</label>
                <textarea cols="30" rows="10" class="form-control" readonly>{{$comment->body}} </textarea>
              </div>

              <div class="form-group">
                <label for="status">status</label>
                {!! Form::select('status',[0=>'hide',1=>'published'],null,['class'=>'form-control','required']) !!}
              </div>

              <div class ="card-footer" bg-transparent>

                <button class="btn btn-primary" type="submit">
                  Submit
                </button>
              </footer>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
@endsection
