<nav class="navbar navbar-flex navbar-full navbar-dark navbar-center">
  <svg id="side-menu-toggle" viewBox="0 0 48 48">
    <path d="M6 36h36v-4H6v4zm0-10h36v-4H6v4zm0-14v4h36v-4H6z"></path>
  </svg>
  <svg style="float: left; margin-top: -4px;" class="hidden-sm-up" width="50px" height="50px" viewbox="0 0 100 100">
    <!--, , Width, Height-->
    <path style="fill:white;" d="M 76.004922,39.075886 C 79.222157,34.147697 82.413376,29.063471 85.493609,23.313269 84.646789,19.528087 83.599043,15.943831 81.656658,13.25423 71.060089,13.735822 61.032489,12.766196 50.803959,14.965315 48.945779,19.113386 49.340185,24.577558 49.405515,29.846454 53.811682,28.4453 61.1232,29.055557 67.122791,28.757549 l -9.899272,10.999194 0.03673,11.402492 8.029409,0.07331 c 5.519893,0.410337 6.631697,6.015098 6.022611,8.878623 -0.608356,2.860096 -3.190449,4.511796 -4.47117,5.172308 6.636414,4.709733 11.136856,-1.822143 17.768,1.93104 1.315184,-2.908988 4.012066,-21.731456 -8.604177,-28.13863 z"
    sodipodi:nodetypes="cccccccccsccc" />

    <path d="m 59.682969,67.652964 c 1.78033,0.974979 4.389133,0.916255 6.427338,-0.190039 6.040498,4.441841 11.376421,-2.562652 17.770656,1.851819 0,0 -0.457659,1.692909 -0.742845,2.638009 C 81.095207,77.516747 74.0459,85.906148 62.857511,85.507454 50.990244,85.084569 38.930196,71.865063 35.237655,61.365999 35.616829,46.115463 33.347638,34.037735 35.608007,17.217282 41.332016,37.451197 46.402184,60.379885 59.682969,67.652964 z"
    style="fill:white;" />

    <path style="fill:white;" d="m 29.71875,16.40625 c -4.414462,0.223036 -10.057711,3.130006 -15.34375,2.90625 2.196569,25.097293 1.658981,47.445773 0,68.6875 6.014488,-2.173362 13.705105,1.025393 18.4375,-1.84375 -1.23411,-6.191914 -1.020855,-15.91342 0.4375,-24.75 0.342022,-17.420679 -1.542323,-30.893859 0.375,-44.125 -1.135162,-0.726686 -2.444971,-0.94883 -3.90625,-0.875 z"
    />

  </svg>
  <a href="#" class="navbar-brand"><b class="hidden-xs-down">NCube</b></a>

  <div class="hidden-sm-down search-div">
    <form role="search" class="app-search search-form" id="search">
      <div class="input-group input-group-md">
        <input id="search-input" type="text" class="form-control" placeholder="Search for...">
        <span class="input-group-btn">
<button class="btn btn-success" type="button"><i class="fa fa-search"></i></button>
</span>
      </div>
    </form>
    <?php include 'search.php'; ?>
  </div>

  <ul class="nav navbar-nav pull-xs-right">
    <?php
      if (Session::loggedIn()) {
          echo '
          <li class="nav-item">
          <a href="javascript:void(0);" class="nav-link nav-icon" id="notif">
          <i class="fa fa-bell top-bar-icon"></i>
          ';
          if (!empty($data['notif_count']) && $data['notif_count'] !== 0) {
              echo '<span class="badge icon badge-color" id="notif-count">'.$data['notif_count'].'</span>';
          } else {
              echo '<span class="badge icon badge-color" id="notif-count" style="display: none">'.$data['notif_count'].'</span>';
          }
          echo '</a>';
    ?>
      <div class="notif-div" id="notif-div">
        <div class="arrow-b"></div>
        <div class="arrow-t"></div>
        <div class="head">
          <h6 class="text-xs-center">Notifications &nbsp<span class="label label-pill" id="notif-count-inner"><?=$data['notif_count']?></span></h6>
        </div>
        <div class="notif-cont" id="notif-container">

          <?php
            foreach ($data['notif'] as $value) {
                echo '
                  <a href="'.$value['link'].'">
                    <div class="not">
                      <div class="row">
                        <div class="col-xs-2">
                          <img class="img-thumb-sm" src="'.$value['profile_pic'].'">
                        </div>
                        <div class="col-xs-10 text-xs-left" style="font-size: 13px;">
                          <b>'.ucwords($value['first_name']).' '.ucwords($value['last_name']).'</b><br> '.$value['msg'].'
                          <span style="margin-left: 5px; float: right; font-size: 11px">'.date("d M h:i A", $value['time']).'</span>
                        </div>
                      </div>
                    </div>
                  </a>
                ';
            }
          ?>
        </div>
        <a href="/notifications">
          <div style="padding: 8px; background-color: whitesmoke">
            See All
          </div>
        </a>
      </div>

      </li>

      <li class="nav-item">
        <a href="javascript:void(0);" class="nav-link nav-icon" id="notif-msg">
          <i class="fa fa-envelope top-bar-icon"></i>
          <?php
            if (!empty($data['notif_msg_count']) && $data['notif_msg_count'] !== 0) {
                echo '<span class="badge icon badge-color" id="notif-msg-count">'.$data['notif_msg_count'].'</span>';
            } else {
                echo '<span class="badge icon badge-color" id="notif-msg-count" style="display: none">'.$data['notif_msg_count'].'</span>';
            }
          ?>
        </a>
        <div class="notif-div" id="notif-msg-div">
          <div class="arrow-b"></div>
          <div class="arrow-t"></div>
          <div class="head">
            <h6 class="text-xs-center">Messsages &nbsp<span class="label label-pill" id="notif-msg-count-inner"><?=$data['notif_msg_count']?></span></h6>
          </div>
          <div class="notif-cont" id="notif-msg-container">
            <?php
              if (!empty($data['notif_msg'])) {
                  foreach ($data['notif_msg'] as $value) {
                      echo '
                      <a href="/messages/'.$value['username'].'">
                        <div class="not">
                          <div class="row">
                            <div class="col-xs-2">
                              <img class="img-thumb-sm" src="'.$value['profile_pic'].'">
                            </div>
                            <div class="col-xs-10 text-xs-left" style="font-size: 13px;">
                              <b>'.ucwords($value['first_name']).' '.ucwords($value['last_name']).'</b> sent you a message
                              <span style="margin-left: 5px; float: right; font-size: 11px">'.$value['time'].'</span>
                            </div>
                          </div>
                        </div>
                      </a>
                      ';
                  }
              }
            ?>
          </div>
          <a href="/messages">
            <div style="padding: 8px; background-color: whitesmoke">
              See All
            </div>
          </a>
        </div>
      </li>

      <li class="nav-item">
        <a href="/settings" class="nav-link nav-icon"><i class="fa fa-cogs"></i></a>
      </li>

      <li class="nav-item">
        <form method="post" action="/logout">
          <input type="hidden" value="<?=$data['token']?>" name="token">
          <button type="submit" class="nav-link nav-icon" style="border: 0; background-color: transparent;"><i class="fa fa-sign-out"></i></button>
        </form>
      </li>


      <li class="nav-item">
        <div class="user-info">
          <img src="<?=$data['profile_pic']?>" alt="user-img" class="img-thumb-sm">
          <h6 class="nav-profile-name hidden-xs-down"><?=$data['first_name']?> <?=$data['last_name']?></h6>
        </div>

      </li>

      <?php } else {?>
        <div class="header-icon">
          <a href="/">
            <button class="btn btn-primary" style="margin-top: -8px;">Login</button>
          </a>
        </div>
        <?php } ?>
  </ul>
</nav>