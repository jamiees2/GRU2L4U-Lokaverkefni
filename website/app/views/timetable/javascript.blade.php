{{--Verður að vera php vegna echo skipana í kóða--}}
<script>
{{--Get the tab--}}
window.TAB = window.location.hash != "" ? 
  window.location.hash.slice(1) :
  "{{date('N')}}";
{{--If we were redirected, get the hash from the localstorage--}}
if({{Session::has('redirect') ? 'true' : 'false'}})
  window.TAB = localStorage['hash'];
</script>