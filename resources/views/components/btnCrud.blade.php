


<div class="d-flex text-nowrap justify-content-center" style="gap: .2rem">
    @if (in_array('detail', $actions))
        <a href="{{ ($path ?? url()->current()) . '/' . $id }}" class="btn btn-sm btn{{ ($isOutline ?? false) ? '-outline' : '' }}-info">
            <i class="mr-1 fas fa-eye"></i>
            <span>Detail</span>
        </a>
    @endif

    @if (in_array('edit', $actions))
        <a href="{{ ($path ?? url()->current()) . '/' . $id . '/edit' }}" class="btn btn-sm btn{{ ($isOutline ?? false) ? '-outline' : '' }}-warning">
            <i class="mr-1 fas fa-edit"></i>
            <span>Edit</span>
        </a>
    @endif

    @if (in_array('delete', $actions))
        <form action="{{ ($path ?? url()->current()) . '/' . $id }}" method="POST" onsubmit="return confirm('Anda benar-benar ingin menghapus data ini?')">
            @csrf
            @method('delete')
            <button class="btn btn-sm btn{{ ($isOutline ?? false) ? '-outline' : '' }}-danger">
                <i class="mr-1 fas fa-trash-alt"></i>
                <span>Hapus</span>
            </button>
        </form>
    @endif
</div>