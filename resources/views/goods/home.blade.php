@extends('layouts.app')

@section('title', '贝壳人自己的商城')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>

<a class="dropdown-item hidden-xs" href="/orders">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/orders">我的订单</a>
@endsection

@section('content')
<link href="http://unpkg.com/iview/dist/styles/iview.css" rel="stylesheet">
<link href="{{ asset('css/goodsShow.css') }}" rel="stylesheet">
<div id="singleItem">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <breadcrumb separator=">">
                    <breadcrumb-item to="/">{{ 'cat1' }}</breadcrumb-item>
                    <breadcrumb-item to="/components/breadcrumb">{{ 'cat2' }}</breadcrumb-item>
                    <breadcrumb-item>{{ 'title' }}</breadcrumb-item>
                    </breadcrumb>
                </div>
                <div class="card-body">
                        <!-- carousel slide -->
                        <div class="image-slide float-left">
                            <Carousel v-model="carouselValue" loop>
                                <template v-for="item in imageList">
                                    <carousel-item>
                                        <div class="img-wrapper img-carousel"
                                            :style="'background-image: url('+item.src+')'">
                                        </div>
                                    </carousel-item>
                                </template>
                            </Carousel>
                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <div class="goods-title col-xs-12 col-lg-6">
                                <h1>{{ '01020304050102030405010203040501020304050102030405' }}</h1>
                            </div>
                            <div class="col-xs-6">
                                {{ 'type' }}
                            </div>
                            <div class="col-xs-6">
                                {{ 'cost' }}
                            </div>
                            <div class="col-xs-12">
                                {{ 'remain' }}
                            </div>
                            <div class="col-xs-12">
                                <i-button type="success" class="float-right">创建订单</i-button>
                                <i-button type="info" class="float-right">联系卖家</i-button>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div>卖家留言</div>
                </div>
                <div class="card-body">
                    <div class="col-xs-12">
                        <div class="col-xs-4">
                            <img class="img-circle img-thumbnail" src="/storage/admin.png" alt="avatar">
                        </div class="col-xs-8">
                        <h3 class="goods-description">{{ 'description' }}</h3>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div>商品评论</div>
                </div>
                <div class="card-body">
                </div>
            </div>
            <div style="padding-top:5%;"></div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="{{ asset('js/axios.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vue.js') }}"></script>

<script type="text/javascript" src="http://unpkg.com/iview/dist/iview.js"></script>

<script src="{{ asset('js/goodsShow.js') }}"></script>
@endsection