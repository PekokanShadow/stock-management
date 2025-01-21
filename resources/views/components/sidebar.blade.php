<!-- resources/views/components/sidebar.blade.php -->
<div class="col-md-3">
    <div class="sidebar bg-light p-3 rounded">
        <div class="list-group">
            <!-- Profile Button -->
            <button class="list-group-item list-group-item-action bg-success text-white" id="profile-button">Setting</button>
            <div id="profile-options" class="collapse">
                @if(Auth::user()->can('view role'))
                <a href="{{ route('role.index') }}" class="list-group-item list-group-item-action">Role</a>
                @endif
                @if(Auth::user()->can('view user'))
                <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action">User</a>
                @endif
            </div>

            <!-- Stock Button -->
            <button class="list-group-item list-group-item-action bg-success text-white" id="stock-button">Stock</button>
            <div id="stock-options" class="collapse">
                @if(Auth::user()->can('create stock' ))
                <a href="{{ route('inventory.create') }}" class="list-group-item list-group-item-action">Create</a>
                @endif
                @if(Auth::user()->can('view stock'))
                <a href="{{ route('inventory.monitor') }}" class="list-group-item list-group-item-action">Monitor</a>
                <a href="{{ route('inventory.komputer') }}" class="list-group-item list-group-item-action">Komputer</a>
                <a href="{{ route('inventory.notebook') }}" class="list-group-item list-group-item-action">Notebook</a>
                <a href="{{ route('inventory.ups') }}" class="list-group-item list-group-item-action">UPS</a>
                <a href="{{ route('inventory.printer') }}" class="list-group-item list-group-item-action">Printer</a>
                <a href="{{ route('inventory.hub') }}" class="list-group-item list-group-item-action">HUB</a>
                <a href="{{ route('inventory.other') }}" class="list-group-item list-group-item-action">Other</a>
                @endif
            </div>
            <!-- Rekap Button -->
            @if(Auth::user()->can('view stock'))
            <a href="{{ route('inventory.rekap') }}" class="list-group-item list-group-item-action bg-success text-white">Rekap</a>
            @endif
        </div>
    </div>
</div>

<!-- Add JavaScript to handle button clicks and store state -->
<script>
    // Function to toggle visibility and store state
    function toggleOptions(buttonId, optionsId) {
        const options = document.getElementById(optionsId);
        options.classList.toggle('collapse');
        const isOpen = !options.classList.contains('collapse');
        localStorage.setItem(buttonId, isOpen); // Store state in local storage
    }

    document.getElementById('profile-button').addEventListener('click', function() {
        toggleOptions('profile-button', 'profile-options');
    });

    document.getElementById('stock-button').addEventListener('click', function() {
        toggleOptions('stock-button', 'stock-options');
    });

    // Restore state on page load
    window.onload = function() {
        if (localStorage.getItem('profile-button') === 'true') {
            document.getElementById('profile-options').classList.remove('collapse');
        }
        if (localStorage.getItem('stock-button') === 'true') {
            document.getElementById('stock-options').classList.remove('collapse');
        }
    };
</script>

<style>
    .collapse {
        display: none;
    }

    .collapse.show {
        display: block;
    }
</style>