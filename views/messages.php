<html>
<head>
    <title><?=$data['title']?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/ncube-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/custom.css">
    <style>	
	.right {
		height: 100%;
	}
	
	.left {
		height: 100%;
		overflow-y: auto;
        border-right: 1px solid lightgray;
	}
	
	.msg {
		background-color: white;
		height: 70px;
		font-size: 16px;
		padding: 15px;
		padding-left: 25px;
		border-bottom: 1px solid whitesmoke;
	}
	
	.msg:hover {
		background-color: lightgray;
	}
    
    .right-middle {
		background-color: palegoldenrod;
		height: 100%;
		font-size: 16px;
		padding: 15px;
        overflow-y: auto;
        margin-bottom: -45px;
	}
	
	.right-bottom {
		background-color: white;
        height: 45px;
		font-size: 16px;
		padding-top: 5px;
	}
    		
	.msg-sent {
		background-color: white;
		float: left ;
		padding: 10px;
		padding-left: 20px;
		border-radius: 10px;
	}
    
	.msg-received {
		float: right;
		background-color: lightgreen;
        padding: 10px;
		padding-left: 20px;
		border-radius: 10px;
	}
	.msg-field {
		font-size: 16px;
		padding: 3px 10px;
	}
    
    .msg-container {
        padding-right: 219px;
    }
    
    .send-icon {
        cursor: pointer;
        height: 45px;
        padding-top: 3px;
    }
    
    .msg-profile {
         width: 45px;
         height: 45px;
         border-radius: 5px;
         margin-right: 10px;
    }
    
    .msg-time {
        margin-top: 5px;
        margin-left: 10px;
        color: gray;
        font-size: 10px;
        float: right;
    }
    
    .msg-active {
        background-color: whitesmoke;
    }
</style>
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
    <div class="side-container">
        <div class="side-header">
            <div class="side-title"><strong><?=$data['first_name']?> <?=$data['last_name']?></strong></div>
            <a href="/profile"><div class="side-items">Profile</div></a>
            <a href="/messages"><div class="side-items">Messages</div></a>
        </div>
    </div>
    <div class="container-hr has-side-header" style="padding: 0;">
        <div class="msg-container">
            <div class="row">
                <div class="col-md-3 left">
                    <?php
                        $listOutput = NULL;
                        foreach ($data['list_data'] as $value) {
                            if ($data['active_username'] === $value['username']) {
                                echo '
                                <a href="/messages/'. $value['username'] .'">
                                    <div class="row msg msg-active">
                                        <img src="/public/images/profile-pic.png" class="msg-profile">
                                        '. ucwords($value['first_name']) . ' ' . ucwords($value['last_name']) . '
                                    </div>
                                </a>
                                ';
                                continue;
                            }
                            $listOutput .= '
                                <a href="/messages/'. $value['username'] .'">
                                    <div class="row msg">
                                        <img src="/public/images/profile-pic.png" class="msg-profile">
                                        '. ucwords($value['first_name']) . ' ' . ucwords($value['last_name']) . '
                                    </div>
                                </a>
                            ';
                        }
                        echo $listOutput;
                    ?>
                </div>
                <div class="col-md-9">
				    <div class="row right">
					   <div class="right-middle">
                            <?php
                                if (!empty($data['msgs'])) {
                                    foreach ($data['msgs'] as $value) {
                                        if ($value['type'] === 'sent') {
                                            echo '
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="msg-sent">
                                                        ' . $value['msg'] . '
                                                        <div class="msg-time">
                                                            ' . date("h:i A", $value['time']) . '
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            ';
                                        } else if ($value['type'] === 'received') {
                                            echo '
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="msg-received">
                                                            ' . $value['msg'] . '
                                                            <div class="msg-time">
                                                                ' . date("h:i A", $value['time']) . '
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                    }
                                } else if (empty($data['active_username'])) {
                                    echo '<- Select Recipient';
                                } else {
                                    echo 'No Messages';
                                }
                            ?>
					   </div>
					   <div class="right-bottom">
                            <form method="post" action="">
                                <div class="col-md-11">
                                    <input type="text" name="msg" class="form-field msg-field" placeholder="Type a message...">
                                </div>
                                <div class="col-md-1 send-icon">
                                    <input type="hidden" value="<?=$data['token']?>" name="token">
                                    <input type="hidden" value="<?=$data['active_username']?>" name="username">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i></button>
                                </div>
                            </form>
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