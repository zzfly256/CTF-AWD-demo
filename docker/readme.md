# 靶机使用方法

## 构建镜像

- 修改 pusher.js，为每个靶机配置 Pusher 环境

`docker build -t awd-web:server1 .`

## 开启容器

- 80 以及 22 端口将会被转发
- 默认用户名密码 root 123456

`docker run -P -d awd-web:server1`