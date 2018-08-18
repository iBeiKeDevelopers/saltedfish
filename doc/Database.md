# Database

## 1 Users

### 1.1 ibuy_users_common

```php
[
    'id'            =>          increments,
    'nick_name'     =>          string,
    'email'         =>          string(unique),
    'password'      =>          string,
    'group'         =>          integer,
]
```

### 1.2 ibuy_users_identify

```php
[
    'id'            =>          integer(unique),
    'degree'        =>          integer(enum),
    'student_id'    =>          string,
]
```

### 1.3 ibuy_users_contact

```php
[
    'id'            =>          integer(unique),
    'college'       =>          string,
    'domitory'      =>          integer,
    'room'          =>          integer,
    'phone'         =>          string,
]
```

### 1.4 ibuy_users_extend

```php
[
    'id'            =>          integer(unique),
    'birthday'      =>          date,
    'credit'        =>          integer default 60,
]
```

## 2 Goods

### 2.1 ibuy_goods_common

```php
[
    'id'            =>          increments,
    'title'         =>          string,
    'owner'         =>          integer,
    'type'          =>          integer(enum),
    'status'        =>          integer(enum),
    'cost'          =>          float(money),
    'fee'           =>          float(money),
    'remain'        =>          integer,
    'description'   =>          text,
    'category'      =>          string,
]
```

### 2.2 ibuy_goods_image

```php
[
    'id'            =>          increments,
    'gid'           =>          integer,
    'src'           =>          string,
]
```

### 2.3 ibuy_goods_comments

```php
[
    'id'            =>          increments,
    'gid'           =>          integer,
    'uid'           =>          integer,
    'uname'         =>          string,
    'avatar'        =>          string,
    'content'       =>          text,
]
```

### 2.4 ibuy_goods_tags

```php
[
    'id'            =>          increments,
    'name'          =>          string,
    'heat'          =>          integer default 0,
]
```

### 2.5 ibuy_goods_browse

```php
[
    'id'            =>          integer,
    'heat'          =>          integer,
    'view'          =>          integer,
]
```

## 3 Orders

### 3.1 ibuy_orders_common

```php
[
    'id'            =>          incremment,
    'gid'           =>          integer,
    'uid'           =>          integer,
    'status'        =>          integer,
]
```