$(document).ready(function() {
    $('#toggle-sidebar').on('click', function() {
      $('#sidebar').toggleClass('show');
    });

    $('#close-sidebar').on('click', function() {
      $('#sidebar').removeClass('show');
    });
  
    $(document).on('click', function(event) {
      if ($(event.target).closest('#sidebar').length === 0 && $(event.target).closest('#toggle-sidebar').length === 0) {
        $('#sidebar').removeClass('show');
      }
    });
  });

  