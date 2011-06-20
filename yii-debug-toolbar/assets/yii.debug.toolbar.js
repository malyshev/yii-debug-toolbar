(function( $ ){
    var COOKIE_NAME = 'yii-debug-toolbar';

    yiiDebugToolbar = {
        init : function(){

            $('#yii-debug-toolbar-swither').bind('click',$.proxy( this.toggleToolbar, this ));
            $('.yii-debug-toolbar-button').bind('click',$.proxy( this.buttonClicked, this ));
            $('.yii-debug-toolbar-panel-close').bind('click',$.proxy( this.closeButtonClicked, this ));

            if ($.cookie(COOKIE_NAME)) {
                $('#yii-debug-toolbar').hide();
            } else {
                $('#yii-debug-toolbar').show();
            }
            this.initTabs();
        },

        initTabs : function()
        {
            $('#yii-debug-toolbar').find('ul.yii-debug-toolbar-tabs li').bind('click', $.proxy( this.toggleTabs, this ));
            $('.tabscontent').hide();

            var panelId = $('#yii-debug-toolbar').find('ul.yii-debug-toolbar-tabs li.active').attr('type');


            if (typeof panelId !== 'undefined')
            {
                var path = panelId.split('-');
                var panelName = path.pop();
                var section = path.join('-');

                if($.cookie(section))
                {
                    $('#yii-debug-toolbar').find('ul.yii-debug-toolbar-tabs li').removeClass('active');
                    panelId = section+'-'+$.cookie(section);
                    $('#'+panelId).show();
                    $('#yii-debug-toolbar').find('ul.yii-debug-toolbar-tabs li[type='+panelId+']').addClass('active');
                }
                else
                {
                    $('#'+panelId).show();
                }
            }

            
        },

        toggleTabs : function(e) 
        {
            e.preventDefault();
            var $target = $(e.currentTarget);
            $('.tabscontent').hide();
            $('#yii-debug-toolbar').find('ul.yii-debug-toolbar-tabs li').removeClass('active');

            var panelId = $target.attr('type');
            var path = panelId.split('-');
            var panelName = path.pop();
            var section = path.join('-');

            $.cookie(section, panelName, {
                path: '/',
                expires: 10
            });

            $('#'+panelId).show();
            $target.addClass('active');

        },

        toggle : function(elem, sender)
        {
            if (typeof elem == 'undefined') return false;
            $this = $(elem);
            if($this.is(":visible"))
            {
                $this.hide();
                $(sender).removeClass('collapsed');
            }
            else
            {
                $this.show();
                $(sender).addClass('collapsed');
            }
            return $this.is(":visible");
        },

        showPanel : function(id)
        {
            this.closeAllPannels();
            $('#'+id).show();
            $('.'+id).addClass('active')
        },

        buttonClicked : function(e)
        {
            this.showPanel($(e.currentTarget).attr('class').split(' ')[1]);
        },

        closeAllPannels : function()
        {
            $('.yii-debug-toolbar-panel').hide();
            $('.yii-debug-toolbar-button').removeClass('active');
        },

        closeButtonClicked : function(e)
        {
            this.closeAllPannels();
        },

        toggleToolbar : function(e)
        {
            //this.closeButtonClicked(e);
            if($('#yii-debug-toolbar').is(":visible"))
            {
                $('#yii-debug-toolbar').hide();
                $('#yii-debug-toolbar-swither a').removeClass('close');
                $.cookie(COOKIE_NAME, 'hide', {
                    path: '/',
                    expires: 10
                });
            }
            else
            {
                $('#yii-debug-toolbar').show();
                $('#yii-debug-toolbar-swither a').addClass('close');
                $.cookie(COOKIE_NAME, null, {
                    path: '/',
                    expires: -1
                });
            }
        }
    }
})( jQuery );
