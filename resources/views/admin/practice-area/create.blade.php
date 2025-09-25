@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.practice-area.store') }}">
        @csrf
        <div class="row">
            {{-- LEFT SIDE --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Tambah Practice Area
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Image Picker --}}
                            <div class="col-12 mb-3">
                                <label for="image">Pilih Icon Practice Area</label>
                                <select name="image" id="image" class="form-select" onchange="previewImage()">
                                    <option value="">Pilih Icon</option>
                                    @for ($i = 1; $i <= 48; $i++)
                                        <option value="{{ $i }}.png"
                                            {{ old('image') == $i.'.png' ? 'selected' : '' }}>
                                            Icon {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @if ($errors->first('image'))
                                    <small class="text-danger">{{ $errors->first('image') }}</small>
                                @endif

                                {{-- Preview --}}
                                <div class="mt-3 text-center">
                                    <img id="preview-img" 
                                        src="{{ old('image') ? asset('assets/images/service/'.old('image')) : '' }}" 
                                        alt="Preview" 
                                        style="max-height:100px; display: {{ old('image') ? 'block' : 'none' }}; margin:auto;">
                                </div>
                            </div>

                            {{-- Title Indonesia --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Nama Practice Area (ID)" for="title_id" name="title_id"
                                    value="{{ old('title_id') }}" :error="$errors->first('title_id')" />
                            </div>

                            {{-- Title English --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Nama Practice Area (EN)" for="title_en" name="title_en"
                                    value="{{ old('title_en') }}" :error="$errors->first('title_en')" />
                            </div>

                            {{-- Description Indonesia --}}
                            <div class="col-12 mb-3">
                                <label>Deskripsi (ID)</label>
                                <textarea name="description_id" class="form-control" rows="4">{{ old('description_id') }}</textarea>
                                @if ($errors->first('description_id'))
                                    <small class="text-danger">{{ $errors->first('description_id') }}</small>
                                @endif
                            </div>

                            {{-- Description English --}}
                            <div class="col-12 mb-3">
                                <label>Deskripsi (EN)</label>
                                <textarea name="description_en" class="form-control" rows="4">{{ old('description_en') }}</textarea>
                                @if ($errors->first('description_en'))
                                    <small class="text-danger">{{ $errors->first('description_en') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Info Data
                    </div>
                    <div class="card-body">
                        {{-- Status --}}
                        <div class="form-group mb-3">
                            <label>Status</label>
                            {{ Form::select('status', ['0' => 'Inactive', '1' => 'Active'], old('status'), ['class' => 'form-select']) }}
                            @if ($errors->first('status'))
                                <small class="text-danger">{{ $errors->first('status') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewImage() {
        const select = document.getElementById('image');
        const preview = document.getElementById('preview-img');
        if (select.value) {
            preview.src = '/assets/images/service/' + select.value;
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    }
</script>
@endpush
