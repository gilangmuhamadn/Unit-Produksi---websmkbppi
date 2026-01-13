<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        
        return view('news.index', compact('news'));
    }

    public function create()
{
    return view('admin.news.create');
}


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|',
        ]);

        $data = $request->all();
    
       if ($request->hasFile('image')) {
    $filename = time() . '_' . $request->file('image')->getClientOriginalName();
    $request->file('image')->move(public_path('storage/news_images'), $filename);
    $data['image'] = 'news_images/' . $filename; 
}
    
        News::create($data);
    

        return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(News $news)
    {
        $latestArticles = Article::latest()->take(8)->get();
        $latestNews = News::latest()->take(8)->get();
        $randomNews = News::inRandomOrder()->take(3)->get();
        
    
        return view('news.show', compact('news', 'latestArticles', 'latestNews', 'randomNews'));
    }

    public function edit($id)
{
    $news = News::findOrFail($id);
    return view('admin.news.edit', compact('news'));
}

   public function update(Request $request, $id)
{
    $request->validate([
        'title'   => 'required|string|max:255',
        'content' => 'required',
        'image'   => 'nullable|image',
    ]);

    $news = News::findOrFail($id);

    $imagePath = $news->image; 

    if ($request->hasFile('image')) {
        // Hapus file lama kalau ada
        if ($imagePath && file_exists(public_path('storage/' . $imagePath))) {
            unlink(public_path('storage/' . $imagePath));
        }

        // Upload file baru
        $filename = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('storage/news_images'), $filename);

        $imagePath = 'news_images/' . $filename;
    }

    // Update data
    $news->update([
        'title'   => $request->title,
        'content' => $request->content,
        'image'   => $imagePath, // kalau tidak upload baru → pakai path lama
    ]);

    return redirect()->route('news.index')->with('success', 'Berita berhasil diperbarui.');
}


  public function destroy($id)
{
    $news = News::findOrFail($id);

    // Hapus file kalau ada
    if ($news->image && file_exists(public_path('storage/' . $news->image))) {
        unlink(public_path('storage/' . $news->image));
    }

    $news->delete();

    return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus.');
}

}
