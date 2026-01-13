<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;
use App\Models\Article;
use App\Models\News;
use App\Models\Staffs;
use App\Models\Jurusan;
use App\Models\Ekskul;
use App\Models\FAQ;
use App\Models\Gallery;
use App\Models\Testimonial;


class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth'); 
    }
    
    
  

    public function index()
{
    $articles = Article::inRandomOrder()->get();  // Mengambil semua artikel terbaru
    $news = News::latest()->get();         // Mengambil semua berita terbaru
    $staffs = Staff::inRandomOrder()->get(); 
    $ekskuls = Ekskul::inRandomOrder()->take(3)->get();
 $jurusans = Jurusan::all();
    $jurusanList = Jurusan::all();
    $jurusanList = Jurusan::select('id', 'nama_jurusan', 'deskripsi', 'logo_jurusan')->get();
    $faqs = FAQ::latest()->take(5)->get();
    $testimonials = Testimonial::latest()->take(5)->get();
    $galleries = Gallery::latest()->take(6)->get();
    return view('home', compact('articles', 'news','staffs','jurusanList','ekskuls','faqs','testimonials','galleries','jurusans'));
}

    // public function index()
    // {

    //     $articles = Article::latest()->take(3)->get(); 
       
    //     return view('welcome', compact('articles',)); 
    // }

    

   
}
