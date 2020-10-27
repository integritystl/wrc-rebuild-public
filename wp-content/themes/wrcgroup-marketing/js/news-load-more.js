jQuery(document).ready(function($) {
  var listContainer = $('#news-list-container');
  var currentSite = listContainer.data('site');
  var pageNumber = 1;
  var defaultPPP = parseInt(rest_object.posts_per_page);
  var redirectNews = rest_object.redirect; //redirect should be false unless we're coming from single view
  var listViewCategory = listContainer.data('category');
  var listViewTag = listContainer.data('tag');

  //check for flag of if is a single post view
  if (rest_object.single) {
    var newsURL = rest_object.newsURL;
  } else {
    var newsURL = '';
  }

  //only do initial page load if its first page; make sure it doesn't overwrite a category filter from Single Post
  if (pageNumber == 1 && !rest_object.single && !listViewCategory && !listViewTag) {
    load_posts(pageNumber, defaultPPP);
  } else if (rest_object.single){
    //don't do anything

  } else {
    //carry on
    load_posts(1, defaultPPP, listViewCategory, listViewTag, true, false);
  }

  //Access the site's ID from a single article's data attribute in case it's undefined
  if(typeof currentSite === undefined) {
    //get the site ID from data-attribute, make sure it's a number
    var siteAttr = $('.post').attr('data-site');
    currentSite = parseInt(siteAttr);
  }

  function load_posts(paged, ppp, category, tag, clearListing, redirect){
    //Defaults
    paged = (typeof paged !== 'undefined') ?  paged : 1;
    ppp = (typeof ppp !== 'undefined') ? ppp : defaultPPP;
    category = (typeof category !== 'undefined') ? category : 'ALL';
    tag = (typeof tag !== 'undefined') ? tag : 'ALL';
    clearListing = (typeof clearListing !== 'undefined') ? clearListing : false;
    redirect = (typeof redirect !== 'undefined') ? redirect : redirectNews;

    var data = {
      paged: paged,
      ppp: ppp,
      site: currentSite,
      newsURL: newsURL,
      redirect: redirect,
    }

    if(category && category !== 'ALL'){
      data['category'] = category;
    }

    if(tag && tag !== 'ALL') {
      data['tag'] = tag;
    }

    $.ajax({
        url: rest_object.api_url + 'load_more_news/',
        dataType: "html",
        type: 'post',
        data: data,
        cache: false,
        beforeSend: function(xhr){
          xhr.setRequestHeader( 'X-WP-Nonce', rest_object.api_nonce );
          $('.loading-screen').addClass('visible');
        },
        success: function( response ){
          if (redirect) {
            if (tag !== 'ALL') {
              window.location.href = newsURL + '?tag=' + tag;
            } else {
              //we clicked a category
              window.location.href = newsURL + '?cat=' + category;
            }
          }

          if(clearListing){
            listContainer.html(response);
          }else{
            listContainer.append(response);
          }
          pageNumber++;

          //Check if there's a query param category set, also update with the sidebar when it's clicked
          if (listViewCategory) {
            if (listViewCategory !== category) {
              var matchCat = listContainer.attr('data-category', category);
              sideBarCategoryFiltering(category);
            } else {
              sideBarCategoryFiltering(listViewCategory);
            }
          }
          //Check if there's a query param tag set
          if (listViewTag && !category) {
             $('.tags-title').addClass('visible');
          }
        },
        fail : function( response ) {
          listContainer.append('<p>Sorry, no posts can be loaded.</p>');
        },
        complete : function(){
           //Match up the data-category attributes for list container and load more btn
           if(category && category !== 'ALL') {
             listContainer.attr('data-category', category);
             $("#load-more-btn").attr('data-category', category);
           } else {
             //wipe out the previous data-category values if ALL
             listContainer.attr('data-category', '');
             $("#load-more-btn").attr('data-category', '');
           }

           if(tag && tag !== 'ALL') {
             listContainer.attr('data-tag', tag);
             $("#load-more-btn").attr('data-tag',tag);
           } else {
              $('.tags-title').removeClass('visible');
           }

           //Check if there's a query param category set, also update with the sidebar when it's clicked
           if (listViewCategory) {
             if (listViewCategory !== category) {
               var matchCat = listContainer.attr('data-category', category);
               sideBarCategoryFiltering(category);
             } else {
               sideBarCategoryFiltering(listViewCategory);
             }
           }
           //Check if there's a query param tag set
           if (listViewTag && !category) {
              $('.tags-title').addClass('visible');
           }
          $('.loading-screen').removeClass('visible');
          $("#load-more-btn").removeClass('btn-hide');

          var noMorePostsMsg = $('p').hasClass('load-more-no-posts');
          if (noMorePostsMsg) {
            $("#load-more-btn").attr('disabled', 'true');
          }else{
            $("#load-more-btn").removeAttr('disabled');
          }
        }
    });
    //end ajax
  };


  $("#load-more-btn").on("click",function(e){
      e.preventDefault();
      var btnCat = $(this).attr('data-category');
      var btnTag = $(this).attr('data-tag');

      //Load more of the current category
      if (btnCat) {
        load_posts(pageNumber, defaultPPP, btnCat);
      } else if (btnTag) {
        load_posts(pageNumber, defaultPPP, btnCat, btnTag);
      } else {
        //if no data-category
        load_posts(pageNumber, defaultPPP);
      }

  });

  //Get the category title and description when we've filtered for a category
  // & update the sidebar styles. Needs categoryID passed in as a param
  function sideBarCategoryFiltering(catID) {
    $('.cat-item.active-item').removeClass('active-item');
    var sidebarCat = $('.news-category-list .cat-item a[data-category*='+ catID +']');

    if ( sidebarCat ) {
      $(sidebarCat).parent('.cat-item').addClass('active-item');

      //Show category title and description, replacing News title
      if( catID !== 'ALL' ) {
        //all other cats
        if($(sidebarCat).parent('.cat-item').hasClass('archive-item')){
          $('.archive-title').removeClass('visible');
          $('.news-title').removeClass('hidden');
        } else {
          if(!$('.archive-title').hasClass('visible')){
            $('.archive-title').addClass('visible');
          }
          if(!$('.news-title').hasClass('hidden')){
            $('.news-title').addClass('hidden');
          }
          $('.tags-title').removeClass('visible');
          $('.archive-title').html($(sidebarCat).text());
          $('.archive-description p').html($(sidebarCat).attr('title'));
        }
      } else {
        //if All News is clicked, keep News page title
        $('.archive-title').removeClass('visible');
        $('.archive-description p').html('');
        $('.news-title').removeClass('hidden');
      }

    }
  }

  //Filtering from the sidebar
  $(".news-category-list .cat-item a").on("click",function(e){
      e.preventDefault();
      var category = $(this).data('category');

      //If newsURL exists, we should be on a single page that gets redirected to that News page
      // when a category is filtered. Otherwise, we're on the List View filtering categories
      if (newsURL && rest_object.single) {
        load_posts(1, defaultPPP, category, tag = 'ALL', true, true);
      } else {
        //reset pageNumber whenever we filter for a category
        // so our Load More for Categories is correct
        if (pageNumber > 1 ) {
          pageNumber = 1;
        }
        sideBarCategoryFiltering(category);
        load_posts(pageNumber, defaultPPP, category, tag = 'ALL', true, false);
      }
  });

  $("#news-list-container").on('click', '.categories .post_item_cat',function(e){
    e.preventDefault();
    var category = $(this).data('category');
    //reset pageNumber whenever we filter for a category
    // so our Load More for Categories is correct
    if (pageNumber > 1 ) {
      pageNumber = 1;
    }
    sideBarCategoryFiltering(category);
    load_posts(1, defaultPPP, category, tag = 'ALL', true, false);
  });

  $("#news-list-container").on('click', '.tags .post_item_tax',function(e){
    e.preventDefault();
    var tag = $(this).data('tag');
    //reset pageNumber whenever we filter for a tag from News page
    // so our Load More for Tags is correct
    if (pageNumber > 1 ) {
      pageNumber = 1;
    }

    if($('.archive-title').hasClass('visible')){
      $('.archive-title').removeClass('visible');
      $('.archive-description p').html('');
    }

    $('.tags-title').html($(this).text());
    $('.tags-title').addClass('visible');

    load_posts(1, defaultPPP, category = 'ALL', tag, true, false);
  });

  $(".single").on('click', '.tags .post_item_tax',function(e){
    e.preventDefault();
    var tag = $(this).data('tag');

    load_posts(1, defaultPPP, category = 'ALL', tag, true, true);
  });

  //Category filtering from post meta on a News Post (Single View)
  $(".single").on('click', '.categories .post_item_cat',function(e){
    e.preventDefault();
    var category = $(this).data('category');
    sideBarCategoryFiltering(category);

    load_posts(1, defaultPPP, category, tag = 'ALL', true, true);
  });

});
