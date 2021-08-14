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
                    <h4 class="card-title mb-4 text-center mb-5">{{__('Edit Permissions Roles')}}</h4>

                    <form action="{{ route('admin.assign.permission-role.update') }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">{{__('Role Name')}}:</label>
                            <div class="col-sm-6">
                              <select name="role_id" class="form-select" id="role">
                                  <option value="" disabled selected>--Select Role--</option>
                                  @foreach ($roles as $role)
                                      <option value="{{ $role->id }}" data-route="{{ route('admin.assign.permission-role.getPermissions', $role->id) }}">{{ $role->name }}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>
                        <h5 class="text-center m-5">Permissions</h5>
                        @foreach ($permissions as $permission)
                            <div class="form-check form-check-primary mb-3">
                                <input class="form-check-input permissions" type="checkbox" name="permission_ids[]" value="{{ $permission->id }}">
                                <label class="form-check-label" for="{{$permission->name}}">
                                    {{$permission->name}}
                                </label>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-md">{{__('Update')}}</button>
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
        var role = document.getElementById('role');
        role.addEventListener('change', function(){
            let url = role.options[role.selectedIndex].getAttribute('data-route');
            let permissions = document.querySelectorAll(".permissions");

            //Setting Every checkbox to unchecked
            permissions.forEach((permission) => {
                permission.checked = false;
            });

            getPermissions(url);
        });

        const getPermissions = async (url = '') => {
            let result = await fetch(url);
            let data = await result.json();
            
            let permissions = document.querySelectorAll(".permissions");
            for(let i = 0; i < permissions.length; i++){
                data.forEach((id) => {
                if(permissions[i].value == id){
                    //Setting specific checbox to checked
                    permissions[i].checked = true;
                }
                });
            }

        }
    </script>
@endsection