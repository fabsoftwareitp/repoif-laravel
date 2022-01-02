@props(["projects" => []])

<div class="project-view">
    <x-project-list :projects="$projects"></x-project-list>
    <x-pagination :paginator="$projects"></x-pagination>
</div>
