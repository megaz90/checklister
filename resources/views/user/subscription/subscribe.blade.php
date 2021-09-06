@extends('layouts.app')

@section('styles')
    
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Our Packages</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if (count($packages))
                            @foreach ($packages as $package)
                            <div class="col-md-3">
                                <div class="card border border-success">

                                    <div class="card-body">
                                        <h4 class="card-title mb-5 text-center">{{$package->name}}</h4>
                                        <p>{{ $package->description }}</p>
                                        <h4 class="text-center">${{ $package->price }}</h4>
                                        <div class="text-center mt-4"><a href="{{ route('subscription.subscribe', $package) }}" class="btn btn-primary waves-effect waves-light btn-sm">Subscribe</a></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                        <h2 class="text-center">No Packages Found</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
                <!-- end card body -->
    </div>
@endsection
@section('scripts')

@endsection