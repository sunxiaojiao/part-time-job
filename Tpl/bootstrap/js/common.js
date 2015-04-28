/**
*返回一个对象，将表单中元素的name值做属性名，value值做属性值。
*@param form String CSS selector
*@return Object
*/
function getFromInput(form){
	var  list = $(form + " *");
	var info = new Object();
	for(var i=0;i<list.length;i++){
		if(list.eq(i).attr("name") == undefined){
			continue;
		}
		info[list.eq(i).attr("name")] = list.eq(i).val();
	}
	return info;
}
/**
*修改指定元素的文本为指定字符串
*@param element
*@param str
*/
function changText(element,str){
  $(element).text(str);
}
/**
*
*/
var form = 0;
function enterKey(keypress,click,form){
	if(form){
		console.log(form);
	}
	keypress.on('keypress',function(e){
		if(e.keyCode == 13){
			click.click();
		}
	});

}