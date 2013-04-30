<script>
$(function(){
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
  //Get the tab
  var TAB = window.location.hash != "" ? 
    window.location.hash.slice(1) :
    "{{date('N')}}";
  //If we were redirected, get the hash from the localstorage
  if({{Session::has('redirect') ? 'true' : 'false'}})
    TAB = localStorage['hash'];
  //Store the hash in the localstorage
  localStorage['hash'] = TAB;
  //Show the tab
  $('#timetable a[href="#' + TAB + '"]').tab('show');
  
  //Add the tab show and click handlers, override needed for footable to work
  $('#timetable a').on('click',function (e) {
    e.preventDefault();
    $(this).tab('show');
  }).on('shown', function (e) { 
   var hash = $(this).attr('href').slice(1);
   setHash(hash);
   localStorage['hash'] = hash;
   $('.tab-pane.active table').trigger('footable_resize');
 });
});
</script>