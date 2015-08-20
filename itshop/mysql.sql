-- 创建数据库
create  database itshop charset  utf8;
use  itshop;
set  names  gbk;
-- 类型表
create  table  it_goods_type(
id  tinyint  unsigned  primary  key  auto_increment,
type_name varchar(32) not null 
)charset  utf8;

--属性表
create table it_attrbute();

--栏目表
create  table  it_category();