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
<script type="text/javascript" src="/js/axios.min.js"></script>
<script type="text/javascript" src="/js/vue.js"></script>
<script type="text/javascript" src="http://unpkg.com/iview/dist/iview.js"></script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12 col-xs-12">
            <div class="card">
				<div class="card-header">要上传啥赶紧填，麻溜利索的！</div>
                <div id="form" class="card-body">
                    <i-form ref="formValidate" :model="formValidate" :rules="ruleValidate" >
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <form-item label="商品名称" prop="title">
                                <i-input v-model="formValidate.title"></i-input>
                            </form-item>
                            <form-item label="商品描述" prop="description">
                                <i-input v-model="formValidate.description" type="textarea" :autosize="{minRows: 5, maxRows: 8}"></i-input>
                            </form-item>
                        </div>

                        <form-item label="价格" prop="cost" class="col-lg-6 col-md-6 float-left">
                            <i-input v-model="formValidate.cost">
                                <Icon type="logo-yen" slot="prepend"></Icon>
                            </i-input>
                        </form-item>
                        <form-item label="库存" prop="remain" class="col-lg-6 col-md-6 float-left">
                            <i-input v-model="formValidate.remain"></i-input>
                        </form-item>

                        <form-item label="类型" prop="type" class="col-lg-6 col-md-6 float-left">
                            <i-select v-model="formValidate.type">
                                <i-option value="0">租赁</i-option>
                                <i-option value="1">出售</i-option>
                            </i-select>
                        </form-item>
                        <form-item label="分类" prop="cat1" class="col-lg-6 col-md-6 float-left">
                            <i-select v-model="formValidate.cat1" placeholder="一级分类">
                                <i-option value="sp">食品</i-option>
                                <i-option value="fs">服饰</i-option>
                                <i-option value="shyp">生活用品</i-option>
                                <i-option value="xxyp">学习用品</i-option>
                                <i-option value="dzcp">电子产品</i-option>
                                <i-option value="tyyp">体育用品</i-option>
                                <i-option value="yyqc">音乐器材</i-option>
                                <i-option value="fstsp">非实体商品</i-option>
                            </i-select>
                            <i-select v-model="formValidate.cat2" placeholder="二级分类">
                                <template v-if="formValidate.cat1 === 'shyp'">
                                    <i-option value="csyp">床上用品</i-option>
                                    <i-option value="xxyp">洗漱用品</i-option>
                                    <i-option value="rcyp">日常用品</i-option>
                                    <i-option value="qtshyp">其他</i-option>
                                </template>
                                <template v-else-if="formValidate.cat1 === 'xxyp'">
                                    <i-option value="xjjc">新旧教材</i-option>
                                    <i-option value="xbbj">学霸笔记</i-option>
                                    <i-option value="fxzl">复习资料</i-option>
                                    <i-option value="sjzz">书籍杂志</i-option>
                                    <i-option value="cgyy">出国英语</i-option>
                                    <i-option value="qtxxyp">其他</i-option>
                                </template>
                                <template v-else-if="formValidate.cat1 === 'sp'">
                                    <i-option value="ls">零食</i-option>
                                    <i-option value="tc">特产</i-option>
                                    <i-option value="yp">饮品</i-option>
                                    <i-option value="qtsp">其他</i-option>
                                </template>
                                <template v-else-if="formValidate.cat1 === 'fs'">
                                    <i-option value="fsxm">服装鞋帽</i-option>
                                    <i-option value="dzfz">定制服装</i-option>
                                    <i-option value="gj">挂件</i-option>
                                    <i-option value="qtfs">其他</i-option>
                                </template>
                                <template v-else-if="formValidate.cat1 === 'dzcp'">
                                    <i-option value="sj">手机</i-option>
                                    <i-option value="dn">电脑</i-option>
                                    <i-option value="sjpj">手机配件</i-option>
                                    <i-option value="dnpj">电脑配件</i-option>
                                    <i-option value="qtdzcp">其他</i-option>
                                </template>
                                <template v-else-if="formValidate.cat1 === 'tyyp'">
                                    <i-option value="qlxg">球类相关</i-option>
                                    <i-option value="jsqc">健身器材</i-option>
                                    <i-option value="qttyyp">其他</i-option>
                                </template>
                                <template v-else-if="formValidate.cat1 === 'yyqc'">
                                    <i-option value="xyyq">西洋乐器</i-option>
                                    <i-option value="mzyq">民族乐器</i-option>
                                    <i-option value="yqpj">乐器配件</i-option>
                                    <i-option value="qtyyqc">其他</i-option>
                                </template>
                                <template v-else-if="formValidate.cat1 === 'fstsp'">
                                    <i-option value="hpjh">轰趴聚会</i-option>
                                    <i-option value="bjzby">北京周边游</i-option>
                                    <i-option value="sy">摄影</i-option>
                                    <i-option value="pmsj">平面设计</i-option>
                                    <i-option value="rjsj">软件设计</i-option>
                                    <i-option value="spjj">视频剪辑</i-option>
                                    <i-option value="pxkc">培训课程</i-option>
                                    <i-option value="qtfstsp">其他</i-option>
                                </template>
                            </i-select>
                        </form-item>
                        <form-item label="img" class="col-md-6 col-xs-12 float-left">
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

<script>
var form = new Vue({
    el: "#form",
    data () {
        const moneyCheck = (rule, value, callback) => {
            regFloat = /[0-9]+.[0-9]+/
            regInteger = /[0-9]+/
            if(!regFloat.test(value) && !regInteger.test(value))
                callback(new Error("请输入数字！"))
            callback();
        }
        return {
            imgName: '',
            visible: false,
            defaultList: [
                @foreach ($list as $item)
                    {
                        name: "{{ $item['name'] }}",
                        url: "{{ $item['url'] }}",
                    },
                @endforeach
            ],
            uploadList: [],
            formValidate: {
                id: {{ $id }},
                title: "{{ $title }}",
                description: "{{ $description }}",
                type:"{{ $type }}",
                cost: {{$cost }},
                remain: {{ $remain }},
                cat1: "{{ $cat1 }}",
                cat2: "{{ $cat2 }}",
                tags: [{{ $tags }}],
            },
            ruleValidate: {
                title: [{
                    required: true,
                    message: "required",
                },{
                    type: 'string',
                    max: 20,
                    message: "too long",
                }],
                description: [{
                    required: true,
                    message: "required",
                },{
                    type: 'string',
                    min: 20,
                    message: "请输入至少20字的商品描述",
                }],
                type:[{
                    required: true,
                    message: "required",
                }],
                cost: [{
                    required: true,
                    message: "required",
                },{
                    validator: moneyCheck,
                }],
                remain: [{
                    required: true,
                    message: "required",
                }],
                cat2: [{
                    required: true,
                    message: "required",
                }],
                //tags: [],
            },
        }
    },
    mounted () {
        this.uploadList = this.$refs.upload.fileList;
    },
    methods: {
        handleSubmit (name) {
            this.$refs[name].validate((valid) => {
                if (valid) {
                    self = this
                    formData = self.formValidate
                    formData.uploadList = []
                    self.uploadList.forEach(function (item) {
                        formData.uploadList.push(item.name)
                    })
                    console.log(formData)
                    @php
                        if($id)
                            echo "formData._method='PUT';"
                    @endphp
                    axios.post('{{ $url }}', formData)
                        .then(function (res) {
                            if(res.data.status === true) {
                                setTimeout(() => {
                                    self.$Message.success('上传成功!')                                    
                                }, 500);
                                window.location.href = "/goods/" + res.data.id
                            }else
                                self.$Message.error(res.data.error);
                        })
                        .catch(function (res) {
                            self.$Message.error('上传失败！');
                        })
                } else {
                    this.$Message.error('请检查!');
                }
            })
        },
        handleReset (name) {
            this.$refs[name].resetFields();
        },
        handleView (name) {
            this.imgName = name;
            this.visible = true;
        },
        handleRemove (file) {
            self = this
            deleteImg(file.name)
                .then(function (status) {
                    if(status) {
                        const fileList = self.$refs.upload.fileList;
                        self.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
                    }
                })
        },
        handleSuccess (res, file) {
            file.url = '/api/image/'+res.name;
            file.name = res.name;
        },
        handleFormatError (file) {
            this.$Notice.warning({
                title: '上传文件格式错误',
                desc: '文件' + file.name + '的格式不受支持，请上传jpg或png格式的图片。'
            });
        },
        handleMaxSize (file) {
            this.$Notice.warning({
                title: '文件大小超出限制',
                desc: '文件' + file.name + '太大，最大支持上传大小为1M的文件。'
            });
        },
        handleBeforeUpload () {
            const checkMost = this.uploadList.length < 4;
            if (!checkMost) {
                this.$Notice.warning({
                    title: '最多上传5张图片。'
                });
            }
            return checkMost;
            }
    }
})

async function deleteImg(name) {
    var status
    await axios.get('/api/image/delete/'+name)
        .then(function (res) {
            if(res.status === 200)
                status = true
            else
                status = false
        })
    return status
}
</script>
@endsection