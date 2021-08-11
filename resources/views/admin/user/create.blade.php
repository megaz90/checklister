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
                    <h4 class="card-title mb-4 text-center mb-5">{{__('New User')}}</h4>

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">{{__('Name')}}:</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control"  placeholder="{{__('Enter User Name')}}" name="name" value="{{old('name')}}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">{{__('Email')}}:</label>
                            <div class="col-sm-6">
                              <input type="email" class="form-control"  placeholder="{{__('Enter User Email')}}" name="email" value="{{old('email')}}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="password" class="col-sm-3 col-form-label">{{__('Password')}}:</label>
                            <div class="col-sm-6">
                              <input type="password" class="form-control"  placeholder="{{__('Enter User Password')}}" name="password">
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-md">{{__('Add New User')}}</button>
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