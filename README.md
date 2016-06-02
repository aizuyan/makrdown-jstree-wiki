# 缩进菜单格式化为jstree使用的json格式

```
基础,dir
    获取ThnikPHP,file
    环境需求,dir
        为什么环境要这么搞,file
        试试新的环境,file
    目录结构,file
配置,dir
    配置格式,file
    配置加载,file
    读取配置,file
```

上面的菜单是不是很很简练，转化为jstree可以使用的json数据格式：

`[{"text":"基础","a_attr":{"md_to_jstree":"dir"},"icon":"glyphicon glyphicon-folder-open","children":[{"text":"获取ThnikPHP","a_attr":{"md_to_jstree":"file"},"icon":"glyphicon glyphicon-file"},{"text":"环境需求","a_attr":{"md_to_jstree":"dir"},"icon":"glyphicon glyphicon-folder-open","children":[{"text":"为什么环境要这么搞","a_attr":{"md_to_jstree":"file"},"icon":"glyphicon glyphicon-file"},{"text":"试试新的环境","a_attr":{"md_to_jstree":"file"},"icon":"glyphicon glyphicon-file"}]},{"text":"目录结构","a_attr":{"md_to_jstree":"file"},"icon":"glyphicon glyphicon-file"}]},{"text":"配置","a_attr":{"md_to_jstree":"dir"},"icon":"glyphicon glyphicon-folder-open","children":[{"text":"配置格式","a_attr":{"md_to_jstree":"file"},"icon":"glyphicon glyphicon-file"},{"text":"配置加载","a_attr":{"md_to_jstree":"file"},"icon":"glyphicon glyphicon-file"},{"text":"读取配置","a_attr":{"md_to_jstree":"file"},"icon":"glyphicon glyphicon-file"}]}]`

格式化为数组为：

```
Array
(
    [0] => Array
        (
            [text] => 基础
            [a_attr] => Array
                (
                    [md_to_jstree] => dir
                )

            [icon] => glyphicon glyphicon-folder-open
            [children] => Array
                (
                    [0] => Array
                        (
                            [text] => 获取ThnikPHP
                            [a_attr] => Array
                                (
                                    [md_to_jstree] => file
                                )

                            [icon] => glyphicon glyphicon-file
                        )

                    [1] => Array
                        (
                            [text] => 环境需求
                            [a_attr] => Array
                                (
                                    [md_to_jstree] => dir
                                )

                            [icon] => glyphicon glyphicon-folder-open
                            [children] => Array
                                (
                                    [0] => Array
                                        (
                                            [text] => 为什么环境要这么搞
                                            [a_attr] => Array
                                                (
                                                    [md_to_jstree] => file
                                                )

                                            [icon] => glyphicon glyphicon-file
                                        )

                                    [1] => Array
                                        (
                                            [text] => 试试新的环境
                                            [a_attr] => Array
                                                (
                                                    [md_to_jstree] => file
                                                )

                                            [icon] => glyphicon glyphicon-file
                                        )

                                )

                        )

                    [2] => Array
                        (
                            [text] => 目录结构
                            [a_attr] => Array
                                (
                                    [md_to_jstree] => file
                                )

                            [icon] => glyphicon glyphicon-file
                        )

                )

        )

    [1] => Array
        (
            [text] => 配置
            [a_attr] => Array
                (
                    [md_to_jstree] => dir
                )

            [icon] => glyphicon glyphicon-folder-open
            [children] => Array
                (
                    [0] => Array
                        (
                            [text] => 配置格式
                            [a_attr] => Array
                                (
                                    [md_to_jstree] => file
                                )

                            [icon] => glyphicon glyphicon-file
                        )

                    [1] => Array
                        (
                            [text] => 配置加载
                            [a_attr] => Array
                                (
                                    [md_to_jstree] => file
                                )

                            [icon] => glyphicon glyphicon-file
                        )

                    [2] => Array
                        (
                            [text] => 读取配置
                            [a_attr] => Array
                                (
                                    [md_to_jstree] => file
                                )

                            [icon] => glyphicon glyphicon-file
                        )

                )

        )

)
```
