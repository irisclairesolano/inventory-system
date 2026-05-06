@props(['route', 'label' => 'Delete', 'confirmMessage' => 'Are you sure?'])

<form method="POST" action="{{ $route }}" class="inline">
    @csrf
    @method('DELETE')
    <button
        type="button"
        onclick="if(confirm('{{ $confirmMessage }}')) this.closest('form').submit();"
        {{ $attributes->merge(['class' => 'btn-sm btn-danger text-xs']) }}
    >
        {{ $label }}
    </button>
</form>
