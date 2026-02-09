@props(['id' => 'modal', 'title' => '', 'maxWidth' => '2xl'])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 bg-transparent">
            <div class="relative w-full sm:max-w-{{$maxWidth}} mx-auto">
                <div class="h-[calc(100%+0.5rem)] w-[calc(100%+0.5rem)] absolute bottom-0 right-0 rounded-lg bg-[#a066a6]"></div>
                <div class="h-[calc(100%+0.5rem)] w-[calc(100%+0.5rem)] absolute top-0 left-0 rounded-lg bg-[#7066a6]"></div>
                <div class="relative px-6 py-4 bg-white overflow-hidden rounded-tl-lg rounded-br-lg">
                    @if($title)
                    <div class="modal-header border-none">
                        <h5 class="modal-title text-xl font-bold text-[#4a0051]" id="{{ $id }}Label">{{ $title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="modal-body">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
