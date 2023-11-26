<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>{{$title}}</title>
    </head>

    <body>
        <header>
            BookManagementSystem
            <hr>
        </header>
        <main>
            {{$slot}}
        </main>
        <footer>
            <hr>
            @Laravel
        </footer>
    </body>
</html>