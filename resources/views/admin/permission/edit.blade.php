@extends('layouts.app')

@section('styles')
    
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-center mb-5">{{__('Edit Permission')}}</h4>

                    <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">{{__('Permission Name')}}:</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control"  placeholder="{{__('Enter Permission Name')}}" name="name" value="{{$permission->name}}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-md">{{__('Update')}}</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
@section('scripts')
    
@endsection