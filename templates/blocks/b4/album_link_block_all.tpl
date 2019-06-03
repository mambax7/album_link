<{if $block.display_type=='list'}>
    <{foreach from=$block.data item=cate}>
        <{if $cate.item}>
            <{if $block.show_title=='1'}>
                <h4><a href="<{$xoops_url}>/modules/album_link/index.php?cate_sn=<{$cate.cate_sn}>" style="text-shadow:1px 1px 1px #aaaaaa;"><{$cate.cate_title}></a></h4>
            <{/if}>
            <ul class="vertical_menu">
            <{foreach from=$cate.item item=link}>
                <li>
                    <i class="fa fa-external-link-square" aria-hidden="true"></i>
                    <a href="<{$link.val}>" target="_blank">
                    <{$link.link_title}></a>
                </li>
            <{/foreach}>
            </ul>
        <{/if}>
    <{/foreach}>
<{else}>
    <{foreach from=$block.data item=cate}>
        <select onChange="<{$cate.link_js}>" style='background-color:<{$cate.color}>;' class="form-control">
            <option value=""><{$cate.cate_title}></option>
            <{foreach from=$cate.item item=link}>
                <option value='<{$link.val}>'>
                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                    <{$link.link_title}>
                </option>
            <{/foreach}>
        </select>
    <{/foreach}>
<{/if}>
