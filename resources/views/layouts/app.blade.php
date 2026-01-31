<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>SMK BPPI Baleendah</title>
    <style>
        
        @import url('https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        </style>

    <title>@yield('title', 'SMK BPPI')</title>
    
    <!-- Link ke CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Link ke JavaScript -->
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body>
    <style>
    .footer-section {
        background-color: #f8f9fa;
        padding: 40px 20px;
        margin-top: 50px;
    }

    .contact-info-footer {
        padding-left: 30px; /* Geser kanan */
    }

    .social-media-footer a {
        font-size: 24px;
        margin-right: 15px;
        color: #333;
        transition: color 0.3s ease;
    }

    .social-media-footer a:hover {
        color: #007bff; /* Warna saat hover (biru) */
    }

    .footer-divider {
        border-top: 1px solid #ccc;
        margin-top: 40px;
        margin-bottom: 10px;
    }

    .footer-text {
        text-align: center;
        font-size: 14px;
        color: #555;
    }

    .footer-text strong {
        color: #007bff;
    }
</style>
    <!-- Navbar -->
   <!-- navbar start -->
   <header>
 
    <div class="container-nav">
    <nav>
        <div class="logo">
       

            <a href="{{ route('home') }}"><img src="{{ asset('img/logosmk.png') }}" alt="Logo SMK BPPI"></a>
            <span class="animated-text">
                <span class="hebat">SMK BPPI</span>
            </span>
        </div>

                <!-- Tombol Hamburger -->
<div class="hamburger" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
</div>

        <div class="nav-links">
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                
                <!-- Dropdown untuk Blog -->
                <li class="dropdown">
                    <a href="#">Informasi</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('articles.index') }}">Artikel</a></li>
                        <li><a href="{{ route('news.index') }}">Berita</a></li>
                    </ul>
                </li>

                 <!-- Dropdown untuk Jurusan -->
<li class="dropdown">
    <a href="#">Program Keahlian</a>
    <ul class="dropdown-menu">
        <li><a href="{{ url('jurusan/1') }}">PPLG</a></li>
        <li><a href="{{ url('jurusan/2') }}">AKL</a></li>
        <li><a href="{{ url('jurusan/4') }}">ACP</a></li>
        <li><a href="{{ url('jurusan/3') }}">TJKT</a></li>
    </ul>
</li>

                <!-- Ekstrakurikuler -->
                <li><a href="{{ route('ekskul.index') }}">Ekstrakurikuler</a></li>

                <!-- Dropdown untuk Staff -->
                <li class="dropdown">
                    <a href="{{ route('tim_sekolah.index')}}">Tim Sekolah</a>
                    
                </li>
                <li><a href="#kontak">Kontak</a></li>
<!-- Tombol Login dan Dropdown Admin -->
@auth
    @if(auth()->user()->role === 'admin')
        <!-- Dropdown untuk Admin -->
        <li class="nav-item ">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=random&color=fff" alt="Profile" class="rounded-circle" width="30" height="30">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li class="dropdown-header text-center">
                    <strong>{{ auth()->user()->name }}</strong><br>
                    <small class="text-muted">Role: {{ auth()->user()->role }}</small>
                </li>
                <li><hr class="dropdown-divider"></li>

                <!-- Link Tambah Admin -->
                <li>
                    <a href="{{ route('register')}}" class="dropdown-item">Tambah Admin Baru</a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <!-- Tombol Logout -->
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
    @endif
@else
    <!-- Tombol Login Jika Belum Login -->
    <li><!--<a href="{{ route('login') }}" class="btn-login">Login Admin</a>--></li>
@endauth

    </header>

    <!-- Konten Utama -->
   

     <div class="tes">adadad</div>
     <div class="container">

         <main class="container mt-5">
         {{-- Flash Message Global --}}
    @if (session('success'))
        <div id="flash-message" style="
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 12px 20px;
            border-radius: 8px;
            z-index: 9999;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        ">
            {{ session('success') }}
        </div>
        <script>
            // Auto hide after 5 seconds
            setTimeout(() => {
                const msg = document.getElementById('flash-message');
                if (msg) {
                    msg.style.opacity = '0';
                    msg.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => msg.remove(), 500);
                }
            }, 3500);
        </script>
    @endif
             @yield('content') 
            </main>
        </div>

  
<footer class="footer-section">
    <div class="container" id="kontak">
        <div class="row">
            <!-- Google Maps -->
            <div class="col-md-6 mb-4">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7920.179158852538!2d107.623453!3d-6.998732!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e688d37d39a17d1%3A0x336ee79e5df2ec1d!2sSMK%20BPPI%20Baleendah!5e0!3m2!1sid!2sid!4v1739975396655!5m2!1sid!2sid"
                    width="100%"
                    height="250"
                    style="border:0; border-radius: 10px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <!-- Info Kontak -->
            <div class="col-md-6 contact-info-footer">
                <h4 class="mb-3 fw-bold text-primary">Kontak</h4>
                <br>
                <p><i class="fas fa-map-marker-alt text-primary"></i> <strong>Lokasi:<br></strong> Jl. Adipati Agung No.23, Baleendah, Kab. Bandung.</p>
                <p><i class="fas fa-envelope text-primary"></i> <strong>Email:<br></strong> smk@bppi.sch.id | smkbppi2008@gmail.com.</p>
                <p><i class="fas fa-phone text-primary"></i> <strong>Telepon:<br></strong> 022-5943350 | HP: 0857-2304-5600.</p>
            </div>
                <!-- Media Sosial -->
                <div class="social-media-footer mt-3">
                    <a href="https://www.instagram.com/smkbppi_be?igsh=MW5jdTZ4ajcwZ3A4cQ==" target="_blank" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
                    <!-- <a href="https://www.facebook.com/share/18mrjoLtwB/" target="_blank" class="social-icon facebook"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.youtube.com/@SMKBPPI" target="_blank" class="social-icon youtube"><i class="fab fa-youtube"></i></a> -->
                    <a href="https://www.tiktok.com/@smkbppibaleendah?_r=1&_t=ZS-93FjFTnnv4H" target="_blank" class="social-icon tiktok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-divider"></div>

        <div class="footer-text">
            <p>© Copyright <strong>Unit Produksi PPLG</strong></p>
            <p>Developed by <strong>SM Studio</strong></p>
        </div>
    </div>
</footer>


    <!-- Tambahkan Script -->
    <script>
  function toggleMenu() {
      const navLinks = document.querySelector('.nav-links');
      const hamburger = document.querySelector('.hamburger');
      navLinks.classList.toggle('active');
      hamburger.classList.toggle('active');
  }
</script>
<!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>


<script>
  tinymce.init({
    selector: '#content',

    plugins: 'image link code lists',
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code',
    height: 400,
    automatic_uploads: true,
    relative_urls: false,
    remove_script_host: false,
    branding: false,
    
    file_picker_types: 'image',
    file_picker_callback: function (callback, value, meta) {
        if (meta.filetype === 'image') {
            let input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function () {
                let file = this.files[0];
                let reader = new FileReader();

                reader.onload = function () {
                    callback(reader.result, {
                        alt: file.name
                    });
                };

                reader.readAsDataURL(file);
            };

            input.click();
        }
    },

    images_upload_handler: function (blobInfo, success, failure) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', "{{ route('articles.upload-image') }}");

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);

        xhr.onload = function () {
            if (xhr.status !== 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            let json = JSON.parse(xhr.responseText);
            if (!json || typeof json.location !== 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.location);
        };

        let formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    }
});
</script>



    <script ></script>
    @stack('scripts')
    
</body>
</html>
