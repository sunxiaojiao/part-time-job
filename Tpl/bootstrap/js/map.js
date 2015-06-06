var mapObj, district, polygons = [],
    citycode;
var citySelect = document.getElementById('city');
var districtSelect = document.getElementById('district');
var areaSelect = document.getElementById('biz_area');
var address = new Array();
var addressname = addresscity = "";
mapObj = new AMap.Map('mapContainer', {
    resizeEnable: true,
    // layers: [
    //     new AMap.TileLayer()
    // ],
    // view: new AMap.View2D({
    //     //center: new AMap.LngLat(116.30946, 39.937629),
    //     zoom: 3
    // })
});

var provinceList = ['北京市', '天津市', '河北省', '山西省', '内蒙古自治区', '辽宁省', '吉林省', '黑龙江省', '上海市', '江苏省', '浙江省', '安徽省', '福建省', '江西省', '山东省', '河南省', '湖北省', '湖南省', '广东省', '广西壮族自治区', '海南省', '重庆市', '四川省', '贵州省', '云南省', '西藏自治区', '陕西省', '甘肃省', '青海省', '宁夏回族自治区', '新疆维吾尔自治区', '台灣', '香港特别行政区', '澳门特别行政区'];
var provinceSelect = document.getElementById('province');
var content = '<option value="">--请选择--</option>';
for (var i = 0, l = provinceList.length; i < l; i++) {
    content += '<option>' + provinceList[i] + '</option>';
    provinceSelect.innerHTML = content;
}

//行政区划查询

AMap.service(["AMap.DistrictSearch"], function() {
    var opts = {
        subdistrict: 1, //返回下一级行政区
        extensions: 'all', //返回行政区边界坐标组等具体信息
        level: 'city' //查询行政级别为 市
    };

    //实例化DistrictSearch
    district = new AMap.DistrictSearch(opts);
});



function getData(e) {
    var dList = e.districtList;
    for (var m = 0, ml = dList.length; m < ml; m++) {
        var data = e.districtList[m].level;
        var bounds = e.districtList[m].boundaries;
        //只绘制 区, 且 本级别行政区划是上一级区划的下级行政区
        if (data == "district" && dList[m].citycode === citycode) {
            if (bounds) {
                for (var i = 0, l = bounds.length; i < l; i++) {
                    //生成行政区划polygon
                    var polygon = new AMap.Polygon({
                        map: mapObj,
                        strokeWeight: 1,
                        strokeColor: '#CC66CC',
                        fillColor: '#CCF3FF',
                        fillOpacity: 0.7,
                        path: bounds[i]
                    });
                    polygons.push(polygon);
                }
                mapObj.setFitView(); //地图自适应
                //清除地图上所有覆盖物
		        setTimeout(function(){
                    mapObj.clearMap();
		        },1500);
            }
        }

        var list = e.districtList || [],
            subList = [],
            level, nextLevel;
        if (list.length >= 1) {
            subList = list[0].districtList;
            level = list[0].level;
        }

        //清空下一级别的下拉列表
        if (level === 'province') {

            nextLevel = 'city';
            citySelect.innerHTML = '';
            districtSelect.innerHTML = '';
            areaSelect.innerHTML = '';
        } else if (level === 'city') {

            nextLevel = 'district';
            districtSelect.innerHTML = '';
            areaSelect.innerHTML = '';
        } else if (level === 'district') {

            nextLevel = 'biz_area';
            areaSelect.innerHTML = '';
        }

        if (subList) {
            var contentSub = '<option value="">--请选择--</option>';
            for (var i = 0, l = subList.length; i < l; i++) {
                var name = subList[i].name;
                var levelSub = subList[i].level;
                var cityCode = subList[i].citycode;
                contentSub += '<option value="' + levelSub + '|' + cityCode + '">' + name + '</option>';
                document.querySelector('#' + levelSub).innerHTML = contentSub;
            }
        }
    }
}

function search(obj) {
        //清除地图上所有覆盖物
        for (var i = 0, l = polygons.length; i < l; i++) {
            polygons[i].setMap(null);
        }

        var option = obj[obj.options.selectedIndex];
        var arrTemp = option.value.split('|');
        var level = arrTemp[0]; //行政级别
        citycode = arrTemp[1]; // 城市编码
        var keyword = option.text; //关键字

        district.setLevel(level); //行政区级别
        //行政区查询
        district.search(keyword, function(status, result) {
            getData(result);
        });
    }
    //地图中添加地图操作ToolBar插件
		mapObj.plugin(["AMap.ToolBar"],function(){		
			var toolBar = new AMap.ToolBar(); 
			mapObj.addControl(toolBar);		
		});
	//创建右键菜单
		var contextMenu = new AMap.ContextMenu();
		//右键放大
		contextMenu.addItem("放大一级",function(){
		mapObj.zoomIn();	
		},0);
		//右键缩小
		contextMenu.addItem("缩小一级",function(){
			mapObj.zoomOut();
		},1);
		//右键添加Marker标记
		contextMenu.addItem("添加标记",function(e){
			var marker = new AMap.Marker({
				map:mapObj,
				position: contextMenuPositon, //基点位置
				icon:"http://webapi.amap.com/images/marker_sprite.png", //marker图标，直接传递地址url
				offset:{x:-8,y:-34} //相对于基点的位置
			});
            //获取经纬度数组
			address    = {x:contextMenuPositon.getLng(),y:contextMenuPositon.getLat()};
            mapObj.getCity(function(result){
                //获取位置字符串（城市+区）
                addressname = result.city + result.district;
                addresscity = result.city;
                if($.inArray(addresscity,allowAddress) === -1){
                    alert('小蜜蜂，此城市未开放服务');
                    address     = new Object();
                    addressname = '';
                    marker.hide();
                    return;
                   }


            })
            //关闭modal
            setTimeout(function(){$(".modal").modal('toggle');},1000);
		},3);
		//地图绑定鼠标右击事件——弹出右键菜单
		AMap.event.addListener(mapObj,'rightclick',function(e){
			contextMenu.open(mapObj,e.lnglat);
			contextMenuPositon = e.lnglat;
		});