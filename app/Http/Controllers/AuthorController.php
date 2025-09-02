<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateAuthorsReport;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; // Necesario para el caché

class AuthorController extends Controller
{
    /**
     * Muestra una lista de autores con sus libros.
     */
    public function index()
    {
        // ================================================================
        // VERSIÓN 1: INEFICIENTE (PROBLEMA N+1)
        // ================================================================

        /* $authors = Author::all(); // <-- La consulta "+1"
        foreach ($authors as $author) {
            $author->books; // <-- Las "N" consultas dentro del bucle
        }
 */
        $authors = Author::select('id', 'name')
            ->with(['books:id,title,author_id']) // selecciona los campos de Book
            ->get();

        // ================================================================
        // VERSIÓN 2: OPTIMIZADA CON EAGER LOADING
        // ================================================================

        /*  $authors = Author::with('books')->get(); */ // <-- ¡La solución! 2 consultas.

        // ================================================================
        // VERSIÓN 3: OPTIMIZACIÓN FINAL CON CACHÉ
        // ================================================================

        /* $authors = Cache::remember('authors.all', 600, function () {
            // Este código solo se ejecuta si los datos no están en el caché.
            // Genera solo 2 consultas la primera vez.
            return Author::with('books')->get();
        }); */

        return view('authors', [
            'authors' => $authors
        ]);
    }

    public function generateReport()
    {
        // Despachamos el job a la cola
        GenerateAuthorsReport::dispatch();

        // Devolvemos una respuesta INMEDIATA al usuario
        return response()->json([
            'message' => 'Tu reporte se está generando en segundo plano. Recibirás una notificación cuando esté listo.'
        ]);
    }
}
