function set_tabs() {
		console.log('tab');
		
		
		
		$(".tab").click(function() {
						
		});	



				$('ul.tabs').on('click', 'li:not(.current)', function() {					
					$('ul.tabs li').removeClass('current');
					$('div.box').hide();
					$(this).addClass('current');
					$(this).parents('div.section').find('div.box').eq($(this).index()).fadeIn(150);
					console.log($(this));
					// .tab
					$('.tabs > *').removeClass('current-tab');
					$(this).addClass('current-tab');
					if ($(".tabs-pages").is(":visible")) {
						$('.tabs-pages').addClass('invis');}
					$('#tab' + ($('.tab').index(this))).removeClass('invis');
				})

				var tabIndex = window.location.hash.replace('#!tab','')-1;				
				if (tabIndex != -1){
					$('ul.tabs li').eq(tabIndex).click();
				}
				else {
					$('ul.tabs li').eq(0).click();
				}	

				$('a[href*=#tab]').click(function() {
					var tabIndex = $(this).attr('href').replace(/(.*)#tab/, '')-1;					
					$('ul.tabs li').eq(tabIndex).click();					
					window.location.hash='!tab'+parseInt(tabIndex+1);					
					return false;
				});
		
			
}
$(function() {

	
			if ($('.fancybox').length) $('.fancybox').fancybox();
			if ($('#accordion').length){
				$('#accordion').accordion({
					collapsible: true
				});
			} 
			if ($('select').length) $('select, input').styler();
		
	
		$("#back-top").hide();
		$(window).scroll(function (){
			if ($(this).scrollTop() > 100){
				$("#back-top").fadeIn();
			} else{
				$("#back-top").fadeOut();
			}
		});
		$("#back-top a").click(function (){
			$("body,html").animate({
				scrollTop:0
			}, 800);
			return false;
		});
		

			$(window).load(function(){
			  $('.flexslider').flexslider();
			});
	

//Переключение вкладок
set_tabs();	
        	


/* Валидация форм */

/* Регистрация */
$('form[name=registration]').submit(function(){
	var log = Logvalid		($('#valid-log'));
	var fam = Famvalid		($('#valid-fam'));
	var nam = Namvalid		($('#valid-nam'));
	var faz = Fazvalid		($('#valid-faz'));
	var eml = Emlvalid		($('#valid-eml'));
	var num = Numvalid		($('#valid-num'));
	var mob = Mobvalid		($('#valid-mob'));
	return (log && fam && nam && faz && eml && num && mob && 
	($("input[type=checkbox]").prop("checked")));	
});

	

    $('#valid-log').blur(function() {
        Logvalid($(this));
    });	
	$('#valid-fam').blur(function() {
        Famvalid($(this));
    });	
	$('#valid-nam').blur(function() {
        Namvalid($(this));
    });
	$('#valid-faz').blur(function() {
        Fazvalid($(this));
    });	
	$('#valid-eml').blur(function() {
        Emlvalid($(this));
    });	
	$('#valid-num').blur(function() {
        Numvalid($(this));
    });		
	$('#valid-mob').blur(function() {
        Mobvalid($(this));
    });
	
	/* Активация ПО */

$('form[name=activation]').submit(function(){
	var lic = Licvalid		($('#valid-lic'));
	var org = Orgvalid		($('#valid-org'));
	var ser = Servalid		($('#valid-ser'));
	var scf = Scfvalid		($('#valid-scf'));
	var usr = Usrvalid		($('#valid-usr'));
	var cod = Codvalid		($('#valid-cod'));
	var dat = Datvalid		($('#valid-dat'));
	var mil = Milvalid		($('#valid-mil'));
	return (lic && org && ser && scf && usr && cod && dat && mil);	
//console.log('1');
//return (lic && org);
});

	

    $('#valid-lic').blur(function() {
        Licvalid($(this));
    });	
	$('#valid-org').blur(function() {
        Orgvalid($(this));
    });	
	$('#valid-ser').blur(function() {
        Servalid($(this));
    });
	$('#valid-scf').blur(function() {
        Scfvalid($(this));
    });	
	$('#valid-usr').blur(function() {
        Usrvalid($(this));
    });	
	$('#valid-cod').blur(function() {
        Codvalid($(this));
    });		
	$('#valid-dat').blur(function() {
        Datvalid($(this));
    });	
	$('#valid-mil').blur(function() {
        Milvalid($(this));
    });
	
	/* ТП */
	$('form[name=modal-form]').submit(function(){
	var fam1 = Fam				($('#fam'));
	var nam1 = Nam				($('#nam'));
	var faz1 = Faz				($('#faz'));
	var org1 = Org				($('#org'));
	var lic1 = Lic				($('#lic'));
	var pos1 = Pos				($('#pos'));	
	var emale1 = Emalevalid		($('#valid-emale'));	
	var mes1 = Mes				($('#mes'));


	return (fam1 && nam1 && faz1 && lic1 && org1 && pos1 && emale1 && mes1);	
});

	$('#fam').blur(function() {
        Fam($(this));
    });	
	$('#nam').blur(function() {
        Nam($(this));
    });
	$('#faz').blur(function() {
        Faz($(this));
    });	
	$('#org').blur(function() {
        Org($(this));
    });		
    $('#lic').blur(function() {
        Lic($(this));
    });		
	$('#pos').blur(function() {
        Pos($(this));
    });	
	$('#valid-emale').blur(function() {
        Emalevalid($(this));
    });	
	$('#mes').blur(function() {
        Mes($(this));
    });	


	/* Support */
	$('form[name=support]').submit(function(){
	var ssn = SSurnameName			($('#ssurnamename'));
	var sphone = SPhoneNumber			($('#sphonenumber'));
	var sorgname = SOrgName			($('#sorgname'));
	var slic = SLicenseNumber		($('#slicensenumber'));
	var sposemp = SPositionEmp			($('#sposemp'));	
	var semail = SEmailFrom		($('#semail-from'));	

	return (ssn && sphone && sorgname && slic && sposemp && semail);
});
	$('#ssurnamename').blur(function() {
        SSurnameName($(this));
    });	
	$('#sphonenumber').blur(function() {
        SPhoneNumber($(this));
    });
	$('#slicensenumber').blur(function() {
        SLicenseNumber($(this));
    });	
	$('#sorgname').blur(function() {
        SOrgName($(this));
    });		
	$('#slicensenumber').blur(function() {
        SLicenseNumber($(this));
    });		
	$('#sposemp').blur(function() {
        SPositionEmp($(this));
    });	
	$('#semail-from').blur(function() {
        SEmailFrom($(this));
    });	
});




function Logvalid(elem) {
	if(elem.val() != '') {
		$('#valid-log').removeClass('modalvalid');
		$('#valid-log').next('br').next('p').next('p').removeClass('invis');	
		$('#valid-log').next('br').next('p').addClass('invis');		
		return true;  
	} else {
		$('#valid-log').addClass('modalvalid');
		$('#valid-log').next('br').next('p').next('p').addClass('invis');	
		$('#valid-log').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Famvalid(elem) {
	if(elem.val() != '') {
		$('#valid-fam').removeClass('modalvalid');
		$('#valid-fam').next('br').next('p').next('p').removeClass('invis');	
		$('#valid-fam').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#valid-fam').addClass('modalvalid');
		$('#valid-fam').next('br').next('p').next('p').addClass('invis');	
		$('#valid-fam').next('br').next('p').removeClass('invis');		
		return false;
	}
};
function Namvalid(elem) {
	if(elem.val() != '') {
		$('#valid-nam').removeClass('modalvalid');
		$('#valid-nam').next('br').next('p').next('p').removeClass('invis');	
		$('#valid-nam').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#valid-nam').addClass('modalvalid');
		$('#valid-nam').next('br').next('p').next('p').addClass('invis');	
		$('#valid-nam').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Fazvalid(elem) {
	if(elem.val() != '') {
		$('#valid-faz').removeClass('modalvalid');
		$('#valid-faz').next('br').next('p').next('p').removeClass('invis');	
		$('#valid-faz').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#valid-faz').addClass('modalvalid');
		$('#valid-faz').next('br').next('p').next('p').addClass('invis');	
		$('#valid-faz').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Emlvalid(elem) {
	if(elem.val() != '') {
		 var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		if(pattern.test(elem.val())){
			$('#valid-eml').removeClass('modalvalid');
			$('#valid-eml').next('br').next('p').next('p').removeClass('invis');	
			$('#valid-eml').next('br').next('p').addClass('invis');	
			return true;
		} else {
			$('#valid-eml').addClass('modalvalid');
			$('#valid-eml').next('br').next('p').next('p').addClass('invis');	
			$('#valid-eml').next('br').next('p').removeClass('invis');
			return false;
		 }
		} else {
		$('#valid-eml').addClass('modalvalid');
		$('#valid-eml').next('br').next('p').next('p').addClass('invis');	
		$('#valid-eml').next('br').next('p').removeClass('invis');
		 return false;
	}
};
function Numvalid(elem) {
	if(elem.val() != '') {
		 var pattern = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/i;
		if(pattern.test(elem.val())){
			$('#valid-num').removeClass('modalvalid');
			$('#valid-num').next('br').next('p').next('p').removeClass('invis');	
			$('#valid-num').next('br').next('p').addClass('invis');	
			return true;
		} else {
			$('#valid-num').addClass('modalvalid');
			$('#valid-num').next('br').next('p').next('p').addClass('invis');	
			$('#valid-num').next('br').next('p').removeClass('invis');
			return false;
		 }
		} else {
		 $('#valid-num').addClass('modalvalid');
		$('#valid-num').next('br').next('p').next('p').addClass('invis');	
		$('#valid-num').next('br').next('p').removeClass('invis');
		 return false;
	}
};
function Mobvalid(elem) {
	if(elem.val() != '') {
		 var pattern = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/i;
		if(pattern.test(elem.val())){
			$('#valid-mob').removeClass('modalvalid');
			$('#valid-mob').next('br').next('p').next('p').removeClass('invis');	
			$('#valid-mob').next('br').next('p').addClass('invis');	
			return true;
		} else {
			$('#valid-mob').addClass('modalvalid');
			$('#valid-mob').next('br').next('p').next('p').addClass('invis');	
			$('#valid-mob').next('br').next('p').removeClass('invis');
			return false;
		 }
		} else {
		 $('#valid-mob').addClass('modalvalid');
		$('#valid-mob').next('br').next('p').next('p').addClass('invis');	
		$('#valid-mob').next('br').next('p').removeClass('invis');
		 return false;
	}
};


function Licvalid(elem) {
	if(elem.val() != '') {
		$('#valid-lic').removeClass('modalvalid');
		$('#valid-lic').next('br').next('p').next('p').removeClass('invis');	
		$('#valid-lic').next('br').next('p').addClass('invis');		
		return true;  
	} else {
		$('#valid-lic').addClass('modalvalid');
		$('#valid-lic').next('br').next('p').next('p').addClass('invis');	
		$('#valid-lic').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Orgvalid(elem) {
	if(elem.val() != '') {
		$('#valid-org').removeClass('modalvalid');
		$('#valid-org').next('br').next('p').next('p').removeClass('invis');	
		$('#valid-org').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#valid-org').addClass('modalvalid');
		$('#valid-org').next('br').next('p').next('p').addClass('invis');	
		$('#valid-org').next('br').next('p').removeClass('invis');		
		return false;
	}
};
function Servalid(elem) {
	if(elem.val() != '') {
		$('#valid-ser').removeClass('modalvalid');
		$('#valid-ser').next('br').next('p').next('p').removeClass('invis');	
		$('#valid-ser').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#valid-ser').addClass('modalvalid');
		$('#valid-ser').next('br').next('p').next('p').addClass('invis');	
		$('#valid-ser').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Scfvalid(elem) {
	if(elem.val() != '') {
		$('#valid-scf').removeClass('modalvalid');
		$('#valid-scf').next('br').next('p').next('p').removeClass('invis');	
		$('#valid-scf').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#valid-scf').addClass('modalvalid');
		$('#valid-scf').next('br').next('p').next('p').addClass('invis');	
		$('#valid-scf').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Usrvalid(elem) {
	if(elem.val() != '') {
		$('#valid-usr').removeClass('modalvalid');
		$('#valid-usr').next('br').next('p').next('p').removeClass('invis');	
		$('#valid-usr').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#valid-usr').addClass('modalvalid');
		$('#valid-usr').next('br').next('p').next('p').addClass('invis');	
		$('#valid-usr').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Codvalid(elem) {
	if(elem.val() != '') {
		$('#valid-cod').removeClass('modalvalid');
		$('#valid-cod').next('br').next('p').next('p').removeClass('invis');	
		$('#valid-cod').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#valid-cod').addClass('modalvalid');
		$('#valid-cod').next('br').next('p').next('p').addClass('invis');	
		$('#valid-cod').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Datvalid(elem) {
	if(elem.val() != '') {
		$('#valid-dat').removeClass('modalvalid');
		$('#valid-dat').next('br').next('p').next('p').removeClass('invis');	
		$('#valid-dat').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#valid-dat').addClass('modalvalid');
		$('#valid-dat').next('br').next('p').next('p').addClass('invis');	
		$('#valid-dat').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Milvalid(elem) {
	if(elem.val() != '') {
		$('#valid-mil').removeClass('modalvalid');
		$('#valid-mil').next('br').next('p').next('p').removeClass('invis');	
		$('#valid-mil').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#valid-mil').addClass('modalvalid');
		$('#valid-mil').next('br').next('p').next('p').addClass('invis');	
		$('#valid-mil').next('br').next('p').removeClass('invis');
		return false;
	}
};

function Lic(elem) {
	if(elem.val() != '') {
		$('#lic').removeClass('modalvalid');
		$('#lic').next('br').next('p').next('p').removeClass('invis');	
		$('#lic').next('br').next('p').addClass('invis');		
		return true;  
	} else {
		$('#lic').addClass('modalvalid');
		$('#lic').next('br').next('p').next('p').addClass('invis');	
		$('#lic').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Fam(elem) {
	if(elem.val() != '') {
		$('#fam').removeClass('modalvalid');
		$('#fam').next('br').next('p').next('p').removeClass('invis');	
		$('#fam').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#fam').addClass('modalvalid');
		$('#fam').next('br').next('p').next('p').addClass('invis');	
		$('#fam').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Nam(elem) {
	if(elem.val() != '') {
		$('#nam').removeClass('modalvalid');
		$('#nam').next('br').next('p').next('p').removeClass('invis');	
		$('#nam').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#nam').addClass('modalvalid');
		$('#nam').next('br').next('p').next('p').addClass('invis');	
		$('#nam').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Faz(elem) {
	if(elem.val() != '') {
		$('#faz').removeClass('modalvalid');
		$('#faz').next('br').next('p').next('p').removeClass('invis');	
		$('#faz').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#faz').addClass('modalvalid');
		$('#faz').next('br').next('p').next('p').addClass('invis');	
		$('#faz').next('br').next('p').removeClass('invis');
		return false;
	}
};
function Lic(elem) {
	if(elem.val() != '') {
		$('#lic').removeClass('modalvalid');
		$('#lic').next('br').next('p').removeClass('invis');	
		$('#lic').next('br').next('p').next('p').addClass('invis');	
		return true;  
	} else {
		$('#lic').addClass('modalvalid');
		$('#lic').next('br').next('p').addClass('invis');	
		$('#lic').next('br').next('p').next('p').removeClass('invis');
		return false;
	}
};
function Org(elem) {
	if(elem.val() != '') {
		$('#org').removeClass('modalvalid');
		$('#org').next('br').next('p').removeClass('invis');	
		$('#org').next('br').next('p').next('p').addClass('invis');	
		return true;  
	} else {
		$('#org').addClass('modalvalid');
		$('#org').next('br').next('p').addClass('invis');	
		$('#org').next('br').next('p').next('p').removeClass('invis');
		return false;
	}
};
function Pos(elem) {
	if(elem.val() != '') {
		$('#pos').removeClass('modalvalid');
		$('#pos').next('br').next('p').removeClass('invis');	
		$('#pos').next('br').next('p').next('p').addClass('invis');	
		return true;  
	} else {
		$('#pos').addClass('modalvalid');
		$('#pos').next('br').next('p').addClass('invis');	
		$('#pos').next('br').next('p').next('p').removeClass('invis');
		return false;
	}
};
function Mes(elem) {
	if(elem.val() != '') {
		$('#mes').removeClass('modalvalid');
		$('#mes').next('br').next('p').removeClass('invis');	
		$('#mes').next('br').next('p').next('p').addClass('invis');	
		return true;  
	} else {
		$('#mes').addClass('modalvalid');
		$('#mes').next('br').next('p').addClass('invis');	
		$('#mes').next('br').next('p').next('p').removeClass('invis');
		return false;
	}
};


function Emalevalid(elem) {
	if(elem.val() != '') {
		 var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		if(pattern.test(elem.val())){
			$('#valid-emale').removeClass('modalvalid');
			$('#valid-emale').next('br').next('p').removeClass('invis');	
			$('#valid-emale').next('br').next('p').next('p').addClass('invis');	
			return true;
		} else {
			$('#valid-emale').addClass('modalvalid');
			$('##valid-emale').next('br').next('p').addClass('invis');	
			$('#valid-emale').next('br').next('p').next('p').removeClass('invis');
			return false;
		 }
		} else {
		$('#valid-emale').addClass('modalvalid');
		$('#valid-emale').next('br').next('p').addClass('invis');	
		$('#valid-emale').next('br').next('p').next('p').removeClass('invis');
		 return false;
	}
};

function SSurnameName(elem) {
	if(elem.val() != '') {
		$('#ssurnamename').removeClass('modalvalid');
		$('#ssurnamename').next('br').next('p').next('p').removeClass('invis');	
		$('#ssurnamename').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#ssurnamename').addClass('modalvalid');
		$('#ssurnamename').next('br').next('p').next('p').addClass('invis');	
		$('#ssurnamename').next('br').next('p').removeClass('invis');
		return false;
	}
};

function SPhoneNumber(elem) {
	if(elem.val() != '') {
		 var pattern = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/i;
		if(pattern.test(elem.val())){
			$('#sphonenumber').removeClass('modalvalid');
			$('#sphonenumber').next('br').next('p').next('p').removeClass('invis');	
			$('#sphonenumber').next('br').next('p').addClass('invis');	
			return true;
		} else {
			$('#sphonenumber').addClass('modalvalid');
			$('#sphonenumber').next('br').next('p').next('p').addClass('invis');	
			$('#sphonenumber').next('br').next('p').removeClass('invis');
			return false;
		 }
		} else {
		 $('#sphonenumber').addClass('modalvalid');
		$('#sphonenumber').next('br').next('p').next('p').addClass('invis');	
		$('#sphonenumber').next('br').next('p').removeClass('invis');
		 return false;
	}
};

function SOrgName(elem) {
	if(elem.val() != '') {
		$('#sorgname').removeClass('modalvalid');
		$('#sorgname').next('br').next('p').next('p').removeClass('invis');	
		$('#sorgname').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#sorgname').addClass('modalvalid');
		$('#sorgname').next('br').next('p').next('p').addClass('invis');	
		$('#sorgname').next('br').next('p').removeClass('invis');		
		return false;
	}
};

function SLicenseNumber(elem) {
	if(elem.val() != '') {
		$('#slicensenumber').removeClass('modalvalid');
		$('#slicensenumber').next('br').next('p').next('p').removeClass('invis');	
		$('#slicensenumber').next('br').next('p').addClass('invis');		
		return true;  
	} else {
		$('#slicensenumber').addClass('modalvalid');
		$('#slicensenumber').next('br').next('p').next('p').addClass('invis');	
		$('#slicensenumber').next('br').next('p').removeClass('invis');
		return false;
	}
};

function SPositionEmp(elem) {
	if(elem.val() != '') {
		$('#sposemp').removeClass('modalvalid');
		$('#sposemp').next('br').next('p').next('p').removeClass('invis');	
		$('#sposemp').next('br').next('p').addClass('invis');	
		return true;  
	} else {
		$('#sposemp').addClass('modalvalid');
		$('#sposemp').next('br').next('p').next('p').addClass('invis');	
		$('#sposemp').next('br').next('p').removeClass('invis');
		return false;
	}
};

function SEmailFrom(elem) {
	if(elem.val() != '') {
		 var pattern = /^([a-z0-9_\.-])+@[a-z0-9-\.]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		if(pattern.test(elem.val())){
			$('#semail-from').removeClass('modalvalid');
			$('#semail-from').next('br').next('p').next('p').removeClass('invis');	
			$('#semail-from').next('br').next('p').addClass('invis');	
			return true;
		} else {
			$('#semail-from').addClass('modalvalid');
			$('#semail-from').next('br').next('p').next('p').addClass('invis');	
			$('#semail-from').next('br').next('p').removeClass('invis');
			return false;
		 }
		} else {
		$('#semail-from').addClass('modalvalid');
		$('#semail-from').next('br').next('p').next('p').addClass('invis');	
		$('#semail-from').next('br').next('p').removeClass('invis');
		 return false;
	}
};

$(document).ready(function(){
	
	$(".accord-content").hide();
	$(".accord-list").not( ".accord-adhoc" ).eq(0).addClass('active');
	$(".accord-list").not( ".accord-adhoc" ).eq(0).find('.accord-content').show();
		
	$(".accord-list .title").on("click", function(){
		var $this = $(this),
		list = $this.closest(".accord-list"),
		content = list.find(".accord-content"),
		contentList = content.find("li"),
		speed = 300;		
		if ( !list.hasClass("active") ) {
			//list.siblings().removeClass("active");
			list.addClass("active");
			content.stop(true, true).slideDown(speed);
			//list.siblings().find(".accord-content").slideUp(speed);
		}
		else{
			list.removeClass("active");
			content.slideUp(speed);
		}
		
	})
	
})
