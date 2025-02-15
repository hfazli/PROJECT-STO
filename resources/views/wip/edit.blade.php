@extends('layouts.app')

@section('title', 'Update Work In Process')

@section('content')
    <div class="pagetitle">
        <h1>Update Work In Process</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('wip.index') }}">Work In Process</a></li>
                <li class="breadcrumb-item active">Update Work In Process</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Update Work In Process</h5>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- Custom Styled Validation -->
                <form class="row g-3 needs-validation" novalidate enctype="multipart/form-data" method="POST"
                    action="{{ route('wip.update', $wip->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="col-md-6">
                        <label for="inventory_id" class="form-label">ID Inventory</label>
                        <input type="text" name="inventory_id" class="form-control @error('inventory_id') is-invalid @enderror"
                            id="inventory_id" value="{{ old('inventory_id', $wip->inventory_id) }}">
                        @error('inventory_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="part_name" class="form-label">Part Name</label>
                        <input type="text" name="part_name" class="form-control @error('part_name') is-invalid @enderror"
                            id="part_name" value="{{ old('part_name', $wip->part_name) }}">
                        @error('part_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="part_number" class="form-label">Part Number</label>
                        <input type="text" name="part_number" class="form-control @error('part_number') is-invalid @enderror"
                            id="part_number" value="{{ old('part_number', $wip->part_number) }}">
                        @error('part_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="type_package" class="form-label">Type Package</label>
                        <input type="text" name="type_package" class="form-control @error('type_package') is-invalid @enderror"
                            id="type_package" value="{{ old('type_package', $wip->type_package) }}">
                        @error('type_package')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="qty_package" class="form-label">Qty Package Pcs</label>
                        <input type="number" name="qty_package" class="form-control @error('qty_package') is-invalid @enderror"
                            id="qty_package" value="{{ old('qty_package', $wip->qty_package) }}">
                        @error('qty_package')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="project" class="form-label">Project</label>
                        <input type="text" name="project" class="form-control @error('project') is-invalid @enderror"
                            id="project" value="{{ old('project', $wip->project) }}">
                        @error('project')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="customer" class="form-label">Customer</label>
                        <select name="customer" class="form-control @error('customer') is-invalid @enderror" id="customer" required>
                            <option value="">Select Customer</option>
                            <option value="ADM-KAP" {{ old('customer', $wip->customer) == 'ADM-KAP' ? 'selected' : '' }}>ADM-KAP</option>
                            <option value="ADM-KEP" {{ old('customer', $wip->customer) == 'ADM-KEP' ? 'selected' : '' }}>ADM-KEP</option>
                            <option value="ADM-SAP" {{ old('customer', $wip->customer) == 'ADM-SAP' ? 'selected' : '' }}>ADM-SAP</option>
                            <option value="ADM-SEP" {{ old('customer', $wip->customer) == 'ADM-SEP' ? 'selected' : '' }}>ADM-SEP</option>
                            <option value="ADM-SPD" {{ old('customer', $wip->customer) == 'ADM-SPD' ? 'selected' : '' }}>ADM-SPD</option>
                            <option value="ASMO-DMIA" {{ old('customer', $wip->customer) == 'ASMO-DMIA' ? 'selected' : '' }}>ASMO-DMIA</option>
                            <option value="DENSO" {{ old('customer', $wip->customer) == 'DENSO' ? 'selected' : '' }}>DENSO</option>
                            <option value="GMK" {{ old('customer', $wip->customer) == 'GMK' ? 'selected' : '' }}>GMK</option>
                            <option value="HAC" {{ old('customer', $wip->customer) == 'HAC' ? 'selected' : '' }}>HAC</option>
                            <option value="HINO" {{ old('customer', $wip->customer) == 'HINO' ? 'selected' : '' }}>HINO</option>
                            <option value="HINO-SPD" {{ old('customer', $wip->customer) == 'HINO-SPD' ? 'selected' : '' }}>HINO-SPD</option>
                            <option value="HMMI" {{ old('customer', $wip->customer) == 'HMMI' ? 'selected' : '' }}>HMMI</option>
                            <option value="HPM" {{ old('customer', $wip->customer) == 'HPM' ? 'selected' : '' }}>HPM</option>
                            <option value="HPM-SPD LOKAL" {{ old('customer', $wip->customer) == 'HPM-SPD LOKAL' ? 'selected' : '' }}>HPM-SPD LOKAL</option>
                            <option value="IAMI" {{ old('customer', $wip->customer) == 'IAMI' ? 'selected' : '' }}>IAMI</option>
                            <option value="IPI" {{ old('customer', $wip->customer) == 'IPI' ? 'selected' : '' }}>IPI</option>
                            <option value="IRC" {{ old('customer', $wip->customer) == 'IRC' ? 'selected' : '' }}>IRC</option>
                            <option value="KTB" {{ old('customer', $wip->customer) == 'KTB' ? 'selected' : '' }}>KTB</option>
                            <option value="KTB-SPD" {{ old('customer', $wip->customer) == 'KTB-SPD' ? 'selected' : '' }}>KTB-SPD</option>
                            <option value="MAH SING" {{ old('customer', $wip->customer) == 'MAH SING' ? 'selected' : '' }}>MAH SING</option>
                            <option value="MMKI" {{ old('customer', $wip->customer) == 'MMKI' ? 'selected' : '' }}>MMKI</option>
                            <option value="MMKI-SPD" {{ old('customer', $wip->customer) == 'MMKI-SPD' ? 'selected' : '' }}>MMKI-SPD</option>
                            <option value="NAFUCO" {{ old('customer', $wip->customer) == 'NAFUCO' ? 'selected' : '' }}>NAFUCO</option>
                            <option value="NAGASSE" {{ old('customer', $wip->customer) == 'NAGASSE' ? 'selected' : '' }}>NAGASSE</option>
                            <option value="NISSEN" {{ old('customer', $wip->customer) == 'NISSEN' ? 'selected' : '' }}>NISSEN</option>
                            <option value="PBI" {{ old('customer', $wip->customer) == 'PBI' ? 'selected' : '' }}>PBI</option>
                            <option value="SIM" {{ old('customer', $wip->customer) == 'SIM' ? 'selected' : '' }}>SIM</option>
                            <option value="SIM-SPD" {{ old('customer', $wip->customer) == 'SIM-SPD' ? 'selected' : '' }}>SIM-SPD</option>
                            <option value="SMI" {{ old('customer', $wip->customer) == 'SMI' ? 'selected' : '' }}>SMI</option>
                            <option value="TMMIN" {{ old('customer', $wip->customer) == 'TMMIN' ? 'selected' : '' }}>TMMIN</option>
                            <option value="TMMIN-POQ" {{ old('customer', $wip->customer) == 'TMMIN-POQ' ? 'selected' : '' }}>TMMIN-POQ</option>
                            <option value="TRID" {{ old('customer', $wip->customer) == 'TRID' ? 'selected' : '' }}>TRID</option>
                            <option value="VALEO" {{ old('customer', $wip->customer) == 'VALEO' ? 'selected' : '' }}>VALEO</option>
                            <option value="YMPI" {{ old('customer', $wip->customer) == 'YMPI' ? 'selected' : '' }}>YMPI</option>
                        </select>
                        @error('customer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="detail_lokasi" class="form-label">Detail Lokasi</label>
                        <input type="text" name="detail_lokasi" class="form-control @error('detail_lokasi') is-invalid @enderror"
                            id="detail_lokasi" value="{{ old('detail_lokasi', $wip->detail_lokasi) }}">
                        @error('detail_lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="satuan" class="form-label">Satuan</label>
                        <select name="satuan" class="form-control @error('satuan') is-invalid @enderror" id="satuan" required>
                            <option value="">Select Satuan</option>
                            <option value="pcs" {{ old('satuan', $wip->satuan) == 'pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="kg" {{ old('satuan', $wip->satuan) == 'kg' ? 'selected' : '' }}>Kg</option>
                            <option value="liter" {{ old('satuan', $wip->satuan) == 'liter' ? 'selected' : '' }}>Liter</option>
                        </select>
                        @error('satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="stok_awal" class="form-label">Stok Awal</label>
                        <input type="number" name="stok_awal" class="form-control @error('stok_awal') is-invalid @enderror"
                            id="stok_awal" value="{{ old('stok_awal', $wip->stok_awal) }}">
                        @error('stok_awal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="plant" class="form-label">Plant</label>
                        <input type="text" name="plant" class="form-control @error('plant') is-invalid @enderror"
                            id="plant" value="{{ old('plant', $wip->plant) }}">
                        @error('plant')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Update Work In Process</button>
                    </div>
                </form><!-- End Custom Styled Validation -->
            </div>
        </div>
    </section>
@endsection 