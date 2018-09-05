@extends('layouts.app')

@section('title', '贝壳人自己的商城')

@section('dropdown')
<a class="dropdown-item hidden-xs" href="/home">个人中心</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/home">个人中心</a>

<a class="dropdown-item hidden-xs" href="/orders">我的订单</a>
<a class="dropdown-item visible-xs" style="text-align:center;" href="/orders">我的订单</a>
@endsection

@section('content')
<link rel="stylesheet" type="text/css" href="/css/upload.css">
<link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
<script type="text/javascript" src="http://unpkg.com/iview/dist/iview.js"></script>

<meta name="id" content="{{ $id }}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12 col-xs-12">
            <div class="card">
                <div class="home-padding hidden-xs"></div>
				<div class="card-header">要上传啥赶紧填，麻溜利索的！</div>
                <div id="form" class="card-body">
                    <i-form ref="formValidate" :model="formValidate" :rules="ruleValidate" >
                        <div class="col-xs-12" style="z-index:1">
                            <form-item label="商品名称" prop="title">
                                <i-input v-model="formValidate.title" clearable></i-input>
                            </form-item>
                            <form-item label="商品描述" prop="description">
                                <i-input v-model="formValidate.description" type="textarea" :autosize="{minRows: 5, maxRows: 8}"></i-input>
                            </form-item>
                        </div>
                        <form-item label="价格" prop="cost" class="col-lg-6 col-md-6 float-left">
                            <i-input v-model="formValidate.cost" clearable>
                                <Icon type="logo-yen" slot="prepend"></Icon>
                            </i-input>
                        </form-item>
                        <form-item label="库存" prop="remain" class="col-md-6 float-left">
                            <i-input v-model="formValidate.remain" clearable>
                                <Icon type="md-filing" slot="prepend"></Icon>
                            </i-input>
                        </form-item>
                        <form-item label="类型" prop="type" class="col-md-6 float-left">
                            <i-select v-model="formValidate.type">
                                <i-option value="0">出售</i-option>
                                <i-option value="1">租赁</i-option>
                            </i-select>
                        </form-item>
                        <form-item label="分类" prop="category" class="col-md-6 float-left">
                            <Cascader :data="cascader" v-model="formValidate.category"></Cascader>
                        </form-item>
                        <form-item label="商品美图" class="col-xs-12 float-left">
                            <div id="img-upload">
                                <div class="upload-list" v-for="item in uploadList">
                                    <template v-if="item.status === 'finished'">
                                        <img :src="item.url">
                                        <div class="upload-list-cover">
                                            <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                            <Icon type="ios-trash-outline" @click.native="handleRemove(item)"></Icon>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <Progress v-if="item.showProgress" :percent="item.percentage" hide-info></Progress>
                                    </template>
                                </div>
                                <Upload
                                    ref="upload"
                                    :show-upload-list="false"
                                    :default-file-list="defaultList"
                                    :on-success="handleSuccess"
                                    :format="['jpg','jpeg','png']"
                                    :max-size="1024"
                                    :on-format-error="handleFormatError"
                                    :on-exceeded-size="handleMaxSize"
                                    :before-upload="handleBeforeUpload"
                                    multiple
                                    type="drag"
                                    action="/api/image"
                                    style="display: inline-block;width:58px;">
                                    <div style="width: 58px;height:58px;line-height: 58px;">
                                        <Icon type="ios-camera" size="20"></Icon>
                                    </div>
                                </Upload>
                                <Modal title="View Image" v-model="visible">
                                    <img :src="'/api/image/'+imgName" v-if="visible" class="img-rounded img-responsive">
                                </Modal>
                            </div>
                        </form-item>
                        <form-item label="标签" class="col-md-6 float-left">
                            <i-select multiple filterable v-model="formValidate.tags" placeholder="可多选">
                                <i-option value=""></i-option>
                            </i-select>
                        </form-item>
                        <form-item label="自定义标签" class="col-md-6 float-left">
                            <i-input v-model="formValidate.newtags" placeholder="标签以空格间隔"></i-input>
                        </form-item>
                        <form-item class="col-xs-12">
                            <i-button type="primary" @click="handleSubmit('formValidate')">提交</i-button>
                            <i-button @click="handleReset('formValidate')">取消</i-button>
                        </form-item>
                    </i-form>
                </div>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('js/goodsForm.js') }}"></script>
@endsection