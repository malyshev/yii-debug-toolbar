(function($){
    YiiDebugToolbar = {
    		
    	ic : function(id, s) {
    		id = 'collapse:' + id;
    		var r = localStorage.getItem(id);
    		if (null == r) {
    			localStorage.setItem(id, true);
    		} else if(typeof s != 'undefined'){
    			localStorage.setItem(id, s);
    		} 
    		return localStorage.getItem(id) == 'false' ? false : true;
    	},	
    		
        init : function() {
        	var lockedPanel = localStorage.getItem('ydtb-panel-lock');
        	if (null != lockedPanel) {
        		this.ic('[data-ydtb-toolbar]', false);
        		$('div[data-ydtb-panel]').removeClass('ydtb-panel-lock');
            	$('div[data-ydtb-panel="'+lockedPanel+'"]').addClass('ydtb-panel-lock').toggleClass('ydtb-collapse', false);
            	$('[data-ydtb-expand-panel="'+lockedPanel+'"]').addClass('active');
        	}
            
            $('#ydtb-toolbar').toggleClass('ydtb-collapse', this.ic('[data-ydtb-toolbar]'));
            $('#ydtb-toolbar').toggleClass('ydtb-slim', this.ic('.ydtb-slim'));
            
            
            $('[data-ydtb-data-table] tr').mouseenter(function(){
            	$(this).addClass('ydtb-hover');
            }).mouseleave(function(){
            	$(this).removeClass('ydtb-hover');
            });
            
            $('[data-ydtb-toggle]').bind('click', $.proxy(function(e) {
				var $el = $(e.currentTarget);
				var $target = $($el.data('ydtb-toggle'));
				$target.toggleClass('ydtb-collapse', !$target.hasClass('ydtb-collapse'));
				this.ic($el.data('ydtb-toggle'), $target.hasClass('ydtb-collapse'));
				localStorage.removeItem('ydtb-panel-lock');
				$('div[data-ydtb-panel]').removeClass('ydtb-panel-lock');
        	}, this));
            
            $('[data-ydtb-expand-panel]').bind('click', function(){
            	var $el = $(this);
            	$('[data-ydtb-menu] *').removeClass('active');
            	localStorage.removeItem('ydtb-panel-lock');
            	$('div[data-ydtb-panel]').removeClass('ydtb-panel-lock').addClass('ydtb-collapse');
            	$('div[data-ydtb-panel="'+$el.data('ydtb-expand-panel')+'"]').removeClass('ydtb-collapse');
            	$el.addClass('active');
            });
            
            $('div[data-ydtb-panel] i[data-ydtb-icon="f"], div[data-ydtb-panel] i[data-ydtb-icon="e"]').bind('click', $.proxy(function(e) {
            	var $target = $('#ydtb-toolbar');
            	$target.toggleClass('ydtb-slim');
            	this.ic('.ydtb-slim', $target.hasClass('ydtb-slim'));
            }, this));
            
            
            $('div[data-ydtb-options] i[data-ydtb-icon="t"], div[data-ydtb-options] i[data-ydtb-icon="u"]').bind('click', $.proxy(function(e) {
            	var $target = $('#ydtb-toolbar');
            	$target.toggleClass('ydtb-slim');
            	this.ic('.ydtb-slim', $target.hasClass('ydtb-slim'));
            }, this));
            
            $('div[data-ydtb-panel] i[data-ydtb-icon="z"]').bind('click', $.proxy(function(e){
            	var $el = $(e.currentTarget);
            	localStorage.setItem('ydtb-panel-lock', $el.data('ydtb-panel-lock'));
            	$('div[data-ydtb-panel]').removeClass('ydtb-panel-lock');
            	$('div[data-ydtb-panel="'+$el.data('ydtb-panel-lock')+'"]').addClass('ydtb-panel-lock');
            }, this));
            
            $('div[data-ydtb-panel] i[data-ydtb-icon="h"]').bind('click',  $.proxy(function(e) {
            	$('[data-ydtb-menu] *').removeClass('active');
            	localStorage.removeItem('ydtb-panel-lock');
            	$('div[data-ydtb-panel]').removeClass('ydtb-panel-lock').addClass('ydtb-collapse');
            }));
            
        	$('div[data-ydtb-tabs] ul li a').bind('click', function(e) {
        		e.preventDefault();
        		var $context = $(this).closest('div[data-ydtb-tabs]');
        		$('ul li a', $context).attr('data-ydtb-tab-state', 'closed');
        		$(this).attr('data-ydtb-tab-state', 'open');
        		$('div[data-ydtb-tab]', $context).hide();
        		$('div[data-ydtb-tab="'+ $(this).attr('href').replace(/^#/, '') +'"]', $context).show();
        	}).first().click();
        	
        	$('div[data-ydtb-accordion-heading]').not('[data-ydtb-data-size="0"]').click(function(){
        		var $el = $(this),
        			$owner = $el.closest('div[data-ydtb-accordion-group]'),
        			$body = $owner.find('div[data-ydtb-accordion-body]');
        		
        		$('div[data-ydtb-accordion-group]').not($owner).attr('data-ydtb-accordion-group', 'collapsed').data('ydtb-accordion-group', 'collapsed')
        		.find('div[data-ydtb-accordion-body]').css({'height' : '0px'});
        		
        		if ($owner.data('ydtb-accordion-group') != 'expanded') {
        			$body.css({'height' : ($body.find(':first-child').outerHeight() + 'px')});
        			$owner.attr('data-ydtb-accordion-group', 'expanded').data('ydtb-accordion-group', 'expanded');
        		} else {
        			$owner.attr('data-ydtb-accordion-group', 'collapsed').data('ydtb-accordion-group', 'collapsed');
        			$body.css({'height' : '0px'});
        		}
        	});
        }
    };
    
    $(function() {
    	YiiDebugToolbar.init();
    });
    
})( jQuery );
