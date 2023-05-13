<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name=description content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', config('app.name'))</title>
  <link rel="dns-prefetch" href="//fonts.googleapis.com">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <style>
    body {
      margin: 20px
    }
  </style>
</head>

<body>
  <table class="table table-bordered table-striped">
    @foreach($data as $row)
    @if ($row == reset($data))
    <tr>
      @foreach($row as $key => $value)
      <th>{!! $key !!}</th>
      @endforeach
    </tr>
    @endif
    <tr>
      @foreach($row as $key => $value)
      @if(is_string($value) || is_numeric($value))
      <td>{!! $value !!}</td>
      @else
      <td></td>
      @endif
      @endforeach
    </tr>
    @endforeach
  </table>
</body>

</html>
