<template>
    <div class="card-body">
        <i-menu class="hidden-xs col-md-3 float-left"
            theme="light" active-name="0"
            @on-select="changeFlag">
            <menu-item name="0">
                基本信息
            </menu-item>
            <menu-item name="1">
                身份信息
            </menu-item>
            <menu-item name="2">
                联系方式
            </menu-item>
        </i-menu>
        <i-menu class="visible-xs"
            mode="horizontal" theme="light"
            active-name="0"
            @on-select="changeFlag">
            <menu-item name="0">
                基本信息
            </menu-item>
            <menu-item name="1">
                身份信息
            </menu-item>
            <menu-item name="2">
                联系方式
            </menu-item>
        </i-menu>
        <div>
            <!-- user_common -->
            <template v-if="flag == 0">
                <i-form class="col-xs-12 col-md-9 float-left">
                    <form-item label="昵称">
                        <i-input v-model="content.nick_name"></i-input>
                    </form-item>
                    <form-item label="邮箱">
                        <i-input :value="content.email" disabled></i-input>
                    </form-item>
                    <form-item label="用户组">
                        <template v-if="content.group == -1">
                            <i-input value="管理员" disabled></i-input>
                        </template>
                        <template v-if="content.group == 0">
                            <i-input value="用户" disabled></i-input>
                        </template>
                        <template v-if="content.group == 1">
                            <i-input value="商家" disabled></i-input>
                        </template>
                    </form-item>
                    <form-item>
                        <i-button type="primary" @click="uploadInfo(flag)">提交</i-button>
                    </form-item>
                </i-form>
            </template>
            <!-- user_identity -->
            <template v-else-if="flag == 1">
                <i-form class="col-xs-12 col-md-9 float-left">
                    <form-item label="学历">
                        <i-select v-model="content.degree" placeholder="目前仅支持本科生认证">
                            <i-option value="0">本科生</i-option>
                            <i-option value="1" disabled>研究生</i-option>
                            <i-option value="2" disabled>博士生</i-option>
                        </i-select>
                    </form-item>
                    <form-item label="学号">
                        <i-input v-model="content.student_id" placeholder="数字"></i-input>
                    </form-item>
                    <form-item>
                        <i-button type="primary" @click="uploadInfo(flag)">提交</i-button>
                    </form-item>
                </i-form>
            </template>
            <!-- user_contact -->
            <template v-else-if="flag == 2">
                <i-form class="col-xs-12 col-md-9 float-left">
                    <form-item label="学院">
                        <i-select v-model="content.college">
                            <i-option value="tz">土木与资源工程学院</i-option>
                            <i-option value="yj">冶金与生态工程学院</i-option>
                            <i-option value="cl">材料科学与工程学院</i-option>
                            <i-option value="jx">机械工程学院</i-option>
                            <i-option value="nh">能源与环境工程学院</i-option>
                            <i-option value="zdh">自动化学院</i-option>
                            <i-option value="jt">计算机与通信工程学院</i-option>
                            <i-option value="sl">数理学院</i-option>
                            <i-option value="hs">化学与生物工程学院</i-option>
                            <i-option value="jg">东凌经济管理学院</i-option>
                            <i-option value="wf">文法学院</i-option>
                            <i-option value="my">马克思主义学院</i-option>
                            <i-option value="wy">外国语学院</i-option>
                            <i-option value="gg">高等工程师学院</i-option>
                            <i-option value="qt">其他</i-option>
                        </i-select>
                    </form-item>
                    <form-item label="宿舍楼">
                        <i-input v-model="content.domitory"
                            placeholder="数字"></i-input>
                    </form-item>
                    <form-item label="宿舍号">
                        <i-input v-model="content.room"
                            placeholder="数字"></i-input>
                    </form-item>
                    <form-item label="手机号">
                        <i-input v-model="content.phone"
                            placeholder="移动电话"></i-input>
                    </form-item>
                    <form-item>
                        <i-button type="primary" @click="uploadInfo(flag)">提交</i-button>
                        </form-item>
                </i-form>
            </template>
            <template v-else>
                error
            </template>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            flag: 1,
            urlList: [
                '/user/common',
                '/user/identity',
                '/user/contact',
            ],
            content: {},
        }
    },
    mounted() {
        this.changeFlag(0)
    },
    methods: {
        changeFlag(num) {
            self = this
            getInfo(this.urlList[num])
                .then(function (data) {
                    if(data != 'error') {
                        console.log(data)
                        self.content = data
                        self.flag = num
                    }
                })
            async function getInfo(url) {
                var data = ''
                await axios.get(url)
                    .then(function (res) {
                        data = res.data
                    })
                    .catch(function () {
                        data = 'error'
                    })
                return data
            }
        },
        uploadInfo(num) {
            self = this
            //console.log(self.content)
            self.content._method = 'PUT'
            self.content._word = getWordOf(num)
            console.log(self.content)
            axios.post(
                    '/user/{{ Auth::id() }}',
                    self.content
                )
                .then(function (res) {
                    if(res.data.status)
                        self.$Message.success('上传成功！')
                    else
                        self.$Message.error(res.data.error)
                })
                .catch(function () {
                    self.$Message.error('上传失败！')
                })

            function getWordOf(num) {
                if(num == 0) return 'common'
                if(num == 1) return 'identity'
                if(num == 2) return 'contact'
            }
        }
    }
    
}
</script>
