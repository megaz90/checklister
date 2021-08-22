<div class="table-responsive">
    <table class="table mb-0 text-center">

        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @if (count($checklist->tasks) == 0)
                <tr>
                    <td colspan="4" class="test-center"><h3>No Task Found</h3></td>
                </tr>
            @else
            @foreach ($checklist->tasks->whereNull('user_id') as $task)
            <tr>
                <td>{{$task->name}}</td>
                <td>{!! $task->description !!}</td>
                <td>
                        @can('delete', \App\Models\Task::class)
                        <form style="display:inline-block" action="{{ route('admin.checklists.tasks.destroy', [$checklist,$task]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-md">{{__('Delete')}}</button>
                        </form>
                        @else
                        <p><strong>(Not Authorized to Delete)</strong></p>
                        @endcan

                        @can('update', \App\Models\Task::class)
                            <a href="{{ route('admin.checklists.tasks.edit', [$checklist,$task]) }}" class="btn btn-success btn-sm w-md">{{__('Edit')}}</a>
                        @else
                        <p><strong>(Not Authorized to Edit)</strong></p>
                        @endcan
                    </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>