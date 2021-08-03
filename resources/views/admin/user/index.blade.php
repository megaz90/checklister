@extends('layouts.app')

@section('styles')
    
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3 text-center">{{__('List of Users')}}</h4>
                    
                    <div class="table-responsive">
                        <table class="table mb-0 text-center">

                            <thead class="table-light">
                                <tr>
                                    <th>Created At</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($users) == 0)
                                    <tr>
                                        <td colspan="4" class="test-center"><h3>No User Found</h3></td>
                                    </tr>
                                @else
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->website ? $user->website : 'N/A' }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection