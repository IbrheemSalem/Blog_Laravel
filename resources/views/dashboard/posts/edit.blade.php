@extends('dashboard.layout.layout')
@section('title', 'Edit Post')
@section('body')
<div class="border border-light ">
    <div class="alert alert-secondary" role="alert">
        {{__('words.Edit Post')}} : {{$post->title}}
    </div>
    <form action="{{route('dashboard.posts.update', $post) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="pb-2">
            <input type="file" class="form-control" name="image"  placeholder="{{__('words.image')}}" aria-label="image">
        </div>
        <div class="pb-2 d-flex justify-content-center">
            <img src="{{asset($post->image)}}" width="100px">
        </div>
        <div class="pb-2">
            <select name="category_id" id="" class="form-control" required>
                @foreach ($categories as $category)
                    <option  @selected($post->category_id == $category->id) value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="tab">
            @foreach (config('app.languages') as $key => $lang)
                <button type="button" class="tablinks" onclick="openCity(event, '{{ $key }}')">{{ $lang }}</button>
            @endforeach
        </div>
        @foreach (config('app.languages') as $key => $lang)
            <div id="{{$key}}" class="tabcontent mb-5">
                <div class="col">
                    <label for="inputtitle" class="form-label">{{__('words.title')}} : {{$lang}}</label>
                    <input type="text" class="form-control" name="{{$key}}[title]" placeholder="{{__('words.title')}}" value="{{$post->translate($key)->title}}" aria-label="title">
                </div>
                <div class="col">
                    <label>{{ __('words.smallDesc') }}</label>
                    <textarea name="{{ $key }}[smallDesc]" class="form-control" id="editor" cols="50" rows="10">{{$post->translate($key)->smallDesc}}</textarea>
                </div>
                <div class="col">
                    <label>{{ __('words.content')}}</label>
                    <textarea name="{{ $key }}[content]" class="form-control" id="editor" cols="50" rows="10">{{$post->translate($key)->content}}</textarea>
                </div>
                <div class="col">
                    <label>{{ __('words.tags')}}</label>
                    <textarea name="{{ $key }}[tags]" class="form-control" id="">{{$post->translate($key)->tags}}</textarea>
                </div>
            </div>
        @endforeach
        <div class="mt-3">
            <button type="button" class="btn btn-primary" onclick="history.back();">{{__('words.Back')}}</button>
            <button type="submit" class="btn btn-primary">{{__('words.Save')}}</button>
        </div>

    </form>
</div>
@endsection
