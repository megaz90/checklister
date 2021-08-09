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
                <li class="mm-active">
                    <a href="{{ route('admin.checklist_groups.edit', $group->id) }}" class="has-arrow waves-effect">
                        <i class="bx bx-list-ul"></i>
                        <span>{{$group->name}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        @foreach($group->checklists as $checklist)
                        <li><a href="{{ route('admin.checklist_groups.checklists.edit', [$group,$checklist]) }}"><i class="bx bx-list-ul"></i>{{ $checklist->name }}<span class="badge rounded-pill bg-info float-end task-count-{{$checklist->id}}"></span></a></li>
                        @endforeach
                        <li>
                            <a href="{{ route('admin.checklist_groups.checklists.create', $group) }}" class="waves-effect">
                                <i class="bx bx-plus"></i>
                                <span>{{ __('New Checklist') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endforeach
                <li>
                    <a href="{{ route('admin.checklist_groups.create') }}" class="waves-effect">
                        <i class="bx bx-plus"></i>
                        <span>{{ __('New Checklist Group') }}</span>
                    </a>
                </li>
                <li class="menu-title" key="t-components">{{__('Pages')}}</li>
                @foreach (\App\Models\Page::all() as $page)
                <li>
                    <a href="{{ route('admin.pages.edit', $page) }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">{{$page->title}}</span>
                    </a>
                </li>
                @endforeach
                <li class="menu-title" key="t-components">{{__('Manage User Data')}}</li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-dashboards">{{__('Users')}}</span>
                    </a>
                </li>
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
                <li class="menu-title" key="t-components">{{__('Others')}}</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-share-alt"></i>
                        <span key="t-multi-level">Multi Level</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);" key="t-level-1-1">Level 1.1</a></li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Level 1.2</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);" key="t-level-2-1">Level 2.1</a></li>
                                <li><a href="javascript: void(0);" key="t-level-2-2">Level 2.2</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>