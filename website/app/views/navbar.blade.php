
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="nav-collapse collapse">
        <ul class="nav">
          {{
            Navbar::render(
              array(
                'Lausar Stofur' => '/',
                'Stofur' => '/rooms', 
                'Áfangar' => '/classes',
              )
            )
          }}
        </ul>
        <ul class="nav pull-right">

          @if(Auth::guest())
          {{
            Navbar::render(
              array(
                'Skrá inn' => '/login'
                
              )
            )
          }}
          @else
          {{
            Navbar::render(
              array(
                'Niðurhala forriti' => '/download',
                'Skrá út' => '/logout'
              )
            )
          }}
          @endif
        </ul>
      </div>
    </div>
  </div>
</div>