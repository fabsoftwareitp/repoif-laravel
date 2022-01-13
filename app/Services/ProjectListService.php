<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class ProjectListService
{
    public static function getProjects(Request $request, ?int $authorId = null)
    {
        $request->validate([
            'tipo_projeto' => ['nullable', 'in:todos,documentos,imagens,videos,projetos-web'],
            'classificacao' => ['nullable', 'in:nenhuma,mais-visualizados,mais-avaliados'],
            'ordenacao' => ['nullable', 'in:mais-recentes,mais-antigos'],
            'data_inicial' => ['nullable', 'required_with:data_final', 'date_format:d/m/Y'],
            'data_final' => ['nullable', 'required_with:data_inicial', 'date_format:d/m/Y', 'after:data_inicial']
        ]);

        $projects = $authorId
            ? Project::where('user_id', $authorId)
            : Project::with([
                'user' => function ($query) {
                    $query->withCount('projects');
                }
            ]);

        $projects = match ($request->tipo_projeto) {
            'documentos' => $projects->where('type', 1),
            'imagens' => $projects->where('type', 2),
            'videos' => $projects->where('type', 3),
            'projetos-web' => $projects->where('type', 4),
            default => $projects
        };

        $projects = match ($request->classificacao) {
            'mais-visualizados' => $projects->orderBy('views', 'desc'),
            'mais-avaliados' => $projects->orderBy('likes_count', 'desc')
                ->orderBy('comments_count', 'desc'),
            default => $projects
        };

        $projects = match ($request->ordenacao) {
            'mais-antigos' => $projects->oldest(),
            default => $projects->latest()
        };

        if ($request->data_inicial && $request->data_final) {
            $initialDate = Carbon::createFromFormat('d/m/Y', $request->data_inicial)->toDateString();
            $finalDate = Carbon::createFromFormat('d/m/Y', $request->data_final)->toDateString();

            $projects = $projects->whereBetween('created_at', [$initialDate, $finalDate]);
        }

        $projects = $projects->withCount(['likes', 'comments'])
            ->paginate(perPage: 20, pageName: 'pagina')
            ->withQueryString();

        return $projects;
    }
}
