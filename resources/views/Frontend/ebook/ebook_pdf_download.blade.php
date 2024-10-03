<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Book</title>
</head>
<body>
    <div style="padding: 40px; margin:40px">
        <h1 style="text-align: center">{{ $ebook->title }}</h1>
        <h2 style="text-align: center">{{ $ebook->lesson }}</h2>
        <h2 style="text-align: center">{{ $ebook->headline }}</h2>
        <br>
        <br>
        <br>
        <H3>Short Description: </H3>
        <p>{!! $ebook->short_desctiption !!}</p>
        <H3>Main Content: </H3>
        <p>{!! $ebook->long_desctiption !!}</p>
        <br>

        <h3>Category: {{ @$ebook->category->name }}</h3>
        <h3>Sub Category: {{ @$ebook->sub_category->name }}</h3>
        <h3>Author: {{ @$ebook->user->name }}</h3>
    </div>
</body>
</html>