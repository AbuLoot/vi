@extends('layout')

@section('title_description', $service->title_description)

@section('meta_description', $service->meta_description)

@section('content')
  @foreach ($section as $item)
    <div class="row">
      <div class="col-md-offset-2 col-md-8">
        <h4 class="category-title text-center text-muted" data-toggle="collapse" data-target="#{{ $item->slug }}" aria-expanded="false" aria-controls="{{ $item->slug }}">{{ $item->title }} <span class="caret"></span></h4><br>
      </div>
    </div>
    <div class="col-md-offset-2 col-md-8 collapse in categories" id="{{ $item->slug }}" style="background-color: #fff; padding: 20px 0;">
      @foreach ($item->categories->sortBy('sort_id')->chunk(4) as $chunk)
        <div class="">
          <!-- <div class="col-md-2"></div> -->
          @foreach ($chunk as $category)
            <section class="col-md-3 col-sm-3 col-xs-6">
              <div class="row">
                <a href="{{ url($category->section->service->slug.'/'.$category->slug) }}" class="text-left">
                  <span class="pull-left">
                    <img src="/img/categories/{{ $category->image }}" alt="{{ $category->title }}" style="width:48px;height:48px;">
                  </span>
                  <span class="category-title">{{ $category->title }}</span>
                </a>
              </div>
            </section>
          @endforeach
        </div><br>
      @endforeach
    </div>
  @endforeach
@endsection