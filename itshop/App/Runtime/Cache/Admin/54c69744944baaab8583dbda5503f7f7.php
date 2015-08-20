<?php if (!defined('THINK_PATH')) exit();?><table >
  <tr style="color:red; background-color:pink">
    <th>商品名</th>
    <th>缩略图</th>
    <th>价格</th>
    <th>数量</th>
    <th>小计</th>
  </tr>
  <?php foreach($goodsdata as $v){ ?>
  <tr style="background-color:#6bd534">
    <td width="20%" align='center'><?php  echo $v['goods_name'];?></td>
    <td width="20%" align='center'><img src="__UPLOAD__/<?php  echo $v['goods_thumb'];?>"/></td>
    <td width="20%" align='center'>￥<?php  echo $v['shop_price'];?>元</td>
    <td width="20%" align='center'><?php  echo $v['goods_number'];?></td>
    <td width="20%" align='center'>￥<?php  echo $v['shop_price']*$v['goods_number'];?>元</td>
  </tr>
  <?php }?>
</table>