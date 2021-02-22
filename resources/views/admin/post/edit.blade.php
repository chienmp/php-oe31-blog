@extends('layouts.backend.app')

@section('title', 'Post')

    @push('css')
        <!-- Bootstrap Select Css -->
        <link href="{{ asset('bower/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" />
    @endpush
@endsection
@section('content')
    <h3>{{ trans('edit_post') }}</h3>
    <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">{{ trans('post_title') }}</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}">
        </div>
        <div class="form-group">
            <label for="image">{{ trans('upload_image') }}</label>
            <input type="file" name="image" id="file" >
                <img id="img" src="{{ asset('storage/image', $post->image) }}" alt="image">
        </div>
        <div class="form-group">
            <input type="checkbox" id="publish" class="filled-in" name="status" checked = "{{ $post->status }}">
            <label for="publish">{{ trans('Publish') }}</label>
        </div>
        <div class="form-group form-float">
            <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                <label for="category">{{ trans('Category') }}</label>
                <select name="categories[]" class="selectpicker" multiple
                    data-selected-text-format="count > 3">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                <label for="tag">{{ trans('Tags') }}</label>
                <select name="tags[]" class="selectpicker" multiple
                    data-selected-text-format="count > 3">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="body">{{ trans('body') }}</label>
            <textarea id="id" name="body">{{ $post->body }}</textarea>
        </div>
        <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('posts.index') }}">{{ trans('back') }}</a>
        <button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ trans('submit') }}</button>
    </form>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('bower/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('js/loadimage.js') }}"></script>
    <script src="{{ asset('bower/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/tinyscript.js') }}"></script>
@endpush
