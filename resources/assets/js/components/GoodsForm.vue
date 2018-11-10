<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12 col-xs-12">
                <div class="card">
                    <div class="home-padding hidden-xs"></div>
                    <div class="card-header">商品上传</div>
                    <div id="form" class="card-body">
                        <Form ref="formValidate" :model="formValidate" :rules="ruleValidate" >
                            <div class="col-xs-12" style="z-index:1">
                                <FormItem label="商品名称" prop="title">
                                    <Input v-model="formValidate.title" clearable></Input>
                                </FormItem>
                                <FormItem label="商品描述" prop="description">
                                    <Input v-model="formValidate.description" type="textarea" :autosize="{minRows: 5, maxRows: 8}"></Input>
                                </FormItem>
                            </div>
                            <FormItem label="价格" prop="cost" class="col-lg-6 col-md-6 float-left">
                                <Input v-model="formValidate.cost" clearable>
                                    <Icon type="logo-yen" slot="prepend"></Icon>
                                </Input>
                            </FormItem>
                            <FormItem label="库存" prop="remain" class="col-md-6 float-left">
                                <Input v-model="formValidate.remain" clearable>
                                    <Icon type="md-filing" slot="prepend"></Icon>
                                </Input>
                            </FormItem>
                            <FormItem label="类型" prop="type" class="col-md-6 float-left">
                                <Select v-model="formValidate.type">
                                    <Option value="0">出售</Option>
                                    <Option value="1">租赁</Option>
                                </Select>
                            </FormItem>
                            <FormItem label="分类" prop="category" class="col-md-6 float-left">
                                <Cascader :data="cascader" v-model="formValidate.category"></Cascader>
                            </FormItem>
                            <FormItem label="商品美图" class="col-xs-12 float-left">
                                <div id="img-upload">
                                    <div class="upload-list" v-for="item in uploadList" :key="item.name">
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
                            </FormItem>
                            <!--<FormItem label="标签" class="col-md-6 float-left">
                                <Select multiple filterable v-model="formValidate.tags" placeholder="可多选">
                                    <Option value=""></Option>
                                </Select>
                            </FormItem>
                            <FormItem label="自定义标签" class="col-md-6 float-left">
                                <Input v-model="formValidate.newtags" placeholder="标签以空格间隔"></Input>
                            </FormItem>-->
                            <FormItem class="col-xs-12">
                                <Button type="primary" @click="handleSubmit('formValidate')">提交</Button>
                                <Button @click="handleReset('formValidate')">取消</Button>
                            </FormItem>
                        </Form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        const moneyCheck = (rule, value, callback) => {
            var regFloat = /[0-9]+\.[0-9]+/
            var regInteger = /[0-9]+/
            if(!regFloat.test(value) && !regInteger.test(value))
                callback(new Error("请输入数字！"))
            callback();
        }
        
        return {
            cascader: [{
                value: "sp",
                label: "食品",
                children: [
                    {value: "ls",label: "零食"},
                    {value: "tc",label: "特产"},
                    {value: "yp",label: "饮品"},
                    {value: "qtsp",label: "其他"},
                ],
            },{
                value: "fs",
                label: "服饰",
                children: [
                    {value: "fsxm",label: "服装鞋帽"},
                    {value: "dzfz",label: "定制服装"},
                    {value: "gj",label: "挂件"},
                    {value: "qtfs",label: "其他"},
                ],
            },{
                    value: "shyp",
                    label: "生活用品",
                    children: [
                        {value: "csyp",label: "床上用品"},
                        {value: "xxyp",label: "洗漱用品"},
                        {value: "rcyp",label: "日常用品"},
                        {value: "qtshyp",label: "其他"},
                    ],
                },{
                    value: "xxyp",
                    label: "学习用品",
                    children: [
                        {value: "xjjc",label: "新旧教材"},
                        {value: "xbbj",label: "学霸笔记"},
                        {value: "fxzl",label: "复习资料"},
                        {value: "sjzz",label: "书籍杂志"},
                        {value: "cgyy",label: "出国英语"},
                        {value: "qtxxyp",label: "其他"},
                    ],
                },{
                    value: "dzcp",
                    label: "电子产品",
                    children: [
                        {value: "sj",label: "手机"},
                        {value: "dn",label: "电脑"},
                        {value: "sjpj",label: "手机配件"},
                        {value: "dnpj",label: "电脑配件"},
                        {value: "qtdzcp",label: "其他"},
                    ],
                },{
                    value: "tyyp",
                    label: "体育用品",
                    children: [
                        {value: "qlxg",label: "球类相关"},
                        {value: "jsqc",label: "健身器材"},
                        {value: "qttyyp",label: "其他"},
                    ],
                },{
                    value: "yyqc",
                    label: "音乐器材",
                    children: [
                        {value: "xyyq",label: "西洋乐器"},
                        {value: "mzyq",label: "民族乐器"},
                        {value: "yqpj",label: "乐器配件"},
                        {value: "qtyyqc",label: "其他"},
                    ],
                },{
                    value: "fstsp",
                    label: "非实体商品",
                    children: [
                        {value: "hpjh",label: "轰趴聚会"},
                        {value: "bjzby",label: "北京周边游"},
                        {value: "sy",label: "摄影"},
                        {value: "pmsj",label: "平面设计"},
                        {value: "rjsj",label: "软件设计"},
                        {value: "spjj",label: "视频剪辑"},
                        {value: "pxkc",label: "培训课程"},
                        {value: "qtfstsp",label: "其他"},
                    ],
                },{
                    value: "qt",
                    label: "其他"
                }
            ],
            imgName: '',
            visible: false,
            defaultList: [
                /*
                @foreach ($list as $item)
                    {
                        name: "{{ $item['name'] }}",
                        url: "{{ $item['url'] }}",
                    },
                @endforeach*/
            ],
            uploadList: [],
            formValidate: {
                id: 0,
                title: "",
                description: "",
                type: "",
                cost: "",
                remain: "",
                category: [],
                tags: [],
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
                category: [{
                    required: true,
                    message: "required",
                }],
            },
        }
    },
    mounted () {
        self = this
        this.uploadList = this.$refs.upload.fileList
        this.setTags()
        
        console.log(this.id)
        if(this.id) {
            axios.get('/api/goods/' + this.id)
            .then((res) => {
                self.formValidate = res.data
                self.formValidate.type = res.data.type.toString()
                self.formValidate.category = [res.data.cat1, res.data.cat2]
            })
            axios.post('/api/image/id/' + this.id, {
                _method: "PUT",
            })
            .then((res) => {
                res.data.images.forEach((img) => {
                    self.uploadList.push({
                        name: img,
                        url: '/api/image/' + img,
                        showProgress: false,
                        status: "finished",
                    })
                })
            })
        }
    },
    methods: {
        handleSubmit (name) {
            this.$refs[name].validate((valid) => {
                if (valid) {
                    self = this
                    var formData = self.formValidate
                    formData.uploadList = []
                    self.uploadList.forEach((item) => {
                        formData.uploadList.push(item.name)
                    })

                    var url
                    if(self.id == "0") { // creating goods
                        url = "/goods"
                    }else { // editing goods
                        url = "/goods/" + self.id
                        formData._method = "PUT"
                    }

                    axios.post(url, formData)
                        .then((res) => {
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
                    self.$Message.error('请检查!');
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
            self.deleteImg(file.name)
                .then(function (status) {
                    if(status) {
                        const fileList = self.$refs.upload.fileList;
                        self.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
                    }
                })
        },  
        async deleteImg(name) {
            var status
            await axios.get('/api/image/delete/'+name)
            .then(function (res) {
                if(res.status === 200)
                    status = true
                else
                    status = false
            })
            return status
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
            const checkMost = this.uploadList.length < 5;
            if (!checkMost) {
                this.$Notice.warning({
                    title: '最多上传5张图片。'
                });
            }
            return checkMost;
        },
        setTags() {
            this.id = document.getElementsByTagName('meta')['id'].content
            axios.get('/api/goods/' + this.id)
                .then(function (res) {
                })
        },
    }
}
</script>

<style>
.upload-list{
    display: inline-block;
    width: 60px;
    height: 60px;
    text-align: center;
    line-height: 60px;
    border: 1px solid transparent;
    border-radius: 4px;
    overflow: hidden;
    background: #fff;
    position: relative;
    box-shadow: 0 1px 1px rgba(0,0,0,.2);
    margin-right: 4px;
}
.upload-list img{
    width: 100%;
    height: 100%;
}
.upload-list-cover{
    display: none;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,.6);
}
.upload-list:hover .upload-list-cover{
    display: block;
}
.upload-list-cover i{
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    margin: 0 2px;
}
</style>
