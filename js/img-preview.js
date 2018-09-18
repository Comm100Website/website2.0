//alert($("body").scrollTop());
$(function() {
	function fullBox(y) {
		$this = this;
		$this.Id = "fulBox";
		$this.contentDoms = $(y)
		$this.init = function() {
			var imgs = new Image();
			var lefts = $(document).width() / 2 - 12;
			var heights = $(document).height() / 2 - 12;
			var str = "<div id='fullBoxBg' class='alpha' style='width:" + $(document).width() + "px;height:" + $(document).height() + "px;top:0;'></div><div style='left:" + lefts + "px;top:" + heights + "px' id=" + $this.Id + "><span id=closeBtn></span><span><img src='http://www.comm100.com/blog/wp-content/themes/comm100/images/loader.gif'/></span></div>";
			$("body").append(str);
			imgs.onload = function() {
				var lefts2 = $(document).width() / 2 - imgs.width / 2 - 10;
				var heights2 = $(document).scrollTop()+60; //+ $(window).height() / 2 - imgs.height / 2;
				$("#" + $this.Id + " span").css("display", "none");
				$("#" + $this.Id + " span img").attr("src", imgs.src);
				$("#" + $this.Id).animate({
					"left" : lefts2,
					"top" : heights2,
					"width" : imgs.width,
					"height" : (imgs.height)
				}, 200);
				setTimeout(function() {
					$("#" + $this.Id + " span").fadeIn(600);
				}, 200);
			}
			imgs.src = $this.contentDoms.attr('href');
			$this.binds();
			delete imgs;
		}
		$this.binds = function() {
			$("#fullBoxBg").bind("click", function() {
				$("#" + $this.Id).fadeOut(600);
				$(this).fadeOut(600);
				setTimeout(function() {
					$("#" + $this.Id).remove();
					$("#fullBoxBg").remove()
				}, 200)

			})
			$("#closeBtn").bind("click", function() {
				$("#fullBoxBg").click()
			})
		}
	}


	$("a.imgpreview").bind("click", function() {
		ok = new fullBox(this)
		ok.init();
		// alert($(document).scrollTop())
		return false;

	})
})