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
            width: 100px;
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
                        <li><a href="{{route('project.hospitality')}}">Hospitality</a></li>
                        <li><a href="{{route('project.residential')}}">Residential</a></li>
                        <li><a href="{{route('project.commercial')}}">Commercial</a></li>
                        <li><a href="{{route('project.interior')}}">Interior Design</a></li>
                        <li><a href="{{route('project.cultural')}}">Cultural</a></li>
                        <li><a href="{{route('project.recreational')}}">Recreational</a></li>
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
                                <img src="{{ url('assets/flags/en.png') }}" alt=""> EN</a></li>
                        <li><a href="#" data-lang="it" onclick="changeLanguage('it')">
                                <img src="{{ url('assets/flags/it.png') }}" alt=""> IT</a></li>
                        <li><a href="#" data-lang="id" onclick="changeLanguage('id')">
                                <img src="{{ url('assets/flags/id.png') }}" alt=""> ID</a></li>
                    </ul>
                </div>

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