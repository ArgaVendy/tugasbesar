<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'username' => 'required|string|max:255',
        'pesan' => 'required|string',
        'rating' => 'required|integer|between:1,5',
    ]);

    Feedback::create($validatedData);

    return response()->json(['message' => 'Kritik dan saran berhasil disimpan.'], 200);
}

    public function index()
{
    $feedbacks = Feedback::latest()->get();
    return response()->json($feedbacks);
}

}
