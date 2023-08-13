@extends('layouts.parent')
@section('title', 'Edit Product')
@section('contant')
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="en_name">En name</label>
                        <input type="text" name="en_name" class="form-control" placeholder="En Name"
                            value=" {{ old('en_name') ?? $product->en_name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="ar_name">Ar Name</label>
                        <input type="text" name="ar_name" class="form-control" placeholder="Ar Name"
                            value="{{ old('ar_name') ?? $product->ar_name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control" placeholder="Price"
                            value="{{ old('price') ?? $product->price }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="text" name="quantity" class="form-control" placeholder="Quantity"
                            value="{{ old('quantity') ?? $product->quantity }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="code">Code</label>
                        <input type="text" name="code" class="form-control" placeholder="Code"
                            value="{{ old('code') ?? $product->code }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="ststus" id="status" class="form-control">
                            <option @selected($product->status == 1) value="1">Active</option>
                            <option @selected($product->status == 0) value="0">Not Active</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="detiles_en">Detiles En</label>
                        <input type="text" name="detiles_en" class="form-control" placeholder="Details En "
                            value="{{ old('detiles_en') ?? $product->detiles_en }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="detiles_ar">Detiles Ar</label>
                        <input type="text" name="detiles_ar" class="form-control" placeholder="Details Ar "
                            value="{{ old('detiles_ar') ?? $product->detiles_ar }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">

                        <label for="brand_id">Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            @foreach ($brands as $brand)
                                <option @selected($product->brands_id == $brand->id) value="{{ $brand->id }}">{{ $brand->en_name }}-
                                    {{ $brand->ar_name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="subcatigories_id">Subcatigories</label>
                        <select name="subcatigories_id" id="subcatigories_id" class="form-control">
                            @foreach ($subcatigories as $subcatigory)
                                <option @selected($product->subcatigories_id == $subcatigory->id) value="{{ $subcatigory->id }}">
                                    {{ $subcatigory->en_name }}
                                    -{{ $subcatigory->ar_name }}
                                </option>
                            @endforeach


                        </select>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mb-3">
            <img src="{{ asset('images/product/' . $product->image) }}" style="width: 20%" alt="">
            <input class="form-control" type="file" id="formFile" name="image"
                value="{{ old('image') ?? $product->image }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
