@extends('layout')

@section('content')
    <div class="row">
      <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
          <div class="panel-body">
            <h3 class="text-center">Размещение услуги</h3><br>
            <form action="{{ route('posts.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <div class="form-group">
                <div class="col-md-offset-3 col-md-9 col-sm-12">
                  @include('partials.alerts')
                </div>

                <label for="title" class="col-md-3 col-sm-3">Заголовок объявления</label>
                <div class="col-md-9 col-sm-9">
                  <input type="text" class="form-control" id="title" name="title" minlength="5" maxlength="80" value="{{ old('title') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="category" class="col-md-3 col-sm-3">Категории</label>
                <div class="col-md-9 col-sm-9">
                  <select class="form-control" name="category_id" id="category" required>
                    <option value="">Выберите категорию</option>
                    @foreach ($section as $item)
                      <optgroup label="{{ $item->title }}">
                        @foreach ($item->categories->sortBy('sort_id') as $category)
                          <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                      </optgroup>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group tag-select-container">
                <label for="tags" class="col-md-3 col-sm-3">Специализации</label>
                <div class="col-md-9 col-sm-9">
                  <select class="" name="tags_id[]" id="tags" style="width:100%;" multiple>
                    <!-- <option value="">Выберите категорию</option> -->
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="price" class="col-md-3 col-sm-3">Цена</label>
                <div class="col-md-5 col-sm-5">
                  <div class="input-group">
                    <input type="text" class="form-control" id="price" name="price" maxlength="10" value="{{ old('price') }}" required>
                    <div class="input-group-addon">тг</div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4">
                  <label class="checkbox-inline">
                    <input type="checkbox" name="deal"> <b>Торг возможен</b>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="price" class="col-md-3 col-sm-3">Описание</label>
                <div class="col-md-9 col-sm-9">
                  <textarea class="form-control" id="description" name="description" rows="6" maxlength="2000">{{ old('description') }}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="price" class="col-md-3 col-sm-3">Фотографии<br><br> <small class="text-muted">Объявления<br> с фотографиями привлекают клиентов<br> на 80% больше</small></label>
                <div class="col-md-9 col-sm-9">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                    <div>
                      <span class="btn btn-default btn-sm btn-file">
                        <span class="fileinput-new"><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Выбрать</span>
                        <span class="fileinput-exists"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;</span>
                        <input type="file" name="images[]" accept="image/*">
                      </span>
                      <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-trash"></i> Удалить</a>
                    </div>
                  </div>
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                    <div>
                      <span class="btn btn-default btn-sm btn-file">
                        <span class="fileinput-new"><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Выбрать</span>
                        <span class="fileinput-exists"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;</span>
                        <input type="file" name="images[]" accept="image/*">
                      </span>
                      <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-trash"></i> Удалить</a>
                    </div>
                  </div>
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                    <div>
                      <span class="btn btn-default btn-sm btn-file">
                        <span class="fileinput-new"><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Выбрать</span>
                        <span class="fileinput-exists"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;</span>
                        <input type="file" name="images[]" accept="image/*">
                      </span>
                      <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-trash"></i> Удалить</a>
                    </div>
                  </div>

                  <p>
                    <a class="btn btn-link btn-sm" data-toggle="collapse" href="#fileinput-part" aria-expanded="false" aria-controls="collapseExample">
                      Больше картинок <span class="caret"></span>
                    </a>
                  </p>

                  <div class="collapse" id="fileinput-part">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                      <div>
                        <span class="btn btn-default btn-sm btn-file">
                          <span class="fileinput-new"><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Выбрать</span>
                          <span class="fileinput-exists"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;</span>
                          <input type="file" name="images[]" accept="image/*">
                        </span>
                        <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-trash"></i> Удалить</a>
                      </div>
                    </div>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                      <div>
                        <span class="btn btn-default btn-sm btn-file">
                          <span class="fileinput-new"><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Выбрать</span>
                          <span class="fileinput-exists"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;</span>
                          <input type="file" name="images[]" accept="image/*">
                        </span>
                        <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-trash"></i> Удалить</a>
                      </div>
                    </div>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                      <div>
                        <span class="btn btn-default btn-sm btn-file">
                          <span class="fileinput-new"><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Выбрать</span>
                          <span class="fileinput-exists"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;</span>
                          <input type="file" name="images[]" accept="image/*">
                        </span>
                        <a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-trash"></i> Удалить</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div><br>

              <h4>Контактная информация</h4><br>
              <div class="form-group">
                <label for="city" class="col-md-3 col-sm-3">Город</label>
                <div class="col-md-9 col-sm-9">
                  <select class="form-control" name="city_id" id="city">
                    @foreach ($cities as $city)
                      @if ($city->id === $user->profile->city_id)
                        <option value="{{ $city->id }}" selected>{{ $city->title }}</option>
                      @else
                        <option value="{{ $city->id }}">{{ $city->title }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="address" class="col-md-3 col-sm-3">Адрес </label>
                <div class="col-md-9 col-sm-9">
                  <input type="text" class="form-control" id="address" name="address" maxlength="80" value="{{ (old('address')) ? old('address') : $user->profile->address }}">
                </div>
                <div class="col-md-12">
                  <a id="show_map_modal" data-toggle="modal" href="#show_map" class="pull-right">Показать на карте</a>
                </div>
              </div>
              <div class="form-group">
                <label for="phone" class="col-md-3 col-sm-3">Телефон 1</label>
                <div class="col-md-5 col-sm-5">
                  <input type="tel" class="form-control" id="phone" name="phone" minlength="5" maxlength="40" value="{{ (old('phone')) ? old('phone') : $contacts->phone }}" required>
                </div>
                <div class="col-md-4 col-sm-4 messengers">
                  <label><input type="checkbox" name="telegram" {{ ($contacts->telegram == 'on') ? 'checked' : null }}> Telegram</label>&nbsp;
                  <label><input type="checkbox" name="whatsapp" {{ ($contacts->whatsapp == 'on') ? 'checked' : null }}> WhatsApp</label>&nbsp;
                  <label><input type="checkbox" name="viber" {{ ($contacts->viber == 'on') ? 'checked' : null }}> Viber</label>
                </div>
              </div>
              <div class="form-group">
                <label for="phone" class="col-md-3 col-sm-3">Телефон 2</label>
                <div class="col-md-5 col-sm-5">
                  <input type="tel" class="form-control" id="phone" name="phone2" minlength="5" maxlength="40" value="{{ (old('phone')) ? old('phone') : $contacts->phone2 }}">
                </div>
                <div class="col-md-4 col-sm-4 messengers">
                  <label><input type="checkbox" name="telegram2" {{ ($contacts->telegram2 == 'on') ? 'checked' : null }}> Telegram</label>&nbsp;
                  <label><input type="checkbox" name="whatsapp2" {{ ($contacts->whatsapp2 == 'on') ? 'checked' : null }}> WhatsApp</label>&nbsp;
                  <label><input type="checkbox" name="viber2" {{ ($contacts->viber2 == 'on') ? 'checked' : null }}> Viber</label>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-md-3 col-sm-3">Email</label>
                <div class="col-md-9 col-sm-9">
                  <input type="email" class="form-control" id="email" name="email" maxlength="40" value="{{ (old('email')) ? old('email') : $user->email }}">
                </div>
              </div>
              <div class="form-group">
                <label for="comment" class="col-md-3 col-sm-3">Разрешить комментарии</label>
                <div class="col-md-9 col-sm-9">
                  <select class="form-control" id="comment" name="comment">
                    <option value="all">Всем</option>
                    <option value="nobody">Никому</option>
                    <option value="registered_users">Только зарегистрированным пользователям</option>
                  </select><br>
                  <p>Размещая объявления на сайте, вы соглашаетесь с <a href="#">этими правилами</a>.</p>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-3 col-sm-offset-3 col-md-9 col-sm-9">
                  <button type="submit" class="btn btn-primary">Разместить объявление</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="show_map" class="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Кликните по карте, чтобы указать адрес</h4>
          </div>
          <div class="modal-body">
            <div id="map"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            <button id="save_map_modal" type="button" class="btn btn-primary" data-dismiss="modal">Сохранить</button>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('styles')
  <link href="/css/multiple-select.css" rel="stylesheet">
  <link href="/bower_components/jasny-bootstrap/dist/css/fileinput.min.css" rel="stylesheet">
@endsection

@section('scripts')
  <script src="/js/multiple-select.js"></script>
  <script src="/js/multi-tag-select.js"></script>
  <script src="/bower_components/jasny-bootstrap/js/fileinput.js"></script>
  <script src="/bower_components/bootstrap-maxlength/src/bootstrap-maxlength.js"></script>
  <script src="/bower_components/bootstrap/dist/js/custom.js"></script>
  <script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
  <script src="/js/show-on-map.js"></script>
@endsection
