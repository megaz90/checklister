@extends('layouts.app')

@section('styles')
    
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3 text-center">{{__('List of Permissions')}}</h4>
                    
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
                                @if (count($permissions) == 0)
                                    <tr>
                                        <td colspan="4" class="test-center"><h3>No Permission Found</h3></td>
                                    </tr>
                                @else
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->created_at }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-sm btn-success" title="Edit Permission"><span class="fa fa-edit"></span></a>
                                    </td>
                                </tr>
                                @endforeach
                                {{$permissions->links()}}
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection