;(function($) {
	$.fn.extend({
		"color":function(value){
			if (value == undefined) {
				return this.css("color");
			} else {
				return this.css("color",value);
			}
		},
		"border":function(value){
			if (value == undefined) {
				return this.css("border");
			} else {
				return this.css("border",value);
			}
		},
		"background":function(value){
			if (value == undefined) {
				return this.css("background");
			} else {
				return this.css("background",value);
			}
		},
		"alertBgColor":function(options){
			//设置默认值
			options = $.extend({
				odd:"odd",
				even:"even",
				selected:"selected"
			},options);
			$("tbody>tr:odd",this).addClass(options.odd);
			$("tbody>tr:even",this).addClass(options.even);
			$("tbody>tr",this).click(function(){
				//判断是否选中
				var hasSelected = $(this).hasClass(options.selected);
				//如果选中，则移除seleed类，否这就加上selected类
				$(this)[hasSelected?"removeClass":"addClass"](options.selected).find(':checkbox').attr('checked',!hasSelected);
			});
			$("tbody>tr:has(:checked)",this).addClass(options.selected);
			return this;//返回this使方法可链
		},
	}); 
})(jQuery);