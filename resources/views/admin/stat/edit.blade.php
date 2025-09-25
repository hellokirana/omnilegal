@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.stat.update', $stat->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            {{-- LEFT SIDE --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Edit Stat
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Image --}}
                            <div class="col-12 mb-3">
                                <x-form.file label="Image" for="image" name="image" 
                                    data-default-file="{{ $stat->image ? asset('storage/stat/'.$stat->image) : '' }}"
                                    :error="$errors->first('image')" />
                            </div>

                            {{-- Label Indonesia --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Label (ID)" for="label_id" name="label_id"
                                    value="{{ old('label_id', $stat->label_id) }}" :error="$errors->first('label_id')" />
                            </div>

                            {{-- Label English --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Label (EN)" for="label_en" name="label_en"
                                    value="{{ old('label_en', $stat->label_en) }}" :error="$errors->first('label_en')" />
                            </div>

                            {{-- Value --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Value" for="value" name="value"
                                    value="{{ old('value', $stat->value) }}" :error="$errors->first('value')" />
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
                            {{ Form::select('status', ['0' => 'Inactive', '1' => 'Active'], old('status', $stat->status), ['class' => 'form-select']) }}
                            @if ($errors->first('status'))
                                <small class="text-danger">{{ $errors->first('status') }}</small>
                            @endif
                        </div>

                        {{-- Created At --}}
                        <div class="form-group mb-3">
                            <label>Tanggal Publish</label>
                            <input type="datetime-local" name="created_at" class="form-control"
                                value="{{ old('created_at', $stat->created_at ? $stat->created_at->format('Y-m-d\TH:i') : '') }}">
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
