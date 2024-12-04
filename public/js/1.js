	
	$(".select2").select2();
	bootbox.setLocale('tr');
	$('[data-toggle="popover"]').popover();
	  	
	function fsubmit(form,sayfa,siralama){
		$(form+" #sayfa").val(sayfa);
		$("#"+form).submit();
	}
	
	function fncFiltrele(){
		$("#form").submit();
	}
	
	$(".formara").on('keyup', function (e) {
	    if (e.keyCode == 13) {
	        $("form").submit();
	    }
	});
	
	function fncPopup(url, title, w, h) {
	    // Fixes dual-screen position                         Most browsers      Firefox
	    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
	    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

	    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
	    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

	    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
	    var top = ((height / 2) - (h / 2)) + dualScreenTop;
	    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

	    // Puts focus on the newWindow
	    if (window.focus) {
	        newWindow.focus();
	    }
	}
	
	function fncCookiesMenu(menu){
		$.cookie('menu', ($.cookie('menu') == 1 ? 0 : 1));
	}
	
	function fncDil(dil){
		$.cookie('dil', dil);
		location.reload(true);
	}	

	$('input[maxlength], textarea[maxlength]').maxlength({
        alwaysShow: true,
        threshold: 10,
        warningClass: "label label-success",
        limitReachedClass: "label label-danger"
    });
	$('textarea[maxlength]').keypress(function(event){
		        var key = event.which;
		        //all keys including return.
		        if(key >= 33 || key == 13) {
		            var maxLength = $(this).attr('maxlength');
		            var length = this.value.length;
		            if(length >= maxLength) {
		                event.preventDefault();
		            }
		        }
		    });
	$(".timepicker").timepicker({
    	showInputs: false,
    	showMeridian: false
    });
    
    $('.datepicker').datepicker({
	  	format: 'dd.mm.yyyy',
	  	startDate: '-1y',
	  	endDate: '+1y',
	  	language: 'tr',
	  	autoclose: true
	  	
	});
	
	$('.datepicker2').datepicker({
	  	format: 'dd.mm.yyyy',
	  	language: 'tr',
	  	autoclose: true
	  	
	});
	
	$('.datepicker3').datepicker({
	  	format: 'dd.mm.yyyy',
	  	startDate: '-1y',
	  	endDate: '0d',
	  	language: 'tr',
	  	autoclose: true
	  	
	});
	
	function fncLinkSil(obj){
		$.ajax({
			url: '/class/db_kayit.do?',
			type: "POST",
			data: { "islem" : "link_sil", 'id' : $(obj).data("id") },
			dataType: 'json',
			async: true,
			success: function(jd) {
				if(jd.HATA){
					bootbox.alert(jd.ACIKLAMA, function() {});
				}else{
					bootbox.alert(jd.ACIKLAMA, function() {
						$(obj).hide();
					});
				}
				
			}
		});
	}

