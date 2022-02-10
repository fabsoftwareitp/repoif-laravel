<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ProjectCommentController extends Controller
{
    /**
     * Create a comment in the project.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request, Project $project)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
            'related_user' => ['nullable', 'exists:users,id']
        ]);

        $projectComment = ProjectComment::create([
            'content' => $request->comment,
            'project_id' => $project->id,
            'user_id' => Auth::id(),
            'replied_to_user_id' => $request->related_user
        ]);

        return redirect(URL::route('project.show', ['project' => $project->id]))
            ->withFragment('comentario-' . $projectComment->id);
    }

    /**
     * Update a comment of the project.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Project $project
     * @param  \App\Models\ProjectComment $projectComment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Project $project, ProjectComment $projectComment)
    {
        abort_if($projectComment->user_id !== Auth::id(), 403);

        $request->validate([
            'comment' => ['required', 'string', 'max:1000']
        ]);

        $projectComment->content = $request->comment;
        $projectComment->save();

        return back()->withFragment('comentario-' . $projectComment->id);
    }

    /**
     * Destroy a comment of the project.
     *
     * @param  \App\Models\Project $project
     * @param  \App\Models\ProjectComment $projectComment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project, ProjectComment $projectComment)
    {
        abort_if($projectComment->user_id !== Auth::id(), 403);

        $projectComment->delete();

        return back()->withFragment('comentarios');
    }

    /**
     * Like or deslike a comment of the project.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Project $project
     * @param  \App\Models\ProjectComment $projectComment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function like(Request $request, Project $project, ProjectComment $projectComment)
    {
        $result = $projectComment->likes()->toggle(Auth::id());

        if (
            count($result['attached']) > 0 &&
            $projectComment->user_id !== Auth::id()
        ) {
            $likedProjectsComments = $request->session()->get('liked_projects_comments', []);

            if (! in_array($projectComment->id, $likedProjectsComments)) {
                $request->session()->push('liked_projects_comments', $projectComment->id);
            }
        }

        return back()->withFragment('comentario-' . $projectComment->id);
    }
}
