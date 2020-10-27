jQuery(document).ready(function($) {
  var listContainer = $('#search-results-container');
  var pageNumber = 1;
  var defaultPPP = rest_object.posts_per_page;
  var currentSite = rest_object.current_site;
  var site = listContainer.data('site');
  var search = listContainer.data('search-terms'); //nab the current search terms

  function load_posts(search, page, ppp){
    //Defaults
    paged = (typeof paged !== 'undefined') ?  paged : 1;
    ppp = (typeof ppp !== 'undefined') ? ppp : defaultPPP;

    var data = {
      page: page,
      ppp: ppp,
      search : search,
      offset: (page * ppp) + 1,
      site: currentSite,
    }

    $.ajax({
        url: rest_object.api_url + 'load_more_results/',
        dataType: "html",
        type: 'post',
        data: data,
        cache: false,
        beforeSend: function(xhr){
          xhr.setRequestHeader( 'X-WP-Nonce', rest_object.api_nonce );
          $('.loading-screen').addClass('visible');
        },
        success: function( response ){
          listContainer.append(response);
          pageNumber++;
        },
        fail : function( response ) {
          listContainer.append('<p>Sorry, no posts can be loaded.</p>');
        },
        complete : function(){
          $('.loading-screen').removeClass('visible');
          $("#load-more-btn").removeClass('btn-hide');
          var noMorePostsMsg = $('p').hasClass('load-more-no-posts');
          if (noMorePostsMsg) {
            $("#load-more-btn").attr('disabled', 'true');
          }

          var noResultsMsg = $('p').hasClass('search-no-results');
          if (noResultsMsg) {
            $("#load-more-btn").remove();
          }
        }
    });
  };


//  only do initial page load if its first page
  if (pageNumber = 1 ) {
    load_posts(search, pageNumber, defaultPPP);
  }

  $("#load-more-btn").on("click",function(e){
      e.preventDefault();
      load_posts(search, pageNumber, defaultPPP);
  });

});
