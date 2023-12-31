@extends('layouts.apps')

@section('content')
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <h2>Users Management</h2>
                    </div>

                    @can('user-create')
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User </a>

                        @endcan
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif

                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Image</th>
                                <th width="280px">Action</th>
                            </tr>
                            @php
                            $i = 0; // Initialize $i here
                            @endphp
                            @foreach ($data as $key => $user)


                            @if(Auth::user()->hasRole('Admin') || Auth::user()->is_super == 1 || (Auth::user()->hasRole('User') && optional($user)->id === Auth::id()))


                            @if(!($user->is_super == 1))
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                    <label class="text-primary">{{ $user->getRoleNames()[0] }}</label>
                                    @endif
                                </td>


                                <td> @if(!empty($user->image))
                                    <img height="80px" src="{{ asset('uploads/usersImage/' . $user->image) }}">
                                    @else
                                    No photo
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                                    @can('user-edit')
                                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                    @endcan

                                    @can('user-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endif
                            @endif
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection