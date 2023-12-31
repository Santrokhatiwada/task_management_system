@extends('layouts.apps')

@section('content')
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <h2>Edit Project</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('projects.index') }}"> Back </a>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Something went wrong.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('projects.update',$project->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Project Name:</strong>
                                    <input type="text" name="name" value="{{$project->name}}" class="form-control" placeholder="Project Name">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Project Details:</strong>
                                    <textarea class="form-control" style="height:150px" name="details" placeholder="Project Details">{{$project->details}}</textarea>
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Give Permission to change status:</strong>

                                    <select class="form-control" name="changer[]" multiple>
                                        @foreach($user as $users)
                                        <option value="{{ $users->id }}" @if(in_array($users->id, $selectedUsers))
                                            selected
                                            @endif
                                            >
                                            {{ $users->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>




                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection