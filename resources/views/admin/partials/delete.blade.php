<form method="POST" action="{{ $action }}" class="inline" onsubmit="return confirm('{{ $confirm ?? 'Delete this item?' }}')">
    @csrf @method('DELETE')
    <button class="btn btn-danger btn-sm">Delete</button>
</form>
