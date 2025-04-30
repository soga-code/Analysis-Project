<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Analysis;
use Inertia\Inertia;
use Inertia\Response;

class AnalyzeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('analyze');
}

    public function store(Request $request)
    {
        $request->validate([
            'text_input' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // 10MB max
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        // Save to DB
        Analysis::create([
            'text_input' => $request->input('text_input'),
            'file_path' => $filePath,
        ]);

        return response()->json(['message' => 'Data stored successfully.'], 200);
    }
}