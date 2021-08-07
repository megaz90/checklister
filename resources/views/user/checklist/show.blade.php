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
                        @foreach ($checklist->tasks as $task)
                        <div class="accordion-item">
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
                        @endforeach
                    </div>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
@endsection