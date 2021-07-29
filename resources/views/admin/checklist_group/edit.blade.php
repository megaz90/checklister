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
                    <h4 class="card-title mb-4 text-center mb-5">{{__('Edit Checklist Group')}}</h4>

                    <form action="{{ route('admin.checklist_groups.update', $checklistGroup) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">{{__('Checklist Group Name')}}:</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control"  placeholder="{{__('Enter Checklist Group Name')}}" name="name" value="{{ $checklistGroup->name }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-md">{{__('Update')}}</button>
                        </div>
                    </form>
                    <form action="{{ route('admin.checklist_groups.destroy', $checklistGroup) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-danger w-md">{{__('Delete')}}</button>
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