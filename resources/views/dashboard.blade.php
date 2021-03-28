@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg ">
            <p style="margin: 0 auto; text-align: center; font-size:30px" class=""style="margin: 0 auto; text-align: center; font-size:30px" class="pb-5" >Dashboard</p> 
            <p style="margin: 0 auto; text-align: center; font-size:20px" class="pb-5">The Dashboard shows you the recommendations we have for you to buy.</p>
            @if(count($products)>0)
                @foreach($products as $product)
                    <div class="w-8/12 bg-red p-6 rounded-lg flex justify-center" style="margin: 0 auto;">
                            <div class="w-8/12 pl-3 pt-3 pr-3 rounded-lg">
                                <p style="font-size: 20px"class="flex">{{$product->productname}}</p>
                                <p style="font-size: 20px"class="flex">{{$product->brandname}}</p>
                            </div>
                            <div class="w-8/12 pl-3 rounded-lg" style="width: 700px;">
                                <p class="flex"style="display: inline-block; font-size: 20px;">You bought this item the last time: {{$product->created_at->diffForHumans()}} </p>
                                <form action="{{route('dashboard.buy', [$product])}}" method="post">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-10 py-30 rounded font-medium float-right">Buy!</button>
                                </form>
                                <form action="{{route('dashboard.remind', [$product])}}" method="post">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-10 py-30 rounded font-medium float-right">Not yet!</button>
                                </form>
                            </div>
                    </div>                    
                @endforeach
            @else
                <div>
                    <p style="margin: 0 auto; text-align: center; font-size:20px" class="pb-5">You currently have no recommendations!</p> 
                </div>
            @endif
        </div>
    </div>
@endsection