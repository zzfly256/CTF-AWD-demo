# 基于 Swoole 构建的 CTF AWD 比赛环境搭建与实践

Author: Rytia

Date: 20190427

Blog: www.zzfly.net

## 背景

受学校老师邀请，为学弟学妹举办分享会介绍 AWD 相关经验，本人一时头脑风暴采用 PHP 的 `Swoole` 扩展搭建了比赛的环境，将分享会变成了友谊赛。

## 项目文件介绍

- server：AWD 中心服务器，运行于 docker 母机，负责根据提供每个回合的 flag：flag3
  - getFlag 文件为 php 可执行文件，根据 `docker ps` 命令中的启动的容器的 ip，为容器生成不同的 flag 并保存为 `flags.json`
  - server 文件为 php 可执行文件，监听 `80` 端口，根据不同回合返回 `flags.json` 文件中的相应值
  - flags.json 保存生成的 flag 
- pusher：`Pusher.js` 的服务端，运行于 `docker` 母鸡或任何一台电脑。关于 pusher 的介绍可移步官网：www.pusher.com
  - pusher-admin 文件为 php 可执行文件，为赛题中管理员用户推送消息（供选手窃听 `websocket`，包含一个 flag ：flag2）
  - pusher-user 文件为 php 可执行文件，为赛题中(ID为 2 )的普通注册用户推送消息（包含一个 flag ： flag1）
  - monitor 文件为 php 可执行文件，用于监控选手靶机是否存活（监控 web 服务/ `pusher.js` 文件大小）
  - pusher-server 文件为 php 可执行文件，按照回合（时间）推送消息以及存活检测
  - getFlag 文件为 php 可执行文件，生成管理员消息（flag2）所用
  - pusher-key.json 保存各个靶机的 `pusher` 密钥，以及 flag2 的值（flag1的值为固定值，每个选手一样）
- web：比赛赛题企业网站部分， 是为 `laravel 5.8` 框架，采用 `sqlite` 数据库
  - 业务逻辑主要在 `/app/Http/Controllers/HomeController.php` 
  - 视图文件在 `/resources/views` 目录下
- docker：靶机 docker 镜像

## 更多

更多关于本项目的介绍，可以移步：http://www.zzfly.net/build-a-ctf-awd-platform-by-swoole/
