@extends('layout')

@section('title_description', $service->title_description)

@section('meta_description', $service->meta_description)

@section('content')
  @foreach ($section as $item)
    <div class="row">
      <div class="col-md-offset-2 col-md-10">
        <h5 data-toggle="collapse" data-target="#{{ $item->slug }}" aria-expanded="false" aria-controls="{{ $item->slug }}">{{ $item->title }} <span class="glyphicon glyphicon-menu-down"></span></h5>
      </div>
    </div>
    <div class="collapse in categories" id="{{ $item->slug }}">
      @foreach ($item->categories->chunk(4) as $chunk)
        <div class="row">
          <div class="col-md-2"></div>
          @foreach ($chunk as $category)
            <section class="col-md-2 col-sm-3 col-xs-6">
              <div class="panel panel-default">
                <div class="panel-body">
                  <a href="{{ url($category->section->service->slug.'/'.$category->slug.'/'.$category->id) }}">
                    <!-- <img src="/img/categories/{{ $category->image }}" alt="{{ $category->title }}"> -->
                    <h5>{{ $category->title }}</h5>
                  </a>
                </div>
              </div>
            </section>
          @endforeach
        </div>
      @endforeach
    </div>
  @endforeach
@endsection