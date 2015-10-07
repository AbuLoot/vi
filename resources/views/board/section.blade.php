@extends('layout')

@section('title_description', $service->title_description)

@section('meta_description', $service->meta_description)

@section('content')
  @foreach ($sections->chunk(4) as $chunk)
    <div class="row">
      <div class="col-md-2"></div>
      @foreach ($chunk as $section)
        <section class="col-md-2 col-sm-3 col-xs-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <a href="{{ url($section->service->slug.'/'.$section->slug.'/'.$section->id) }}" class="center-block text-center">
                <img src="/img/section/{{ $section->image }}" alt="{{ $section->title }}">
                <h5 class="section-title-fix">{{ $section->title }}</h5>
              </a>
            </div>
          </div>
        </section>
      @endforeach
    </div>
  @endforeach
@endsection