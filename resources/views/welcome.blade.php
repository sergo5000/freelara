<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col align-self-center">
                    @foreach($categories as $category)
                        {{ $category->name }} <br><br>


                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
