<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use frontend\components\TagsCloudWidget;
use frontend\components\RctReplyWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<style>
	#waterfallcontent {
		position: relative;
		display: flex;
		flex-direction: row;
		justify-content: flex-start;
		align-items: flex-start;
		flex-wrap: wrap;
	}

	#waterfallcontent .pagination {
		position: absolute;
		bottom: -70px;
		left: 470px;
	}

	form {
		position: absolute;
		display: inline-block;
		right: 20px;
		top: 5px;
	}

	.breadcrumb {
		background: rgba(255, 255, 255, 0.65);
		box-shadow: 0 8px 20px 0 rgba(31, 38, 135, 0.37);
		backdrop-filter: blur(5.0px);
		-webkit-backdrop-filter: blur(5.0px);
		border-radius: 10px;
		border: 1px solid rgba(255, 255, 255, 0.18);
		position: relative;
		height: 50px;
		line-height: 34px;
		font-size: 16px;
	}
</style>

<div class="container">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="<?= Yii::$app->homeUrl; ?>">首页</a></li>
			<li>文章列表</li>
			<form class="form-inline" action="index.php?r=post/index" id="w0" method="get">
				<div class="form-group">
					<input style="width: 400px;border:none;height:38px" type="text" class="form-control" name="PostSearch[title]" id="w0input" placeholder="请输入标题">
				</div>
				<button type="submit" class="btn btn-default">
					<svg style="width: 16px;height:16px;" t="1624862258813" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2437" width="200" height="200">
						<path d="M448.287762 896.58959a447.06983 447.06983 0 0 1-317.125025-131.15569c-174.874253-174.874253-174.874253-459.403956 0-634.26413s459.418037-174.888333 634.26413 0 174.860173 459.389876 0 634.26413a447.08391 447.08391 0 0 1-317.139105 131.15569z m0-832.525351a383.216792 383.216792 0 0 0-271.829496 112.40106C26.576106 326.347459 26.576106 570.242131 176.458266 720.124291s393.776831 149.89624 543.673072 0 149.88216-393.776831 0-543.658992A383.230872 383.230872 0 0 0 448.287762 64.064239z" fill="#FFF000" p-id="2438"></path>
						<path d="M991.960833 1023.999986a31.933559 31.933559 0 0 1-22.654804-9.391395l-181.210277-181.210277a32.03212 32.03212 0 1 1 45.295529-45.295529l181.224357 181.210277a32.0462 32.0462 0 0 1-22.654805 54.686924z" fill="#E51373" p-id="2439"></path>
					</svg>
				</button>
			</form>
		</ol>
		<div class="col-md-14" style="margin-bottom: 30px;">

			<?= ListView::widget([
				'id' => 'waterfallcontent',
				'dataProvider' => $dataProvider,
				'itemView' => '_listitem', //子视图,显示一篇文章的标题等内容.
				'layout' => '{items} {pager}',
				'pager' => [
					'maxButtonCount' => 10,
					'nextPageLabel' => Yii::t('app', '下一页'),
					'prevPageLabel' => Yii::t('app', '上一页'),
				],
			]) ?>

		</div>


		<!-- <div class="col-md-3">


			<div class="tagcloudbox">
				<ul class="list-group" style="background-color: red;">
					<li class="list-group-item" style="background-color: red;">
						<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> 标签云
					</li>
					<li class="list-group-item" style="background-color: red;">
						<?= TagsCloudWidget::widget(['tags' => $tags]) ?>
					</li>
				</ul>
			</div>


			<div class="commentbox">
				<ul class="list-group">
					<li class="list-group-item">
						<span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 最新回复
					</li>
					<li class="list-group-item">
						<?= RctReplyWidget::widget(['recentComments' => $recentComments]) ?>
					</li>
				</ul>
			</div>


		</div> -->


	</div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/gh/stevenjoezhang/live2d-widget/autoload.js"></script>