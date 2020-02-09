@extends('layouts.index')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
                        <!--category-productsr-->
                        @foreach ($categories as $category)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a
                                        href="/product/category/{{$category->id}}">{{$category->name}}</a></h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--/category-products-->

                    <div class="price-range">
                        <!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                                data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div>
                    <!--/price-range-->
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">{{$category_clicked->name}}</h2>
                    @forelse ($products as $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{asset('storage')}}/product_image/{{$product->image}}" alt="" />
                                    <h2>{{number_format($product->price,2)}}</h2>
                                    <p>{{$product->name}}</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>{{number_format($product->price,2)}}</h2>
                                        <p>{{$product->name}}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="#"><i class="fa fa-info-circle"></i>Product Detail</a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-danger">
                        <p>Category <strong>{{$category_clicked->name}}</strong> have no product</p>
                    </div>
                    @endforelse
                </div>
                <!--features_items-->
                {{-- {{$products->links()}} --}}
            </div>
        </div>
    </div>
</section>
@endsection
