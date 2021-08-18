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
            @if (\Session::has('info'))
                <div class="alert alert-info">
                   <h3>{{ Session::get('info') }}</h3>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-center mb-5">{{__('New Permission')}}</h4>

                    <form action="{{ route('admin.permissions.store') }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">{{__('Permission Name')}}:</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control"  placeholder="{{__('Enter Permission Name')}}" name="name" value="{{old('name')}}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">{{__('Permission Assigning To:')}}:</label>
                            <div class="col-sm-6">
                              <select name="implemented_id" class="form-select">
                                  <option value="" disabled selected>--Select Model--</option>
                                  @foreach ($implemented_permissions as $implemented_permission)
                                      <option value="{{ $implemented_permission['id'] }}"> {{ ucwords(preg_replace('/_/i', ' ', $implemented_permission['name']))  }}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-md">{{__('Create')}}</button>
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