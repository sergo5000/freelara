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
                <div id="category-container" class="col align-self-center">                    
                    <div id="category-values" hidden><?= json_encode($categoriesArray) ?></div>
                </div>
            </div>
        </div>
    </body>
</html>
