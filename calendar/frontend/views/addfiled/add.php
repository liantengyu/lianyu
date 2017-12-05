<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


?>
<meta charset="utf8">

<style>
	table{ border-collapse: collapse; border: 1px solid #ddd; width: 800px; margin: 0 auto;margin-top: 50px; background: rgba(121, 217, 221, 0.4); color: #666}
	table tr{ height: 40px;}
	table td{ border: 1px solid #ddd; text-align: center}

	*{margin: 0; padding:0 ; font-family: 微软雅黑}
	a{ text-decoration: none; color: #666;}
	ul{ list-style: none}

	.top{ width: 100%; background: rgba(14, 196, 210, 0.99); color: #fff; height: 100px; line-height: 150px; text-align: right;}
	.top span{ margin-right: 20px}


	.left{ width: 260px; float: left; height: 100%; background: rgba(121, 217, 221, 0.4)}
	.left ul{ list-style: none; width: 100%;}
	.left ul li{ height: 40px; width: 100%; border: 1px solid #ddd; line-height: 40px; text-align: center;}
	.left .selected{ background: rgba(14, 196, 210, 0.99);}
	.left .selected a{ color: #fff;}


	.right{ float: left; width: 1000px;}
	.search-box{ width: 900px; margin: 0 auto; margin-top: 100px; }
	.right li{
	    margin-top: 20px;
	}
	.right span{
	    display: inline-block;
	    width: 200px;
	    line-height: 40px;
	    height: 40px;
	    text-align: right;
	    margin-right: 20px;
	}

	.right .filed-name{
	    width: 300px;
	    line-height: 40px;
	    height: 40px;
	    border: 1px solid #ddd;
	    border-radius: 3px;
	    font-size: 14px;
	}

	.right .length{
	    width: 140px;
	    line-height: 40px;
	    height: 40px;
	    border: 1px solid #ddd;
	    border-radius: 3px;
	    font-size: 14px;
	}

	.submit{
	    width: 150px;
	    height: 40px;
	    line-height: 40px;
	    border-radius: 3px;
	    border: 1px solid #ddd;
	    display: inline-block;
	    background: rgba(14, 196, 210, 0.99);
	    color: #fff;
	    text-align: center;
	    margin-left: 200px;
	    margin-top: 20px;
	}
</style>

<div class="top">
    <span>欢迎管理员：admin</span>
</div>

<div class="left">
    <ul>
        <li class="selected"><a href="<?=Url::toRoute(['addfiled/list']) ?>">查看注册字段</a></li>
        <li><a href="<?=Url::toRoute(['addfiled/add']) ?>">添加注册字段</a></li>
    </ul>
</div>

<div class="right">
    <div class="search-box">
	        <?=Html::beginForm(['addfiled/add_edit'],'post');?>
	           <ul>
	            <?php if (!$data): ?>
            	    <li>
	                    <span>请输入字段名称：</span>
	                    <input class="filed-name" type="text" name="name" >
	                </li>
	                <li>
	                    <span>请输入字段默认值：</span>
	                    <input class="filed-name" type="text" name="default">
	                </li>
	                <li>
	                    <span>请选择字段类型：</span>
	                    <select name="cat" id="">
	                        <option value="input-text">文本框</option>
	                        <option value="input-radio">单选框</option>
	                        <option value="input-password">密码框</option>
	                        <option value="textarea">文本域</option>
	                    </select>
	                </li>
	                <!-- <li>
	                    <span>请填写字段选项：</span>
	                    <input type="text" class="filed-name" name="option1" placeholder="选项1">
	                    <input type="text" class="filed-name" name="option2" placeholder="选项2">
	                </li> -->
	                <li>
	                    <span>是否必填：</span>
	                    <input type="checkbox" value="1" name="is_must">必填
	                </li>
	                <li>
	                    <span>请选择验证规则：</span>
	                    <select name="rule" id="">
	                        <option value="">无</option>
	                        <option value="phone">手机号码</option>
	                        <option value="length">长度</option>
	                    </select>
	                </li>
	                <li>
	                    <span>请选择填写长度范围：</span>
	                    <input class="length" type="text" name="min" value="" placeholder="请输入最小长度">
	                    ~
	                    <input class="length" type="text" name="max" value="" placeholder="请输入最大长度">
	                </li>
	            <?php else: ?>
	            	<input type="hidden" name="filed_id" value="<?=$data['id'] ?>">
            	    <li>
	                    <span>请输入字段名称：</span>
	                    <input class="filed-name" type="text" name="name" value="<?=$data['name'] ?>">
	                </li>
	                <li>
	                    <span>请输入字段默认值：</span>
	                    <input class="filed-name" type="text" name="default" value="<?=$data['default'] ?>" >
	                </li>
	                <li>
	                    <span>请选择字段类型：</span>
	                    <select name="cat" id="">
	                        <option value="input-text">文本框</option>
	                        <option value="input-radio">单选框</option>
	                        <option value="input-password">密码框</option>
	                        <option value="textarea">文本域</option>
	                    </select>
	                </li>
	                <!-- <li>
	                    <span>请填写字段选项：</span>
	                    <input type="text" class="filed-name" name="option1" placeholder="选项1">
	                    <input type="text" class="filed-name" name="option2" placeholder="选项2">
	                </li> -->
	                <li>
	                    <span>是否必填：</span>
	                    <?php if ($data['is_must'] == 1): ?>
	                    	<input type="checkbox" value="1" name="is_must" checked>必填
	                    <?php else: ?>
	                    	<input type="checkbox" value="1" name="is_must">必填
	                    <?php endif ?>
	                </li>
	                <li>
	                    <span>请选择验证规则：</span>
	                    <select name="rule" id="">
	                        <option value="">无</option>
	                        <option value="phone">手机号码</option>
	                        <option value="length">长度</option>
	                    </select>
	                </li>
	                <li>
	                    <span>请选择填写长度范围：</span>
	                    <input class="length" type="text" name="min" value="<?=$data['min'] ?>" placeholder="请输入最小长度">
	                    ~
	                    <input class="length" type="text" name="max" value="<?=$data['max'] ?>" placeholder="请输入最大长度">
	                </li>
	            <?php endif ?>
                <li>
                    <?=Html::submitButton('提交',['class'=>'submit']);?>
                </li>
            </ul>
        <?=Html::endForm()?>
    </div>
</div>