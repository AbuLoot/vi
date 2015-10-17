@extends('layout')

@section('title_description', $service->title_description)

@section('meta_description', $service->meta_description)

@section('content')
  @foreach ($sections->chunk(4) as $chunk)
    <div class="row section">
      <div class="col-md-2"></div>
      @foreach ($chunk as $section)
        <section class="col-md-2 col-sm-3 col-xs-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <a href="{{ url($section->service->slug.'/'.$section->slug.'/'.$section->id) }}">
                <img src="/img/section/{{ $section->image }}" alt="{{ $section->title }}">
                <h5>{{ $section->title }}</h5>
              </a>
            </div>
          </div>
        </section>
      @endforeach
    </div>
  @endforeach
@endsection