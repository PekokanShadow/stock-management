@props(['item']) <!-- The $item contains the row data -->

<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        Actions
    </button>
    <ul class="dropdown-menu" aria-labelledby="actionsDropdown">
        <!-- Edit Link -->
        <li>
            @if(Auth::user()->can('edit stock'))
            <a class="dropdown-item" href="{{ route('inventory.edit', str_replace('/', '-', $item->stocknumber)) }}">
                Edit
            </a>
            @endif
        </li>
        <!-- Delete Button -->
        <li>
            @if(Auth::user()->can('delete stock'))
            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->stocknumber }}">
                Delete
            </button>
            @endif
        </li>
        <!-- Details Link -->
        <li>
            @if(Auth::user()->can('view details stock'))
            <a class="dropdown-item" href="{{ route('inventory.details', str_replace('/', '-', $item->stocknumber)) }}">
                Details
            </a>
            @endif
        </li>
        <!-- Print QR Code Link -->
        <li>
            @if(Auth::user()->can('print qrcode'))
            <a class="dropdown-item" href="{{ route('generate.barcode', urlencode($item->stocknumber)) }}" target="_blank">
                Print QR Code
            </a>
            @endif
        </li>
    </ul>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal{{ $item->stocknumber }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->stocknumber }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="/inventory/rekap/{{ str_replace('/', '-', $item->stocknumber) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
