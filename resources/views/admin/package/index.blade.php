@extends('layouts.app')

@section('styles')
    
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3 text-center">{{__('List of Packages')}}</h4>
                    
                    <div class="table-responsive">
                        <table class="table mb-0 text-center">

                            <thead class="table-light">
                                <tr>
                                    <th>Created At</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($packages) == 0)
                                    <tr>
                                        <td colspan="4" class="test-center"><h3>No Packages Found</h3></td>
                                    </tr>
                                @else
                                @foreach ($packages as $package)
                                <tr>
                                    <td>{{ $package->created_at }}</td>
                                    <td>{{ $package->name }}</td>
                                    <td>{{ $package->description }}</td>
                                    <td>{{ $package->price }}</td>
                                    <td>
                                        <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm btn-success" title="Edit Package"><span class="fa fa-edit"></span></a>
                                    </td>
                                </tr>
                                @endforeach
                                {{$packages->links()}}
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection