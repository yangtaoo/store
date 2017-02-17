<?php
/**
 * 分页类组件.
 *
 * @author Yao Jian <1400310011@qq.com>
 */

/**
 * 分页类.
 */
class Pagination
{

    /**
     * 生成翻页条.
     *
     * @param integer $page     当前页.
     * @param integer $cnt      总条数.
     * @param integer $pagecnt  总页数.
     * @param integer $pageSize 每页条数.
     * @param string  $url      基准URL.
     * @param array   $data     参数数组.
     *
     * @return string 翻页条.
     */
    public static function make($page, $cnt, $pagecnt, $pageSize, $url, array $data = array())
    {
        $url .= '?';
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    $url .= '&'.$key.'='.$v;
                }
            } else {
                $url .= '&'.$key.'='.$value;
            }
        }
        $page_prev = $page > 1 ? $page - 1 : 1;
        $page_next = $page < $pagecnt ? $page + 1 : $pagecnt;

        $buttonCount = 3;

        $html = '<div class="pages">';
        $html .= '<div class="fl">每页'.$pageSize.'条，共计'.$cnt.'条，'.$pagecnt.'页</div><div class="fr">';
        $html .= '<a href="'.$url.'&page='.$page_prev.'" class="a_prev"><i  class="ico"></i>上一页</a>';
        if ($page > 1) {
            for ($i = $page - $buttonCount; $i < $page; $i++) {
                if ($i < 1) {
                    continue;
                }
                $html .= '<a href="'.$url.'&page='.$i.'">'.$i.'</a>';
            }
        }
        $html .= '<a href="'.$url.'&page='.$page.'" class="hover">'.$page.'</a>';
        if ($page < $pagecnt) {
            for ($i = $page + 1; $i < $page + $buttonCount; $i++) {
                $html .= '<a href="'.$url.'&page='.$i.'">'.$i.'</a>';
                if ($i == $pagecnt) {
                    break;
                }

            }
        }
        $html .= '<a href="'.$url.'&page='.$page_next.'" class="a_next">下一页<i class="ico"></i></a>';
        $html .= '</div><div class="clear"></div></div>';
        return $html;
    }

    /**
     * 生成翻页条.
     *
     * @param integer $page     当前页.
     * @param integer $cnt      总条数.
     * @param integer $pagecnt  总页数.
     * @param integer $pageSize 每页条数.
     * @param string  $url      基准URL.
     * @param array   $data     参数数组.
     *
     * @return string 翻页条.
     */
    public static function makeForOwner($page, $cnt, $pagecnt, $pageSize, $url, array $data = array())
    {
        $url .= '?';
        $html = '<div class="pages">';
        $html .= '<div class="fl">每页</div>';
        $html .= '<dl class="select sl2">';
        $html .= '<dt>'.$pageSize.'条</dt>';
        $html .= '<dd>';
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    $url .= '&'.$key.'='.$v;
                }
            } else {
                $url .= '&'.$key.'='.$value;
            }
        }
        $html .= '<ul>';
        $html .= '<li><a href="'.$url.'&pageSize=10">10条</a></li>';
        $html .= '<li><a href="'.$url.'&pageSize=20">20条</a></li>';
        $html .= '<li><a href="'.$url.'&pageSize=30">30条</a></li>';
        $html .= '</ul>';
        $html .= '</dd>';
        $html .= '</dl>';
        $page_prev = $page > 1 ? $page - 1 : 1;
        $page_next = $page < $pagecnt ? $page + 1 : $pagecnt;

        $buttonCount = 3;
        
        $html .= '<div class="fl">共计'.$cnt.'条，'.$pagecnt.'页</div><div class="fr">';
        $html .= '<a href="'.$url.'&page='.$page_prev.'" class="a_prev"></a>';
        if ($page > 1) {
            for ($i = $page - $buttonCount; $i < $page; $i++) {
                if ($i < 1) {
                    continue;
                }
                $html .= '<a href="'.$url.'&page='.$i.'">'.$i.'</a>';
            }
        }
        $html .= '<a href="'.$url.'&page='.$page.'" class="hover">'.$page.'</a>';
        if ($page < $pagecnt) {
            for ($i = $page + 1; $i < $page + $buttonCount; $i++) {
                $html .= '<a href="'.$url.'&page='.$i.'">'.$i.'</a>';
                if ($i == $pagecnt) {
                    break;
                }
            }
        }
        $html .= '<a href="'.$url.'&page='.$page_next.'" class="a_next"></a>';
        $html .= '</div><div class="clear"></div></div>';
        return $html;
    }

}
