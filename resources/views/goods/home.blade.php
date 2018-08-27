@extends('layouts.app')

@section('title', '贝壳人自己的商城')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>

<a class="dropdown-item hidden-xs" href="/orders">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/orders">我的订单</a>
@endsection

@section('content')
<meta name="goods_id" content="{{ $id }}">
<link href="http://unpkg.com/iview/dist/styles/iview.css" rel="stylesheet">
<link href="{{ asset('css/goodsShow.css') }}" rel="stylesheet">
<div id="singleItem">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <breadcrumb separator=">">
                    <breadcrumb-item to="/">{{ $cat1 }}</breadcrumb-item>
                    <breadcrumb-item to="/components/breadcrumb">{{ $cat2 }}</breadcrumb-item>
                    <breadcrumb-item>{{ $title }}</breadcrumb-item>
                    </breadcrumb>
                </div>
                <div class="card-body">
                        <!-- carousel slide -->
                        <div class="image-slide float-left">
                            <Carousel v-model="carouselValue" loop>
                                <template v-for="item in imageList">
                                    <carousel-item>
                                        <div class="img-wrapper img-carousel"
                                            style="background-size:contain;"
                                            :style="'background-image: url('+item.src+')'">
                                        </div>
                                    </carousel-item>
                                </template>
                            </Carousel>
                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <div class="goods-title col-xs-12">
                                <h1>{{ $title }}</h1>
                            </div>
                            <div class="home-padding col-xs-12">
                                <div class="goods-info col-xs-6">
                                    <h3>类型：{{ $type?'出售':'租赁' }}</h3>
                                </div>
                                <div class="goods-info col-xs-6">
                                    <h3>价格：{{ $cost }}</h3>
                                </div>
                                <div class="goods-info col-xs-12">
                                    <h3>库存：{{ $remain }}</h3>
                                </div>
                                <div class="col-xs-12">
                                    <i-button type="success" class="float-right">创建订单</i-button>
                                    <i-button type="info" class="float-right">联系卖家</i-button>
                                </div>
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
                        <h3 class="goods-description">{{ $description }}</h3>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div>商品评论</div>
                </div>
                <div class="card-body">
                    <template v-for="card in commentList">
                        <ul class="list-group">
                        <template v-if="card.uid">
                            <li class="list-group-item comment col-xs-12">
                                <div class="col-xs-4">
                                    <div class="img-wrapper"
                                        style="background-size: contain;"
                                        :style="'background-image: url('+card.avatar+')'">
                                    </div>
                                    <h5>@{{ card.uname }}</h5>
                                </div>
                                <div>@{{ card.content }}</div>
                                <div class="goods-meta">@{{ card.created_at }}</div>
                            </li>
                        </template>
                        </ul>
                    </template>
                    <div>
                        <i-form>
                        <i-col span="2">评论</i-col>
                        <i-col span="16">
                            <form-item>
                                <i-input placeholder="说些什么..."></i-input>
                            </form-item>
                        </i-col>
                        <i-col span="2">&nbsp;</i-col>
                        <i-col span="4">
                            <form-item>
                                <i-button type="primary">提交</i-button>
                            </form-item>
                        </i-col>
                        </i-form>
                    </div>
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