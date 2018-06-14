@extends('cms::appui.layouts.app')
@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Categories</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->

        <!-- Datatables Block -->
        <!-- Datatables is initialized in js/pages/uiTables.js -->
        <div class="block full">
            <div class="block-title">
                <h2>Add Category</h2>
            </div>
            <!-- General Elements Content -->
            <div>
                <form id="cate-add-form-post" {{ url('cms/cate/add') }} method="POST" enctype="multipart/form-data"
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
                        <label class="col-md-3 control-label" for="slug">Slug</label>
                        <div class="col-md-8">
                            <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}"
                                   placeholder="Slug">
                            @if($errors->has('slug'))
                                <div class="error-text text-danger">
                                    {{$errors->first('slug')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="order">Order</label>
                        <div class="col-md-8">
                            <input type="number" id="order" name="order" class="form-control" value="{{ old('order') }}"
                                   placeholder="Order">
                            @if($errors->has('order'))
                                <div class="error-text text-danger">
                                    {{$errors->first('order')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="status">Status</label>
                        <div class="col-md-8">
                            <input type="number" id="status" name="status" class="form-control" value="{{ old('status') }}"
                                   placeholder="Status">
                            @if($errors->has('status'))
                                <div class="error-text text-danger">
                                    {{$errors->first('status')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="parent_id">ParentId</label>
                        <div class="col-md-8">
                            <input type="number" id="parent_id" name="parent_id" class="form-control" value="{{ old('parent_id') }}"
                                   placeholder="ParentId">
                            @if($errors->has('parent_id'))
                                <div class="error-text text-danger">
                                    {{$errors->first('parent_id')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="parent_slug">Parent Slug</label>
                        <div class="col-md-8">
                            <input type="text" id="parent_slug" name="parent_slug" class="form-control" value="{{ old('parent_slug') }}"
                                   placeholder="Parent Slug">
                            @if($errors->has('parent_slug'))
                                <div class="error-text text-danger">
                                    {{$errors->first('parent_slug')}}
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
                        <label class="col-md-3 control-label" for="cover">Cover</label>
                        <div class="col-md-8">
                            <input type="file" id="cover" name="cover" class="form-control" value="{{ old('cover') }}"
                                   placeholder="Cover">
                            @if($errors->has('cover'))
                                <div class="error-text text-danger">
                                    {{$errors->first('cover')}}
                                </div>
                            @endif
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label" for="icon">Icon</label>
                        <div class="col-md-8">
                            <input type="file" id="icon" name="icon" class="form-control" value="{{ old('icon') }}"
                                   placeholder="Icon">
                            @if($errors->has('icon'))
                                <div class="error-text text-danger">
                                    {{$errors->first('icon')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2 pull-right">
                            <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add Category</button>
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

