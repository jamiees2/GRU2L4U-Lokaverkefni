$(function(){
  //Sets the hash without the browser pointing to the element
  function setHash(hash){
    var node = $( '#' + hash );
    if ( node.length ) {
      node.attr( 'id', '' );
    }
    document.location.hash = hash;
    if ( node.length ) {
      node.attr( 'id', hash );
    }
  }
  var TAB = window.TAB;
  //Store the hash in the localstorage
  localStorage['hash'] = TAB;
  //Show the tab
  $('#timetable a[href="#' + TAB + '"]').tab('show');
  //Add the tab show and click handlers, override needed for footable to work
  $('#timetable a').on('click',function (e) {
    e.preventDefault();
    $(this).tab('show');
  }).on('shown', function (e) {
    //Update the hash
     var hash = $(this).attr('href').slice(1);
     setHash(hash);
     localStorage['hash'] = hash;
    //Make sure footable is updated
    $('.tab-pane.active table').trigger('footable_resize');
 });
});