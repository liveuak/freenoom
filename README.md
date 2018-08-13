# freenom：freenom域名自动续期

### 前言
众所周知，freenom是地球上唯一一个提供免费顶级域名的商家，不过需要每年续期，每次续期最多一年。由于我申请了一堆域名，而且不是同一时段申请的，
所以每次续期都觉得折腾，于是就写了这个自动续期的脚本。curl依然用的是第三方轮子[php-curl-class](https://github.com/php-curl-class/php-curl-class)，
这个轮子的作者人挺不错，回复贼快。

### 效果
![邮件示例](https://raw.githubusercontent.com/luolongfei/freenom/master/mail/images/Snipaste_2018-08-13_15-58-52.png "邮件内容")

需要科学上网才能看到效果图片。用crontab创建定时任务后，每天自动执行脚本查看域名是否需要续期，有需要续期的就续期。无论是续期成功或者失败或者脚本执行出错，都会收到的程序发出的通知邮件。如果是续期成败相关的邮件，
邮件会包括未续期域名的到期天数等内容。邮件发送功能依赖[PHPMailer](https://github.com/PHPMailer/PHPMailer/)。
话说一开始这个邮件内容的样式很丑，我调了好久，迭代了几个版本，还参考了微信发送的注销公众号的邮件样式，最终看到的这个效果还算满意了。

### 使用方法
一言以蔽之。将config.php中的freenom账号和freenom密码改为自己的，以及邮箱账户和邮箱密码也改为自己的，配置文件里都有注释，根据感觉改。
然后丢服务器上，创建crontab定时任务每天自动执行。

#### 原料准备
- 一台VPS
- 本项目源码

*在vps上安装git和lamp环境之类的我就不多赘述了，相信玩域名和vps的人都会，不会的可以去找一键脚本。*
#### clone本仓库源码
```bash
$ clone https://github.com/luolongfei/freenom.git ./
```
#### 创建crontab定时任务
```bash
1.安装crontabs以及cronie
$ yum -y install cronie crontabs

2.验证
# 验证crond是否安装及启动
$ yum list cronie && systemctl status crond
# 验证crontab是否安装
$ yum list crontabs $$ which crontab && crontab -l

3.添加任务
$ crontab -e # 打开任务表单，并编辑
# 任务内容如下
# 此任务的含义是在每天凌晨2点33分执行/data/www/freenom.feifei.ooo/路径下的index.php文件
# 注意将/data/www/freenom.feifei.ooo/替换为你自己index.php所在路径
33 2 * * * cd /data/www/freenom.feifei.ooo/; php index.php

$ systemctl restart crond # 重启crond守护进程
$ systemctl status crond # 查看当前crond状态
$ crontab -l # 查看当前计划任务列表
```
