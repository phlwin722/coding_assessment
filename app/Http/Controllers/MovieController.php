<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;


class MovieController extends Controller
{

    public function index()
    {
        try {
            $movie = Movie::all();

            return response()->json([
                'movie' => $movie
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function create(MovieRequest $movieRequest)
    {
        try {
            $data = $movieRequest->validated();
            $movie = Movie::create($data);

            if ($movie) {
                return response()->json([
                    'movie' => $movie,
                    'message' => 'Created successfully'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update(MovieRequest $movieRequest)
    {
        try {
            $data = $movieRequest->validated();
            $movie = Movie::findOrFail($movieRequest->id);
            $movie->update($data);

            if ($movie) {
                return response()->json([
                    '$movie' => $movie,
                    'message' => 'Update successfully'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $movie = Movie::findOrFail($request->id);
            $movie->delete();

            if ($movie) {
                return response()->json([
                    'message' => 'Deleted successfully'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function findMovie(Request $request)
    {
        try {
            $movie = DB::table('movies')->where('id', $request->id)->get();

            if ($movie) {
                return response()->json([
                    'movie' => $movie,
                    'message' => 'Find successfully'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
