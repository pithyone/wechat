# Laravel

## 创建配置文件

``` bash
php artisan vendor:publish --provider="WeWork\Laravel\WeWorkServiceProvider"
```

## 用法

以获取 access_token 为例：

```php
app('wework')->get('token')->get();
```

使用其他应用时，改变默认设置即可，假设有一个测试应用为 `test`

```php
app()->make('wework', ['default' => 'test'])->get('token')->get();
```
