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
<script type="text/javascript" src="{{ asset('js/vue.js') }}"></script>

<div id="order" class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header hidden-xs">
                    <Steps :current="step">
                        <Step :title=                "step==0?'进行中':'已完成'"  content="填写订单"></Step>
                        <Step :title="step<1?'待进行':(step==1?'进行中':'已完成')" content="卖家接受订单"></Step>
                        <Step :title="step<2?'待进行':(step==2?'进行中':'已完成')" content="商品派送/自取"></Step>
                        <Step :title="step<3?'待进行':(step==3?'进行中':'已完成')" content="订单完成"></Step>
                    </Steps>
                </div>
                <div class="card-body visible-xs">
                    <Steps :current="step" size="small">
                        <Step title="填写订单"></Step>
                        <Step title="卖家接受"></Step>
                        <Step title="商品派送"></Step>
                        <Step title="订单完成"></Step>
                    </Steps>
                </div>
            </div>
            <div class="card-body">
                <template v-if="step == 0">
                    <div class="col-xs-12">
                        <i-form>
                            <div class="col-xs-12 col-md-6">
                            <div class="img-wrapper" style="background-image:url('')"></div>
                            </div>
                        </i-form>
                    </div>
                </template>
                <template v-if="step == 1"></template>
                <template v-if="step == 2"></template>
                <template v-if="step == 3"></template>
                <template v-if="step >= 4"></template>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="{{ asset('js/axios.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vue.js') }}"></script>
<script type="text/javascript" src="http://unpkg.com/iview/dist/iview.js"></script>

<script type="text/javascript" src="{{ asset('js/order.js') }}"></script>
@endsection