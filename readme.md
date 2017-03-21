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