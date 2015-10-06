$.fn.ourCampuses = function(){
    var ourCampusesSnippet = this;
    var ourCampusesIndex = this.find('.our-campuses-courses-index');
    var ourCampusesContent = this.find('.our-campuses-courses-content');

    var last_browser_width = $(window).width();// only updated when browser changes from mobile to desktop width or vice versa

    // show a particular campus on the desktop view
    ourCampusesSnippet.showDesktopCampus = function(campus){
        //if there is no campus, hide them all
        if(!campus){
            ourCampusesContent.find('.campuses').hide();
            return;
        }

        //show the appropriate campus
        ourCampusesContent.find('.campuses').show();
        ourCampusesContent.find('.campuses-nav li').each(function(){
            if($(this).data('campus') == campus){
                $(this).find('a').addClass('active');
            }
            else{
                $(this).find('a').removeClass('active');
            }
        });
        ourCampusesContent.find('.campuses li').each(function(){
            if($(this).data('campus') == campus){
                $(this).show();
            }
            else{
                $(this).hide();
            }
        });
        
    };

    // prepare the desktop view
    ourCampusesSnippet.prepDesktopCampus = function(){
        ourCampusesContent.hide();
        ourCampusesSnippet.clearMobileCampus();
        ourCampusesIndex.show();
    };

    // show a particular campus on the mobile view
    ourCampusesSnippet.showMobileCampus = function(campus){

        //if no campus is passed, hide all mobile campuses
        if(!campus){
            ourCampusesContent.find('.campuses-nav li').each(function(){
                    $(this).find('.campus-content').hide();
            });
            return;
        }

        //else toggle the specified campus
        ourCampusesContent.find('.campuses-nav li').each(function(){
            if($(this).data('campus') == campus){
                var show = !$(this).find('.campus-content').is(":visible");

                if (show) {
                    $(this).find('.campus-content').slideDown(400);
                    $(this).find("i").removeClass('icon-chevron-down');
                    $(this).find("i").addClass('icon-chevron-up');
                    $(this).find('a').addClass('active');
                }
                else{
                    $(this).find('.campus-content').slideUp(400);
                    $(this).find("i").removeClass('icon-chevron-up');
                    $(this).find("i").addClass('icon-chevron-down');
                    $(this).find('a').removeClass('active');
                }
                
            }
        });
    };

    ourCampusesSnippet.prepMobileCampus = function(){
        // hide the desktop campuses
        ourCampusesIndex.hide();
        ourCampusesContent.find('.campuses').hide();
        ourCampusesContent.find('.campuses-nav li a').removeClass('active');
        ourCampusesContent.find('.campuses-nav li i').removeClass('icon-chevron-up');
        ourCampusesContent.find('.campuses-nav li i').addClass('icon-chevron-down');

        // setup each campus's mobile content if is hasnt already
        if(ourCampusesContent.find('.campus-content').length == 0){
            ourCampusesContent.find('.campuses-nav li').each(function(){
                var campus = $(this).data('campus');
                $(this).append('<div class="campus-content">'+ourCampusesContent.find('.campuses li[data-campus="'+campus+'"]').html()+'</div>');
                $(this).find('.campus-content').hide();
            });
        }
        
        ourCampusesContent.show();
        
    };

    ourCampusesSnippet.clearMobileCampus = function(){
        ourCampusesContent.find('.campuses-nav li .campus-content').remove();
    };

    ourCampusesSnippet.prepare = function(){

        // Desktop
        if (last_browser_width > 767) {
            ourCampusesSnippet.prepDesktopCampus();
        }

        // Mobile
        else{
            ourCampusesSnippet.prepMobileCampus();
        }
    };

    ourCampusesSnippet.prepare();

    // hide all campuses in the detailed view
    ourCampusesSnippet.showDesktopCampus(false);

    //find each campus thumbnail and assign a click to them
    ourCampusesIndex.find('li.thumbnail').click(function(){
        ourCampusesSnippet.showDesktopCampus($(this).data('campus'));
        ourCampusesIndex.fadeOut(100, function(){
            ourCampusesContent.fadeIn(100);
        });
        
        return false;
    });

    //find each campus link and assign a click to them
    ourCampusesContent.find('li.campuses-nav-item a').click(function(){
        if (last_browser_width > 767) {
            ourCampusesSnippet.showMobileCampus(false);
            ourCampusesSnippet.showDesktopCampus($(this).parent().data('campus'));
        }
        else{
            ourCampusesSnippet.showDesktopCampus(false);
            ourCampusesSnippet.showMobileCampus($(this).parent().data('campus'));

        }

        return false;
    });

    //be responsive when the window is changed
    $(window).resize(function(view) {
        if( (last_browser_width <= 767 && $(window).width() > 767) ||
            (last_browser_width > 767 && $(window).width() <= 767)
        ){
            last_browser_width = $(window).width();
            ourCampusesSnippet.prepare();
        }
    });
};