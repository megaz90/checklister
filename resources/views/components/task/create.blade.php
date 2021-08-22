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
        <textarea class="form-control" id="task-description" name="description" cols="30" rows="7" placeholder="{{ __('Enter Description') }}">{{ old('description') }}</textarea>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary btn-sm w-md">{{__('Create Task')}}</button>
    </div>
</form>