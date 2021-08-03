@extends('layouts.app')

@section('styles')
    
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            {{-- Edit Task Body --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-center mb-5">{{__('Edit Page')}}</h4>
                    <form action="{{ route('admin.pages.update', $page) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <label for="title" class="col-sm-3 col-form-label">{{__('Page Title')}}:</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control"  placeholder="{{__('Enter Page Title')}}" name="title" value="{{ $page->title }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="content" class="col-sm-3 col-form-label">{{__('Page Content')}}:</label>
                            <div class="col-sm-6">
                              <textarea class="form-control" id="page-content" name="content" cols="30" rows="7" placeholder="{{ __('Enter content') }}">{{ $page->content }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-sm w-md">{{__('Update Page')}}</button>
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
    ClassicEditor
        .create( document.querySelector( '#page-content' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection