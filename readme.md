# evaluation

## 安装

    1. 在自己喜欢的目录git clone

    2. 百度 下载composer,建议官网下载windows的msi版本

    3. 安装composer，换源或者翻墙随意

    4. 通过git bash进入evaluation项目文件夹，执行composer install

    5. 复制.env.sample->.env,修改里面的内容

    6. 确认bash可执行php命令，否则百度将php bin 目录添加到环境变量中

    7. 执行php artisan migrate

    8. 注意evaluation/public 才是业务代码，所以应该浏览器访问evaluation/public/index.php，或者建立alias对应

    9. 通过浏览器访问evaluation项目，看报错，dubug，一般情况下，会提示缺少evaluation/storage/log什么东西的，在对应位置建立文件夹即可。

## nginx配置

```conf
server {
    listen       80;
    server_name  54.gg ; #hosts里自己设置一个就好了
    root   "d:/Gitwork/evaluation"; #文件夹根目录

    location / {
        alias "d:/Gitwork/evaluation/public/"; #public目录
        if (!-f $request_filename) {
            rewrite ^(.*)$ /public/index.php?$query_string;
        }
        index  index.html index.htm index.php;
        autoindex  on;
    }
    location ~ \.php(.*)$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_split_path_info ^(.+/.php)(/.+)$;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        fastcgi_param  PATH_INFO  $fastcgi_path_info;
        fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
        include        fastcgi_params;
    }

}
```

修改完配置要重启nginx
