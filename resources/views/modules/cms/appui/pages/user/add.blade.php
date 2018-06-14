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
                <h2>Add User</h2>
            </div>
            <!-- General Elements Content -->
            <div>
                <form id="game-add-form-post" {{ url('cms/user/add') }} method="POST" enctype="multipart/form-data"
                      class="form-horizontal form-bordered">
                    @csrf

                    @if(session()->has('msg'))
                        <div class="form-group">
                            <div class="col-md-8">
                                <div class="error-text text-{{ session()->get('msg')['alert'] }}">
                                    {{ session()->get('msg')['message'] }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="fullname">Fullname</label>
                        <div class="col-md-8">
                            <input type="text" id="fullname" name="fullname" class="form-control"
                                   value="{{ old('fullname') }}"
                                   placeholder="Fullname">
                            @if($errors->has('fullname'))
                                <div class="error-text text-danger">
                                    {{$errors->first('fullname')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="username">Username</label>
                        <div class="col-md-8">
                            <input type="text" id="username" name="username" class="form-control"
                                   value="{{ old('username') }}"
                                   placeholder="Username">
                            @if($errors->has('username'))
                                <div class="error-text text-danger">
                                    {{$errors->first('username')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">Email</label>
                        <div class="col-md-8">
                            <input type="text" id="email" name="email" class="form-control"
                                   value="{{ old('email') }}"
                                   placeholder="Email">
                            @if($errors->has('email'))
                                <div class="error-text text-danger">
                                    {{$errors->first('email')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="password">Password</label>
                        <div class="col-md-8">
                            <input type="password" id="password" name="password" class="form-control"
                                   value="{{ old('password') }}"
                                   placeholder="Password">
                            @if($errors->has('password'))
                                <div class="error-text text-danger">
                                    {{$errors->first('password')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="birthday">Birthday</label>
                        <div class="col-md-8">
                            <input type="text" id="example-datepicker2" name="birthday"
                                   class="form-control input-datepicker" data-date-format="dd/mm/yy"
                                   placeholder="dd/mm/yy" value="{{ old("birthday") }}">
                            @if($errors->has('birthday'))
                                <div class="error-text text-danger">
                                    {{$errors->first('birthday')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="mobile">Mobile</label>
                        <div class="col-md-8">
                            <input type="tel" id="mobile" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="Mobile">
                            @if($errors->has('mobile'))
                                <div class="error-text text-danger">
                                    {{$errors->first('mobile')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="address">Address</label>
                        <div class="col-md-8">
                            <input type="tel" id="address" name="address" class="form-control"
                                   value="{{ old('address') }}"
                                   placeholder="Address">
                            @if($errors->has('address'))
                                <div class="error-text text-danger">
                                    {{$errors->first('address')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="avatar">Avatar</label>
                        <div class="col-md-8">
                            <input type="file" id="avatar" name="avatar" class="form-control" value=""
                                   placeholder="Avatar">
                            @if($errors->has('avatar'))
                                <div class="error-text text-danger">
                                    {{$errors->first('avatar')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="gender">Gender</label>
                        <div class="col-md-8">
                            <select id="example-select" name="gender" class="form-control" size="1">
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Khác</option>
                            </select>
                            @if($errors->has('gender'))
                                <div class="error-text text-danger">
                                    {{$errors->first('gender')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="status">Status</label>
                        <div class="col-md-8">
                            <input type="number" id="status" name="status" class="form-control"
                                   value="{{ old('status') }}" placeholder="Status">
                                @if($errors->has('status'))
                                    <div class="error-text text-danger">
                                        {{$errors->first('status')}}
                                    </div>
                                @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="role_id">Role</label>
                        <div class="col-md-8">
                            <select id="example-select" name="role_id" class="form-control" size="1">
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('role_id'))
                                <div class="error-text text-danger">
                                    {{$errors->first('role_id')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2 pull-right">
                            <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add User</button>
                        </div>
                    </div>
                </form>
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
    <script src="{{ asset('appui/js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('appui/js/pages/formsComponents.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
@endsection

