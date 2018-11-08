@extends('layouts.app')

@section('title', '个人中心')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/user/{{ Auth::id() }}/orders">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/user/orders">我的订单</a>

<a class="dropdown-item hidden-xs" href="/user/{{ Auth::id() }}/goods">我的商品</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/user/{{ Auth::id() }}/goods">我的商品</a>

<a class="dropdown-item hidden-xs" href="/goods/create">上传商品</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/goods/create">上传商品</a>

<a class="dropdown-item hidden-xs" href="">修改密码</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="">修改密码</a>
@endsection

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/upload.css') }}">
<link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">

<meta name="uid" content="{{ Auth::id() }}">
<div id="user" class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
				<div class="card-header">
					<div class="float-left">个人信息</div>
					<div class="rounded float-right"><a href="profile">编辑</a></div>
				</div>
				<div class="card-body">
					<div class="thumbnail float-left col-xs-3">
						<img class="img-responsive" src="{{ Auth::user()->avatar ?? '/storage/null.png' }}">
					</div>
					<div id="profile" class="col-xs-9 float-left">
						<table class="table">
  							<tbody>
    							<tr>
      								<td>昵称</td>
      								<td>{{ Auth::user()->nick_name }}</td>
    							</tr>
    							<tr>
      								<td>uid</td>
      								<td>{{ Auth::id() }}</td>
    							</tr>
								<tr>
									<td>宿舍楼</td>
									<td>{{ App\User::find(Auth::id())->contact->domitory ?? '-' }}</td>
								</tr>
								<tr>
									<td>联系方式</td>
									<td>{{ App\User::find(Auth::id())->contact->phone ?? '-' }}</td>
								</tr>
  							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
        <div class="col-lg-8">
			<Upload type="drag" action="/user/avatar" :on-success="reload">
				<div style="padding: 20px">
            		<Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
            		<p>点击此处更换头像</p>
        		</div>
			</Upload>
		</div>
	</div>
    <user-list></user-list>
</div>
@endsection
