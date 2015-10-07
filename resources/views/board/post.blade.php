@extends('layout')

@section('title_description', $post->title)

@section('meta_description', $post->description)

@section('content')
      <div class="row">
        <div class="col-md-12">
          <article class="panel panel-default">
            <div class="panel-body">
              @include('partials.alerts')
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <ol class="breadcrumb">
                    <li><a href="{{ route($post->section->service->route) }}">{{ $post->section->service->title }}</a></li>
                    <li><a href="{{ url($post->section->service->slug . '/' . $post->section->slug . '/' . $post->section->id) }}">{{ $post->section->title }}</a></li>
                  </ol>
                </div>
                <div class="col-md-6 col-sm-6">
                  <ol class="breadcrumb text-right">
                    @if (is_null($previous))
                      <li class="text-muted">← Предыдущий</li>
                    @else
                      <li><a href="{{ url($post->section->service_id . '/' . $previous->slug . '/' . $previous->id) }}">← Предыдущий</a></li>
                    @endif
                    @if (is_null($next))
                      <li class="text-muted">Следуйщий →</li>
                    @else
                      <li><a href="{{ url($post->section->service_id . '/' . $next->slug . '/' . $next->id) }}">Следуйщий →</a></li>
                    @endif
                  </ol>
                </div>
              </div>
              <h3>{{ $post->title }}</h3>
              <div class="row">
                @if ($images)
                  <div class="col-md-7 col-sm-12 gallery">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
                      <div class="carousel-inner" role="listbox">
                        <?php $i = 0; ?>
                        @foreach ($images as $key => $image)
                          @if ($i == 0)
                            <div class="item active">
                              <img src="/img/posts/{{ $post->user_id.'/'.$image['image'] }}" class="img-responsive">
                            </div>
                            <?php $i++; ?>
                          @else
                            <div class="item">
                              <img src="/img/posts/{{ $post->user_id.'/'.$image['image'] }}" class="img-responsive">
                            </div>
                          @endif
                        @endforeach
                      </div>
                    </div><br>
                    <ol class="list-inline">
                      <?php $i = 0; ?>
                      @foreach ($images as $key => $image)
                        @if ($i == 0)
                          <li data-target="#carousel-example-generic" data-slide-to="0" class="active">
                            <a href="#">
                              <img src="/img/posts/{{ $post->user_id.'/'.$image['mini_image'] }}" class="img-responsive">
                            </a>
                          </li> 
                        @else
                          <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}">
                            <a href="#">
                              <img src="/img/posts/{{ $post->user_id.'/'.$image['mini_image'] }}" class="img-responsive">
                            </a>
                          </li>
                        @endif
                        <?php $i++; ?>
                      @endforeach
                    </ol>
                  </div>
                @endif
                <div class="col-md-5 col-sm-12">
                  <ul class="list-inline">
                    <li><a href="/profile/{{ $post->user->profile->id }}"><u><i class="glyphicon glyphicon-user"></i> {{ $post->user->name }}</u></a></li>
                    <li><i class="glyphicon glyphicon-envelope"></i> {{ $post->email }}</li>
                  </ul>
                  <h3><span class="text-price">{{ $post->price }} тг</span> @if ($post->deal == 'on') <small class="text-muted">- Торг&nbsp;возможен</small> @endif</h3><hr>
                  <p>{{ $post->phone }}</p>
                  <p>{{ $post->city->title }}, {{ $post->address }}</p>
                  <p>{{ $post->description }}</p>
                  <p><small>{{ $post->created_at }}</small> | <small>Просмотров: {{ $post->views }}</small></p>
                </div>
              </div>
            </div>
          </article>
        </div>
        <div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-body">
              @unless ($post->comment === 'nobody')
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <i class="glyphicon glyphicon-comment"></i> Комментарии: {{ $post->comments->count() }}
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        @foreach ($post->comments as $comment)
                          <tr>
                            <th style="width:110px">{{ $comment->name }}</th>
                            <td>
                              {{ $comment->comment }}<br>
                              <small>Опубликовано {{ $comment->created_at }}</small>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              @endunless

              @if ($post->comment === 'nobody')
                <p>Комментарии к этому объявлению отключены.</p>
              @elseif ($post->comment === 'all' OR ($post->comment === 'registered_users' AND Auth::check()))
                <div class="well">
                  <h4>Добавить комментарий</h4><br>
                  <form action="/comment" method="POST" class="form-horizontal">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input name="id" type="hidden" value="{{ $post->id }}">
                    <input name="type" type="hidden" value="post">
                    <input name="type_1" type="hidden" value="post_{{ $first_number }}">
                    <input name="type_2" type="hidden" value="post_{{ $second_number }}">
                    <div class="form-group">
                      <label for="name" class="col-md-2 col-sm-2">Ваше имя</label>
                      <div class="col-md-10 col-sm-10">
                        <input type="text" class="form-control input-sm" id="name" name="name" minlength="3" maxlength="60" placeholder="Введите имя" value="{{ old('name') }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-md-2 col-sm-2">Email</label>
                      <div class="col-md-10 col-sm-10">
                        <input type="email" class="form-control input-sm" id="email" name="email" minlength="8" maxlength="60" placeholder="Введите email" value="{{ old('eamil') }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="comment" class="col-md-2 col-sm-2">Сообщение</label>
                      <div class="col-md-10 col-sm-10">
                        <textarea rows="3" class="form-control" id="comment" name="comment" maxlength="2000" required>{{ old('comment') }}</textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-offset-2 col-sm-offset-2 col-md-3 col-sm-3">
                        <table>
                          <tbody>
                            <tr>
                              <th class="text-nowrap">{{ $second_number }} + {{ $first_number }} =&nbsp;</th>
                              <td><input type="text" class="form-control input-sm" id="equal" name="equal" minlength="1" maxlength="2" placeholder="?" required></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-md-5 col-sm-5">
                        <button type="submit" class="btn btn-default btn-sm">Добавить</button>
                      </div>
                    </div>
                  </form>
                </div>
              @else
                <p>Только авторизованные пользователи могут оставлять комментарии</p>
              @endif
            </div>
          </div>
        </div>
        <aside class="col-md-4">
          @include('partials/rating')
        </aside>
      </div>
@endsection
