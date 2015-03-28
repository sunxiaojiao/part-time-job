/**
*返回一个对象，将表单中input的name值做属性名，value值做属性值。
*@param form String CSS selector
*@return Object
*/
function getFromInput(form){
	var  input_list = $(form + " input");
	var info = new Object();
	for(var i=0;i<input_list.length;i++){
		info[input_list.eq(i).attr("name")] = input_list.eq(i).val();
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