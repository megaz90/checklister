@extends('layouts.app')

@section('styles')
    
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $checklist->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        @foreach ($checklist->tasks->whereNull('user_id') as $task)
                        <div class="row">
                        <div class="col-md-1">
                            {{-- <span class="fa fa-check mt-4"></span> --}}
                            <input class="form-check-input mt-4 task-check" type="checkbox" data-id={{ $task->id }} data-route="{{ route('task.complete' , $task->id) }}"/>
                        </div>
                        <div class="col-md-11">
                        <div class="accordion-item mt-2">
                            <h2 class="accordion-header" id="heading{{$task->id}}">
                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$task->id}}" aria-expanded="true" aria-controls="collapse{{$task->id}}">
                                     {{$task->name}}
                                </button>
                            </h2>
                            <div id="collapse{{$task->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$task->id}}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="text-muted">
                                        {!!$task->description!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        @endforeach
                </div>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        const checked = async() => {
            const result = await fetch('{{ route("task.checkCompleted", $checklist) }}');
            const data = await result.json();

            let checkboxTasks = document.querySelectorAll(".task-check");

            //Looping through each checkbox
            for(let i = 0; i < checkboxTasks.length ; i++)
            {
                //Looping through api data array and comparing it with data-id set
                data.find((ele)=>{
                    if(checkboxTasks[i].dataset.id == ele){
                        checkboxTasks[i].setAttribute('checked', true);
                    }
                });
            }

        }

        window.addEventListener('load', checked);

        document.body.onclick = function (e)
        {
            if(e.target.type === 'checkbox')
            {
                let url = e.target.getAttribute("data-route");
                setTaskComplete(url);
            }else{
                return;
            }
        }
        const setTaskComplete = async (url = "") => {
            const result = await fetch(url);
            const data = await result.json;
            getData();
        }

    </script>
@endsection