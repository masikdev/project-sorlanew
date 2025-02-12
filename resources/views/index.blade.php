<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ url('assets/logo/sorla_logo_black.png') }}" type="image/x-icon">
    <title>Sorla Architecture</title>


    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

    <!-- ANIMATED ON SCROLL -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>

    <header>
        <nav class="navbar">
            <div class="navbar-logo">
                <a href="/">
                    <img src="{{ url('assets/logo/sorla_logo_black.png') }}" alt="">
                </a>
            </div>
            <div class="main-navbar">
                <ul>
                    <li><a href="/">All</a></li>
                    <li><a href="#">Architecture</a></li>
                    <li><a href="#">Interior</a></li>
                    <li><a href="#">Foundation Projects</a></li>
                    <li><a href="#">Building Performance</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="projects-gallery">
        <ul class="images">
            @foreach ($projects as $item)
                <li class="card-img" data-aos="fade-up" data-aos-delay="600">
                    <a href="{{ route('project.show', $item->id_project) }}">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="project images">
                        <div class="card-info">
                            <h4>{{ $item->project_name }}</h4>
                            <h6>{{ $item->category }}</h6>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        {{-- <ul class="images">
            <li class="card-img"><img src="{{url('images-sample/1.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/2.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/3.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/4.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/5.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/6.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/7.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/8.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/9.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/10.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/11.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/12.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/13.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/14.jpg')}}" alt=""></li>
            <li class="card-img"><img src="{{url('images-sample/15.jpg')}}" alt=""></li>
        </ul> --}}
    </main>

    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
