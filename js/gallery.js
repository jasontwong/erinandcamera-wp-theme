jQuery(function($){
    var background = $('#backgrounds'),
        images = $(window).data('images'),
        delay = 5000,
        left_nav = $('#left-nav'),
        right_nav = $('#right-nav'),
        gallery_nav = $('.gallery-nav'),
        current_images = $('img', background),
        first_slide, last_slide, animate_timeout,
        animate_prev = function(image) {
            var next_image = image.next().length
                ? image.next() 
                : first_slide;
            image
                .fadeOut('slow');
            next_image
                .fadeIn('slow');
                /* 
                .fadeIn('slow', function(){
                    animate_timeout = setTimeout(function(){ animate(next_image); }, delay);
                });
                */
        },
        animate_next = function(image) {
            var next_image = image.prev().length
                ? image.prev() 
                : last_slide;
            image
                .fadeOut('slow');
            next_image
                .fadeIn('slow');
                /* 
                .fadeIn('slow', function(){
                    animate_timeout = setTimeout(function(){ animate(next_image); }, delay);
                });
                */
        };
    // {{{ nav
    right_nav
        .click(function(){
            if (current_images.length > 1)
            {
                animate_timeout = setTimeout(function(){ animate_next($('img:visible', background)); } );
            }
        })
        .hover(function(){
            if (current_images.length > 1)
            {
                $(this).css('cursor', 'pointer');
                $('> img', this).show();
            }
            else
            {
                $(this).css('cursor', 'default');
            }
        }, function(){
            $('> img', this).hide();
            $(this).css('cursor', 'default');
        });
    left_nav
        .click(function(){
            if (current_images.length > 1)
            {
                animate_timeout = setTimeout(function(){ animate_prev($('img:visible', background)); } );
            }
        })
        .hover(function(){
            if (current_images.length > 1)
            {
                $(this).css('cursor', 'pointer');
                $('> img', this).show();
            }
            else
            {
                $(this).css('cursor', 'default');
            }
        }, function(){
            $('> img', this).hide();
            $(this).css('cursor', 'default');
        });
    // }}}
    // {{{ window resize
    $(window)
        .resize(function(){
            var win_height = $(window).height(),
                win_width = $(window).width(),
                nav_left_img = $('> img', left_nav);
                nav_right_img = $('> img', right_nav);
            nav_right_img
                .css('margin-top', (win_height / 2) - (nav_right_img.height() / 2) + 'px');
            nav_left_img
                .css('margin-top', (win_height / 2) - (nav_left_img.height() / 2) + 'px');
            current_images
                .each(function(){
                    var el = $(this),
                        img_height = el.data('height'),
                        img_width = el.data('width'),
                        current_height = el.height(),
                        current_width = el.width(),
                        height_ratio = win_height / img_height;
                    if (img_width * height_ratio < win_width)
                    {
                        el.width(win_width);
                    }
                    else
                    {
                        el.height(win_height);
                    }
                    if (current_width < win_width)
                    {
                        el.width(win_width);
                    }
                    if (current_height < win_height)
                    {
                        el.height(win_height);
                    }
                });
        });
    // }}}
    // {{{ gallery load
    $('a', gallery_nav)
        .click(function(){
            var el = $(this),
                img;
            // start loading
            el.addClass('selected').siblings().removeClass('selected');
            background.empty();
            console.log(images);
            for (i in images)
            {
                if (images[i].group === el.text())
                {
                    img = $('<img src="' + images[i].src + '" />');
                    img.data('height', images[i].height);
                    img.data('width', images[i].width);
                    img.hide();
                    background.append(img);
                }
            }
            current_images = $('> img', background);
            first_slide = current_images.first();
            last_slide = current_images.last();
            last_slide
                .show()
                .load(function(){
                    // end loading
                    last_slide.show();
                    // animate_timeout = setTimeout(function(){ animate(last_slide); }, delay);
                    $(window).resize();
                });
        });
    // }}}
    $(window).resize();
    $('body')
        .bind("contextmenu", function(e) {
            e.preventDefault();
        });
});
