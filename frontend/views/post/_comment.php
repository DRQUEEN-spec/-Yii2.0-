<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<style>
	.box {
		width: 1200px;
		height: 700px;
		position: absolute;
		top: 140px;
		left: 90px;
		z-index: 0;
	}

	.barrage-container-wrap {
		width: 100%;
		height: 700px;
		position: relative;
		overflow: hidden;
		background-size: 100% 100%;
	}

	.barrage-container {
		position: absolute;
		z-index: 20;
		top: 0;
		left: 0;
		right: 0;
		bottom: 30px;
		cursor: default;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}

	.barrage-item {
		position: absolute;
		top: 0;
		left: 100%;
		white-space: nowrap;
		cursor: pointer;
		color: #fff;
		padding: 5px;
		font-size: 20px;
		background: rgba(255, 255, 255, 0.45);
		box-shadow: 0 8px 10px 0 rgba(31, 38, 135, 0.37);
		backdrop-filter: blur(5.0px);
		-webkit-backdrop-filter: blur(5.0px);
		border-radius: 10px;
		border: 1px solid rgba(255, 255, 255, 0.18);
	}

	.barrage-item .barrage-tip {
		display: none;
		position: absolute;
		top: -26px;
		padding: 7px 15px;
		line-height: 12px;
		font-size: 12px;
		color: #f20606;
		background-color: #fff;
		white-space: nowrap;
		border: 1px solid #ddd;
		border-radius: 8px;
		-webkit-box-shadow: 0 0 10px 1px rgba(0, 0, 0, .1);
		box-shadow: 0 0 10px 1px rgba(0, 0, 0, .1);
		-webkit-transform-origin: 15px 100%;
		-ms-transform-origin: 15px 100%;
		transform-origin: 15px 100%;
		webkit-animation: tipScale cubic-bezier(.22, .58, .12, .98) .4s;
		animation: tipScale cubic-bezier(.22, .58, .12, .98) .4s;
	}

	.send-wrap {
		margin-top: 20px;
	}

	.input {
		width: 300px;
		height: 30px;
		line-height: 30px;
		outline: none;
		-webkit-appearance: none;
		border-radius: 5px;
		padding: 0;
		padding-left: 10px;
	}

	.send-btn {
		height: 38px;
		line-height: 38px;
		text-align: center;
		font-weight: bold;
		color: #fff;
		background: #93d0ea;
		text-shadow: 1px 1px 1px #333;
		border-radius: 5px;
		margin: 0 20px 20px 0;
		position: relative;
		overflow: hidden;
		cursor: pointer;
		padding: 5px 15px;
	}

	@-webkit-keyframes tipScale {
		0 {
			-webkit-transform: scale(0);
			transform: scale(0);
		}

		50% {
			-webkit-transform: scale(1.1);
			transform: scale(1.1);
		}

		100% {
			-webkit-transform: scale(1);
			transform: scale(1);
		}
	}
</style>

<div class="box">
	<div class="barrage-container-wrap clearfix">
		<div class="barrage-container">
		</div>
	</div>
</div>
<?php
foreach ($comments as $value) {
	$json .= json_encode($value->content) . ',';
}
?>
<script>
	(function() {
		var barrageArray = <?php echo '[' . substr($json, 0, strlen($json) - 1) . ']' ?>;

		var barrageColorArray = [
			'#ff0000', '#9F5F9F', '#FF7F00', '#8E2323', '#3232CD', '#FF2400', '#00009C', '#9932CD', '#4A766E'
		];
		var barrageTipWidth = 50; //提示语的长度

		var barrageBoxWrap = document.querySelector('.barrage-container-wrap');;
		var barrageBox = document.querySelector('.barrage-container');
		var inputBox = document.querySelector('.input');
		var sendBtn = document.querySelector('.send-btn');

		//容器的宽高度
		var barrageWidth = ~~window.getComputedStyle(barrageBoxWrap).width.replace('px', '');
		var barrageHeight = ~~window.getComputedStyle(barrageBoxWrap).height.replace('px', '');

		//发送
		function sendMsg() {
			var inputValue = inputBox.value;
			inputValue.replace(/\ +/g, "");

			if (inputValue.length <= 0) {
				alert('请输入');
				return false;
			}

			//生成弹幕
			createBarrage(inputValue, true);
			inputBox.value = '';
		}


		//创建弹幕
		function createBarrage(msg, isSendMsg) {
			var divNode = document.createElement('div');
			var spanNode = document.createElement('span');

			divNode.innerHTML = msg;
			divNode.classList.add('barrage-item');
			barrageBox.appendChild(divNode);

			spanNode.innerHTML = '举报';
			spanNode.classList.add('barrage-tip');
			divNode.appendChild(spanNode);

			barrageOffsetLeft = getRandom(barrageWidth, barrageWidth * 2);
			barrageOffsetLeft = isSendMsg ? barrageWidth : barrageOffsetLeft
			barrageOffsetTop = getRandom(10, barrageHeight - 30);
			barrageColor = barrageColorArray[Math.floor(Math.random() * (barrageColorArray.length))];

			//执行初始化滚动
			initBarrage.call(divNode, {
				left: barrageOffsetLeft,
				top: barrageOffsetTop,
				color: barrageColor
			});
		}

		//初始化弹幕移动(速度，延迟)
		function initBarrage(obj) {
			//初始化
			obj.top = obj.top || 0;
			obj.class = obj.color || '#fff';
			this.style.left = obj.left + 'px';
			this.style.top = obj.top + 'px';
			this.style.color = obj.color;

			//添加属性
			this.distance = 0;
			this.width = ~~window.getComputedStyle(this).width.replace('px', '');
			this.offsetLeft = obj.left;
			this.timer = null;

			//弹幕子节点
			var barrageChileNode = this.children[0];
			barrageChileNode.style.left = (this.width - barrageTipWidth) / 2 + 'px';

			//运动
			barrageAnimate(this);

			//停止
			this.onmouseenter = function() {
				barrageChileNode.style.display = 'block';
				cancelAnimationFrame(this.timer);
			};

			this.onmouseleave = function() {
				barrageChileNode.style.display = 'none';
				barrageAnimate(this);
			};

			//举报
			barrageChileNode.onclick = function() {
				alert('举报成功');
			}
		}

		//弹幕动画
		function barrageAnimate(obj) {
			move(obj);

			if (Math.abs(obj.distance) < obj.width + obj.offsetLeft) {
				obj.timer = requestAnimationFrame(function() {
					barrageAnimate(obj);
				});
			} else {
				cancelAnimationFrame(obj.timer);
				//删除节点
				obj.parentNode.removeChild(obj);
			}
		}

		//移动
		function move(obj) {
			obj.distance--;
			obj.style.transform = 'translateX(' + obj.distance + 'px)';
			obj.style.webkitTransform = 'translateX(' + obj.distance + 'px)';
		}

		//随机获取高度
		function getRandom(start, end) {
			return start + (Math.random() * (end - start));
		}


		/*******初始化事件**********/
		//系统数据
		barrageArray.forEach(function(item, index) {
			createBarrage(item, false);
		});

		//点击发送
		sendBtn.onclick = sendMsg; //点击发送

		//回车
		inputBox.onkeydown = function(e) {
			e = e || window.event;
			if (e.keyCode == 13) {
				send();
			}
		}

	})()
</script>