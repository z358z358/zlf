/**
* jClass - A JavaScript Class Funtion.
* Copyright (c) 2008 Double Kai (doublekai.org)
* Dual licensed under MIT and GPL.
* Date: 2008-12-02
*
*    http://doublekai.org/demo/jquery/jclass.html
*
* @author Liao TzuKai - liaotzukai@gmail.com
* @version 0.0.1
*/
var Class = {
    superclass: function(superclass){
        var jSueprclass = superclass || new Object();
        return {
            implement: function(propertys){
                if (typeof jSueprclass == "object") {
                    return Class.superclass(jSueprclass).statics(propertys);
                }
                for (var prop in propertys) {
                    jSueprclass.prototype[prop] = propertys[prop];
                }
                return jSueprclass;
            },
            statics: function(propertys){
                for (var prop in propertys) {
                    jSueprclass[prop] = propertys[prop];
                }
                return jSueprclass;
            }
        }
    },
    create: function(declare){
        return Class.extend(Object).create(declare);
    },
    implement: function(){
        return Class.extend(Object).implement(arguments);
    },
    extend: function(superclass){
        var jSuperclass = (typeof superclass == "function") ? new superclass : superclass;
        var jInterfaces = null;
        var canDo = {
            create: function(declare){
                var classDeclare = declare || new Function();
				var adapterClass = new Function();
				adapterClass.prototype = jSuperclass;
				
				classDeclare.prototype = new adapterClass();
			    //classDeclare.prototype.constructor = classDeclare;
				classDeclare.prototype.superclass = jSuperclass;
				
                if (jInterfaces) {
                    for (var i = 0, j = jInterfaces.length; i < j; i++) {
                        jClass.superclass(classDeclare).implement(jInterfaces[i]);
                    }
                }
               				
                classDeclare.implement = function(propertys){
                    Class.superclass(classDeclare).implement(propertys);
                    return classDeclare;
                }
                
                classDeclare.statics = function(propertys){
                    Class.superclass(classDeclare).statics(propertys);
                    return classDeclare;
                };
                
                return classDeclare;
            },
            implement: function(){
                jInterfaces = arguments;
                return canDo;
            }
        }
        return canDo;
    }
}
/**
* jQuery.tablepager
* Copyright (c) 2008 Double Kai (doublekai.org)
* Dual licensed under MIT and GPL.
* Date: 2008-12-02
*
* http://doublekai.org/demo/jquery/tablepager.html
*
* @author Liao,SanKai - liaosankai@gmail.com
* @version 1.0.0
*/



var tablePager = Class.create(function(){
    var tableObject;
    var totalRows;
    var from;
    var to;
    var totalPages;
    var pageSize;
    var currentPage;
    var pagerInfo;
	var currentData;

    //public construct
    this.constructor = function(table){
		tableObject = $(table);
		totalRows = 0;
		from = 0;
		to = 0;
		totalPages = 0;
		pageSize = 10;
		currentPage = 1;
		pagerInfo = 'view:{from} ~ {to}, total:{totalRows}, page:{currentPage}/{totalPages}';
		currentData	= null;
        this.setPageSize(pageSize);
   };

    //public setPagerInfo
    this.setPagerInfo = function(info) {
        pagerInfo = info;
    };

    //public setPageSize
    this.setPageSize = function(size) {
        pageSize = size;
        totalRows = jQuery('tbody tr',tableObject).length;
        totalPages = Math.ceil(totalRows / pageSize);
        this.moveCurrentPage();
    };

    //public setCurrenctPage
    this.setCurrentPage = function(pageNo) {
        if(pageNo > totalPages){
            currentPage = totalPages;
        } else if(pageNo < 1){
            currentPage = 1;
        } else {
            currentPage = pageNo;
        }
    };

    //public info
    this.pagerInfo = function (){
        var clonePagerInfo = pagerInfo;
        clonePagerInfo = clonePagerInfo.replace('{from}',from+1)
        clonePagerInfo = clonePagerInfo.replace('{to}',to+1);
        clonePagerInfo = clonePagerInfo.replace('{totalRows}',totalRows);
        clonePagerInfo = clonePagerInfo.replace('{currentPage}',currentPage);
        clonePagerInfo = clonePagerInfo.replace('{totalPages}',totalPages);
        return clonePagerInfo;
    };
    //public moveCurrentPage
    this.moveRangePage = function (start,end){
        //將先前的資料插入到原始位置
		if(currentData != null){
			currentData.hide();
		} else {
			tableObject.find('tbody tr').css('display','none');
		}
		from = start;
        to = end;
        this.setCurrentPage(currentPage);
		currentData = tableObject.find('tbody tr:gt(' + (start-1) + ')').not(':gt(' + (end-(pageSize*(currentPage-1))) + ')');
		currentData.show();	
    };
	
    //public moveCurrentPage
    this.moveSetPage = function (pagerNo){
        this.setCurrentPage(pagerNo);
        this.moveCurrentPage(from,to);
    };
	
    //public moveCurrentPage
    this.moveCurrentPage = function (){
        this.setCurrentPage(currentPage);
        var from = (currentPage-1) * pageSize;
        var to = ((currentPage) * pageSize - 1);
        this.moveRangePage(from,to);
    };
    //public moveFirstPage
    this.moveFirstPage = function() {
        this.setCurrentPage(1);
        this.moveCurrentPage();
    };
    //public moveLastPage
    this.moveLastPage = function() {
        this.setCurrentPage(totalPages);
        this.moveCurrentPage();
    };
    //public moveNextPage
    this.moveNextPage = function() {
        currentPage++;
        this.moveCurrentPage();
    };
    //public movePrevPage
    this.movePrevPage = function() {
        currentPage--;
        this.moveCurrentPage();
    };
	this.constructor.apply(this,arguments);
});
