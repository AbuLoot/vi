@extends('layout')

@section('content')
      <div class="row">
        <div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-body">
              <h4>Избранные ({{ count($posts) }})</h4>

              @forelse ($posts as $post)
                <section class="media">
                  <div class="media-left">
                    <a href="{{ url($post->category->section->service_id.'/'.$post->slug.'/'.$post->id) }}">
                      @if ( ! empty($post->image))
                        <img class="media-object" src="/img/posts/{{ $post->user_id.'/'.$post->image }}" alt="{{ $post->title }}" style="width:200px">
                      @else
                        <img class="media-object" src="/img/no-main-image.png" alt="{{ $post->title }}" style="width:200px">
                      @endif
                    </a>
                  </div>
                  <div class="media-body">
                    <div class="h4 media-heading">
                      <a href="{{ url($post->category->section->service_id.'/'.$post->slug.'/'.$post->id) }}">{{ $post->title }}</a>
                      @include('partials.favorites')
                    </div>
                    <span class="text-success"><b>{{ $post->price }} тг</b></span>
                    @if ($post->deal == 'on')<span class="text-deal"> - торг возможен</span>@endif
                    <br>
                    <span class="text-post"><b>{{ $post->category->section->title }}</b> > {{ $post->category->title }}</span><br>
                    <span class="text-post"><b>{{ $post->city->title }}</b> - {{ $post->created_at }}. Просмотров {{ $post->views }}</span><br>
                  </div>
                </section><hr>
              @empty
                <h4>У вас пока нет объявлений в избранных</h4>
                <p>Вы можете добавлять понравившиеся вам объявления в избранные, чтобы потом вернуться к ним для более подробного изучения в любое время. Чтобы добавить объявление в избранные, нужно нажать на значок <i class="glyphicon glyphicon-star"></i>  , который находится справа в списке объявлений, или на странице с текстом просматриваемого объявления. При этом значок сменит цвет, это значит что объявление добавлено.</p>
                <a href="{{ route('posts.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Разместить Услугу</a>
              @endforelse
            </div>
          </div>
        </div>

        <aside class="col-md-4">
          @include('partials/rating')
        </aside>
      </div>
@endsection

@section('styles')
  <link href="/css/multiple-select.css" rel="stylesheet">
  <link href="/bower_components/bootstrap/dist/css/dropdowns-enhancement.min.css" rel="stylesheet">
@endsection

@section('scripts')
  <script src="/bower_components/bootstrap/dist/js/dropdowns-enhancement.js"></script>
  <script src="/js/multiple-select.js"></script>
  <script src="/js/multi-tag-select.js"></script>
  <script src="/js/favorite.js"></script>
@endsection
