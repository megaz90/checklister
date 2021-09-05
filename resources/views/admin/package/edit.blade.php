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
                    <h4 class="card-title mb-4 text-center mb-5">{{__('Edit Package')}}</h4>
                    <form action="{{ route('admin.packages.update', $package) }}" method="POST">
                        @csrf
                        @method('PUT');
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">{{__('Package Name')}}:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control"  placeholder="{{__('Enter Package Name')}}" name="name" value="{{ $package->name }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="description" class="col-sm-3 col-form-label">{{__('Package Description')}}:</label>
                            <div class="col-sm-6">
                            <textarea class="form-control" name="description" cols="30" rows="7" placeholder="{{ __('Enter Description') }}">{{ $package->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="price" class="col-sm-3 col-form-label">{{__('Package Price')}}:</label>
                            <div class="col-sm-6">
                            <input type="number" class="form-control"  placeholder="{{__('Enter Package Price')}}" name="price" value="{{ $package->price }}" step="any">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-sm w-md">{{__('Update Package')}}</button>
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