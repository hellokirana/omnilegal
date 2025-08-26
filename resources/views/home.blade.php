@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container mt-4">
    @php $user = Auth::user(); @endphp

    @hasanyrole('superadmin')
        <h1 class="mb-4">Dashboard Admin</h1>

        <div class="row">
            <!-- Total Data Packaging -->
            <div class="col-md-3">
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Data Packaging</h5>
                        <p class="card-text display-6">{{ $totalMembers ?? '0' }}</p>
                        <small class="text-muted">Perusahaan</small>
                    </div>
                </div>
            </div>
        
            <!-- Perusahaan Terdaftar -->
            <div class="col-md-3">
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Perusahaan Terdaftar</h5>
                        <p class="card-text display-6">{{ $memberCount ?? '0' }}</p>
                        <small class="text-muted">Perusahaan</small>
                    </div>
                </div>
            </div>

            <!-- Category Distribution -->
            <div class="col-md-3">
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Kategori Perusahaan</h5>
                        <div class="form-group">
                            <select id="categoryDropdown" class="form-control" onchange="filterCategory()">
                                <option value="all">Semua Kategori</option>
                                <option value="Kecil">Kecil</option>
                                <option value="Menengah">Menengah</option>
                                <option value="Besar">Besar</option>
                            </select>
                        </div>
                        <p class="card-text display-6" id="categoryCount">{{ $totalMembers ?? '0' }}</p>
                        <small class="text-muted">Perusahaan</small>
                    </div>
                </div>
            </div>

            <!-- Basic Member -->
            <div class="col-md-3">
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Basic Member</h5>
                        <p class="card-text display-6">{{ $partnerCount ?? '0' }}</p>
                        <small class="text-muted">Perusahaan</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded-2xl shadow">
                <h2 class="text-lg font-semibold mb-3">Kategori Perusahaan</h2>
                <div>{!! $categoryChart->container() !!}</div>
            </div>
            
            <div class="bg-white p-4 rounded-2xl shadow">
                <h2 class="text-lg font-semibold mb-3">Proses Cetak</h2>
                <div>{!! $printingChart->container() !!}</div>
            </div>
            
            <div class="bg-white p-4 rounded-2xl shadow">
                <h2 class="text-lg font-semibold mb-3">Badan Usaha</h2>
                <div>{!! $businessEntityChart->container() !!}</div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl shadow mb-6">
            <h2 class="text-lg font-semibold mb-3">Anggota Bergabung Tiap Tahunnya</h2>
            <div>{!! $joinPerYearChart->container() !!}</div>
        </div>

        @stack('scripts')

        @push('scripts')
            {!! $categoryChart->script() !!}
            {!! $printingChart->script() !!}
            {!! $businessEntityChart->script() !!}
            {!! $joinPerYearChart->script() !!}
            <script>
                function filterMemberType() {
                    const dropdown = document.getElementById('memberTypeDropdown');
                    const selected = dropdown.value;
                    const countDisplay = document.getElementById('memberTypeCount');

                    fetch(`/admin/member-type-count?type=${selected}`)
                        .then(res => res.json())
                        .then(data => {
                            countDisplay.textContent = data.count;
                        })
                        .catch(err => {
                            console.error('Error fetching member type count:', err);
                            countDisplay.textContent = '0';
                        });
                }
                
                function filterCategory() {
                    const dropdown = document.getElementById('categoryDropdown');
                    const selected = dropdown.value;
                    const countDisplay = document.getElementById('categoryCount');

                    fetch(`/admin/category-count?category=${selected}`)
                        .then(res => res.json())
                        .then(data => {
                            countDisplay.textContent = data.count;
                        })
                        .catch(err => {
                            console.error('Error fetching category count:', err);
                            countDisplay.textContent = '0';
                        });
                }                
            </script>
        @endpush
    @else
        <h1 class="mb-4">Dashboard Member</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Selamat datang, {{ $user->company_name }}</h5>
                <p class="card-text">Status: 
                    <span class="badge bg-{{ $user->status === 'approved' ? 'success' : ($user->status === 'pending' ? 'warning' : 'danger') }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </p>
                <p class="card-text">Tipe Member: {{ ucfirst($user->member_type) }}</p>
                <p class="card-text">Kategori: {{ ucfirst($user->category) }}</p>
                <p class="card-text">Email: {{ $user->company_email }}</p>
            </div>
        </div>
    @endhasanyrole
</div>
@endsection