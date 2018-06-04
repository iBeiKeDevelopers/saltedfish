# 后端 API 文档
## 1.简述

* 该系统 api 主要处理数据请求和数据修改请求
- 并按用户权限分为两大类：
- 普通用户
- 管理员
---

## 2.功能（普通用户） 以 URL/ 开头

### 2.1 Goods 吃的

#### 2.1.1 goods_new 提交商品
>返回数据：
>```
>[
>   'goods_id'          =>      goods_id,
>]
>```
>
>POST 数据格式：
>```
>[
>   'goods_title'       =>      goods_title,
>   'single_cost'       =>      single_cost,
>   'goods_status'      =>      goods_status,
>   'goods_type'        =>      goods_type,
>   'goods_remain'      =>      remain,
>   'goods_tags'        =>      tags,
>   'goods_img'         =>      goods_img,
>   'delevery_fee'      =>      delivery_fee,
>   'lv1'               =>      cl_lv_1,
>   'lv2'               =>      cl_lv_2,
>   'lv3'               =>      cl_lv_3,
>]
>```


#### 2.1.2 goods_submit 修改商品信息
>
>返回数据：
>```
>[
>   'goods_id'          =>      goods_id,
>]
>```
>
>POST 数据格式：
>```
>[
>   'goods_id'          =>      goods_id,
>   'goods_title'       =>      goods_title,
>   'single_cost'       =>      single_cost,
>   'goods_status'      =>      goods_status,
>   'goods_type'        =>      goods_type,
>   'goods_remain'      =>      remain,
>   'goods_tags'        =>      tags,
>   'goods_img'         =>      goods_img,
>   'delevery_fee'      =>      delivery_fee,
>   'lv1'               =>      cl_lv_1,
>   'lv2'               =>      cl_lv_2,
>   'lv3'               =>      cl_lv_3,
>]
>```

#### 2.1.3 goods_revoke
>
>返回数据：
>```
>    无
>```
>
>POST 数据格式：
>```
>[
>   'goods_id'          =>      goods_id,
>]
>```

#### 2.1.4 goods_edit
>
>返回数据：
>```
>    无
>```
>
>POST 数据格式：
>```
>[
>   'goods_id'          =>      goods_id,
>]
>```

### 2.2 Orders 订单

#### 2.2.1 order_new

>返回数据：
>```
>[
>   'goods_id'          =>      goods_id,
>]
>```
>
>POST 数据格式：
>```
>[
>   'goods_id'          =>       goods_id,
>   'order_type'        =>       order_type,
>   //取决于商品类型（出售 || 租赁）
>   'rent_duration'     =>       rent_dutation,
>   'delivery_fee'      =>       delivery_fee,
>   'purchase_amount'   =>       purchase_amount,
>   'single_cost'       =>       single_cost,
>   'offer'             =>       offer,
>]
>```
# 》》》从这里开始没写《《《
#### 2.2.2 order_accept

>返回数据：
>```
>    无
>```
>
>POST 数据格式：
>```
>[
>   'order_id'          =>      order_id, 
>]
>```

#### 2.2.3 order_complete

>返回数据：
>```
>    无
>```
>
>POST 数据格式：
>```
>[
>   'order_id'          =>      order_id, 
>]
>```

#### 2.2.4 order_finish

>返回数据：
>```
>    无
>```
>
>POST 数据格式：
>```
>[
>   'order_id'          =>      order_id, 
>]
>```

#### 2.2.5 order_cancel

>返回数据：
>```
>    无
>```
>
>POST 数据格式：
>```
>[
>   'order_id'          =>      order_id, 
>]
>```
---

## 3.功能(管理员) 以 URL/admin/ 开头
---

## 4.返回数据格式 (json)

### 4.1 请求成功

>```
>[
>   "status"            =>      "true",
>   "data"              =>      $data,  //返回数据 或 id 
>]
>```

### 4.2 请求失败

>```
>[
>   "status"            =>      "false",
>   "error"             =>      $error, //错误码 或 提示信息
>]
>```

### 4.3 状态码对照表
>
>
>
>
>
>
>
>
---
---