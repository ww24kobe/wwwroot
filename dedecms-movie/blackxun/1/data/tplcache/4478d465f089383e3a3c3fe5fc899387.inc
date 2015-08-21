{dede:sppage sptype='full' sptype='full' srul='1' erul='5'}{/dede:sppage}
{dede:previewurl}http://www.7060.la/movie/22410.html{/dede:previewurl}
{dede:keywordtrim}{/dede:keywordtrim}
{dede:descriptiontrim}{/dede:descriptiontrim}
{dede:item field='title' value='' isunit='' isdown=''}
   {dede:match}<h1 title="[内容]">{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}
{dede:item field='writer' value='' isunit='' isdown=''}
   {dede:match}{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}
{dede:item field='source' value='' isunit='' isdown=''}
   {dede:match}{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}
{dede:item field='pubdate' value='' isunit='' isdown=''}
   {dede:match}{/dede:match}
   
   {dede:function}@me=GetMkTime(@me);{/dede:function}
{/dede:item}
{dede:item field='daoyan' value='' isunit='' isdown=''}
   {dede:match}<li><span>导演：</span>[内容]</li>{/dede:match}
   {dede:trim replace=''}<a([^>]*)>{/dede:trim}
{dede:trim replace=''}</a>{/dede:trim}
   {dede:function}{/dede:function}
{/dede:item}
{dede:item field='zhuyan' value='' isunit='' isdown=''}
   {dede:match}<li><span>主演：</span>[内容]</li>{/dede:match}
   {dede:trim replace=''}<a([^>]*)>{/dede:trim}
{dede:trim replace=','}</a>{/dede:trim}
   {dede:function}@me=trim(@me,',') {/dede:function}
{/dede:item}
{dede:item field='niandai' value='2010,2011,2012,2013,2014,2015' isunit='' isdown=''}
   {dede:match}<li class="leixing"><span>时间：</span>[内容]</li>{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}
{dede:item field='diqu' value='大陆,欧美,日韩,港台,其他' isunit='' isdown=''}
   {dede:match}<li><span>地区：</span>[内容]</li>{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}
{dede:item field='yuuan' value='国语,英语,韩语,粤语' isunit='' isdown=''}
   {dede:match}<li><span>语言：</span>[内容]</li>{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}
{dede:item field='pfz' value='0' isunit='' isdown=''}
   {dede:match}{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}
{dede:item field='pfrs' value='0' isunit='' isdown=''}
   {dede:match}{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}
{dede:item field='juqing' value='' isunit='1' isdown='1'}
   {dede:match}<div class="down_juqing">[内容]</div>{/dede:match}
   {dede:trim replace=''}-\d{2}-\d{2}{/dede:trim}
   {dede:function}{/dede:function}
{/dede:item}
