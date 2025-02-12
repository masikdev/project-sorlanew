<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <main class="project">
        <section class="project-detail">
            <div class="title">
                <h3>{{ $project->project_name }}</h3>
            </div>
            <table>
                <tr>
                    <td>Type :</td>
                    <td>{{ $project->category }}</td>
                </tr>
                <tr>
                    <td>Location :</td>
                    <td>{{ $project->location }}</td>
                </tr>
                <tr>
                    <td>Size:</td>
                    <td>{{ $project->size }}</td>
                </tr>
                <tr>
                <tr>
                    <td>Status:</td>
                    <td>{{ $project->status }}</td>
                </tr>
                <tr>
                    <td>Date Project:</td>
                    <td>{{ \Carbon\Carbon::parse($project->date)->format('d F Y') }}</td>
                </tr>

            </table>


            <div class="description">
                <h3 class="fw-bold">Description</h3>
                <p>{{ $project->description }}</p>
            </div>
        </section>


        <section class="project-gallery">
            <ul class="project-images">
                
                @foreach ($gambarProject as $gambar)
                    @foreach ($gambar['image_desc'] as $image)
                        <li class="project-img" data-aos="fade-up" data-aos-delay="600">
                            <a href="{{ asset('storage/' . $image) }}" target="_blank">
                                <img src="{{ asset('storage/' . $image) }}" alt="">
                                <div class="image-info">
                                    <h4>{{ $gambar['image_name'] }}</h4>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </section>
    </main>

    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>
