<?php if (!defined('THINK_PATH')) exit();?><table>
<?php  foreach($attrdata as $v){ if($v['attr_type']==1){ echo "<tr><td ><a href='javascript:' onclick='copysel(this)'>[+]</a>".$v['attr_name']."</td>"; }else{ echo "<tr><td >".$v['attr_name']."</td>"; } if($v['attr_input_type']==0){ echo "<td><input type='text' name='attr[".$v['id']."]'/></td>"; }else{ $attrs = explode(',',$v['attr_value']); if($v['attr_type']==1){ echo "<td><select name='attr[".$v['id']."][]'>"; foreach($attrs as $v1){ echo "<option value='".$v1."'>".$v1."</option>"; } echo "</select>属性价格：<input type='text' size='5' name='price[".$v['id']."][]'/></td>"; }else{ echo "<td><select name='attr[".$v['id']."]'>"; foreach($attrs as $v1){ echo "<option value='".$v1."'>".$v1."</option>"; } echo "</select></td>"; } } echo "</tr>"; } ?>
</table>

<script>
function copysel(o){
    //要选择当前行
    var trs = $(o);//返回的a标签的jquery对象
    //alert(trs.html());
    //判断 
   if(trs.html()=='[+]'){
    //要完成复制当前行
        var curr_trs = trs.parent().parent();//获取当前行对象
        var new_trs=curr_trs.clone();//克隆当前行
        //新行里面的a标签里面的[+]要变成[-]
        new_trs.find('a').html('[-]');//把新行里面的[+]变成[-]
        //把新行插入到当前行的后面
        curr_trs.after(new_trs);
    }else{
         trs.parent().parent().remove(); //如果不是[+]就删除当前行。
    }
}
</script>