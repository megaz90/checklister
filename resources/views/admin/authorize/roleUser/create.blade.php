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
            @if (\Session::has('info'))
                <div class="alert alert-info">
                   <h3>{{ Session::get('info') }}</h3>
                </div>
            @endif
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                   <h3>{{ Session::get('error') }}</h3>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-center mb-5">{{__('Assign Roles to User')}}</h4>

                    <form action="{{ route('admin.assign.role-user.store') }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">{{__('User')}}:</label>
                            <div class="col-sm-6">
                              <select name="user_id" class="form-select" id="user">
                                  <option value="" disabled selected>--Select user--</option>
                                  @foreach ($users as $user)
                                      <option value="{{ $user['id'] }}" data-route="{{ route('admin.assign.role-user.getRoles', $user['id']) }}">{{ $user['name'] }}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>
                        <h5 class="text-center m-5">Roles</h5>
                        @foreach ($roles as $role)
                            <div class="form-check form-check-primary mb-3">
                                <input class="form-check-input roles" type="checkbox" name="role_ids[]" value="{{ $role['id'] }}">
                                <label class="form-check-label" for="{{$role['name']}}">
                                    {{$role['name']}}
                                </label>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-md">{{__('Assign')}}</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        var user = document.getElementById('user');
        user.addEventListener('change', function(){
            let url = user.options[user.selectedIndex].getAttribute('data-route');
            let roles = document.querySelectorAll(".roles");

            //Setting Every checkbox to unchecked
            roles.forEach((role) => {
                role.checked = false;
            });

            getRoles(url);
        });

        const getRoles = async (url = '') => {
            let result = await fetch(url);
            let data = await result.json();
            
            let roles = document.querySelectorAll(".roles");
            for(let i = 0; i < roles.length; i++){
                data.forEach((id) => {
                if(roles[i].value == id){
                    //Setting specific checbox to checked
                    roles[i].checked = true;
                }
                });
            }

        }
    </script>
@endsection