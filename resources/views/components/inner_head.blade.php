<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="title-holder">
            <div class="title-holder-cell text-left">

                @auth()
                  <h1 class="page-title">{{ session('name') }}さん</h1>
                @endauth

                @guest
                <h1 class="page-title">{{ $title }}</h1>
                @endguest

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<!-- end inner page banner -->