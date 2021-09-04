@extends('layouts.app')

@section('styles')
    
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            {{-- Edit Task Body --}}
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
                    <form action="{{ route('admin.checklists.tasks.update', [$checklist, $task]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">{{__('Task Name')}}:</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control"  placeholder="{{__('Enter Task Name')}}" name="name" value="{{ $task->name }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="description" class="col-sm-3 col-form-label">{{__('Task Description')}}:</label>
                            <div class="col-sm-6">
                              <textarea class="form-control" id="task-description" name="description" cols="30" rows="7" placeholder="{{ __('Enter Description') }}">{{ $task->description }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-sm w-md">{{__('Update Task')}}</button>
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
<script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'task-description' );
</script>
{{-- <script>
    ClassicEditor
        .create( document.querySelector( '#task-description' ) )
        .catch( error => {
            console.error( error );
        } );
</script> --}}
@endsection