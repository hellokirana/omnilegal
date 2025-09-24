@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.website.update', $website->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            {{-- LEFT SIDE: Maps, Address, Contact --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Info Kontak & Lokasi
                    </div>
                    <div class="card-body">
                        {{-- Maps --}}
                        <div class="mb-3">
                            <label>Embed Maps</label>
                            <textarea name="maps" class="form-control" rows="3">{{ old('maps', $website->maps) }}</textarea>
                            @if ($errors->first('maps'))
                                <small class="text-danger">{{ $errors->first('maps') }}</small>
                            @endif
                        </div>

                        {{-- Address Indonesia --}}
                        <div class="mb-3">
                            <label>Alamat (ID)</label>
                            <textarea name="address_id" class="form-control" rows="3">{{ old('address_id', $website->address_id) }}</textarea>
                            @if ($errors->first('address_id'))
                                <small class="text-danger">{{ $errors->first('address_id') }}</small>
                            @endif
                        </div>

                        {{-- Address English --}}
                        <div class="mb-3">
                            <label>Alamat (EN)</label>
                            <textarea name="address_en" class="form-control" rows="3">{{ old('address_en', $website->address_en) }}</textarea>
                            @if ($errors->first('address_en'))
                                <small class="text-danger">{{ $errors->first('address_en') }}</small>
                            @endif
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <x-form.text label="Phone" for="phone" name="phone" value="{{ old('phone', $website->phone) }}" :error="$errors->first('phone')" />
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <x-form.text label="Email" for="email" name="email" value="{{ old('email', $website->email) }}" :error="$errors->first('email')" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE: Social Media --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Media Sosial
                    </div>
                    <div class="card-body">
                        {{-- Social Media --}}
                        <div class="mb-3">
                            <x-form.text label="Facebook" for="facebook" name="facebook" value="{{ old('facebook', $website->facebook) }}" :error="$errors->first('facebook')" />
                            <x-form.text label="Instagram" for="instagram" name="instagram" value="{{ old('instagram', $website->instagram) }}" :error="$errors->first('instagram')" />
                            <x-form.text label="LinkedIn" for="linkedin" name="linkedin" value="{{ old('linkedin', $website->linkedin) }}" :error="$errors->first('linkedin')" />
                            <x-form.text label="X" for="x" name="x" value="{{ old('x', $website->x) }}" :error="$errors->first('x')" />
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
