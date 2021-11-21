## 配合 vscode 在 docker 中使用 gdb 断点调试 php 代码

### 项目目录

```
./php-src
./gdb
```

```
./php-src
    ./.vscode // 编辑器配置
    ./code/a.php // 准备 debug 的 php 代码
    ./docker-compose.yml
    ./Dockerfile
    ... // php 源代码
```

```
./gdb
    ./docker-compose.yml
    ./Dockerfile
```

### 运行

```
cd php-src

git clone https://github.com/php/php-src php_source

git checkout php8.0 or php7.0... // 可以选择自己想要调试的版本

docker-compose up -d

cd ../gdb

docker-compose build gdb

docker-compose up -d gdb
```

* 主机进入 vscode，安装插件 [Remote - Container](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) 
* `COMMAND + P` 搜索 remote-containers: Attach to Running Container进入启动的`gdb_gdb_*`容器内

* 选择源代码的目录 file --> open --> `/var/www/php_source`

* 需要在容器内安装 [C/C++ 智能提示、断点调试插件](https://marketplace.visualstudio.com/items?itemName=ms-vscode.cpptools)

* start debugging，要选gdb-atach，配置文件如下
```
{
    // Use IntelliSense to learn about possible attributes.
    // Hover to view descriptions of existing attributes.
    // For more information, visit: https://go.microsoft.com/fwlink/?linkid=830387
    "version": "0.2.0",
    "configurations": [
        {
            "name": "(gdb) Launch",
            "type": "cppdbg",
            "request": "launch",
            "program": "/usr/local/bin/php",
            "args": [
                "/var/www/html/index.php"
            ],
            "stopAtEntry": true,
            "cwd": "${fileDirname}",
            "environment": [],
            "externalConsole": false,
            "MIMode": "gdb",
            "setupCommands": [
                {
                    "description": "Enable pretty-printing for gdb",
                    "text": "-enable-pretty-printing",
                    "ignoreFailures": true
                }
            ],
            "miDebuggerPath": "/usr/bin/gdb"
        }
    ]
}
```