@extends('layout')

@section('content')
      @include('partials.admin_menu')
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-8">
              <h3>Создание тега</h3>
              <form action="{{ route('admin.tags.store') }}" method="post" class="form-horizontal">
                {!! csrf_field() !!}
                <div class="form-group">
                  <div class="col-md-offset-3 col-md-9">
                    @include('partials.alerts')
                  </div>

                  <label for="sort_id" class="col-md-3">Номер</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="sort_id" name="sort_id" maxlength="5" value="{{ (old('sort_id')) ? old('sort_id') : NULL }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="category_id" class="col-md-3">Категории</label>
                  <div class="col-md-9">
                    <select class="form-control" name="category_id" id="category">
                      @foreach ($section as $item)
                        <optgroup label="{{ $item->title }}">
                          @foreach ($item->categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                          @endforeach
                        </optgroup>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="title" class="col-md-3">Заголовок тега</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="title" name="title" minlength="3" maxlength="80" value="{{ (old('title')) ? old('title') : '' }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="slug" class="col-md-3">Slug</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="slug" name="slug" minlength="3" maxlength="80" value="{{ (old('slug')) ? old('slug') : '' }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="lang" class="col-md-3">Язык</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="lang" name="lang" maxlength="255" value="{{ (old('lang')) ? old('lang') : '' }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="status" class="col-md-3">Статус</label>
                  <div class="col-md-9">
                    <label>
                      <input type="checkbox" id="status" name="status" checked> Активен
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-9 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">Создать тег</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('styles')
  <link href="/bower_components/jasny-bootstrap/dist/css/fileinput.min.css" rel="stylesheet">
@endsection

@section('scripts')
  <script src="/bower_components/jasny-bootstrap/js/fileinput.js"></script>
  <script src="/bower_components/bootstrap-maxlength/src/bootstrap-maxlength.js"></script>
  <script src="/bower_components/bootstrap/dist/js/custom.js"></script>
@endsection
