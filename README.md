# docker_php

#### 介绍
一个简单使用docker部署php环境

#### 软件架构
一个简单使用docker部署php环境


#### 安装教程

⚠️记得如果不是root账号需要前面加`sudo`

1. centos安装docker:
    ```bash
    1. curl -sSL https://get.daocloud.io/docker | sh
    2. yum install -y yum-utils \
      device-mapper-persistent-data \
      lvm2
    3. yum-config-manager \
    --add-repo \
    http://mirrors.aliyun.com/docker-ce/linux/centos/docker-ce.repo
    4. yum install docker-ce docker-ce-cli containerd.io
    5. systemctl start docker
    ```
2. centos安装docker-compose:
    ```bash
    1. curl -L "https://github.com/docker/compose/releases/download/1.24.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    2. chmod +x /usr/local/bin/docker-compose
    3. ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose
    测试是否安装成功：
    4. docker-compose --version
    ```


#### 使用说明

1.  xxxx
2.  xxxx
3.  xxxx

#### 参与贡献

1.  Fork 本仓库
2.  新建 Feat_xxx 分支
3.  提交代码
4.  新建 Pull Request


#### 特技

1.  使用 Readme\_XXX.md 来支持不同的语言，例如 Readme\_en.md, Readme\_zh.md
2.  Gitee 官方博客 [blog.gitee.com](https://blog.gitee.com)
3.  你可以 [https://gitee.com/explore](https://gitee.com/explore) 这个地址来了解 Gitee 上的优秀开源项目
4.  [GVP](https://gitee.com/gvp) 全称是 Gitee 最有价值开源项目，是综合评定出的优秀开源项目
5.  Gitee 官方提供的使用手册 [https://gitee.com/help](https://gitee.com/help)
6.  Gitee 封面人物是一档用来展示 Gitee 会员风采的栏目 [https://gitee.com/gitee-stars/](https://gitee.com/gitee-stars/)
