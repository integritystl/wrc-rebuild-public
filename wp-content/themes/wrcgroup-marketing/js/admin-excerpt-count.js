//Requires jquery.simplyCountable.js
// https://github.com/aaronrussell/jquery-simply-countable/
// Limit the word count of the Excerpt field.
jQuery(document).ready(function($) {
  var wordCount = 100;
  $('#postexcerpt .inside').prepend('<span class="counter-number">Current Words Remaining: <span id="counter"></span></span><p class="counter-msg"></p>');
  $('#excerpt').simplyCountable({
    countType:          'words',
    maxCount:           wordCount,
    onSafeCount:        function(count, countable, counter){
      $('.counter-msg').text('');
      $('.counter-number').css('color', 'initial');
    },
    onOverCount:        function(count, countable, counter){
      $('.counter-msg').text('You have reached the maximum word count of ' + wordCount + ' words. Please reduce the length of your excerpt.').css('font-weight', '600');
      $('.counter-number').css('color', '#dc2241');
    },
  });

  //Cover if someone saved the post with the long excerpt and page reloads
  if ( $('#postexcerpt .inside #counter').hasClass('over') ) {
    $('.counter-msg').text('You have reached the maximum word count of ' + wordCount + ' words. Please reduce the length of your excerpt.').css('font-weight', '600');
    $('.counter-number').css('color', '#dc2241');
  }
});