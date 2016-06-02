<?php
/**
 * @描述    这个类的作用是将以tab（4个空格）缩进的的菜单树转换为jstree渲染所需的json格式
 * @作者    燕睿涛
 * @邮箱    ritoyan@163.com
 *
 * @例子
 *  基础
 *      获取ThnikPHP
 *      环境需求
 *      目录结构
 *  配置
 *      配置格式
 *      配置加载
 *      读取配置
 *
 * 上面的缩进目录解析之后为
 *
 * [
 *   {
 *     text": "配置错误",
 *     "icon": "glyphicon glyphicon-remove",
 *     "children": [
 *       {
 *         "text": "配置错误",
 *         "icon": "glyphicon glyphicon-remove"
 *       },
 *       {
 *         "text": "配置错误",
 *         "icon": "glyphicon glyphicon-remove"
 *       },
 *       {
 *         "text": "配置错误",
 *         "icon": "glyphicon glyphicon-remove"
 *       }
 *     ]
 *   },
 *   {
 *     "text": "配置错误",
 *     "icon": "glyphicon glyphicon-remove",
 *     "children": [
 *       {
 *         "text": "配置错误",
 *         "icon": "glyphicon glyphicon-remove"
 *       },
 *       {
 *         "text": "配置错误",
 *         "icon": "glyphicon glyphicon-remove"
 *       },
 *       {
 *         "text": "配置错误",
 *         "icon": "glyphicon glyphicon-remove"
 *       }
 *     ]
 *   }
 * ]
 *
 */

class menuJson
{
    private $fd = null;

    private $json = "";

    private $delimiter = ",";

    private $mytype = "md_to_jstree";

    private $isInChildren = [];

    private $types = [
        "dir" => "glyphicon glyphicon-folder-open",
        "file" => "glyphicon glyphicon-file",
        "error" => "glyphicon glyphicon-remove",
    ];

    public function __construct($file) {
        $this->fd = fopen($file, "r");
    }

    public function __destruct() {
        $this->fd && fclose($this->fd);
    }

    public function handle() {
        $this->startArr();
        $level = false;
        $old_level = false;
        $j=0;
        while(($buf = fgets($this->fd, 1024)) !== false) {
            $level = $this->getTabLevel($buf);
            if($level === false){
                continue;
            }
            if($old_level === false) {  //初始化
                $this->startObj();
                $this->addText(trim($buf));
            } else {
                if($level == $old_level) {
                    $this->endObj();
                    $this->startObj();
                    $this->addText(trim($buf));
                } else if($level > $old_level) {
                    $this->startChild();
                    $this->startObj();
                    $this->addText(trim($buf));
                } else if($level < $old_level) {
                    if(!empty($this->isInChildren)) {
                        $this->endObj();
                        $this->endChild();
                    }
                    $this->endObj();
                    if(!empty($this->isInChildren) && $level == 0) {
                        while(!empty($this->isInChildren)) {
                            $this->endChild();
                            $this->endObj();
                        }
                    }
                    $this->startObj();
                    $this->addText(trim($buf));
                }
            }
            $old_level = $level;
        }
        $this->endObj();
        if(!empty($this->isInChildren)) {
            while(!empty($this->isInChildren)) {
                $this->endChild();
                $this->endObj();
            }
        }
        $this->json = substr($this->json, 0, -1);      
        $this->endArr();
        return $this->json;
    }

    public function startArr() {
        $this->json = $this->json . "[";
    }

    public function endArr() {
        $this->json = $this->json . "]";
    }

    public function startObj() {
        $this->json = $this->json . "{";
    }

    public function endObj() {
        $this->json = $this->json . "},";
    }

    public function startChild() {
        array_push($this->isInChildren, 1);
        $this->json = $this->json . ",\"children\":[";
    }

    public function endChild() {
        $this->json = substr($this->json, 0, -1);
        array_pop($this->isInChildren);
        $this->json = $this->json . "]";
    }
    
    public function addText($text) {
        $ret  = explode($this->delimiter, $text);
        if(count($ret) != 2) {
            $this->json = $this->json . "\"text\":\"配置错误\",";
            $this->json = $this->json . "\"icon\":\"" . $this->types["error"] . "\"";
            return false;
        }
        list($name, $type) = $ret;
        $name = trim($name);
        $type = trim($type);
        $this->json = $this->json . "\"text\":\"{$name}\",";
        $this->json = $this->json . "\"a_attr\":{\"" . $this->mytype . "\":\"$type\"},";
        $this->json = $this->json . "\"icon\":\"" . $this->types[$type] . "\"";
    }

    public function getTabLevel($line, $tab = 4) {
        $line = rtrim($line);
        if(!$line)
            return false;
        $i = 0;
        $num = 0;
        while($i < strlen($line)) {
            if($line[$i] != " ")
                break;
            $num++;
            $i++;
        }
        return floor($num/$tab);
    }
}
