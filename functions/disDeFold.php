<?php
/**
 * Created by Xiangbaoyan.
 * Date: 14-2-22
 * Time: 上午8:55
 */

    function disDeFold($title){
            global $con;
     ?>
        <form action="/actions/deHtmlelemA.php" method="post" style="display:inline-block">
            <label><?php echo $title?>:</label>
            <label for="file">目标网页：</label>
            <input style="width: 400px" type="text" name="file" id="file" value="<?php echo $con['proDir']."\\"?>"/>
            <label for="sourId" style="margin-left: 50px">目标div的id：</label>
            <input type="text" id="sourId" name="id"/>
            <label for="sourClass">或者目标class(只要唯一)：</label>
            <input type="text" id="sourClass" name="class"/>
<!--                <label for="sourPage" style="margin-left: 50px">源网页地址: </label>-->
<!--                <input type="text" name="sourPage" id="sourPage" placeholder="http://www.baidu.com"/>-->
                <input type="submit" value="处理"/>
<!--            <a href="/actions/updateCssA.php" class="btn btn-primary" role="button" style="margin-left: 1000px">-->
<!--                <i class="glyphicon glyphicon-plus"></i>-->
<!--                手动去除无用的页面元素后，更新所有模块的css</a>-->
        </form>
        <hr>
<?php

    }
