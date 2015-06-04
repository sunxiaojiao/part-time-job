/**
 *返回一个对象，将表单中元素的name值做属性名，value值做属性值。
 *@param form String CSS selector
 *@return Object
 */
function getFromInput(form) {
        var list = $(form + " *");
        var info = new Object();
        for (var i = 0; i < list.length; i++) {
            if (list.eq(i).attr("name") == undefined) {
                continue;
            }
            if(list.eq(i).val() != ''){
                info[list.eq(i).attr("name")] = list.eq(i).val();
            }
        }
        return info;
    }
    /**
     *修改指定元素的文本为指定字符串
     *@param element
     *@param str
     */
function changText(element, str) {
        $(element).text(str);
    }
    /**
     *
     */
var form = 0;

function enterKey(keypress, click) {
        keypress.on('keypress', function(e) {
            if (e.keyCode == 13) {
                click.click();
            }
        });

    }
    //刷新验证码
$(document).on('ready', function() {
    $("#verify button.verify").click(function() {
        var ver_img = $("#verify img.verify");
        var src     = ver_img.attr("src");
        var a = document.createElement("a");
        a.href= src;
        ver_img.attr("src", a.pathname + "?" + new Date().getTime());
    });
    $("#verify img.verify").click(function() {
    	var src = $(this).attr("src");
        var a   = document.createElement("a");
        a.href  = src;
        $(this).attr("src", a.pathname + "?" + new Date().getTime());
    });
//alert button x
(function() {
    $(".alert button").on('click', function() {
        $(this).parent().addClass("hidden");
    });
})();

});
