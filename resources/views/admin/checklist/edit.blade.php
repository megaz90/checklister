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
                    <h4 class="card-title mb-4 text-center mb-5">{{__('Edit Checklist')}}</h4>

                    <form action="{{ route('admin.checklist_groups.checklists.update', [$checklistGroup, $checklist]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">{{__('Checklist Name')}}:</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control"  placeholder="{{__('Enter Checklist Name')}}" name="name" value="{{ $checklist->name }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-sm w-md">{{__('Update')}}</button>
                        </div>
                    </form>
                    @can('delete', \App\Models\Checklist::class)
                        <form action="{{ route('admin.checklist_groups.checklists.destroy', [$checklistGroup, $checklist]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-danger btn-sm w-md">{{__('Delete')}}</button>
                            </div>
                        </form>
                    @endcan

                </div>
                <!-- end card body -->
            </div>
            <h1 class="text-center"><hr>Manage Task<hr></h1>

            @can('viewAny', \App\Models\Task::class)
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3 text-center">{{__('List of Tasks')}}</h4>

                    @can('view', \App\Models\Task::class)
                        @include('components.task.index')
                    @else
                        <h3 class="text-center"><strong>(Not Authorized)</strong></h2>
                    @endcan

                </div>
            </div>
            {{-- Make New Task Body --}}
            @if ($errors->storeTask->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->storeTask->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-center mb-5">{{__('Add new Task to Checklist')}}</h4>
                    @can('create', \App\Models\Task::class)
                        @include('components.task.create')
                    @else
                    <h3 class="text-center"><strong>(Not Authorized)</strong></h2>
                    @endcan
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
            @else
            <h3 class="text-center"><strong>(Not Authorized)</strong></h2>
            @endcan

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#task-description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection