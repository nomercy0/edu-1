<html>

<head>
    <title><?=$data['username']?> - Profile</title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
</head>

<body onclick="event_handler(event)">
    
    <?php include 'include/body/header.php'; ?>
       
    <div id="search-area">
        <div class="col-sm-2 col-sm-offset-10"><i class="fa fa-close" id="close"> Close</i></div>
        <div class="results">Results are displayed here</div>
        <div class="results">Results are displayed here</div>
        <div class="results">Results are displayed here</div>
        <div class="results">Results are displayed here</div>
        <div class="results">Results are displayed here</div>
    </div>

    <div class="container-hr">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><img src="/public/images/profile-pic.png" alt="@" class="pro"></div>
                    <div class="col-sm-6">
                        <div class="row">
                            <h3><?=$data['first_name']?> <?=$data['last_name']?></h3>
                            <h4 style="color: gray">@ <?=$data['username']?></h4>
                            <a style="color: black">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam varius tellus vulputate sapien pellentesque scelerisque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus sodales tortor in pharetra convallis.</a>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <a class="btn btn-success m-t-20" href="#"><!--<i class="fa fa-check"></i>--> Follow</a>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-success m-t-20" href="#"> <i class="fa fa-plus"></i> Add</a>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-success m-t-20" href="#"> <i class="fa fa-envelope"></i> Message</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="aboutme">
                            <br>
                            <h4>About</h4>
                            <table class="table">
                                <tbody>
                                    <!--<tr>
                                        <td>Gender</td>
                                        <td>ncubeschool.org/profile/nutan</td>
                                    </tr>
                                    <tr>
                                        <td>DOB</td>
                                        <td>(546)-456-7890</td>
                                    </tr>                                    -->
                                    <tr>
                                        <td>Email</td>
                                        <td><?=$data['email']?></td>
                                    </tr> 
                                    <!--<tr>
                                        <td>Country</td>
                                        <td>fb.com/n.nutan</td>
                                    </tr>                                  -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'include/body/footer.php'; ?>
</body>
<script type="text/javascript">

    function resetMe() {
        search.style.width = '';
        icon.style.marginRight = '';
        searchArea.style.display = '';
    }

    function event_handler(event) {
        var id = event.target.id;
        // var class_name = event.target.className;
        // var tag_name = event.target.tagName;

        search = document.getElementById('search');
        icon = document.getElementById('search-icon');
        searchArea = document.getElementById('search-area');

        document.onkeydown = function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
                resetMe();
            }
        };

        if (id == 'close') {
            resetMe();
        }

        if (id == 'search') {
            search.style.width = '100%';
            icon.style.marginRight = '0';
            searchArea.style.display = 'block';
        } else {
            resetMe();
        }
    }
</script>

</html>