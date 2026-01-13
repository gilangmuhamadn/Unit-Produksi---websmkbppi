<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    
    public function index()
    {
        $faqs = FAQ::all();
        
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        FAQ::create([
            'question' => $request->question,
            'description' => $request->description,
        ]);
    
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil ditambahkan.');
    }
    

    public function edit(FAQ $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, FAQ $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255', // Tambahkan validasi question
            'description' => 'required|string|max:1000',
        ]);
    
        $faq->update([
            'question' => $request->question, // Simpan question
            'description' => $request->description,
        ]);
    
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui');
    }
    

    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil dihapus');
    }
}
