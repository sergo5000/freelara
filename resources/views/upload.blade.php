<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-9">
            <div class="card-header">
                Создание
            </div>
            <br>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('add') }}" enctype="multipart/form-data">
                @csrf
                <div class="card mb-3 p-5">

                    <div class="form-group row background-item">
                        <label for="inputTitle" class="col-sm-3 col-form-label">
                            Заголовок
                        </label>
                        <div class="col-sm-9">
                            <input id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row background-item">
                        <label for="inputPrice" class="col-sm-3 col-form-label">Цена</label>
                        <div class="col-sm-9">
                            <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}">
                            @if ($errors->has('price'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('price') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row background-item">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Фото</label>
                        <div class="col-sm-9">
                            <input id="photos" type="file" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="files[]" multiple>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
