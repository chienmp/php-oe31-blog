@extends('layouts.backend.app')

@section('title', 'Category')

    @push('css')

    @endpush
@endsection
    <script src="{{ asset('js/loadimage.js') }}"></script>
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ trans('add_cate') }}
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="{{ trans('tag_name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="image">{{ trans('upload_image') }}</label>
                                    <input type="file" name="image" id="file">
                                    <img id="img" src="#" alt="image">
                                </div>
                            </div>
                            <a class="btn btn-danger  waves-effect"
                                href="{{ route('categories.index') }}">{{ trans('back') }}</a>
                            <button type="submit" class="btn btn-primary waves-effect">{{ trans('submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
