@props(["paginator" => []])

@if ($paginator->hasPages())
    <div class="pagination">
        <div class="pagination__container">
            <p class="pagination__info">{{ NumberFormatHelper::formatInteger($paginator->currentPage()) . " de " . NumberFormatHelper::formatInteger($paginator->lastPage()) }}</p>
            <div class="pagination__buttons">
                <a
                    class="pagination__button"
                    @if (! $paginator->onFirstPage())
                        href="{{ $paginator->url(1) }}"
                    @endif
                >
                    @php echo file_get_contents(public_path('img/icons/double-pagination-arrow-icon.svg')) @endphp
                </a>
                <a
                    class="pagination__button"
                    @if ($paginator->previousPageUrl())
                        href="{{ $paginator->previousPageUrl() }}"
                    @endif
                >
                    @php echo file_get_contents(public_path('img/icons/single-pagination-arrow-icon.svg')) @endphp
                </a>
                <a
                    class="pagination__button pagination__button--reverse"
                    @if ($paginator->nextPageUrl())
                        href="{{ $paginator->nextPageUrl() }}"
                    @endif
                >
                    @php echo file_get_contents(public_path('img/icons/single-pagination-arrow-icon.svg')) @endphp
                </a>
                <a
                    class="pagination__button pagination__button--reverse"
                    @if ($paginator->currentPage() !== $paginator->lastPage())
                        href="{{ $paginator->url($paginator->lastPage()) }}"
                    @endif
                >
                    @php echo file_get_contents(public_path('img/icons/double-pagination-arrow-icon.svg')) @endphp
                </a>
            </div>
        </div>
    </div>
@endif
