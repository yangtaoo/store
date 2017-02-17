<?php

class Helper extends CController {

    public static function truncate_utf8_string($string, $length, $etc = '...') {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++) {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0')) {
                if ($length < 1.0) {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            } else {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen) {
            $result .= $etc;
        }
        return $result;
    }

    /**
     * 生成页码
     * @param integer $page     当前页码.
     * @param integer $pageSize 每页条数 .
     * @param integer $total    总记录数.
     * @return string.
     */
    public static function creagePageBar($page = 1, $pageSize = 10, $total = 0) {
        $pageNum   = ceil($total / $pageSize);
        $start     = ($page - 1) * $pageSize;
        $start     = $start < 0 ? 0 : $start;
        $pageStart = $page - 1;
        $pageStart = $pageStart < 1 ? 1 : $pageStart;
        $pageEnd   = $pageStart + 2;
        $pageEnd   = $pageEnd > $pageNum ? $pageNum : $pageEnd;
        $param     = '';
        foreach ($_GET as $key => $val) {
            if ($key == 'page') {
                continue;
            }

            $param .= '&' . $key . '=' . Yii::app()->request->getParam($key, ""); //调用公用方法获取参数，方便过滤
        }
        $param .= empty($param) ? '' : '&' . $param;

        $html = '<div class="row"><div class="fl"><div class="dataTables_info" id="example_info">显示第 ' . ($start + 1) . ' 到 ' . ($start + $pageSize) . ' 条，共 ' . $total . ' 条</div></div><div class="fr"><div class="dataTables_paginate paging_bootstrap">';
        if ($pageNum > 1) {
            $html .= '<ul class="pagination">';

            //上一页逻辑
            $html .= $page > 1 ? '<li class="prev"><a href="?page=' . ($page - 1) . $param . '">← 上一页</a></li>' : '<li class="prev disabled"><a href="#">← 上一页</a></li>';
            //第一页逻辑
            $html .= $pageStart > 1 ? '<li' . ($page == 1 ? ' class="active"' : '') . '><a href="?page=1' . $param . '">1</a></li>' : '';
            //省略页码逻辑
            $html .= $pageStart > 2 ? '<li class="disabled"><span>...</span></li>' : '';
            //循环页码
            while ($pageStart <= $pageEnd) {
                $html .= '<li' . ($page == $pageStart ? ' class="active"' : '') . '><a href="?page=' . $pageStart . $param . '">' . $pageStart . '</a></li>';
                $pageStart++;
            }
            //省略页码逻辑
            $html .= $pageEnd < $pageNum - 1 ? '<li class="disabled"><span>...</span></li>' : '';
            //最后一页逻辑
            $html .= $pageEnd < $pageNum ? '<li' . ($page == $pageNum ? ' class="active"' : '') . '><a href="?page=' . $pageNum . $param . '">' . $pageNum . '</a></li>' : '';
            //下一页逻辑
            $html .= $page == $pageNum ? '<li class="next disabled"><a href="#">下一页 → </a></li>' : '<li class="next"><a href="?page=' . ($page + 1) . $param . '">下一页 → </a></li>';
            $html .= '</ul>';
        }
        $html .= '</div></div></div>';
        return $html;
    }

    /**
     * xml格式化数据
     * @param array             $array 参数.
     * @param SimpleXMLExtended $xml   xml对象
     * @return xml
     */
    public static function array2xml($array, $xml = false) {
        if ($xml === false) {
            $xml = new SimpleXMLExtended('<xml/>');
        }
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                array2xml($value, $xml->addChild($key));
            } else {
                $xml->$key = NULL;
                $xml->$key->addCData($value);
            }
        }
        return $xml->asXML();
    }

    /**
     * 获取IP地址
     *
     * @return string
     */
    public static function getIp() {
        $cip = '-';
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        } else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (!empty($_SERVER["REMOTE_ADDR"])) {
            $cip = $_SERVER["REMOTE_ADDR"];
        } else {
            $cip = "无法获取！";
        }
        return $cip;
    }

    /**
     * 图片上传
     * @param type $tmpFile
     * @param type $targetId
     * @param type $uploadType
     * @return array
     */
    public static function uploadImg($tmpFile, $targetId, $uploadType = 'productimg') {
        $status = array(
            'status'  => false,
            'message' => '',
        );
        $savePath   = '/upload/' . $uploadType;
        $attach_dir = BASE_PATH . $savePath;
        if (!is_dir($attach_dir)) {
            @mkdir($attach_dir, 0777, true);
        }
        $savePath .= '/' . $targetId . '/';
        $attach_dir = BASE_PATH . $savePath;
        if (!is_dir($attach_dir)) {
            @mkdir($attach_dir, 0777, true);
        }
        if ($tmpFile['name'] != '') {
            $tmp_file   = $tmpFile['tmp_name'];
            $file_types = explode(".", $tmpFile['name']);
            $file_type  = $file_types[count($file_types) - 1];
            if (strtolower($file_type) != "jpg" && strtolower($file_type) != "jpeg" && strtolower($file_type) != "gif" && strtolower($file_type) != "bmp" && strtolower($file_type) != "png") {
                $status['message'] = '上传文件格式错误';
                return $status;
            }
            $file_name = uniqid(time()) . "." . $file_type;
            if (!copy($tmp_file, $attach_dir . $file_name)) {
                $status['message'] = '上传错误请重试';
                return $status;
            } else {
                $status['status']  = true;
                $status['message'] = $savePath . $file_name;
                return $status;
            }
        } else {
            $status['message'] = '无文件上传';
            return $status;
        }
    }

    /**
     * excel文件
     * @param type $tmpFile
     * @param type $targetId
     * @param type $uploadType
     * @return array
     */
    public static function uploadExcel($tmpFile, $targetId = 'source', $uploadType = 'excel') {
        $status = array(
            'status'  => false,
            'message' => '',
        );
        $savePath   = '/upload/' . $uploadType;
        $attach_dir = BASE_PATH . $savePath;
        if (!is_dir($attach_dir)) {
            @mkdir($attach_dir, 0777);
        }
        $savePath .= "/" . $targetId;
        $attach_dir = BASE_PATH . $savePath;
        if (!is_dir($attach_dir)) {
            @mkdir($attach_dir, 0777);
        }
        if ($tmpFile['name'] != '') {
            $tmp_file   = $tmpFile['tmp_name'];
            $file_types = explode(".", $tmpFile['name']);
            $file_type  = $file_types[count($file_types) - 1];
            if (strtolower($file_type) != "xls" && strtolower($file_type) != "xlsx") {
                $status['message'] = '上传文件格式错误' . $file_type;
                return $status;
            }
            $file_name = $targetId . "." . $file_type;
            if (!copy($tmp_file, $attach_dir . '/' . $file_name)) {
                $status['message'] = '上传错误请重试';
                return $status;
            } else {
                $status['status']  = true;
                $status['message'] = $savePath . '/' . $file_name;
                return $status;
            }
        } else {
            $status['message'] = '无文件上传';
            return $status;
        }
    }

    /**
     * 获取日历数据
     * @param integer $dayNum 要获取的天数
     */
    public static function getDateList($dayNum = 10) {
        $startDate = time();
        $result    = array();
        $weekArray = array("日", "一", "二", "三", "四", "五", "六");
        for ($i = 0; $i < $dayNum; $i++) {
            $result[] = array(
                'day'  => date('d', $startDate),
                'week' => $weekArray[date('w', $startDate)],
                'date' => date('Y-m-d', $startDate),
            );
            $startDate += 86400;
        }
        return $result;
    }

    /**
     * 记录日志
     * @param string $file    日志文件
     * @param string $content 日志内容
     */
    public static function logToFile($file, $content) {
        $fp = fopen($file, "a");
        flock($fp, LOCK_EX);
        fwrite($fp, "执行日期：" . strftime("%Y-%m-%d-%H：%M：%S", time()) . "\n" . $content . "\n\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    /**
     * 生成加密密码串
     *
     * @param string $pwd  真实密码.
     * @param string $salt 盐.
     *
     * @return string
     */
    public static function getTruePassWord($pwd, $salt) {
        return hash_hmac('SHA256', $pwd, $salt);
    }

    /**
     * 获得一个随机的盐
     */
    public static function getSalt() {
        $str = md5(time());
        $str = substr($str, 0, rand(1, 32));
        return substr(md5($str), 0, rand(1, 32));
    }

}
