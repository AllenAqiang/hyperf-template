# 介绍

Hyperf-template 基于Hyperf v1.1 框架的开发模版

## 使用

    composer update

## 介绍

    基于hyperf-skeleton进行了改装。
    加入了：
    1. jwt鉴权：支持单点登录、多点登录、支持注销token(token会失效)、支持刷新token  
    详细点击 https://github.com/PHP-OPEN-HUB/hyperf-jwt
    
    2. 常用方法的封装：包括api响应，快速抛出异常，入消息队列等（在app/Helper/Functions.php）
    
    3. 常用枚举类
    
    4. 异常处理：业务层抛出异常和异常捕获处理
    
    5. 封装了验证器：在controller更方便的去使用验证器
    
    6. Model层分级处理： Entity -> Dao -> Logic -> Service
    
    7. Http下包含Controller 和 Middleware文件
    
##  目的

    封装的都是基础组件，让开发者更快速上手使用hyperf框架。