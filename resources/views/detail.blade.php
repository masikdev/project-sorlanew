<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorla Architecture</title>


    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
                        <td>{{ __('messages.location') }} :</td>
                        <td>{{ $project->{'location_' . session('app_locale')} }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('messages.size') }} :</td>
                        <td>{{ $project->{'size_' . session('app_locale')} }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('messages.status') }} :</td>
                        <td>{{ $project->{'status_' . session('app_locale')} }}</td>
                    </tr>
                    @if ($project->collaborator)
                    <tr>
                        <td>{{ __('messages.collaborator') }} :</td>
                        <td>{{ $project->collaborator }}</td>
                    </tr>
                    @endif
                    </tr>
                    <tr>
                        <td>{{ __('messages.project date') }} :</td>
                        <td>{{ \Carbon\Carbon::parse($project->year)->format('d F Y') }}</td>
                    </tr>
                </table>

                <div class="description">
                    <h3 class="fw-bold">{{ __('messages.description') }}</h3>
                    <p>{{ $project->{'description_' . session('app_locale')} }}</p>
                </div>

        </section>


        {{-- <section class="project-gallery">
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
        </section> --}}

        <!-- Tambahkan Modal -->
        <!-- Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center position-relative">
                        <button class="btn btn-dark position-absolute start-0 top-50 translate-middle-y" id="prevImage"
                            style="z-index: 10;">&#10094;</button>
                        <img id="modalImage" src="" class="img-fluid" alt="Preview">
                        <button class="btn btn-dark position-absolute end-0 top-50 translate-middle-y" id="nextImage"
                            style="z-index: 10;">&#10095;</button>
                        <h5 class="modal-title" id="imageModalLabel"></h5>

                    </div>
                </div>
            </div>
        </div>

        <section class="project-gallery">
            <ul class="project-images">
                @foreach ($gambarProject as $gambar)
                @foreach ($gambar['image_desc'] as $image)
                <li class="project-img" data-aos="fade-up" data-aos-delay="600">
                    <a href="#" class="open-modal" data-image="{{ asset('storage/' . $image) }}"
                        data-name="{{ $gambar['image_name'] }}">
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

    <!-- Tambahkan Bootstrap JS jika belum ada -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = new bootstrap.Modal(document.getElementById("imageModal"));
            const modalImage = document.getElementById("modalImage");
            const modalTitle = document.getElementById("imageModalLabel");
            const prevButton = document.getElementById("prevImage");
            const nextButton = document.getElementById("nextImage");

            let images = [];
            let currentIndex = 0;

            document.querySelectorAll(".open-modal").forEach((item, index) => {
                item.addEventListener("click", function(e) {
                    e.preventDefault();

                    images = Array.from(document.querySelectorAll(".open-modal")).map(link => ({
                        src: link.getAttribute("data-image"),
                        name: link.getAttribute("data-name")
                    }));

                    currentIndex = index;
                    updateModalContent();

                    modal.show();
                });
            });

            function updateModalContent() {
                modalImage.src = images[currentIndex].src;
                modalTitle.textContent = images[currentIndex].name;
            }

            prevButton.addEventListener("click", function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateModalContent();
                }
            });

            nextButton.addEventListener("click", function() {
                if (currentIndex < images.length - 1) {
                    currentIndex++;
                    updateModalContent();
                }
            });
        });
    </script>

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
                languageButton.innerHTML =
                    `<img src="{{ url('assets/flags/') }}/${currentLang}.png" alt="Language Flag"> ${currentLang.toUpperCase()}`;
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>