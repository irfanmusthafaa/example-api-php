<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $bukus = Buku::all();
        if ($bukus->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No book data found.',
                'data' => []
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Book data retrieved successfully.',
            'data' => $bukus
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|digits:4',
            'penerbit' => 'required|string|max:255',
            'isbn' => 'required|string|max:20|unique:bukus,isbn'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $buku = Buku::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Book created successfully.',
                'data' => $buku
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while creating the book.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json([
                'status' => false,
                'message' => 'Book not found.',
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Book data retrieved successfully.',
            'data' => $buku
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json([
                'status' => false,
                'message' => 'Book not found.',
                'data' => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'sometimes|required|string|max:255',
            'penulis' => 'sometimes|required|string|max:255',
            'tahun_terbit' => 'sometimes|required|integer|digits:4',
            'penerbit' => 'sometimes|required|string|max:255',
            'isbn' => 'sometimes|required|string|max:20|unique:bukus,isbn,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $buku->update($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Book updated successfully.',
                'data' => $buku
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while updating the book.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $buku = Buku::find($id);
        if (!$buku) {
            return response()->json([
                'status' => false,
                'message' => 'Book not found.'
            ], 404);
        }

        try {
            $buku->delete();
            return response()->json([
                'status' => true,
                'message' => 'Book deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while deleting the book.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
