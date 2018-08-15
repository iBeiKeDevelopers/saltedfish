# Database

## 1 Users

### 1.1 ibuy_user_common

```php
[
    'id'            =>          increments,
    'nick_name'     =>          string,
    'email'         =>          string(unique),
    'password'      =>          string,
]
```

### 1.2 ibuy_user_identify

```php
[
    'id'            =>          integer(unique),
    'degree'        =>          integer(enum),
    'student_id'    =>          string,
]
```

### 1.3 ibuy_user_contact

```php
[

]
```

### 1.4 ibuy_user_extend

```php
[
    'id'            =>          integer(unique),
    'birthday'      =>          date,
    'college'       =>          string,
    'domitory'      =>          integer,
    'room'          =>          integer,
    'phone'         =>          string,
]
```

## 2 Goods

### 2.1 ibuy_goods

```php
[
    'title'         =>          string,
    'type'          =>          integer(enum),
    'status'        =>          integer(enum),
    'cost'          =>          float(money),
    'fee'           =>          float(money),
    'remain'        =>          integer,
    'description'   =>          text,
    'category'      =>          string,
]
```

### 2.3 ibuy_goods_image

### 2.4 ibuy_goods_comments

### 2.5 ibuy_goods_tags

### 2.6 ibuy_goods_browse

## 3 Orders

### 3.1 ibuy_orders