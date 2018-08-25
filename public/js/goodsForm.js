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
            uploadList: [],
            formValidate: {
                title: "",
                description: "",
                type:"",
                cost: 0,
                remain: 0,
                cat1: "",
                cat2: "",
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
                    axios.post('/goods', self.formValidate)
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
            file.url = res.src;
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
    await axios.post('/api/image/delete', {
        file: name,
    })
        .then(function (res) {
            if(res.status === 200)
                status = true
            else
                status = false
        })
    return status
}