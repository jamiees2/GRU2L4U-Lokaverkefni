$(function() {
  // Support for AJAX loaded modal window.
  // Focuses on first input textbox after it loads the window.
  $('.modal-btn').click(function(e) {
    e.preventDefault();
    //Loading screen
    $('#table').html('<div class="progress progress-striped active"><div class="bar" id="ajax-bar" style="width: 100%;"></div></div>');
    //Show the modal
    $('#free-rooms').modal('show');

    //AJAX load the url
    var url = $(this).attr('data-target');
    $.ajax({
      'url': url,
      success: function(data){
        $('#table').html(data);
      }
    });
  });
});