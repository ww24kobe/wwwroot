<?php if (!defined('THINK_PATH')) exit();?><table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>属性名称</th>
                <th>商品类型</th>
                <th>属性值录入方式</th>
                <th>可选值列表</th>
                <th>操作</th>
            </tr>
            <?php  $i=0; foreach($attrdata as $v) {?>
            <tr>
                <td align="center"><?php  echo ++$i;?></td>
                <td align="center" class="first-cell"><span><?php  echo $v['attr_name'];?></span></td>
                <td align="center"><span onclick=""><span><?php  echo $v['type_name'];?></span></td>
                <td align="center"><span><?php  echo $v['attr_input_type']?'列表选择':'手工输入';?></span></td>
                <td align="center"><span><?php  echo $v['attr_value'];?></span></td>
                <td align="center">
                <a href="__GROUP__/Attribute/edit/id/<?php  echo $v['id'];?>" title="编辑"><img src="__AIMG__/icon_edit.gif" width="16" height="16" border="0" /></a>
                <a href="__GROUP__/Attribute/del/id/<?php  echo $v['id'];?>" onclick="return confirm('确认删除此属性?');" title="回收站"><img src="__AIMG__/icon_trash.gif" width="16" height="16" border="0" /></a>
                </td>
            </tr>
            <?php  }?>
        </table>

    <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            
        </table>