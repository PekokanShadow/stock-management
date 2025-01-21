@props(['route']) <!-- Accept a dynamic route -->

<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ $route }}">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date (Tanggal Masuk)</label>
                        <input 
                            type="date" 
                            id="start_date" 
                            name="start_date" 
                            class="form-control" 
                            value="{{ request('start_date') }}"
                        >
                    </div>
                    
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date (Tanggal Masuk)</label>
                        <input 
                            type="date" 
                            id="end_date" 
                            name="end_date" 
                            class="form-control" 
                            value="{{ request('end_date') }}"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="cabangid" class="form-label">Nomor Cabang</label>
                        <input 
                            type="number" 
                            id="cabangid" 
                            name="cabangid" 
                            class="form-control" 
                            value="{{ request('cabangid') }}"
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="departemenid">Departemen</label>
                        <select name="departemenid" id="departemenid" class="form-control">
                            <option disabled selected value="">Pilih Departemen</option>
                            <option value="SLS" {{ request('departemenid') === 'SLS' ? 'selected' : '' }}>SLS (Sales)</option>
                            <option value="SRV" {{ request('departemenid') === 'SRV' ? 'selected' : '' }}>SRV (Service)</option>
                            <option value="SPR" {{ request('departemenid') === 'SPR' ? 'selected' : '' }}>SPR (Spare Part)</option>
                            <option value="KWL" {{ request('departemenid') === 'KWL' ? 'selected' : '' }}>KWL (Kanwil)</option>
                            <option value="OTR" {{ request('departemenid') === 'OTR' ? 'selected' : '' }}>OTR (Other)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="jenisid">Jenis</label>
                        <select name="jenisid" id="jenisid" class="form-control">
                            <option disabled selected value="">Pilih Jenis</option>
                            <option value="MNT" {{ request('jenisid') === 'MNT' ? 'selected' : '' }}>MNT (Monitor)</option>
                            <option value="CPU" {{ request('jenisid') === 'CPU' ? 'selected' : '' }}>CPU (Central Processing Unit)</option>
                            <option value="NBK" {{ request('jenisid') === 'NBK' ? 'selected' : '' }}>NBK (Notebook)</option>
                            <option value="UPS" {{ request('jenisid') === 'UPS' ? 'selected' : '' }}>UPS (Uninterruptible Power Supply)</option>
                            <option value="PRN" {{ request('jenisid') === 'PRN' ? 'selected' : '' }}>PRN (Printer)</option>
                            <option value="SWP" {{ request('jenisid') === 'SWP' ? 'selected' : '' }}>SWP (Switch - Power)</option>
                            <option value="SWH" {{ request('jenisid') === 'SWH' ? 'selected' : '' }}>SWH (Switch - Hub)</option>
                            <option value="HDE" {{ request('jenisid') === 'HDE' ? 'selected' : '' }}>HDE (Hard Disk External)</option>
                            <option value="MDM" {{ request('jenisid') === 'MDM' ? 'selected' : '' }}>MDM (Modem)</option>
                            <option value="OTR" {{ request('jenisid') === 'OTR' ? 'selected' : '' }}>OTR (Other)</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
