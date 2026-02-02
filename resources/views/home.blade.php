<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>SMK BPPI Baleendah</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        </style>
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
</head>

<body>

<!-- navbar start -->
    <header>
    @if(session('welcome_message'))
        <div class="alert">
            {{ session('welcome_message') }}
            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    @endif

    <div class="container-nav">
    <nav>
        
        <div class="logo">
            <a href="#"><img src="img/logosmk.png" alt="Logo SMK BPPI"></a>
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
                <li><a href="#">Beranda</a></li>
               

                <!-- Dropdown untuk Blog -->
                <li class="dropdown">
                    <a href="#mading">Informasi</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('articles.index') }}">Artikel</a></li>
                        <li><a href="{{ route('news.index') }}">Berita</a></li>
                        @auth
        @if(auth()->user()->role === 'admin')
            <li><a href="{{ route('admin.ppdb.index') }}">PPDB</a></li>
        @else
            <li><a href="{{ route('ppdb.create') }}">PPDB</a></li>
        @endif
    @else
        <li><a href="{{ route('ppdb.create') }}">PPDB</a></li>
    @endauth
                    </ul>
                </li>

                <!-- Dropdown untuk Jurusan -->
<li class="dropdown">
    <a href="#jurusan">Program Keahlian</a>
    <ul class="dropdown-menu">
        @foreach($jurusans as $jurusan)
            <li>
                <a href="{{ route('jurusan.show', $jurusan->id) }}">
                    {{ $jurusan->nama_jurusan }}
                </a>
            </li>
        @endforeach
       
    </ul>
</li>


                <!-- Ekstrakurikuler -->
                <li><a href="{{ route('ekskul.index') }}">Ekstrakurikuler</a></li>

                <!-- Tim Sekolah -->
                <li class="dropdown">
                    <a href="{{ route('tim_sekolah.index')}}">Tim Sekolah</a>
                    
                </li>
                <li><a href="#contact">Kontak</a></li>

                <!-- Tombol Login dan Logout -->
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

            </ul>
        </div>
    </nav>
</div>

    </header>

    <!-- home start -->
    <section id="home">
        <video autoplay muted loop class="bg_vid">
            <source src="vid/vidhome.mp4" type="video/mp4">
        </video>
        <div class="container">
            <div class="info">
                <div class="content">
                    <h1>Selamat Datang di SMK BPPI</h1>
                    
                    <p>Hijau Bersih Berkarakter</p>
                     <button  class="btn"><a href="#tentang">Selengkapnya</a></button>
                </div>
            </div>
        </div>
    </section>
    

<!-- tentang start -->

<section id="tentang">
    <div class="container hidden">
        <div class="content">
            <h1 style="text-align: center; font-size: 28px; font-weight: bold;">Tentang SMK BPPI Baleendah</h1>
            
            <p>SMK BPPI Baleendah didirikan pada tahun 2008 dengan komitmen menjadi sekolah kejuruan informatika yang siap menghadapi tantangan dunia kerja. 
                Sekolah ini terus meningkatkan kualitas pendidikan dengan penyempurnaan sarana dan prasarana. 
                Lulusan SMK BPPI Baleendah tidak hanya siap bekerja di bidang komputer, 
                tetapi juga didorong untuk melanjutkan pendidikan ke perguruan tinggi atau berwirausaha.
            </p>
            
    
    
</div>

            <div class="kotak">
                <div class="gerbang-container">
                <video class="foto-gerbang" autoplay muted loop playsinline>
                    <source src="vid/vidbawah.mp4" type="video/mp4">
                </video>
            <div class="feature">
                <div class="feature-item">
                <div class="icon-container">
                        <i class="fa-solid fa-wifi"></i>
                    </div>
                    <div class="text-container">
                        <h3>Wifi di lingkungan sekolah</h3>
                        <p>Memberikan akses internet cepat untuk mendukung pembelajaran dan kegiatan lainnya</p>
                    </div>
                   
                </div>
                <div class="feature-item">
               
                <div class="icon-container">
                        <i class="fa-solid fa-fingerprint"></i>
                    </div>
                    <div class="text-container">
                        <h3>Absensi menggunakan Fingerprint</h3>
                        <p>Dengan sistem Fingerprint absensi, orang tua dapat memantau siswa nya dengan aplikasi jendela sekolah.</p>
                    </div>
                </div>
                <div class="feature-item">
                <div class="icon-container">
                        <i class="fa-solid fa-gift"></i>
                    </div>
                    <div class="text-container">
                        <h3>Proyektor di setiap kelas</h3>
                        <p>Proyektor dapat membantu memberikan pelayanan kegiatan pembelajaran dengan lebih baik dan menarik.</p>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="visi-misi hidden">
            <div class="visi">
              <div class="header">
                <!-- <i class="fa-solid fa-eye"></i> -->
                <h3 class="hover-title">Visi:</h3>
              </div>
              <p>
              Menciptakan lulusan yang berkompeten dengan kebutuhan industri serta berkarakter, religius, profesional dan berwawasan lingkungan YANG BERKOMPETEN DENGAN KEBUTUHAN INDUSTRI SERTA BERKARAKTER, RELIGIUS, PROFESIONAL, DAN BERWAWASAN LINGKUNGAN.
              </p>
            </div>
          
            <div class="misi">
              <div class="header">
                <!-- <i class="fa-solid fa-bullseye"></i> -->
                <h3 class="hover-title">Misi:</h3>
              </div>
              <ul>
                <li>Mewujudkan masyarakat sekolah yang relegius melalui peningkatan pendidikan yang memuat imtaq</li>
                <li>Membangun prilaku disiplin Siswa sejak dini</li>
                <li>Meningkatkan kemampuan siswa dalam kegiatan intra dan ekstrakurikuler</li>
                <li>Meningkatkan efektifitas KBM serta pembinaan seluruh warga sekolah dalam menegakan disiplin yang dilandasi keikhlasan dan penuh rasa tanggungjawab</li>
                <li>Mengembangkan dan memacu propesionalisme kerja, baik guru maupun tenaga tata laksana sehingga diperoleh sumber daya yang berkualitas</li>
                <li>Menyiapkan lulusan dapat diserap oleh Dunia Industri, mampu berwirausaha dan dapat melanjutkan studi ke jenjang berikutnya</li>
                <li>Mewujudkan lingkungan sekolah yang hijau, indah, aman dan Nyaman.</li>
                <li><a href="{{ route('admin.ppdb.index') }}">PPDB</a></li>

              </ul>
            </div>
          </div>
          
          
          
    </div>
</section>

<!-- mading -->
 <section id="mading">
    <div class="container">
        <div class="row">

            <!-- Kolom Kiri: Berita -->
            <div class="col-md-8 hidden">
            <h2 style="text-align: center; font-size: 28px; font-weight: bold;">Berita</h2>
                <div class="divider-with-text">
    <span></span>
</div>

                <div class="row">
                @foreach ($news->take(4) as $berita)
    <div class="col-md-6 mb-4 berita-mobile-hidden">

                           <div class="card shadow h-100 berita-item">

                            <a href="{{ route('news.show', $berita->id) }}" class="text-success text-decoration-none">
                                <img src="{{ asset('storage/' . $berita->image) }}" class="card-img-top" alt="{{ $berita->title }}">
</a>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('news.show', $berita->id) }}" class="t text-decoration-none">
                                            {{ Str::limit($berita->title, 80) }}
                                        </a>
                                    </h5>
                                    <small class="text-muted d-block mb-2">
                                        <i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d M Y') }}
                                        &nbsp;&nbsp;
                                    </small>
                                    <p class="card-text">{{ Str::limit(strip_tags($berita->content), 100) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
    <div class="text-center mt-3">
    <a href="{{ route('news.index') }}" class="btn btn-outline-primary" id="btn-ot">
        Lihat Berita Lainnya
    </a>
</div>
<br>
                </div>
            </div>

            <div class="col-md-4 hidden">
                <div class="artikel-dan-staff-wrapper">

                    <!-- Artikel -->
                    <h2 style="text-align: center; font-size: 28px; font-weight: bold;">Artikel</h2>
                    <div class="divider-with-text artikel-mobile-hidden">
                        <span></span>
                    </div>

                    <div class="artikel-list">
                        @foreach ($articles->take(3) as $article)
                            <div class="card artikel-item">
                                <div class="row g-0">
                                    <div class="col-4">
                                        <a href="{{ route('articles.show', $article->id) }}" class="text-dark text-decoration-none">
                                            <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded-start" alt="{{ $article->title }}">
                                        </a>
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body py-2 px-3">
    <h6 class="card-title mb-1">
        <a href="{{ route('articles.show', $article->id) }}" class="text-decoration-none">
            {{ Str::limit($article->title) }}
        </a>
    </h6>
<small class="text-muted">
    <i class="fa fa-calendar"></i>
    @if ($article->updated_at != $article->created_at)
        Last edited: {{ \Carbon\Carbon::parse($article->updated_at)->translatedFormat('l, d F Y') }}
    @else
       Published: {{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('l, d F Y') }}
    @endif
</small>

    <p class="card-text">{{ Str::limit(strip_tags($article->content), 20) }}</p>
</div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('articles.index') }}" class="btn btn-outline-primary" id="btn-ot">
                            Lihat Artikel Lainnya
                        </a>
                    </div>

                    <br>

                    <!-- Staff -->
                    <h2 style="text-align: center; font-size: 28px; font-weight: bold;">Tim Sekolah</h2>
                    <div class="divider-with-text hidden">
                        <span></span>
                    </div>

                    <div class="staff-container-2col">
                        @foreach($staffs->take(4) as $staff)
                            <div class="staff-card-large">
                                <img src="{{ asset('storage/' . $staff->photo) }}" alt="Staff" class="staff-image-large">
                                <div class="staff-overlay-large">
                                    <p class="staff-position-large">{{ $staff->department }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('tim_sekolah.index') }}" class="btn btn-outline-primary" id="btn-ot">
                            Lihat Staf Lainnya
                        </a>
                    </div>

                </div> <!-- akhir artikel-dan-staff-wrapper -->
            </div> 
</section>


<!-- Jurusan Section -->
<section id="jurusan">
    <div class="container hidden">
        <h2 style="text-align: center; font-size: 28px; font-weight: bold;">Program Keahlian</h2>
        <p class="description">Program Keahlian yang tersedia saat ini di SMK BPPI Baleendah</p>
        <div class="divider-with-text">
    <span></span>
</div>


        <div class="row">
            <!-- Sidebar Jurusan -->
            <div class="col-md-3">
                <div class="jurusan-navigation">
                    @foreach ($jurusanList as $jurusan)
                        <button class="jurusan-tab" 
                            onclick="showJurusan('{{ $jurusan->id }}', 
                                                 '{{ $jurusan->nama_jurusan }}', 
                                                 
                                                 '{{ Str::limit(strip_tags($jurusan->deskripsi),100) }}', 
                                                 '{{ asset('storage/' . $jurusan->logo_jurusan) }}', 
                                                 '{{ route('jurusan.show', $jurusan->id) }}')">
                            {{ $jurusan->nama_jurusan }}
                        </button>
                   
                    @endforeach
                </div>
            </div>

            <!-- Konten Jurusan -->
            <div class="col-md-9">
                <div class="jurusan-card d-flex align-items-center">
                    <div class="jurusan-text">
                        <h3 class="jurusan-name">Pilih Jurusan</h3>
                        <p class="jurusan-description">Klik salah satu jurusan untuk melihat informasi lengkap.</p>
                        <a href="#" id="more-button-link" style="display: none;">
    <button class="btn btn-outline-primary" id="btn-ot">Lihat Selengkapnya</button>
</a>

                    </div>

                    <!--  PR -->
                    <div class="jurusan-image">
                        <img src="{{ asset('img/logosmk.png') }}" id="jurusan-logo" class="jurusan-logo" alt="Jurusan Logo">
                    </div>
                    

                </div>
            </div>
        </div>
        @auth
@if(auth()->user()->role == 'admin')
    <a href="{{ route('jurusan.index') }}">
        <button class="more-button admin-only">Lihat Semua Jurusan</button>
    </a>
@endif
@endauth

    </div>
</section>








<!-- ekskul start -->
<section id="ekskul">
    <div class="container text-center hidden">
        <h2 style="text-align: center; font-size: 28px; font-weight: bold;">Ekstrakurikuler</h2>
        <p>Macam-macam ekstrakurikuler yang ada di SMK BPPI Baleendah</p>
        <div class="divider-with-text">
    <span></span>
</div>


        <div class="row">
            @foreach ($ekskuls as $ekskul)
            <div class="col-md-4">
                <div class="card ekskul-card text-center">
                    <div class="ekskul-image">
                        <a href="{{ url('/ekskul/' . $ekskul->id) }}" class="exkul-link">
                        <img src="{{ asset('storage/' . $ekskul->logo) }}" alt="{{ $ekskul->nama }}">
                    </div>
                    <h4 class="mt-3">
    <strong>{{ $ekskul->nama }}</strong>
  </a>
</h4>


                    <p>{{ Str::limit(strip_tags($ekskul->deskripsi), 100) }}</p>
                    
                </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <a href="{{ route('ekskul.index') }}" class="btn btn-outline-primary" id="btn-ot">Ekskul Lainnya</a>
        </div>
    </div>
</section>

<!-- gallery start -->
<section id="gallery">
    <h2 style="text-align: center; font-size: 28px; font-weight: bold;">Gallery</h2>
    <p style="text-align: center;">Kumpulan foto-foto di SMK BPPI Baleendah</p>
    <div class="divider-with-text">
    <span></span>
</div>


    <div class="gallery-container hidden">
        @foreach($galleries->take(6) as $gallery) {{-- Menampilkan maksimal 6 foto --}}
            <div class="gallery-item">
                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->name }}">
                <div class="overlay">{{ $gallery->name }}</div>
            </div>
        @endforeach
    </div>

    @if(auth()->check() && auth()->user()->role === 'admin') {{-- Cek apakah user adalah admin --}}
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-primary">Lainnya</a>
        </div>
    @endif
</section>


<!-- testimoni start 

<section id="testimoni">
    <div class="testimonial-container hidden">
        <h2>Testimoni Alumni</h2>
        <div class="divider-with-text">
    <span></span>
</div>

<div class="testimonial-slider-wrapper" style="overflow: hidden;">
    <div class="testimonial-slider">
        @foreach ($testimonials as $index => $testimonial)
            <div class="testimonial-slide {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="testimonial-photo">
                <div class="testimonial-text-container">
                    <span class="testimonial-name">{{ $testimonial->name }}</span>
                    <span class="graduation-year">Tahun Lulus: {{ $testimonial->graduation_year }}</span>
                    <p class="testimonial-content">"{{ $testimonial->testimonial }}"</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
-->
        <!-- Navigasi Titik 
        <div class="testimonial-dots">
            @foreach ($testimonials as $index => $testimonial)
            <span class="dot {{ $index === 0 ? 'active' : '' }}" onclick="changeSlide({{ $index }})"></span>
            @endforeach
        </div>
        -->

        <!-- Tombol "Lihat Semua Testimoni" (Hanya Admin yang Bisa Melihat) 
        @if(auth()->user() && auth()->user()->role === 'admin')
        <div class="text-center mt-3">
            <a href="{{ route('admin.testimonial.index') }}" class="btn-testimonial">Lihat Semua Testimoni</a>
        </div>
        @endif
    </div>
</section>

</section>
            -->

<!-- faq start -->
<section id="faq">
 <div class="container hidden">
    <h2 class="faq-title">Frequently Asked Questions</h2>
    <p class="faq-subtitle">Pertanyaan yang sering ditanyakan</p>
    <div class="divider-with-text">
    <span></span>
</div>


    <div class="faq-container">
        @foreach ($faqs as $index => $faq)
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ({{ $index }})">
                <span class="faq-icon">❓</span> {{ $faq->question }}
                <span class="toggle-icon" id="icon{{ $index }}">+</span>
            </button>
            <div class="faq-answer" id="answer{{ $index }}">
                {{ $faq->description }}
            </div>
        </div>
        @endforeach
    </div>
    @auth
        @if (auth()->user()->role === 'admin')
            <div class="text-center mt-4">
                <a href="{{ route('admin.faq.index') }}" class="btn btn-primary">Lainnya</a>
            </div>
        @endif
    @endauth

</div>
</section>


<!-- Contact Section -->
<section id="contact">
    <div class="contact-container hidden">
        <h2>Kontak</h2>
        
<div class="divider-with-text">
    <span></span>
</div>

        <!-- Google Maps -->
        <div class="contact-map">
            <iframe 
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7920.179158852538!2d107.623453!3d-6.998732!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e688d37d39a17d1%3A0x336ee79e5df2ec1d!2sSMK%20BPPI%20Baleendah!5e0!3m2!1sid!2sid!4v1739975396655!5m2!1sid!2sid"
            width="100%"
            height="300"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        
        <p>Kontak yang dapat dihubungi</p>
        <!-- Contact Info -->
        <div class="contact-info">
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <p><strong>Lokasi:</strong><br>Jl. Adipati Agung No.23, Baleendah, Kec. Baleendah, Kabupaten Bandung, Jawa Barat 40375.</p>
            </div>
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <p><strong>Email:</strong><br>smk@bppi.sch.id | smkbppi2008@gmail.com.</p>
            </div>
            <div class="contact-item">
                <i class="fas fa-phone"></i>
                <p><strong>Telepon:</strong><br>022-5943350 | HP: 0857-2304-5600.</p>
            </div>
        </div>
        <div class="social-media">
            <a href="https://www.instagram.com/smkbppi_be?igsh=MW5jdTZ4ajcwZ3A4cQ==" target="_blank" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
            <!-- <a href="https://www.facebook.com/share/18mrjoLtwB/" target="_blank" class="social-icon facebook"><i class="fab fa-facebook"></i></a>
            <a href="https://www.youtube.com/@SMKBPPI" target="_blank" class="social-icon youtube"><i class="fab fa-youtube"></i></a> -->
            <a href="https://www.tiktok.com/@smkbppibaleendah?_r=1&_t=ZS-93FjFTnnv4H" target="_blank" class="social-icon tiktok"><i class="fab fa-tiktok"></i></a>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer>
    <p>© Copyright <strong>Unit Produksi PPLG</strong>. All Rights Reserved</p>
    <p>Developed by <strong>SM Studio</strong></p>
</footer>



<script>
document.addEventListener("DOMContentLoaded", function () {
    const hiddenElements = document.querySelectorAll(".hidden");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            } else {
                entry.target.classList.remove("show"); // Hilang saat scroll ke atas
            }
        });
    }, { threshold: 0.2 }); // Akan muncul ketika 20% elemen terlihat

    hiddenElements.forEach(el => observer.observe(el));
});


</script>

<scrtipt>
    
</scrtipt>

<script>
    let currentIndex = 0;
    const slides = document.querySelectorAll('.testimonial-slide');
    const dots = document.querySelectorAll('.dot');

    function showSlide(index) {
        // Tambahkan class keluar ke slide saat ini
        slides[currentIndex].classList.remove('active');
        slides[currentIndex].classList.add('exit-left');

        // Hapus efek keluar setelah animasi selesai
        setTimeout(() => {
            slides[currentIndex].classList.remove('exit-left');
        }, 500); // sesuai durasi animasi di CSS

        // Perbarui ke slide berikutnya
        slides[index].classList.add('active');

        dots.forEach(dot => dot.classList.remove('active'));
        dots[index].classList.add('active');

        currentIndex = index;
    }

    function nextSlide() {
        const nextIndex = (currentIndex + 1) % slides.length;
        showSlide(nextIndex);
    }

    function changeSlide(index) {
        if (index !== currentIndex) {
            showSlide(index);
        }
    }

    setInterval(nextSlide, 7000); // Auto-slide tiap 7 detik
</script>



<!-- JavaScript -->
<script>
    function showJurusan(id, nama, deskripsi, logo, link) {
        // Update teks nama dan deskripsi jurusan
        document.querySelector(".jurusan-name").innerText = nama;
        document.querySelector(".jurusan-description").innerText = deskripsi;
        
        // Update logo jurusan
        document.getElementById("jurusan-logo").src = logo;

        // Update tautan tombol "Lihat Selengkapnya"
        var moreButton = document.getElementById("more-button-link");
        moreButton.href = link;
        moreButton.style.display = "block"; // Munculkan tombol setelah jurusan dipilih
    }
</script>



<script>
    function toggleFAQ(index) {
        const answer = document.getElementById("answer" + index);
        const icon = document.getElementById("icon" + index);

        if (answer.classList.contains("active")) {
            answer.classList.remove("active");
            icon.textContent = "+";
        } else {
            answer.classList.add("active");
            icon.textContent = "-";
        }
    }
</script>

<script>
  function toggleMenu() {
      const navLinks = document.querySelector('.nav-links');
      const hamburger = document.querySelector('.hamburger');
      navLinks.classList.toggle('active');
      hamburger.classList.toggle('active');
  }
</script>

<script>
function showJurusan(id, nama, deskripsi, logo, link) {
    const card = document.querySelector('.jurusan-card');
    const name = document.querySelector('.jurusan-name');
    const desc = document.querySelector('.jurusan-description');
    const logoImg = document.getElementById('jurusan-logo');
    const moreBtn = document.getElementById('more-button-link');

    // Tambahkan animasi keluar
    card.classList.add('fade-out');

    setTimeout(() => {
        // Update isi setelah animasi keluar selesai
        name.textContent = nama;
        desc.textContent = deskripsi;
        logoImg.src = logo;

        // Update link tombol
        moreBtn.href = link;
        moreBtn.style.display = 'inline-block';

        // Hapus kelas fade-out dan tambahkan fade-in
        card.classList.remove('fade-out');
        card.classList.add('fade-in');

        // Hapus fade-in setelah selesai agar bisa dipakai lagi nanti
        setTimeout(() => {
            card.classList.remove('fade-in');
        }, 500);
    }, 300); // waktu delay sama dengan waktu animasi
}
</script>

<!-- Quill Core JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Image Resize Module -->
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>


    <script src="script.js"></script>



    <!-- POPUP PPDB -->
<div id="ppdbPopupOverlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.65); z-index:9999;">
  <div style="
      background:#fff;
      max-width:520px;
      margin:8vh auto;
      border-radius:14px;
      position:relative;
      overflow:hidden;
      box-shadow:0 12px 30px rgba(0,0,0,.25);
  ">

    <!-- HEADER -->
    <div style="padding:14px 18px; display:flex; align-items:center; justify-content:space-between;">
      <div style="font-weight:800; letter-spacing:.3px;">
        Pendaftaran Siswa Baru
      </div>

      <button onclick="closePpdbPopup()"
        style="border:none; background:transparent; font-size:22px; line-height:1; cursor:pointer; color:#444;">
        &times;
      </button>
    </div>

    <!-- IMAGE -->
    <div style="padding:0 18px 12px 18px;">
      <img
        src="{{ asset('img/popup.png') }}"
        alt="PPDB"
        style="width:100%; border-radius:12px; display:block;"
      >
    </div>

    <!-- CONTENT -->
    <div style="padding:0 18px 18px 18px;">
      <div style="font-size:22px; font-weight:900; margin-bottom:6px; color:#1f2a37;">
        SPMB 2025/2026
      </div>

      <div style="font-size:15px; line-height:1.6; color:#374151; margin-bottom:14px;">
        Pendaftaran PPDB sudah dibuka. Ayo segera daftarkan diri kamu dan pastikan kamu mendapatkan pendidikan yang unggul dan berkualitas di sini.
      </div>

      <!-- BUTTONS -->
      <div style="display:flex; gap:10px;">
        <a href="{{ route('ppdb.create') }}"
          style="
            flex:1;
            text-align:center;
            padding:12px 14px;
            background:#168AC7;
            color:#fff;
            border-radius:10px;
            text-decoration:none;
            font-weight:800;
          ">
          Daftar Sekarang
        </a>

        <button onclick="closePpdbPopup()"
          style="
            padding:12px 14px;
            background:#e5e7eb;
            border:none;
            border-radius:10px;
            cursor:pointer;
            font-weight:700;
          ">
          Nanti
        </button>
      </div>
    </div>

  </div>
</div>

<script>
  function closePpdbPopup(){
    localStorage.setItem("ppdb_popup_closed", "1");
    document.getElementById("ppdbPopupOverlay").style.display = "none";
  }

  window.addEventListener("load", function(){
    const closed = localStorage.getItem("ppdb_popup_closed");
    if(!closed){
      document.getElementById("ppdbPopupOverlay").style.display = "block";
    }
  });
</script>


</body>
</html>