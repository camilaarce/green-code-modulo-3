<?php

namespace App\Jobs;

use App\Models\Author; // Importar el modelo
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; // Importar Log

class GenerateAuthorsReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        // No necesitamos pasar datos por ahora
    }

    public function handle(): void
    {
        // 1. Mensaje de inicio en el log
        Log::info('Iniciando la generación del reporte de autores...');

        // 2. Obtenemos los datos de forma eficiente (¡buenas prácticas también aquí!)
        $authors = Author::with('books')->get();

        // 3. Simulamos un proceso de creación de CSV que tarda 20 segundos
        sleep(20);

        // 4. (Opcional) Aquí iría la lógica para guardar el archivo CSV.
        // Por ahora, solo lo simulamos escribiendo en el log.
        $reportContent = "Reporte generado con {$authors->count()} autores.";
        Log::info($reportContent);
        // file_put_contents(storage_path('app/reports/authors.csv'), $reportContent);

        // 5. Mensaje de finalización
        Log::info('¡Reporte de autores generado exitosamente!');
    }
}
