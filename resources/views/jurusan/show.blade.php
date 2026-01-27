@extends('layouts.app')

@section('content')
<style>
.jurusan-container {
    display: flex;
    max-width: 1200px;
    margin: 20px auto;
    gap: 30px;
}

.left-content {
    flex: 2;
}

.right-sidebar {
    flex: 1;
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
    height: fit-content;
}

.article-image-detail {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 20px;
}

.article-title {
    font-size: 2rem;
    font-weight: bold;
    color: #168AC7;
    text-transform: uppercase;
    margin-bottom: 10px;
    text-align: left;
}

.article-meta {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 20px;
}

.article-content {
    font-size: 1rem;
    line-height: 1.6;
    color: #333;
    text-align: justify;
}

.sidebar-title {
    font-weight: bold;
    margin-bottom: 10px;
    color: #2c4964;
}

.sidebar-list {
    list-style: none;
    padding: 0;
}

.sidebar-list li {
    margin-bottom: 10px;
}

.sidebar-list a {
    text-decoration: none;
    color: #168ac7;
}

.sidebar-list a:hover {
    text-decoration: underline;
}

.recommended {
    margin-top: 40px;
}

.card-wrapper {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 kolom */
    gap: 10px;
    margin-top: 15px;
}

.card {
    border: 1px solid #ccc;
    border-radius: 6px;
    overflow: hidden;
    text-align: center;
    background-color: #fff;
    transition: box-shadow 0.3s ease;
}

.card img {
    width: 100%;
    height: 80px; /* lebih kecil */
    object-fit: cover;
}

.card-title {
    padding: 8px;
    font-size: 13px; /* kecilkan teks */
    color: #333;
}


.card:hover {
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.divider-with-text {
    display: flex;
    align-items: center;
    text-align: center;
    margin: 40px 0 20px;
}

.divider-with-text::before,
.divider-with-text::after {
    content: '';
    flex: 1;
    border-bottom: 2px solid #e0e0e0;
}

.divider-with-text:not(:empty)::before {
    margin-right: .75em;
}

.divider-with-text:not(:empty)::after {
    margin-left: .75em;
}

.divider-with-text span {
    font-size: 0.9rem;
    color: #888;
    font-style: italic;
}

.btn-back {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #168AC7;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-back:hover {
    background-color: #106aa1;
    transform: translateY(-2px);
}

/* Hover untuk artikel rekomendasi */
.card:hover {
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    transform: scale(1.02);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.jurusan-image {
    max-width: 100%; /* atur lebar maksimum */
    height: auto; /* menjaga aspek rasio */
    display: block;
    margin-bottom: 20px;
    border-radius: 8px;
    
}


.recommended-horizontal-card {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 12px;
    background-color: #fff;
    text-decoration: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.recommended-horizontal-card:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.recommended-horizontal-card img {
    width: 90px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
}

.recommended-horizontal-content {
    flex: 1;
}

.recommended-horizontal-content .title {
    font-size: 14px;
    font-weight: bold;
    color: #168ac7;
    margin-bottom: 4px;
}

.recommended-horizontal-content .date {
    font-size: 12px;
    color: #666;
}


@media (max-width: 767px) {
  .jurusan-container {
    margin-top: 70px; /* tambahkan jarak dari navbar */
    padding: 0 15px;
    flex-direction: column; /* untuk stack konten dan sidebar */
  }

  .left-content, .right-sidebar {
    width: 100%;
  }

  .right-sidebar {
    margin-top: 30px;
  }

  .recommended-list {
        flex-direction: column;
    }

    .recommended-card {
        flex: 1 1 100%;
        max-width: 100%;
    }

    .recommended-horizontal-card {
        flex-direction: column;
        align-items: flex-start;
    }

    .recommended-horizontal-card img {
        width: 100%;
        height: auto;
    }

    .recommended-horizontal-content .title {
        font-size: 15px;
    }

}


</style>

<div class="container jurusan-container">
    <!-- Kiri: Detail Jurusan -->
    <div class="left-content">
        @if ($jurusan->logo_jurusan)
            <img src="{{ asset('storage/' . $jurusan->logo_jurusan) }}" alt="Logo {{ $jurusan->nama_jurusan }}" class="jurusan-image">
        @endif

        <h1 class="article-title">{{ strtoupper($jurusan->nama_jurusan) }}</h1>

        <div class="article-content">
            <p>{{ (strip_tags($jurusan->deskripsi)) }}</p>
        </div>
    </div>

    <!-- Kanan: Sidebar -->
    <div class="right-sidebar">
        <div>
            <div class="sidebar-title">Artikel Terbaru</div>
            <ul class="sidebar-list">
                @foreach($latestArticles as $latest)
                    <li><a href="{{ route('articles.show', $latest->id) }}">{{ $latest->title }}</a></li>
                @endforeach
            </ul>
        </div>

        <div style="margin-top: 30px;">
            <div class="sidebar-title">Berita Terbaru</div>
            <ul class="sidebar-list">
                @foreach($latestNews as $news)
                    <li><a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
