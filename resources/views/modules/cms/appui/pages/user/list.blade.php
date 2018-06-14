@extends('cms::appui.layouts.app')
@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>User</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->

        <!-- Datatables Block -->
        <!-- Datatables is initialized in js/pages/uiTables.js -->
        <div class="block full">
            <div class="block-title">
                <h2>User List</h2>
                <a href="{{ url('cms/user/add') }}" style="padding: auto;" data-toggle="tooltip" title="Add New User" class="btn btn-success pull-right"><i class="fa fa-plus"></i>  Add New User</a>
            </div>
            <div class="table-responsive">

                @if(session()->has('msg'))
                    <ul class="task-list">
                        <li>
                            <a href="javascript:void(0)" onload="$('.task-list').show(0).delay(5000).hide(0);" class="task-close text-{{ session()->get('msg')['alert'] }}"><i class="fa fa-times"></i></a>
                            <label class="checkbox-inline error-text text-{{ session()->get('msg')['alert'] }}">
                                {{ session()->get('msg')['message'] }}
                            </label>
                        </li>
                    </ul>
                @endif

                <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th style="width: 120px;">Status</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $k => $u)
                        <tr>
                            <td class="text-center">{{ $u->id }}</td>
                            <td><strong>{{ $u->name }}</strong></td>
                            <td><strong>{{ $u->username }}</strong></td>
                            <td><span>{{ $u->email }}</span></td>
                            <td class="text-center"><span class="label label-info">{{ $u->status }}</span></td>
                            <td class="text-center">
                                <a href="javascript:void(0)" onclick="user.detail({{ $u->id }})" data-toggle="tooltip" title="Detail" class="btn btn-effect-ripple btn-xs btn-info"><i class="fa fa-eye fa-fw"></i></a>
                                {{-- <a href="javascript:void(0)" onclick="game.edit({{ $u->game_id }})" data-toggle="tooltip" title="Edit" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a> --}}
                                <a href="{{ route('cms.g.user.editUser', $u->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="user.del({{ $u->id }})" data-toggle="tooltip" title="Delete" class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Datatables Block -->
    </div>
    <!-- END Page Content -->
@endsection
@section('scripts')
    <!-- Load and execute javascript code used only in this page -->
    <script src="{{ asset('appui/js/pages/uiTables.js') }}"></script>
    <script>
        $(function () {
            UiTables.init();
        });
    </script>

    <script src="{{ asset('appui/js/cms/user.js') }}"></script>
@endsection

