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



                    <form method="POST" action="{{ route('create') }}">
                        @csrf


                        <div class="card mb-3">


{{--                        <div class="form-group">--}}
{{--                            <label for="address" class="col-form-label">Адрес</label>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-11">--}}
{{--                                    <div id="app">--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-1">--}}
{{--                                    <span class="btn btn-primary btn-block location-button" data-target="#address"><span class="fa fa-location-arrow"></span></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div id="category-container" class="col align-self-center">
                            <div id="category-values" hidden>{{ json_encode($categoriesArray) }}</div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                Характеристики
                            </div>
                            <div class="card-body pb-2">
                                @foreach ($category->allAttributes() as $attribute)

                                    <div class="form-group">
                                        <label for=attribute_{{ $attribute->id }}" class="col-form-label">{{ $attribute->name }}</label>

                                        @if ($attribute->isSelect())

                                            <select id="attribute_{{ $attribute->id }}" class="form-control{{ $errors->has('attributes.' . $attribute->id) ? ' is-invalid' : '' }}" name="attributes[{{ $attribute->id }}]">
                                                <option value=""></option>
                                                @foreach ($attribute->variants as $variant)
                                                    <option value="{{ $variant }}"{{ $variant == old('attributes.' . $attribute->id) ? ' selected' : '' }}>
                                                        {{ $variant }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        @elseif ($attribute->isNumber())

                                            <input id="attribute_{{ $attribute->id }}" type="number" class="form-control{{ $errors->has('attributes.' . $attribute->id) ? ' is-invalid' : '' }}" name="attributes[{{ $attribute->id }}]" value="{{ old('attributes.' . $attribute->id) }}">

                                        @else

                                            <input id="attribute_{{ $attribute->id }}" type="text" class="form-control{{ $errors->has('attributes.' . $attribute->id) ? ' is-invalid' : '' }}" name="attributes[{{ $attribute->id }}]" value="{{ old('attributes.' . $attribute->id) }}">

                                        @endif

                                        @if ($errors->has('parent'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('attributes.' . $attribute->id) }}</strong></span>
                                        @endif
                                    </div>

                                @endforeach
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
