@props(['route'])
<form method="GET" action="{{ route($route) }}" class="w-full relative">
    @if(request('categoria'))
    <input type="hidden" name="categoria" value="{{ request('categoria') }}">
    @endif
    <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Pesquisar ..."
        class="w-full bg-[#a066a6] border-2 border-[#4a0051] text-[#4a0051] placeholder:text-[#4a005180] rounded-lg px-3 py-2 pr-10 focus:border-[#000] focus:ring-[#a066a6] focus:outline-none">
    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#4a0051] text-lg hover:text-[#000]">
        <i class="bi bi-search"></i>
    </button>
</form>