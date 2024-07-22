<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamPaper;
use Illuminate\Support\Facades\Auth;

class ExamPaperController extends Controller
{
    // Récupérer tous les sujets d'examen
    public function index()
    {
        $examPapers = ExamPaper::all();
        return response()->json($examPapers);
    }

    // Récupérer un sujet d'examen spécifique
    public function show($id)
    {
        $examPaper = ExamPaper::find($id);
        if (!$examPaper) {
            return response()->json(['message' => 'Exam paper not found'], 404);
        }
        return response()->json($examPaper);
    }

    // Créer un nouveau sujet d'examen
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $examPaper = new ExamPaper();
        $examPaper->title = $validated['title'];
        $examPaper->file_path = $request->file('file')->store('exam_papers');
        $examPaper->user_id = Auth::id();
        $examPaper->save();

        return response()->json(['message' => 'Exam paper created successfully!'], 201);
    }

    // Mettre à jour un sujet d'examen
    public function update(Request $request, $id)
    {
        $examPaper = ExamPaper::find($id);
        if (!$examPaper) {
            return response()->json(['message' => 'Exam paper not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'file' => 'sometimes|required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->has('title')) {
            $examPaper->title = $validated['title'];
        }
        if ($request->has('file')) {
            $examPaper->file_path = $request->file('file')->store('exam_papers');
        }
        $examPaper->save();

        return response()->json(['message' => 'Exam paper updated successfully!']);
    }

    // Supprimer un sujet d'examen
    public function destroy($id)
    {
        $examPaper = ExamPaper::find($id);
        if (!$examPaper) {
            return response()->json(['message' => 'Exam paper not found'], 404);
        }

        $examPaper->delete();
        return response()->json(['message' => 'Exam paper deleted successfully!']);
    }
}
