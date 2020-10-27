jQuery(document).ready(function($) {
  //FIND AN AGENT/MUTUAL DATA TABLE
  //https://datatables.net/examples/basic_init/dom.html

  //Check if we are running a distance search
  var distanceSearch = $('#agent-search__container').attr('data-distance');
  //Check for keyword search and if we're on the page-find-agent template
  var keywordSearch = $('#agent-search__container').attr('data-keyword');
  var tablePage = rest_object.isTablePage;

  //Check if form has values first passed through first so we can compare to know if we should load ajax at all
  var latParam = getUrlParameter('userLatitude');
  var longParam = getUrlParameter('userLongitude');

  var homeSearchParam = getUrlParameter('homepage_search');
  var searchAgainParam = getUrlParameter('research');

  //By default, disable the submit button for Agent/Mutual Search By Distance until someone does a search
  $('.homepage_agent_search_submit, .agent-distance-search-submit').prop('disabled', true);

  //Search Agent/Mutual with user location if we have it
  //This fires slowly :\
  var userLatitude  = '';
  var userLongitude = '';
  function load_location_dist(lat, long){
    var data = {
      lat : lat,
      long : long,
      pageTemp : rest_object.permalink,
      distanceSearch : distanceSearch,
      objectType : rest_object.objectType,
    }
    $.ajax({
      url: rest_object.api_url + 'load_location_dist/',
      data: data,
      type: 'post',
      dataType: "html",
      cache: false,
      beforeSend: function(xhr){
        xhr.setRequestHeader( 'X-WP-Nonce', rest_object.api_nonce );
        $('.loading-screen').addClass('visible'); //need to loading screen over the table while these requests happen
      },
      fail: function(response){
        //Whadda we doing if this fails?
      },
      success: function(response){
      //IF it's not from the homepage, reload the whole damn page after running distance func
        if (data.distanceSearch != 1 && data.lat && data.long) {
          window.location.href = rest_object.permalink + '?userLatitude=' + data.lat + '&userLongitude=' + data.long +'&research=1';
        } else {

        }
      },
      complete: function(response){
        $('.loading-screen').removeClass('visible');
        if (data.distanceSearch != 1 ) {

        } else {

        }
      }
    });
  };

  var geoCookie = getCookie('disableGeolocation');
  if (navigator.geolocation && !geoCookie){
    /* geolocation is available */
    var positionOptions = {
      //https://developer.mozilla.org/en-US/docs/Web/API/PositionOptions
      //https://developers.google.com/web/fundamentals/native-hardware/user-location/
      maximumAge: 5 * 60 * 1000,
    }
    var latitude = getCookie('userLatitude');
    var longitude = getCookie('userLongitude');
    if(latitude && longitude){
      var position = {
        coords: {
          latitude: latitude,
          longitude: longitude
        }
      };
      showPosition(position);
    }
    else {
      navigator.geolocation.getCurrentPosition(showPosition, noPosition, positionOptions);
    }
  } else {
    //no geolocation support for this browser, what should happen?
    noPosition();
  }
  //a thing for geo location
  function showPosition(position) {
    console.log(position);
    userLatitude  = position.coords.latitude;
    userLongitude = position.coords.longitude;
    //Set a cookie so we can read this easily on other pages.
    setCookie('userLatitude', userLatitude, 1);
    setCookie('userLongitude', userLongitude, 1);

    //assign users position to hidden input fields for our homepage search & on-page search
    $('#homepage_search-userLat').val(userLatitude);
    $('#homepage_search-userLong').val(userLongitude);
    $('#agent-distance-search-userLat').val(userLatitude);
    $('#agent-distance-search-userLong').val(userLongitude);
    $('.form-location-info').text('Thanks for letting us know your location').addClass('show-location');
    $('.form-location-clear-info').addClass('show-location');
    $('.form-location-clear-button').addClass('show-location');

    $('.form-location-reuse-button').removeClass('show-location');
    //assign position to data-attributes that need 'em
    $('#agent-search__container').attr('data-lat',userLatitude ).attr('data-long',userLongitude );

    $('.homepage_agent_search_submit, .agent-distance-search-submit').prop('disabled', false);
    $('.agent-search_block').addClass('no-background');
    $('.agent_search_block-intro').hide();
    $('.agent_search-input, .homepage_search-input').hide();
    $('.agent-distance-search-submit').hide();
    $('#agent-search-term__container').addClass('no-terms');
    $('.search-term').hide();


    if (userLatitude !== '' && userLatitude !== '') {
      //Once we have lat/long, stop asking for location so we don't use up extra processes
      //navigator.geolocation.clearWatch(geoId);
    }

    //this needs to NOT run if we've come from the homepage search,
    //the actual homepage template, or the in-page agent search box
    //Check for agent-search-keywords and ?homepage_search instead of empty lats?
    if ( tablePage && homeSearchParam.length == 0 && keywordSearch.length == 0 && !searchAgainParam) {
    //if ( tablePage && latParam.length == 0 && longParam.length == 0) {
      load_location_dist(userLatitude, userLongitude);

    } else {

    }
  }

  function noPosition(positionError) {
    console.log(positionError);
    $('#homepage_search-userLat').val('');
    $('#homepage_search-userLong').val('');
    $('#agent-distance-search-userLat').val('');
    $('#agent-distance-search-userLong').val('');
    $('.form-location-info').text('').removeClass('show-location');
    $('.form-location-clear-info').removeClass('show-location');
    $('.form-location-clear-button').removeClass('show-location');
    
    if(getCookie('disableGeolocation')){
      $('.form-location-reuse-button').addClass('show-location');
    }
  }

  $('.form-location-clear-button').on('click', function(){
    if(getCookie('userLatitude')){
      setCookie('userLatitude', -1, -1);
    }
    if(getCookie('userLongitude')){
      setCookie('userLongitude', -1, -1);
    }
    if(getCookie('disableGeolocation') === ''){
      setCookie('disableGeolocation', true, 1);
    }

    window.location.href = rest_object.permalink;
  });

  $('.form-location-reuse-button').on('click', function(){
    if(getCookie('disableGeolocation')){
      setCookie('disableGeolocation', -1, -1);
    }

    window.location.href = rest_object.permalink;
  });

  //Autocomplete is set to 'off' on these inputs to prevent issues with disabling Search button
  $('#homepage_agent_search_input, .agent-distance-search-box').on('keyup change', function(){
    var emptySearch = false;
    if ($(this).val() == '') {
      emptySearch = true;
    }
    //Re-disable it if someone clears their search
    if (emptySearch) {
      $('.homepage_agent_search_submit, .agent-distance-search-submit').prop('disabled', true);
    } else {
      $('.homepage_agent_search_submit, .agent-distance-search-submit').prop('disabled', false);
    }
  });

  var placeholderText = '';
  //Change placeholder text based on if it's a Mutual or Agent table
  if ($('#agent-search__table').hasClass('table-agent') ) {
    placeholderText = "Filter by Agency or Address";
  } else {
    placeholderText =  "Mutual, Address or Manager";
  }

  //reorder based on if there's distance search
  if(!distanceSearch) {
    tableOrder = [[0, "asc"]];
  } else {
    tableOrder = [[3, "asc"]]; //order only by distance, not distance/alpha
  }

  $('#agent-search__table').DataTable({
    "dom": '<"agent-search__table-top"f>t<"agent-search__table-bottom"ip>',
    "processing": true,
    "order": tableOrder,
    "pageLength" : 20,
    "search": {
      "search": keywordSearch, //pre-fill the table with a search at initilization if there's a keyword search
    },
    "language": {
      "search": "Filter",
      "searchPlaceholder": placeholderText,
    },
    drawCallback: function(settings) {
        var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
        pagination.toggle(this.api().page.info().pages > 1);
    }
  });


  //Move some controls that aren't in Datatables
  $("#agent-search__table_filter").prepend( $('#agent-search-term__container') );
  $("#agent-search__table_filter input").addClass('agent-search-field');

  var agentTable = $('#agent-search__table').DataTable();

  //Stuff that happens on most resets/clearing of search/filters
  function baseReset() {
    agentTable.columns().order('asc'); //Change column ordering back to default
    agentTable.draw(); //Redraw's required to reset
  }

  //Clear All Button / Reset to initial table
  $('.agent-search-clear').on('click', function(){

    agentTable.column(3).search(''); //reset any search from Distance
    agentTable.columns(3).order('asc');
    agentTable.search(''); //Clear search

    $('#agent-search-keywords').val(''); //clear any distance search terms
    $('.search-term').empty().addClass('term-empty'); //destroy that distance search

    $('#agent-search-term__container').css({
      'opacity': '0',
      'visibility': 'hidden',
      });

    baseReset();
  });


  //put the Filter Term in the Search results container
  $('.agent-search-field').keyup(function() {

    $('#agent-search-term__container').css({
      'opacity': '1',
      'visibility': 'visible',
    });

    $('.filter-term').removeClass("term-empty");
    $('.filter-term').html($('.agent-search-field').val() + '<i class="fa fa-times-circle" aria-label="Remove Term"></i>');
  });


  //clear Search term if clicked
  $('.search-term').on('click', function(){
    $(this).html('').addClass('term-empty');
    if(!distanceSearch || $('.filter-term').length == 0 || $('.filter-term').hasClass('term-empty') ) {
      agentTable.search(''); //this clears All the Things
      baseReset();
    } else {
      //keep the distance ordering if this is a distance search
      agentTable.search('');
      agentTable.order( [3, 'asc'] ); //redo our distance ordering after clearing out filter
      agentTable.draw();
    }
    //hide search term container if zip/state/city search from homepage is removed or if its empty
    if ($('.filter-term').hasClass('term-empty') || $('.filter-term').length == 0 ) {

      $('#agent-search-term__container').css({
        'opacity': '0',
        'visibility': 'hidden',
      });

    }
  });

  //clear filter term if clicked
  $('.filter-term').on('click', function(){
    $(this).html('').addClass('term-empty');
    if(!distanceSearch || $('.search-term').length == 0 || $('.search-term').hasClass('term-empty') ) {
      agentTable.search(''); //this clears All the Things
      baseReset();
    } else {
      //keep the distance ordering if this is a distance search
      agentTable.search('');
      agentTable.order( [3, 'asc'] ); //redo our distance ordering after clearing out filter
      agentTable.draw();
    }
    //hide search term container if zip/state/city search from homepage is removed or if its empty
    if ($('.search-term').hasClass('term-empty') || $('.search-term').length == 0 ) {

      $('#agent-search-term__container').css({
        'opacity': '0',
        'visibility': 'hidden',
      });

    }
  });

  //gimme URL params
  //https://davidwalsh.name/query-string-javascript
  function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
  };

  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
  }
  function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

});
