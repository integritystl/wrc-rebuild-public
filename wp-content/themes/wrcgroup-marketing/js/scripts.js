//this is where our js goes
jQuery(document).ready(function($) {
  //Emergency Announcement cookie functionality

  function createCookie(name,value,minutes) {
      if (minutes) {
          var date = new Date();
          date.setTime(date.getTime()+(minutes*60*1000));
          var expires = "; expires="+date.toGMTString();
      }
      else var expires = "";
      document.cookie = name+"="+value+expires+"; path=/";
  }

  function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    var bannerCookie = readCookie('bannerCookie');
    if(!bannerCookie){
      $('.announcements-banner').removeClass('closed');
    }

    $('a.announcement-close').on('click', function(e){
      e.preventDefault();
      $('.announcements-banner').addClass('closed');
      var expiration = 60;
      if ($('.announcements-banner').data('expiration')) {
        expiration = $('.announcements-banner').data('expiration');
      }
      createCookie('bannerCookie', true, expiration);
    });


  //This is all JS from The Bridge
  // Overwrite some of the default configurations for Parsley, like DOM placement of error messages
  var parsleyConfig = {
    errorsContainer: '.modal__error'
  }

  $('#policy-number-check').parsley(parsleyConfig);
  $('#policy-number-check').on('submit', function(e){
    var form = $('#policy-number-check').parsley();
    form.validate();

    if(form.isValid()){
      var inputVal = $('#policy-num').val();
      var ottomationPattern = /^[a-zA-Z]{4}\d{6}[-]\d{2}$/;
      if(ottomationPattern.test(inputVal)){
        window.open('https://mypolicy.1stauto.com/#/access/signin', 'target=_blank, rel=noreferrer');
      }else{
        window.open('https://epayment.epymtservice.com/epay.jhtml?billerGroupId=AUT&billerId=AUT&productCode=BillerGroup-AUT&disallowLogin=N', 'target=_blank, rel=noreferrer');
      }
      closeModal();
    }
    //avoid return false so our tagmanager events can capture events
    e.preventDefault();
  });


  window.Parsley.addValidator('policyTypeCheck', {
    requirementType: 'string',
    validateString: function(value, requirement){
      var fieldInstance = $('#policy-num').parsley();
      var boltPattern = /^[a-zA-Z]{4}[-]\d{1,5}$/;
      fieldInstance.removeError("customError");
      if(value.match(requirement)){
        if (boltPattern.test(value) && $('#modalFormBillPolicy .modal__title').data("title") === "access-policy") {
          fieldInstance.removeError("policyTypeCheck"); //don't show the message about matching the bill at the same time as the Contact Agent message
          fieldInstance.addError("customError", {message: "Please contact your Agent. Your policy number is not accessible at this time."});
          return false;
        }else{
          return true;
        }
      }else{
        //this happens in the form and isn't needed here (?)
      //  fieldInstance.addError("customError", {message: "Please enter a policy number that matches the format on your invoice."});
        return false;
      }
    }
  });

  //Bill Pay Modal involves 2 steps to choose company. My Policy one does not.
  $('.bill__modal-trigger').on('click', function(e){
    e.preventDefault();
    dataLayer.push({'modal_link_click': 'bill__modal-trigger'});
    openModal('Pay Bill', 'pay-bill', $(this) );
  });

  $('.policy__modal-trigger').on('click', function(e){
    e.preventDefault();
    dataLayer.push({'modal_link_click': 'My Policy Modal'});
    openModal('My Policy', 'access-policy', $(this) );
  });

  $('.first-otto-link').on('click', function(e) {
    e.preventDefault();
    $('body').addClass('modal-open');
    $('#modal1stOtto').removeClass('modal__hide');
  });

  $('.modal__inner').on('click', function(e) {
    e.stopPropagation();
  });

  $('.modal-fade-screen, .modal__close').on('click', closeModal);

  function openModal(title, titleAttr, modal) {

    //The modals for My Policy & Pay Bill use the same form.
    //Pay Bill requires selecting a company first & My Policy has a different error message
    var title = "Pay Bill";
    var titleAttr = "pay-bill";
    if(modal.hasClass('policy__modal-trigger')){
      //if it's about Policy, change the header and hide the company logos
      title = "My Policy";
      titleAttr = "access-policy";
      $('.modal__company').addClass('modal__hide');
      $('.modal__form-wrap').removeClass('modal__hide');
      $('.modal__inner').removeClass('modal__inner-select');
    } else {
      //Pay Bill, we get the Company selection instead
      $('.modal__company').removeClass('modal__hide');
      $('.modal__form-wrap').addClass('modal__hide');
    }
    $('#modalFormBillPolicy .modal__title').text(title);
    $('#modalFormBillPolicy .modal__title').data("title", titleAttr);

    $('body').addClass('modal-open');
    //this should be specific to company modal and not global
    //$('.modal__company').removeClass('modal__hide');
    //$('.modal__form-wrap').addClass('modal__hide');
    $('.modal__bill_policy').removeClass('modal__hide');
  }

  function closeModal(){
    $('body').removeClass('modal-open');
    $('#modal1stOtto').addClass('modal__hide');
    $('.modal__policy').addClass('modal__hide');
    $('.modal__bill_policy').addClass('modal__hide');
    $('.modal__inner').addClass('modal__inner-select'); //put this back in case we click Company or 1st Ottomation modals
    // reset Parsley & form field attributes so we don't have conflicts betwee Pay Bill and My Policy
    $('#policy-number-check').parsley().reset();
    $('#policy-num').val('');
  }

  
  //remove not using modal form-wrap anymore
  // $('.company__modal-trigger').on('click', function(){
  //   $('.modal__inner').removeClass('modal__inner-select');
  //   $('.modal__company').addClass('modal__hide');
  //   $('.modal__form-wrap').removeClass('modal__hide');
  // });

  //--Smooth Scrolling for our navigation anchors
  // Reference: https://css-tricks.com/snippets/jquery/smooth-scrolling/
  $(function() {
    // WP Nav adds the class to the <li>, so we have to target the <a> inside
    $('.smoothScroll a, .wrc_home_assistance_single_icon, .wrc_hero_cta').click(function() {

      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);

        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

        if (target.length) {
          $('html, body').animate({
            scrollTop: target.offset().top
          }, 1000);
          //avoid return false so our tagmanager events can capture events
          target.preventDefault();
        }
      }
    });
  });

  $('.fa-search').click(toggleSearchBox);
  $('.top_nav__search .close_header_search').click(toggleSearchBox);

  //Search hookup
  function toggleSearchBox() {
    $('.top_nav__search').toggleClass('active');
    $('.top_nav__search input[type="search"]').focus();
    var toggleExpanded = $('.top_nav__search').attr('aria-expanded');
    if (toggleExpanded === 'false') {
        $('.top_nav__search').attr('aria-expanded', 'true');
    } else {
        $('.top_nav__search').attr('aria-expanded', 'false');
    }
  }

  //Child Page sidebar navigation
  // Open/close for Mobile
  $('.nav-child-page__title').click(function(){
      $(this).toggleClass('open-menu');
  });

  //Add in submenu toggles for sidebar navigation
  $('<span class="subnav-toggle"><i class="fa fa-caret-right"> </i></span>').insertBefore('.menu-child-page .page_item_has_children .children');
  //Add class to make it easier to target 1st Lvl Parents in sidebar nav
  $('.menu-child-page > .page_item_has_children').addClass('page_lvl_one');
  //Give our open subnav class to current page on page load
  $('.menu-child-page .page_item_has_children.current_page_ancestor, .menu-child-page .page_item_has_children.current_page_item').addClass('open-child-menu');
  $('.menu-child-page .current_page_item, .menu-child-page .current_page_ancestor').children('.subnav-toggle').children().removeClass('fa-caret-right').addClass('fa-caret-down');
  $('.subnav-toggle').click(function(e){
    e.preventDefault();
    if($(this).parent('.page_item_has_children').hasClass('open-child-menu')) {
      $(this).children().removeClass('fa-caret-down').addClass('fa-caret-right');
      $(this).parent('.page_item_has_children').removeClass('open-child-menu');
    }
    else {
      //if its page_lvl_one, keep open when opening child but close other already opened ones
      $('li.open-child-menu').not( $(this).parents('.page_lvl_one') ).find('.fa').removeClass('fa-caret-down').addClass('fa-caret-right'); // swap out icon on already opened submenus to be closed
      $('li.open-child-menu').not( $(this).parents('.page_lvl_one') ).removeClass('open-child-menu');
      $(this).children().removeClass('fa-caret-right').addClass('fa-caret-down');
      $(this).parent().addClass('open-child-menu');
    }
  });


  //initalize side menu for mobile
  var sidrName = 'sidr-main';

  $('#mobile-nav-trigger').sidr({
      name: sidrName,
      side: 'right',
      source: '#mobile-nav-dropdown',
      renaming: false,
      onOpen: function(){
          $(window).on('click.sidr', function (e) {
              $.sidr('close', sidrName);
          });
          $('#mobile-nav-trigger').addClass('menu-open');
      },
      onClose: function(){
          $(window).off('click.sidr');
          $('#mobile-nav-trigger').removeClass('menu-open');
      }
  });

  //Make sure modals from mobile menu still open
  $('#' + sidrName + ' .bill__modal-trigger').on('click.sidr', function (e) {
      openModal('Pay Bill', 'pay-bill', $(this) );
      $.sidr('close', sidrName);
  });
  $('#' + sidrName + ' .policy__modal-trigger').on('click.sidr', function (e) {
      openModal('My Policy', 'access-policy', $(this) );
      $.sidr('close', sidrName);
  });
  $('#' + sidrName + ' .first-otto-link').on('click.sidr', function (e) {
    $('body').addClass('modal-open');
    $('#modal1stOtto').removeClass('modal__hide');
      $.sidr('close', sidrName);
  });


  // Don't you dare close me out!
  $('#' + sidrName).on('click.sidr', function (e) {
      e.stopPropagation();
  });

  $('#' + sidrName + ' .companies-link').on('click', function(e){
    e.preventDefault();
    $('#' + sidrName + ' .companies-dropdown').slideToggle();
  });

  if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
  }

  
   $(".dropdown-newsletter").on("click",function(){
      $(this).next().toggleClass('show');
    });
   $("body").click(function(event) {
        if (!$(event.target).closest(".child_nav_wrapper, .dropdown-newsletter").length) {
          $(".child_nav_wrapper").removeClass("show");
        }
    }); 
});
