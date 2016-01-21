@extends('layout')

@section('title_description', $service->title_description)

@section('meta_description', $service->meta_description)

@section('content')
  <div class="row">
    <div class="col-md-offset-2 col-md-8">
      @foreach ($section as $item)
        <h4 class="category-title text-center">{{ $item->title }}</h4><br>
        <section class="categories" id="{{ $item->slug }}"><br>
          @foreach ($item->categories->sortBy('sort_id')->chunk(3) as $chunk)
            <div class="row">
              @foreach ($chunk as $category)
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <a href="{{ url($category->section->service->slug.'/'.$category->slug) }}" class="service">
                    <i class="material-icons md-24 icon">{{ $category->image }}</i> <span class="title">{{ $category->title }}</span>
                  </a>
                </div>
              @endforeach
            </div><br>
          @endforeach
        </section>
      @endforeach
    </div>
  </div>
@endsection