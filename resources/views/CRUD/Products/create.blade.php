@extends('layouts.parent')
@section('title', 'Create Product')
@section('contant')
    <form method="POST" enctype="multipart/form-data" action="{{ route('products.store') }}">
        @csrf
        <div class="row">
            <div iv class="col-md-6">
                <div class="mb-3">
                    <input type="text" name="en_name" class="form-control" placeholder="En Name"
                        value="{{ old('en_name') }}">
                </div>
            </div>
            @error('en_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-6">
                <div class="mb-3">
                    <input type="text" name="ar_name" class="form-control" placeholder="Ar Name"
                        value="{{ old('ar_name') }}">
                </div>
            </div>
            @error('ar_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-6">
                <div class="mb-3">
                    <input type="text" name="price" class="form-control" placeholder="Price"
                        value="{{ old('price') }}">
                </div>
            </div>
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-6">
                <div class="mb-3">
                    <input type="text" name="quantity" class="form-control" placeholder="Quantity"
                        value="{{ old('quantity') }}">
                </div>
            </div>
            @error('quantity')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-6">
                <div class="mb-3">
                    <input type="text" name="code" class="form-control" placeholder="Code"
                        value="{{ old('code') }}">
                </div>
            </div>
            @error('code')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-6">
                <div class="mb-3">
                    <input type="text" name="detiles_en" class="form-control" placeholder="Details En "
                        value="{{ old('detiles_en') }}">
                </div>
            </div>
            @error('detiles_en')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-6">
                <div class="mb-3">
                    <input type="text" name="detiles_ar" class="form-control" placeholder="Details Ar "
                        value="{{ old('detiles_ar') }}">
                </div>
            </div>
            @error('detiles_ar')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>

                    </select>
                </div>
            </div>
            @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-6">
                <div class="mb-3">

                    <label for="brands_id">Brand</label>
                    <select name="brands_id" id="brands_id" class="form-control">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->en_name }}- {{ $brand->ar_name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            @error('brands_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="subcatigories_id">Subcatigories</label>
                    <select name="subcatigories_id" id="subcatigories_id" class="form-control">
                        @foreach ($subcatigories as $subcatigory)
                            <option value="{{ $subcatigory->id }}">{{ $subcatigory->en_name }}
                                -{{ $subcatigory->ar_name }}
                            </option>
                        @endforeach


                    </select>
                </div>
            </div>
            @error('subcatigories_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input class="form-control" type="file" id="formFile" name="image" value="{{ old('image') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

@endsection
