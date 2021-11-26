# docker_php

#### 介绍
一个简单使用docker部署php环境


#### 目录结构

```bash
.
├── data                           数据目录
│   ├── mysql                      MySQL数据目录
│   └── redis                      Redis数据目录
├── log                            日志目录 
│   ├── nginx                      Nginx日志目录 
│   └── php                        PHP日志目录
├── services                       程序目录（含配置文件）
│   ├── mysql                      MySQL配置文件
│   ├── nginx                      Nginx程序目录（含配置文件）
│   ├── php                        PHP程序目录（含配置文件）
│   ├── php_extensions             PHP扩展程序目录
│   └── redis                      Redis数据目录
├── www                            PHP代码程序
├── docker-compose.yml.example     Docker服务配置示例文件 
└── env.example                    环境配置示例文件
```


#### 安装教程

⚠️记得如果不是root账号需要前面加`sudo`

1. CentOS 7.6安装docker:
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
2. CentOS 7.6安装docker-compose:
    ```bash
    1. curl -L "https://github.com/docker/compose/releases/download/1.24.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    2. chmod +x /usr/local/bin/docker-compose
    3. ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose
    测试是否安装成功：
    4. docker-compose --version
    ```
3. 拷贝并命名配置文件（Windows系统请用`copy`命令），启动：
    ```bash
    $ cd dnmp                                            # 进入项目目录
    $ cp env.example .env                                # 复制环境变量文件
    $ cp docker-compose.yml.example docker-compose.yml   # 复制 docker-compose 配置文件。默认启动3个服务：
    $ docker-compose up                                  # 启动
    ```

#### 网速太慢，无法下载或者`Get https://registry-1.docker.io/v2/`错误可以用以下方法解决

1.  切换国内镜像`$ vi /etc/docker/daemon.json`
    ```bash
    {
        // 阿里云镜像
        "registry-mirrors":["https://6kx4zyno.mirror.aliyuncs.com"]
        // 中科院镜像
        // "registry-mirrors":["https://docker.mirrors.ustc.edu.cn"]
    }
    ```
2.  重启docker和daemon
    ```bash
    systemctl daemon-reload
    systemctl restart docker
    ```
3.  继续执行`$ docker-compose up`


#### 使用说明

1.  docker-compose常用命令有：
    ```bash
    $ docker-compose up                         # 创建并且启动所有容器
    $ docker-compose up -d                      # 创建并且后台运行方式启动所有容器
    $ docker-compose up nginx php mysql         # 创建并且启动nginx、php、mysql的多个容器
    $ docker-compose up -d nginx php  mysql     # 创建并且已后台运行的方式启动nginx、php、mysql容器


    $ docker-compose start php                  # 启动服务
    $ docker-compose stop php                   # 停止服务
    $ docker-compose restart php                # 重启服务
    $ docker-compose build php                  # 构建或者重新构建服务

    $ docker-compose rm php                     # 删除并且停止php容器
    $ docker-compose down                       # 停止并删除容器，网络，图像和挂载卷
    ```
2.  可以用命令`docker exec -it`进入到容器，我们可以通过`~/.bashrc`或者`~/.zshrc`文件，
    加上`alias docker_mysql='docker exec -it mysql mysql -hlocalhost -uroot -p'`来快捷进入mysql。
    在这里记得注意的是保存后执行`source ~/.bashrc`命令。 
3.  `docker ps`命令查看所有运行中的容器，后面携带`-a`可以查看所有容器
