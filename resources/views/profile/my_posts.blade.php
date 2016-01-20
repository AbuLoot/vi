@extends('layout')

@section('content')
      <div class="row">
        <div class="col-md-3">
          @include('partials.profile_menu')
        </div>
        <div class="col-md-9">
          <div class="row-left">
            <div class="panel panel-default">
              <div class="panel-body">
                <h3>Мои объявления</h3>
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
                      <div class="row">
                        <div class="col-md-9">
                          <div class="h4 media-heading">
                            <a href="{{ url($post->category->section->service_id.'/'.$post->slug.'/'.$post->id) }}">{{ $post->title }}</a>
                          </div>
                          <span class="text-success"><b>{{ $post->price }} тг</b></span>
                          @if ($post->deal == 'on')<span class="text-deal"> - торг возможен</span>@endif
                          <br>
                          <span class="text-post"><b>{{ $post->category->section->title }}</b> > {{ $post->category->title }}</span><br>
                          <span class="text-post"><b>{{ $post->city->title }}</b> - {{ $post->created_at }}. Просмотров {{ $post->views }}</span><br>
                        </div>
                        <div class="col-md-3">
                          <p><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-block btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Редактировать</a></p>
                          <form method="POST" action="{{ route('posts.destroy', $post->id) }}" accept-charset="UTF-8">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-block btn-danger btn-xs" onclick="return confirm('Удалить объявление?')"><span class="glyphicon glyphicon-remove"></span> Удалить</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </section><hr>
                @empty
                  <h4>В этой рубрике пока нет объявлений.</h4>
                  <a href="{{ route('posts.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Разместить Услугу</a>
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

