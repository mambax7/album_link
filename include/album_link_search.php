<?php
//好站連結搜尋程式
function album_link_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;
    //處理許功蓋
    if (get_magic_quotes_gpc()) {
        foreach ($queryarray as $k => $v) {
            $arr[$k] = addslashes($v);
        }
        $queryarray = $arr;
    }
    $sql = 'SELECT `link_sn`,`link_title`,`link_url`,`post_date`, `uid` FROM ' . $xoopsDB->prefix('album_link') . " WHERE enable='1'";
    if (0 != $userid) {
        $sql .= ' AND uid=' . $userid . ' ';
    }
    if (is_array($queryarray) && $count = count($queryarray)) {
        $sql .= " AND ((`link_title` LIKE '%{$queryarray[0]}%'  OR `link_desc` LIKE '%{$queryarray[0]}%' )";
        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";
            $sql .= "(`link_title` LIKE '%{$queryarray[$i]}%' OR  `link_desc` LIKE '%{$queryarray[$i]}%' )";
        }
        $sql .= ') ';
    }
    $sql .= 'ORDER BY  `post_date` DESC';
    $result = $xoopsDB->query($sql, $limit, $offset);
    $ret = [];
    $i = 0;
    while ($myrow = $xoopsDB->fetchArray($result)) {
        $ret[$i]['image'] = 'images/mouse.png';
        $ret[$i]['link'] = 'index.php?link_sn=' . $myrow['link_sn'];
        $ret[$i]['title'] = empty($myrow['link_title']) ? $myrow['link_url'] : $myrow['link_title'];
        $ret[$i]['time'] = strtotime($myrow['post_date']);
        $ret[$i]['uid'] = $myrow['uid'];
        $i++;
    }

    return $ret;
}
