@extends('layouts.app')

@section('styles')
    
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3 text-center">{{__('List of Roles')}}</h4>
                    
                    <div class="table-responsive">
                        <table class="table mb-0 text-center">

                            <thead class="table-light">
                                <tr>
                                    <th>Created At</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($roles) == 0)
                                    <tr>
                                        <td colspan="4" class="test-center"><h3>No Role Found</h3></td>
                                    </tr>
                                @else
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->created_at }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('update', $role)
                                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-success" title="Edit Role"><span class="fa fa-edit"></span></a>
                                        @else
                                        <p><strong>(Not Authorized)</strong></p>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                {{$roles->links()}}
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection