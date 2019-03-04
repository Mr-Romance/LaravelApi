<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## PhpStorm 需要以下扩展

- Laravel-plugin
- [laravel-help](https://github.com/barryvdh/laravel-ide-helper) 创建本地文件，增强 IDE 自动代码提示


### 常用IDE增强命令
- php artisan ide-helper:models "App\Models\User"

### 开发注意点
- 文件上传请阅读“文件存储”部分
- 如果你修改了类的命名空间，注意修改auth对user的引用同步修改
- 使用数据填充，你需要先 composer dump-autoload，要注意数据表填充的顺序为categories--users--topics



