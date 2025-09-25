@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.stat.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            {{-- LEFT SIDE --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Tambah Stat
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Image --}}
                            <div class="col-12 mb-3">
                                <x-form.file label="Image" for="image" name="image" 
                                    value="{{ old('image') }}" :error="$errors->first('image')" />
                            </div>

                            {{-- Label Indonesia --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Label (ID)" for="label_id" name="label_id"
                                    value="{{ old('label_id') }}" :error="$errors->first('label_id')" />
                            </div>

                            {{-- Label English --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Label (EN)" for="label_en" name="label_en"
                                    value="{{ old('label_en') }}" :error="$errors->first('label_en')" />
                            </div>

                            {{-- Value --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Value" for="value" name="value"
                                    value="{{ old('value') }}" :error="$errors->first('value')" />
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
