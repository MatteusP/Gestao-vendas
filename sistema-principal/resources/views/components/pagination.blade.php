<div class="flex justify-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="flex space-x-2">
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-200 rounded-lg">Anterior</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Anterior</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="px-4 py-2 text-sm font-medium text-gray-400">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 rounded-lg">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Próximo</a>
                </li>
            @else
                <li>
                    <span class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-200 rounded-lg">Próximo</span>
                </li>
            @endif
        </ul>
    </nav>
</div>
