@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.team.update', $team->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            {{-- LEFT SIDE --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Edit Team
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Image --}}
                            <div class="col-12 mb-3">
                                <x-form.file label="Image" for="image" name="image" 
                                    data-default-file="{{ $team->image ? asset('storage/team/'.$team->image) : '' }}"
                                    :error="$errors->first('image')" />
                            </div>

                            {{-- Name --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Nama" for="name" name="name"
                                    value="{{ old('name', $team->name) }}" :error="$errors->first('name')" />
                            </div>

                            {{-- Position Indonesia --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Jabatan (ID)" for="position_id" name="position_id"
                                    value="{{ old('position_id', $team->position_id) }}" :error="$errors->first('position_id')" />
                            </div>

                            {{-- Position English --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Jabatan (EN)" for="position_en" name="position_en"
                                    value="{{ old('position_en', $team->position_en) }}" :error="$errors->first('position_en')" />
                            </div>

                            {{-- Description Indonesia --}}
                            <div class="col-12 mb-3">
                                <label>Deskripsi (ID)</label>
                                <textarea name="description_id" class="form-control" rows="4">{{ old('description_id', $team->description_id) }}</textarea>
                                @if ($errors->first('description_id'))
                                    <small class="text-danger">{{ $errors->first('description_id') }}</small>
                                @endif
                            </div>

                            {{-- Description English --}}
                            <div class="col-12 mb-3">
                                <label>Deskripsi (EN)</label>
                                <textarea name="description_en" class="form-control" rows="4">{{ old('description_en', $team->description_en) }}</textarea>
                                @if ($errors->first('description_en'))
                                    <small class="text-danger">{{ $errors->first('description_en') }}</small>
                                @endif
                            </div>

                            {{-- Email --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Email" for="email" name="email"
                                    value="{{ old('email', $team->email) }}" :error="$errors->first('email')" />
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
                            {{ Form::select('status', ['0' => 'Inactive', '1' => 'Active'], old('status', $team->status), ['class' => 'form-select']) }}
                            @if ($errors->first('status'))
                                <small class="text-danger">{{ $errors->first('status') }}</small>
                            @endif
                        </div>

                        {{-- Created At --}}
                        <div class="form-group mb-3">
                            <label>Tanggal Publish</label>
                            <input type="datetime-local" name="created_at" class="form-control"
                                value="{{ old('created_at', $team->created_at ? $team->created_at->format('Y-m-d\TH:i') : '') }}">
                            @if ($errors->first('created_at'))
                                <small class="text-danger">{{ $errors->first('created_at') }}</small>
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
