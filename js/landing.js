jQuery(function($){
    var masthead = $('#masthead')
        bookmark = $('> .bookmark', masthead),
        social = $('> .social', masthead),
        div = $('> div', social);
    $('.facebook', social)
        .hover(function(){
            div.text("yeah, i'm on this");
        },
        function(){
            div.text('');
        });
    $('.flickr', social)
        .hover(function(){
            div.text('* i use this lots');
        },
        function(){
            div.text('');
        });
    $('.heart', social)
        .click(function(e){
            e.preventDefault(); // this will prevent the anchor tag from going the user off to the link
            var el = $(this),
                bookmarkUrl = this.href,
                bookmarkTitle = this.title;
             
            if (window.sidebar) { // For Mozilla Firefox Bookmark
                window.sidebar.addPanel(bookmarkTitle, bookmarkUrl,"");
            } else if( window.external || document.all) { // For IE Favorite
                window.external.AddFavorite( bookmarkUrl, bookmarkTitle);
            } else if(window.opera) { // For Opera Browsers
                el.attr("href",bookmarkUrl)
                    .attr("title",bookmarkTitle)
                    .attr("rel","sidebar");
            } else { // for other browsers which does not support
                 alert('Your browser does not support this bookmark action');
                 return false;
            }
        })
        .hover(function(){
            bookmark.show();
        },
        function(){
            bookmark.hide();
        });
});
