@section('head')
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Teach Me</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- site icons -->
    <link rel="icon" href="{{asset('images/fevicon/fevicon.png')}}" type="image/gif" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <!-- Site css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
    <!-- colors css -->
    <link rel="stylesheet" href="{{asset('css/colors1.css')}}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
    <!-- wow Animation css -->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}" />
    <!-- revolution slider css -->
    <link rel="stylesheet" type="text/css" href="{{asset('revolution/css/settings.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('revolution/css/layers.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('revolution/css/navigation.css')}}" />
@endsection