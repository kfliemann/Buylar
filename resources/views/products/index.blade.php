@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">
            <p class="font-bold pb-4">Add a newly bought item!</p>
            
            <form action="{{route('product.store')}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="productname" class="sr-only">Productname</label>
                    <input type="text" name="productname" id="productname" placeholder="Productname" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                    @error('productname') border-red-500 @enderror " value="{{old('productname')}}">

                    @error('productname')
                        <div class="text-red-500 mt-2 text-sm">
                            Insert a productname!
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="brandname" class="sr-only">Brandname (optional)</label>
                    <input type="text" name="brandname" id="brandname" placeholder="Product brandname (optional)" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                    @error('brandname') border-red-500 @enderror" value="{{old('brandname')}}">
                
                    @error('brandname')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="quantity" class="sr-only">Quantity</label>
                    <input type="number" name="quantity" id="quantity" placeholder="State your bought quantity"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('quantity') border-red-500 @enderror" value="1">
                    @error('quantity')
                        <div class="text-red-500 mt-2 text-sm">
                            Input a number!
                        </div>
                    @enderror
                </div>
                
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Add</button>
                </div>
            
            </form>
        </div>
    </div>
@endsection
