@extends('layouts.app')
@section('page_css')
    <link rel="stylesheet" href="css/style.css">
@endsection
@section('title')
    About Us
@endsection
@section('content')
    <div class="content-wrapper" style="width: 83%!important">
        <div class="container-full">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h4 class="page-title">About</h4>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                                class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item active " aria-current="page">About Content</li>
                                </ol>
                            </nav>
                        </div>

                    </div>

                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">About Us</h4>
                            </div>
                            <!-- /.box-header -->
                            <form class="form" method="post" action="{{ route('admin.about.update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">
                                    <hr class="my-15">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Content</label>
                                                <input type="hidden" name="about_id" value="{{ $about->id }}">
                                                <textarea class="form-control no-radius"
                                                          id="editor1" placeholder="About Content"
                                                          name="content" required>{{ $about->content }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">

                                    <button type="submit" class="btn btn-primary btn-sm no-radius">
                                        <i class="ti-save-alt"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.box -->
                    </div>




                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
@section('footer')


@endsection
