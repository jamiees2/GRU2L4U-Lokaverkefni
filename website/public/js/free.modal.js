$(function() {
  // Support for AJAX loaded modal window.
  // Focuses on first input textbox after it loads the window.
  $('.modal-btn').click(function(e) {
    e.preventDefault();
    $('#table').html('<div class="progress progress-striped active"><div class="bar" id="ajax-bar" style="width: 100%;"></div></div>');
    $('#free-rooms').modal('show');
    var url = $(this).attr('data-target');
    $.ajax({
      url: url,
      success: function(data){
        $('#table').html(data);
      }
    });
  });
});