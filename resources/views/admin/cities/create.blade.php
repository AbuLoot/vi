@extends('layout')

@section('content')
      @include('partials.admin_menu')
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-8">
              <h3>Добавление города</h3>
              <form action="{{ route('admin.cities.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                  <label for="title" class="col-md-3">Название</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="title" name="title" minlength="3" maxlength="60" value="{{ (old('title')) ? old('title') : '' }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="slug" class="col-md-3">Slug</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="slug" name="slug" minlength="3" maxlength="60" value="{{ (old('slug')) ? old('slug') : '' }}">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-9 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection
