$(function() {
    var $tabButtonItem = $('#tab-button li'),
        $tabSelect = $('#tab-select'),
        $tabContents = $('.tab-contents'),
        activeClass = 'is-active';
  
    $tabButtonItem.first().addClass(activeClass);
    $tabContents.not(':first').hide();
  
    $tabButtonItem.find('a').on('click', function(e) {
      var target = $(this).attr('href');
  
      $tabButtonItem.removeClass(activeClass);
      $(this).parent().addClass(activeClass);
      $tabSelect.val(target);
      $tabContents.hide();
      $(target).show();
      e.preventDefault();
    });
  
    $tabSelect.on('change', function() {
      var target = $(this).val(),
          targetSelectNum = $(this).prop('selectedIndex');
  
      $tabButtonItem.removeClass(activeClass);
      $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
      $tabContents.hide();
      $(target).show();
    });
  });
  
   function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


$(document).ready(function(){

  $("#mascotWrong").hide();

  $("#correct").click(function(){
      $("#mascotCorrect").show();
      $("#mascotWrong").hide();
  });

  $("#wrong").click(function(){
    $("#mascotCorrect").hide();
    $("#mascotWrong").show();

});
});