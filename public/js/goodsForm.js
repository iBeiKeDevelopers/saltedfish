var form = new Vue({
    el: "#form",
    data () {
        self = this
        const moneyCheck = (rule, value, callback) => {
            regFloat = /[0-9]+.[0-9]+/
            regInteger = /[0-9]+/
            if(!regFloat.test(value) && !regInteger.test(value))
                callback(new Error("请输入数字！"))
            callback();
        }

        element = document.getElementsByTagName('meta')['id']
        id = element?element.content:0
        
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
            formValidate: {/*
                id: {{ $id }},
                title: "{{ $title }}",
                description: "{{ $description }}",
                type:"{{ $type }}",
                cost: {{$cost }},
                remain: {{ $remain }},
                category: ["{{ $cat1 }}", "{{ $cat2 }}"],
                tags: [],*/
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
        this.uploadList = this.$refs.upload.fileList
        this.setTags()
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
                    //console.log(formData)
                    if(this.id)
                        formData._method='PUT'
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
            const checkMost = this.uploadList.length < 5;
            if (!checkMost) {
                this.$Notice.warning({
                    title: '最多上传5张图片。'
                });
            }
            return checkMost;
        },
        setTags() {
            axios.get('/api/goods/1')
                .then(function (res) {
                })
        },
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