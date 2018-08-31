@extends('layouts.app')

@section('title', '个人中心')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>

<a class="dropdown-item hidden-xs" href="/user/{{ Auth::id() }}/orders">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/user/orders">我的订单</a>

<a class="dropdown-item hidden-xs" href="/goods/create">上传商品</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/goods/create">上传商品</a>

<a class="dropdown-item hidden-xs" href="">修改密码</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="">修改密码</a>
@endsection

@section('content')
<link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
<script type="text/javascript" src="/js/axios.min.js"></script>
<script type="text/javascript" src="/js/vue.js"></script>
<script type="text/javascript" src="http://unpkg.com/iview/dist/iview.js"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('mescroll/mescroll.css') }}">
<script type="text/javascript" src="{{ asset('mescroll/mescroll.js') }}"></script>

<div id="user" class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xs-10">
            <div class="card">
                <div class="card-header">
                    <breadcrumb separator=">">
                        <breadcrumb-item to="/home">个人中心</breadcrumb-item>
                        <breadcrumb-item>我的商品</breadcrumb-item>
                    </breadcrumb>
                </div>
                <div class="card-body">
                    <i-menu
                        theme="light"
                        active-name="0"
                        mode="horizontal"
                        @on-select="changeFlag">
                        <menu-item class="col-xs-6" style="text-align:center;" name="0">
                            出售
                        </menu-item>
                        <menu-item class="col-xs-6" style="text-align:center;" name="1">
                            租赁
                        </menu-item>
                    </i-menu>
                    <div>
                        <!-- sell -->
                        <template v-if="flag == 0">
                            <div id="mescroll" style="max-height:700px;overflow:scroll">
                                <ul id="datalist" class="list-group" style="overflow-y:hidden;">
                                    <li class="list-group-item" v-for="item in pdlist">
										<a :href="'/goods/'+item.id">
											<div :style="'background-image: url('+item.thumbnail.src+')'" 
												class="img-wrapper float-left"
												style="width:20%;padding-top:20%;" alt="thumbnail"></div>
										</a>
										<div class='table-responsive float-left'
											style='padding-left:5%;width:55%;overflow:hidden;margin: 5% 0;'>
											<table class='table table-condensed'>
												<thead>
                                                    <tr>
													    <td>@{{ item.title }}</td>
                                                    </tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<template v-if="item.type">
                                                                租赁&nbsp;@{{ item.cost }}/天
                                                            </template>
															<template v-else>
                                                                出售&nbsp;@{{ item.cost }}
                                                            </template>
                                                            &nbsp;&nbsp;
                                                            库存
                                                            @{{ item.remain }}
														</td>
													</tr>
												</tbody>
											</table>
										</div>
                                        <div class="float-left hidden-xs" style="width:25%;padding: 0 5%;margin: 5% 0;">
                                            <table class="table-condensed">
                                                <tr>
                                                    <td>
                                                        <img class="img-icon" src="/storage/find.png">
                                                        <a :href="'/goods/'+item.id">查看</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img class="img-icon" src="/storage/edit.png">
                                                        <a :href="'/goods/'+item.id+'/edit'">修改</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
									</li>
                                </ul>
                            </div>
                        </template>
                        <!-- rent -->
                        <template v-else-if="flag == 1">
                            <div id="mescroll1"></div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new Vue({
        el: "#user",
        data() {
            return {
                flag: 0,
                mescroll: null,
                pdlist: [],
                totalSize: 0,
            }
        },
        mounted() {
            self = this
            axios.get('/user/goods/sell/totalsize')
                .then(function (res) {
                    self.totalSize = res.data.size
                })
            self.mescroll = new MeScroll('mescroll', {
                up: {
                    callback: self.upCallback,
                    isBounce: false,
                    page: {size: 6},
                    toTop: {
                        src: "/mescroll/res/img/mescroll-totop.png",
                    },
                    empty: {
                        warpId:"datalist",
                        icon: "/mescroll/res/img/mescroll-empty.png",
                        tip: "no more",
                        btntext: "look look",
                        btnClick: function () {
                            alert("aaa")
                        }
                    },
                },
            })
            
        },
        methods: {
            changeFlag(num) {
                this.flag = num
            },
            upCallback(page) {
                self = this
                getListData(page.num, page.size, function (curPageData) {
                    console.log("page.num="+page.num+", page.size="+page.size+", curPageData.length="+curPageData.length+", self.pdlist.length==" + self.pdlist.length);

                    if(page.num == 1) self.pdlist = []

                    self.pdlist = self.pdlist.concat(curPageData)                    

                    self.mescroll.endBySize(curPageData.length, self.totalSize);
                }, function () {
                    self.mescroll.endErr()
                })
            }
        }
    })

    function getListData(pageNum, pageSize, successCallback, errorCallback) {
        var list = []
        axios.get('/user/goods/'+pageNum+'/'+pageSize)
            .then(function (res) {
                res.data.forEach(function (item) {
                    list.push(item)
                })
                successCallback&&successCallback(list)
            })
            .catch(function (error) {
                errorCallback&&errorCallback()
            })
    }
</script>
@endsection