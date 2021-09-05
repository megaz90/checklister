<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @if(auth::user()->is_admin)
                <li class="menu-title" key="t-components">{{__('Manage Checklists')}}</li>
                @foreach($admin_menu as $group)

                @can('update', \App\Models\ChecklistGroup::class)
                <li class="mm-active">
                    <a href="{{ route('admin.checklist_groups.edit', $group->id) }}" class="has-arrow waves-effect">
                        <i class="bx bx-list-ul"></i>
                        <span>{{$group->name}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        @foreach($group->checklists as $checklist)
                        @can('update', \App\Models\Checklist::class)
                            <li><a href="{{ route('admin.checklist_groups.checklists.edit', [$group,$checklist]) }}"><i class="bx bx-list-ul"></i>{{ $checklist->name }}<span class="badge rounded-pill bg-info float-end task-count-{{$checklist->id}}"></span></a></li>
                        @endcan
                        @endforeach
                        @can('create', \App\Models\Checklist::class)
                        <li>
                            <a href="{{ route('admin.checklist_groups.checklists.create', $group) }}" class="waves-effect">
                                <i class="bx bx-plus"></i>
                                <span>{{ __('New Checklist') }}</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @endforeach

                @can('create', \App\Models\ChecklistGroup::class)
                <li>
                    <a href="{{ route('admin.checklist_groups.create') }}" class="waves-effect">
                        <i class="bx bx-plus"></i>
                        <span>{{ __('New Checklist Group') }}</span>
                    </a>
                </li>
                @endcan

                <li class="menu-title" key="t-components">{{__('Pages')}}</li>
                @foreach (\App\Models\Page::all() as $page)
                <li>
                    <a href="{{ route('admin.pages.edit', $page) }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">{{$page->title}}</span>
                    </a>
                </li>
                @endforeach
                <li class="menu-title" key="t-components">{{__('Other')}}</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow" key="t-horizontal"><i class="fa fa-money-bill-alt"></i> <span>Package</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('admin.packages.create') }}" key="t-horizontal">Add Package</a></li>
                        <li><a href="{{ route('admin.packages.index') }}" key="t-horizontal">All Packages</a></li>
                    </ul>
                </li>
                <li class="menu-title" key="t-components">{{__('Manage User Data')}}</li>
                @can('viewAny', \App\Models\User::class)
                <li>
                    <a href="javascript: void(0);" class="has-arrow" key="t-horizontal"><i class="fa fa-user"></i> <span>Users</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        @can('create', \App\Models\User::class)
                        <li><a href="{{ route('admin.users.create') }}" key="t-horizontal">Add User</a></li>
                        @endcan
                        @can('view', \App\Models\User::class)
                        <li><a href="{{ route('admin.users.index') }}" key="t-horizontal">All Users</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('viewAny', \App\Models\Authorization::class)
                <li>
                    <a href="javascript: void(0);" class="has-arrow" key="t-horizontal"><i class="fa fa-lock"></i><span> Authorization</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        @can('viewAny', \App\Models\RoleUser::class)
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Role User</a>
                            <ul class="sub-menu" aria-expanded="true">
                                @can('create', \App\Models\RoleUser::class)
                                    <li><a href="{{ route('admin.assign.role-user.create') }}" key="t-horizontal">Assign Roles to Users</a></li>
                                @endcan
                                @can('update', \App\Models\RoleUser::class)
                                    <li><a href="{{ route('admin.assign.role-user.edit') }}" key="t-horizontal">Edit Roles Users </a></li>
                                @endcan
                            </ul>
                        </li>
                        @endcan
                        @can('viewAny', \App\Models\PermissionRole::class)
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Permission Role</a>
                            <ul class="sub-menu" aria-expanded="true">
                                @can('create', \App\Models\PermissionRole::class)
                                    <li><a href="{{ route('admin.assign.permission-role.create') }}" key="t-horizontal">Assign Permissions to Roles</a></li>
                                @endcan
                                @can('update', \App\Models\PermissionRole::class)
                                    <li><a href="{{ route('admin.assign.permission-role.edit') }}" key="t-horizontal">Edit Permissions Roles</a></li>
                                @endcan

                            </ul>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('viewAny', \App\Models\Role::class)
                <li>
                    <a href="javascript: void(0);" class="has-arrow" key="t-horizontal"><i class="fa fa-users"></i><span> Role</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        @can('create', \App\Models\Role::class)
                            <li><a href="{{ route('admin.roles.create') }}" key="t-horizontal">Add Role</a></li>
                        @endcan
                        @can('view', \App\Models\Role::class)
                            <li><a href="{{ route('admin.roles.index') }}" key="t-horizontal">All Roles</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('viewAny', \App\Models\Permission::class)
                <li>
                    <a href="javascript: void(0);" class="has-arrow" key="t-horizontal"><i class="fa fa-user-lock"></i><span> Permission</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        @can('create', \App\Models\Permission::class)
                        <li><a href="{{ route('admin.permissions.create') }}" key="t-horizontal">Add Permission</a></li>
                        @endcan
                        @can('view', \App\Models\Permission::class)
                        <li><a href="{{ route('admin.permissions.index') }}" key="t-horizontal">All Permissions</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                
                @else
                <li class="menu-title" key="t-components">{{__('Checklists')}}</li>
                @foreach($user_menu as $group)
                <li class="mm-active">
                    <a href="#" class="waves-effect">
                        <i class="bx bx-list-ul"></i>
                        @if ($group['is_new'])
                        <span class="badge rounded-pill bg-info float-end">New</span>
                        @elseif($group['is_updated'])
                        <span class="badge rounded-pill bg-info float-end">UPT</span>
                        @endif
                        <span>{{$group['name']}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        @foreach($group['checklists'] as $checklist)
                        <li>
                            <a href="{{ route('user.checklists.show', [$checklist['id']]) }}">
                                <i class="bx bx-list-ul"></i>
                                @if ($checklist['is_new'])
                                <span class="badge rounded-pill bg-info float-end task-count-{{$checklist['id']}}"></span>
                                <span class="badge rounded-pill bg-info float-end">New</span>
                                @elseif($checklist['is_updated'])
                                <span class="badge rounded-pill bg-info float-end task-count-{{$checklist['id']}}"></span>
                                <span class="badge rounded-pill bg-info float-end">UPT</span>
                                @endif
                                <span class="badge rounded-pill bg-info float-end task-count-{{$checklist['id']}}"></span>
                                {{ $checklist['name'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>