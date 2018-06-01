# API 文档

## 1.简述
>#### 该系统api主要处理数据请求和数据修改请求，并按用户权限分为两大类：
>普通用户 管理员

## 2 功能（普通用户） 以 URL/ 开头

### 2.1 Goods 吃的(雾)
#### 2.1.1 goods_submit 提交商品 && 修改商品

#### 2.1.2 goods_submit 提交商品 && 修改商品
>
>返回数据：
>```
>    无
>```
>
>请求数据格式：
>```
>[
>    'goods_id'          =>      goods_id,
>    'goods_title'       =>      goods_title,
>    'single_cost'       =>      single_cost,
>    'goods_status'      =>      goods_status,
>    'goods_type'        =>      goods_type,
>    'goods_remain'      =>      remain,
>    'goods_tags'        =>      tags,
>    'goods_img'         =>      goods_img,
>    'delevery_fee'      =>      delivery_fee,
>    'lv1'               =>      cl_lv_1,
>    'lv2'               =>      cl_lv_2,
>    'lv3'               =>      cl_lv_3,
>]
>```

#### 2.1.3 goods_revoke
>
>返回数据：
>```
>    无
>```
>
>请求数据格式：
>```
>[
>    'goods_id'          =>      goods_id,
>]
>```

#### 2.1.4 goods_edit
>
>返回数据：
>```
>    无
>```
>
>请求数据格式：
>```
>[
>    'goods_id'          =>      goods_id,
>]
>```

### 2.2 Orders 订单

#### 2.2.1 order_new

>返回数据：
>```
>    无
>```
>
>请求数据格式：
>```
>[
>    'goods_id'          =>       goods_id,
>    'order_type'        =>       order_type,
>    'rent_duration'     =>       0 || rent_dutation,
>    'delivery_fee'      =>       delivery_fee,
>    'purchase_amount'   =>       purchase_amount,
>    'single_cost'       =>       single_cost,
>    'offer'             =>       offer,
>]
>```

#### 2.2.2 order_accept

>返回数据：
>```
>    无
>```
>
>请求数据格式：
>```
>[
>    'order_id'          =>      order_id, 
>]
>```
#### 2.2.3 order_complete
返回数据：
```
    无
```
请求数据格式：
```
[
    'order_id'          =>      order_id, 
]
```
#### 2.2.4 order_finish
返回数据：
```
    无
```
请求数据格式：
```
[
    'order_id'          =>      order_id, 
]
```
#### 2.2.5 order_cancel
返回数据：
```
    无
```
请求数据格式：
```
[
    'order_id'          =>      order_id, 
]
```
>## 3 返回数据格式 (json)
### 3.1 请求成功
```
[
    "status"            =>      "true",
    "data"              =>      $data, //返回请求的数据 或 id 
]
```
### 3.2 请求失败
```
[
    "ststus"            =>      "false",
    "error"             =>      $error, //错误码 或 提示信息
]
```
>## 4 状态码