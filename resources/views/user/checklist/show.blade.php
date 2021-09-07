@extends('layouts.app')

@section('styles')
    
@endsection
@section('content')
@include('includes.tasks_status')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $checklist->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        @if (count($checklist->tasks) != 0)
                        @foreach ($checklist->tasks->whereNull('user_id') as $task)
                        @if ($loop->iteration == 6)
                            <div class="row mt-5">
                                <div class="col-md-12 offset-5">
                                <a href="{{ route('subscription.show') }}" class="btn btn-primary">Subscribe for More Tasks</a>
                                </div>
                            </div>
                        @elseif($loop->iteration <= 5)
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
                        @endif
                        @endforeach
                        @else
                        <h2 class="text-center">No Tasks Found</h2>
                        @endif
                </div>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>

        //Marking Task as True
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
        //Loading checked tasks and marking them as checked
        window.addEventListener('load', checked);

        //Getting all cheklist data from DB
        const getAllData = async() => {
            const result = await fetch('{{ route("checklistGroupData", $checklist) }}');
            const data = await result.json();

            var getData = '';
            data.forEach((checklist) => {
                const {user_tasks_count, tasks_count, id, name} = checklist;
                let pctg = user_tasks_count/tasks_count *100;
                if(isNaN(pctg))
                {
                    pctg = 0;
                }
                const allData = `<div class="col-md-3 mt-3">
                                    <h5 class="font-size-13">${name}</h5>
                                    <p class="total_count">${user_tasks_count}/${tasks_count}</p>
                                    <div class="progress progress-md">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: ${pctg}%;" 
                                    aria-valuenow="${pctg}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>`;

                
                getData += allData;
            });

            const output = document.getElementById("output");
            output.innerHTML = getData;

        }

        window.addEventListener('load', getAllData);

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
            getAllData();
        }

    </script>
@endsection