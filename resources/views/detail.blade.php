<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorla Architecture</title>


    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

    <!-- ANIMATED ON SCROLL -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .language-selector {
            position: relative;
            display: inline-block;
        }

        .language-selector button {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 16px;
            padding: 5px;
        }

        .language-selector button img {
            width: 20px;
            height: 15px;
            margin-right: 5px;
        }

        .language-options {
            display: none;
            position: absolute;
            background: white;
            list-style: none;
            padding: 5px;
            margin: 0;
            border: 1px solid #ddd;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            width: 140px;
            right: 0;
            z-index: 10;
        }

        .language-options li {
            padding: 5px;
        }

        .language-options li a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: black;
        }

        .language-options li a img {
            width: 20px;
            height: 15px;
            margin-right: 5px;
        }

        .language-selector:hover .language-options {
            display: block;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar">



            <div class="left-navbar">
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
            </div>
            <div class="right-navbar">
                <div class="language-selector">
                    <button id="selected-language">
                        <img src="assets/flags/en.png" alt="EN Flag">
                        EN
                    </button>
                    <ul class="language-options">
                        <li><a href="#" data-lang="en" onclick="changeLanguage('en')">
                                <img src="{{ url('assets/flags/en.png') }}" alt=""> English</a></li>
                        <li><a href="#" data-lang="it" onclick="changeLanguage('it')">
                                <img src="{{ url('assets/flags/it.png') }}" alt=""> Italian</a></li>
                        <li><a href="#" data-lang="id" onclick="changeLanguage('id')">
                                <img src="{{ url('assets/flags/id.png') }}" alt=""> Indonesian</a></li>
                    </ul>
                </div>

                <!-- <select name="language" id="language" onchange="location = this.value;">
                    <option value="{{ route('change.language', 'en') }}" {{ session('app_locale') == 'en' ? 'selected' : '' }}> <img src="{{url('assets/flags/UK.png') }}" alt=""> EN</option>
                    <option value="{{ route('change.language', 'it') }}" {{ session('app_locale') == 'it' ? 'selected' : '' }}> <img src="{{url('assets/flags/Italy.png') }}" alt=""> IT</option>
                    <option value="{{ route('change.language', 'id') }}" {{ session('app_locale') == 'id' ? 'selected' : '' }}> <img src="{{url('assets/flags/Indonesian.png') }}" alt=""> ID</option>
                </select> -->
            </div>

        </nav>
    </header>

    <main class="project">
        <section class="project-detail">
            <div class="title">
                <h3>{{ $project->{'project_name_' . session('app_locale')} }}</h3>
                <table>
                    <tr>
                        <td>{{ __('messages.type') }} :</td>
                        <td>{{ $project->{'category_' . session('app_locale')} }}</td>
                    </tr>
                    <tr>
                        <td>{{__('messages.location')}} :</td>
                        <td>{{ $project->{'location_' . session('app_locale')} }}</td>
                    </tr>
                    <tr>
                        <td>{{__('messages.size')}} :</td>
                        <td>{{ $project->{'size_' . session('app_locale')} }}</td>
                    </tr>
                    <tr>
                        <td>{{__('messages.status')}} :</td>
                        <td>{{ $project->{'status_' . session('app_locale')} }}</td>
                    </tr>
                    <tr>
                        <td>{{__('messages.project date')}} :</td>
                        <td>{{ \Carbon\Carbon::parse($project->year)->format('d F Y') }}</td>
                    </tr>
                </table>

                <div class="description">
                    <h3 class="fw-bold">{{__('messages.description')}}</h3>
                    <p>{{ $project->{'description_' . session('app_locale')} }}</p>
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

    <!-- dropdown -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // AOS Initialization
            AOS.init();

            // Language Selector Logic
            const languageButton = document.getElementById("selected-language");
            const languageOptions = document.querySelector(".language-options");

            // Change language when clicking an option
            languageOptions.addEventListener("click", function(event) {
                if (event.target.tagName === "A") {
                    event.preventDefault();
                    const selectedLang = event.target.getAttribute("data-lang");
                    changeLanguage(selectedLang);
                }
            });

            // Set active language button based on cookie
            const appLocale = document.cookie.split("; ").find(row => row.startsWith("app_locale="));
            if (appLocale) {
                const currentLang = appLocale.split("=")[1];
                languageButton.innerHTML = `<img src="{{ url('assets/flags/') }}/${currentLang}.png" alt="Language Flag"> ${currentLang.toUpperCase()}`;
            }
        });

        function changeLanguage(lang) {
            fetch("{{ route('change.language', '') }}/" + lang, {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => {
                if (response.ok) {
                    document.cookie = "app_locale=" + lang + "; path=/";
                    location.reload();
                }
            }).catch(error => console.error("Error changing language:", error));
        }
    </script>


</body>

</html>