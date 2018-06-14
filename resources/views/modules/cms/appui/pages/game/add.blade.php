@extends('cms::appui.layouts.app')
@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Game</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->

        <!-- Datatables Block -->
        <!-- Datatables is initialized in js/pages/uiTables.js -->
        <div class="block full">
            <div class="block-title">
                <h2>Add Game</h2>
            </div>
            <!-- General Elements Content -->
            <div>
                <form id="game-add-form-post" {{ url('cms/game/add') }} method="POST" enctype="multipart/form-data"
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
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-8">
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                                   placeholder="Name">
                            @if($errors->has('name'))
                                <div class="error-text text-danger">
                                    {{$errors->first('name')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="file">Game File</label>
                        <div class="col-md-8">
                            <input type="file" id="file" name="file" class="form-control" value="{{ old('file') }}"
                                   placeholder="Game File">
                            @if($errors->has('file'))
                                <div class="error-text text-danger">
                                    {{$errors->first('file')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="logo">Logo</label>
                        <div class="col-md-8">
                            <input type="file" id="logo" name="logo" class="form-control" value="" placeholder="Logo">
                            @if($errors->has('logo'))
                                <div class="error-text text-danger">
                                    {{$errors->first('logo')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="cover">Cover</label>
                        <div class="col-md-8">
                            <input type="file" id="cover" name="cover" class="form-control" value=""
                                   placeholder="Cover">
                            @if($errors->has('cover'))
                                <div class="error-text text-danger">
                                    {{$errors->first('cover')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="thumb_share">Thumb Share</label>
                        <div class="col-md-8">
                            <input type="file" id="thumb_share" name="thumb_share" class="form-control" value=""
                                   placeholder="Thumb Share">
                            @if($errors->has('thumb_share'))
                                <div class="error-text text-danger">
                                    {{$errors->first('thumb_share')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="description">Description</label>
                        <div class="col-md-8">
                            <textarea id="description" name="description" rows="5" cols="47" class="form-control"
                                      value="{{ old('description') }}" placeholder="Description.."></textarea>
                            @if($errors->has('description'))
                                <div class="error-text text-danger">
                                    {{$errors->first('description')}}
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
                        <div class="col-md-2 pull-right">
                            <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Game</button>
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
@endsection

