<x-app-layout>
    <div class="p-12 flex justify-center">
        <div class="bg-[#4a0051c3] p-8 rounded-lg border-[3px] border-[#a066a6] max-w-6xl w-full">
            <div class="flex flex-col gap-2">
                <div class="flex flex-col sm:flex-row items-center gap-8">
                    <img src="{{ Storage::url($produto->foto_produto) }}" alt="{{ $produto->nome }}" class="object-cover sm:w-2/5 h-auto">
                    <div class="flex flex-col gap-3 sm:w-3/5">
                        <p class="text-lg text-[#f8e9f9] bg-[#a066a6] px-3 rounded-full w-min text-nowrap">{{ $produto->categoria->nome }}</p>
                        <h1 class="text-4xl font-bold text-[#f8e9f9] capitalize">{{ $produto->nome }}</h1>
                        <p class="text-4xl text-[#d7addb] font-bold">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                        @if (!isAdmin())
                        <div class="flex mt-2 justify-start items-center gap-4 text-2xl text-[#f8e9f9]">
                            <p>Quantidade </p>
                            <div class="flex justify-start items-center gap-1 border-2 border-[#a066a6] rounded-lg px-2">
                                <button class="qtd-menos hover:text-[#a066a6] duration-200">
                                    -
                                </button>
                                <input type="text" value="1" class="qtd bg-transparent w-4 text-center border-none p-0">
                                <button class="qtd-mais hover:text-[#a066a6] duration-200">
                                    +
                                </button>
                            </div>
                        </div>
                        <form action="{{ route('checkout') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="id_produto" value="{{ $produto->id }}">
                            <input type="hidden" name="quantidade" value="1" class="qtd-final">
                            @if (Auth::check())
                            <button type="submit" class="w-full items-center px-4 py-2 bg-[#E2C4E5] rounded-md font-bold text-xl text-[#4a0051] tracking-widest focus:bg-[#4a0051] focus:text-[#f8e9f9] focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 duration-200 hover:transform hover:scale-105">
                                <i class="bi bi-bag-check text-2xl"></i>
                                COMPRAR AGORA
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="w-full block text-center items-center px-4 py-2 bg-[#E2C4E5] rounded-md font-bold text-xl text-[#4a0051] tracking-widest hover:bg-[#d7addb] focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 duration-200 hover:transform hover:scale-105">
                                <i class="bi bi-bag-check text-2xl"></i>
                                COMPRAR AGORA
                            </a>
                            @endif
                        </form>
                        @else
                            <p class="w-1/2 text-lg text-[#f8e9f9]">Estoque: {{ $produto->quantidade }}</p>
                            <p class="w-1/2 text-lg text-[#f8e9f9]">Vendedor: {{ $produto->vendedor->name }}</p>
                            <p class="w-1/2 text-lg text-[#f8e9f9]">Contato: {{ $produto->vendedor->telefone }}</p>
                        @endif
                    </div>
                </div>
                <h2 class="mt-3 text-2xl font-bold text-[#f8e9f9]">Descrição do Produto:</h2>
                <p class="text-lg text-[#f8e9f9]">{{ $produto->descricao }}</p>
                @if (!isAdmin())
                <h2 class="mt-3 text-2xl font-bold text-[#f8e9f9]">Informações do Vendedor:</h2>
                <div class="flex flex-col sm:flex-row w-full gap-4">
                    <p class="w-1/2 text-lg text-[#f8e9f9]">Nome: {{ $produto->vendedor->name }}</p>
                    <p class="w-1/2 text-lg text-[#f8e9f9]">Contato: {{ $produto->vendedor->telefone }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const qtdMenos = document.querySelector('.qtd-menos');
    const qtdMais = document.querySelector('.qtd-mais');
    const inputQtd = document.querySelector('.qtd');
    const inputFinal = document.querySelectorAll('.qtd-final');

    function atualizarInputs(valor) {
        inputQtd.value = valor;
        inputFinal.forEach(input => {
            input.value = valor;
        });
    }

    qtdMenos.addEventListener('click', () => {
        let qtdAtual = parseInt(inputQtd.value);
        if (qtdAtual > 1) {
            atualizarInputs(qtdAtual - 1);
        }
    });

    qtdMais.addEventListener('click', () => {
        let qtdAtual = parseInt(inputQtd.value);
        atualizarInputs(qtdAtual + 1);
    });
</script>