(function( $ ) {
	'use strict';

function Run_Test(){

	this.run = function(value){
			$('.loading-icon').show();
	  		$('.run-desc').css({display: 'none'});
	    	$('.left-section').css({display: 'block'});
	    	var options = ['wp-prefix', 'fx_user','changelog','active_plugins',
	    					'check_wp_ver','get_seo','get_permalink','check_domain',
	    					'misc_wordpress', 'deactivated_plugins', 'user_capabilities', 
	    					'plugin_version', 'contact_form', 'wordpress_settings'];

	    	

	    	// waitForElement(".results-container",function(){
	    	// 	$('.accordion li').addClass('disabled');
	    	// });
	    	
	    	var count = 0;
	    	var options_length = options.length;
	    	//console.log(options_length);
	    	$.each(options , function(index, opt){
	    		var data = {
	            	action: 'my_action',
	      			opt : opt,
	      			BPOptions: value

		        };

		        $.post(ajaxurl, data, function(response) {
		        	count++;
		            switch (opt) {
		            	case 'wp-prefix':
		            		$('.right-section .wordpress_settings').append(response);
		            		break;
		            	case 'fx_user':
		            		$('.fxuser_container').append(response);
		            		break;
		            	case 'deactivated_plugins':
		            		$('.deactivated_plugins').append(response);
		            		break;
		            	case 'changelog':
		            		$('.wordpress_files').append(response);
		            		break;
		            	case 'active_plugins':
		            		$('.accordion .plugins_container').append(response);
		            		break;
		            	case 'check_wp_ver':
		            		$('.right-section .wordpress_settings').append(response);
		            		break;
		            	case 'get_seo':
		            		$('.right-section .wordpress_settings').append(response);
		            		break;
		            	case 'get_permalink':
		            		$('.right-section .wordpress_settings').append(response);
		            		break;
		            	case 'check_domain':
		            		$('.right-section .wordpress_settings').append(response);
		            		break;
		            	case 'misc_wordpress':
		            		$('.right-section .wordpress_settings').append(response);
		            		break;
		            	case 'user_capabilities':
		            		$('.user_capabilities').append(response);
		            		break;
		            	case 'plugin_version':
		            	    $('.plugin_versions').append(response);
		            		break;
		            	case 'contact_form':
		            	    $('.cform_fields').append(response);
		            		// alert(response);
		            		break;
		            	case 'wordpress_settings':
		            	    $('.wordpress_settings').append(response);
		            		// alert(response);
		            		break;
		            	default:
		            		alert(response);
		            		break;
		            }
		            
		            if (count == options_length) {
		            	$('.loading-icon').hide();
		            	$('.accordion li').removeClass('disabled');
		            }
		        });
	    	});
	  }
}
	
  function waitForElement(elementPath, callBack){
    window.setTimeout(function(){
      if($(elementPath).length){
        callBack(elementPath, $(elementPath));
      }else{
        waitForElement(elementPath, callBack);
      }
    },500)
  }
  
  waitForElement(".settings_page_fxbp-scanner #wpbody-content",function(){
	var vm = new Vue({
  		el: '.wrap',
		data: {
		    selected: {
		    	serverType : '',
		    	brandType: { 
		    		name: '', abbreviation: '',
		    		urlLink: '', email: ''
		    	},
		    	clientEmail: '',
		    	websiteType: '',
		    },
		    
		    scanIsClicked: false,
		    brandList: [
	    		{ name: 'Cloud9 Media', abbrev: 'c9',
	    		  url: 'http://www.cld9.ph/', email: 'development@cld9.co', marketingEmail: 'marketing@cld9.co' },	
	    		{ name: 'FX Web Studio', abbrev: 'fx',
	    		  url: 'http://www.fxwebstudio.com.au/', email: 'development@fxwebstudio.com.au', marketingEmail: 'marketing@fxwebstudio.com.au' },
	    		{ name: 'Hello Local Media', abbrev: 'hl',
	    		  url: 'http://www.hellolocalmedia.com.au/', email: 'development@hellolocalmedia.com.au', marketingEmail: 'marketing@hellolocalmedia.com.au' },	
	    		{ name: 'Rocket SEO', abbrev: 'rs',
	    		  url: 'http://www.rocketseo.com.au/', email: 'development@rocketseo.com.au', marketingEmail: 'marketing@rocketseo.com.au'},
	    		{ name: 'Hero Media', abbrev: 'hm',
	    		  url: 'http://www.heromedia.net.au/', email: 'development@heromedia.net.au', marketingEmail: 'marketing@heromedia.net.au' },
	    	],
		},
		methods: {
			scanValidate: function(){
				var sEmail = $("input[name='clientEmail']").val();
		        
				if (($("input[name='webServer']:checked").val() == undefined) || 
					($("input[name='TypeOfWebsite']:checked").val() == undefined) || 
					($("input[name='companyBrand']:checked").val() == undefined) ) {
					alert('Fill the Required Fields');

				}else{

			        this.scanFunc();
				}
			},
			scanFunc : function(){
				this.scanIsClicked = true;
				var containers = '.left-section .fxuser_container .container, ' + 
		    	'.left-section .plugins_container .container, .right-section .misc_container .container,' +
		    	'.right-section .wpver_container .container';
		    	$(containers).remove();

		    	var runTest = new Run_Test();
		    	runTest.run(this.selected);

		    	Vue.nextTick(function(){
			  		$('.toggle').click(function(e) {
					  	e.preventDefault();
					  
					    var $this = $(this);
					  
					    if ($this.next().hasClass('show')) {
					        $this.next().removeClass('show');
					        $this.next().slideUp(350);
					    } else {
					        $this.parent().parent().find('li .inner').removeClass('show');
					        $this.parent().parent().find('li .inner').slideUp(350);
					        $this.next().toggleClass('show');
					        $this.next().slideToggle(350);
					    }
					});
			  	});
			},
			setBrand: function(brandName,abbrev, brandUrl, email, marketingEmail){
				// console.log('test' + name + ' ' + abbrev);
				this.selected.brandType.name = brandName,
				this.selected.brandType.abbreviation = abbrev,
				this.selected.brandType.urlLink = brandUrl,
				this.selected.brandType.email = email,
				this.selected.brandType.marketingEmail = marketingEmail
			}
		}
  	});

  	



	
  });

})( jQuery );
