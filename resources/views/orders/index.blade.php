@extends('layouts.app')

@section('title', '我的订单')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>

<a class="dropdown-item hidden-xs" href="/user/{{ Auth::id() }}/goods">我的商品</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/user/{{ Auth::id() }}/goods">我的商品</a>
@endsection

@section('content')
<link href="http://unpkg.com/iview/dist/styles/iview.css" rel="stylesheet">
<link href="{{ asset('mescroll/mescroll.css') }}" rel="stylesheet">

<script type="text/javascript" src="{{ asset('js/axios.min.js') }}"></script>

<div id="orders" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
				<div class="card-header">    
                    <breadcrumb separator=">">
                        <breadcrumb-item to="/home">个人中心</breadcrumb-item>
                        <breadcrumb-item>我的订单</breadcrumb-item>
                    </breadcrumb>
				</div>
                <div class="card-body">
                    <i-menu active-name="0" style="text-align:center"
                        mode="horizontal" @on-select="changeFlag">
                        <menu-item class="col-xs-4" name="0">
                            buy
                        </menu-item>
                        <menu-item class="col-xs-4" name="1" >
                            sell
                        </menu-item>
                        <menu-item class="col-xs-4" name="2" >
                            finished
                        </menu-item>
                    </i-menu>
                </div>
                <template>
                    <div v-show="flag == 0">
                        aaa
                    </div>
                    <div v-show="flag == 1">
                        bbb
                    </div>
                    <div v-show="flag == 2">
                        ccc
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="{{ asset('js/axios.min.js') }}"></script>
<script type="text/javascript" src="http://unpkg.com/iview/dist/iview.js"></script>
<script type="text/javascript" src="{{ asset('mescroll/mescroll.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/ordersIndex.js') }}"></script>
@endsection