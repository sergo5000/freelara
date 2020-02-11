<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="{{asset('css/app.css')}}" rel="stylesheet">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>
<body>
<div id="app">
    <div class="container">
        <div class="row">
            <form method="POST" action="{{ route('create') }}">
                @csrf
                <br>
                <br>
                <h2>222</h2>

                <autocomplete></autocomplete>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>

            </form>



{{--            <region-ajax-component></region-ajax-component>--}}
        </div>
    </div>
</div>
<script src="{!! asset('js/app.js') !!}"></script>
</body>
</html>