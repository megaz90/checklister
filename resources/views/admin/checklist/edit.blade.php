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
                    <form action="{{ route('admin.checklist_groups.checklists.destroy', [$checklistGroup, $checklist]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-danger btn-sm w-md">{{__('Delete')}}</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

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
                    <form action="{{ route('admin.checklists.tasks.store', $checklist) }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">{{__('Task Name')}}:</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control"  placeholder="{{__('Enter Task Name')}}" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="description" class="col-sm-3 col-form-label">{{__('Task Description')}}:</label>
                            <div class="col-sm-6">
                              <textarea class="form-control" name="description" cols="30" rows="7" placeholder="{{ __('Enter Description') }}">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-sm w-md">{{__('Create Task')}}</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3 text-center">{{__('List of Tasks')}}</h4>
                    
                    <div class="table-responsive">
                        <table class="table mb-0 text-center">

                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($checklist->tasks) == 0)
                                    <tr>
                                        <td colspan="3" class="test-center"><h3>No Task Found</h3></td>
                                    </tr>
                                @else
                                @foreach ($checklist->tasks as $task)
                                <tr>
                                    <td>{{$task->name}}</td>
                                    <td>
                                        <form style="display:inline-block" action="{{ route('admin.checklists.tasks.destroy', [$checklist,$task]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-md">{{__('Delete')}}</button>
                                        </form>
                                        <a href="{{ route('admin.checklists.tasks.edit', [$checklist,$task]) }}" class="btn btn-success btn-sm w-md">{{__('Edit')}}</a>
                                    </td>
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
@section('scripts')
    
@endsection