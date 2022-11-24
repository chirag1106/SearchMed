<?php
session_start();
if (!isset($_SESSION['userIP'])) {
    header('location:./loader.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css?v=s<?php echo time() ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php
    // if(isset($_COOKIE)){
    //     echo "<script>window.confirm('list found. want to add it!');</script>";
    // }
    ?>
    <title>Generic Medicine</title>
    <script src="./index.js" type="text/javascript"></script>

</head>

<body>
    <div id="trans-bg"></div>
    <!-- navbar starts here-->
    <nav class="navbar">
        <div id="nav-left">
            <div class="nav-logo">
                <a href="./loader.php"><img src="./images/logo.png" alt="logo here" width="50" height="40"></a>
            </div>
            <div class="nav-brand">
                <a href="./index.php">Generic Medicine</a>
            </div>
        </div>
        <div id="nav-right">
            <button id="show-list" type="button">
                <img src='./images/add-list-btn.png' alt='add to list'>
            </button>
        </div>
    </nav>
    <!-- nav end here -->

    <!-- cookies-consent -->
    <div class="cookies">
        <img src="./images/cookies.png" alt="">
        <div class="content">
            <header>Cookies Consent</header>
            <p>This website use cookies to ensure you get the best experience on our website.</p>
            <div class="buttons">
                <button id="accept" class="item" type="button">I understand</button>
                <a href="#" class="item">Learn more</a>
            </div>
        </div>
    </div>
    <!-- end cookies consent -->

    <!-- main section starts here -->
    <div class="section">
        <div id="main" class="main-section">

            <div class="search-section">
                <div class="welcome">
                    <Span>Welcome to </Span>
                    <span>Generic Medicine</Span>
                    <span class="small-text">your one stop to search substitute for your medicine</span>
                </div>
                <div class="search">
                    <form action="" method="post" id="search-form">
                        <input type="text" class="search-input" name="keyword" id="" placeholder="Search Your Medicine Here..." autocomplete="off">
                        <button id="ocr">
                            <img src="images/ocr.png" alt="">
                        </button>
                        <button id="search-btn">Search</button>
                    </form>
                </div>
                <div class="search-result" style="display: none;">
                    <div class="result">
                        <div class='result-match'>
                            <table id="result-table"></table>
                        </div>
                    </div>
                    <div id="sugges" class="suggestion">
                        <div id="sugges-list" class='suggestion-list'>
                            <span id="give-suggestion">
                                <h4>
                                    "Want medicine to be added?"
                                </h4>
                                <button id="sugg-btn" type="button">suggestion</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sugg-form">
                <div id='sugg-form-nav'>
                    <a id="sugg-hide">
                        <img src="./images/hide.png" alt="hide">
                    </a>
                </div>
                <div id="sugg-detail">
                    <form class="form" method="post">
                        <div class="title">Suggestions</div>
                        <div class="subtitle">Let's get your suggestion!</div>
                        <div class="input-container ic1">
                            <input id="firstname" class="input" type="text" placeholder=" " autocomplete="off" />
                            <div class="cut"></div>
                            <label for="firstname" class="placeholder">Name</label>
                        </div>
                        <div class="input-container ic2">
                            <input id="email" class="input" type="text" placeholder=" " autocomplete="off" />
                            <div class="cut cut-short"></div>
                            <label for="email" class="placeholder">Non-Generic Medicine</label>
                        </div>
                        <div class="input-container ic2">
                            <input id="email" class="input" type="text" placeholder=" " autocomplete="off" />
                            <div class="cut cut-short"></div>
                            <label for="email" class="placeholder">Generic Medicine (OPTIONAL)</label>
                        </div>
                        <button type="button" class="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="list">
                <div class='list-section'>
                    <div class='list-nav'>
                        <span>MEDICINE LIST</span>
                        <div class='share-down-btn'>
                            <a href=''>
                                <img id="share-img" src='./images/share.svg' alt='share now'>
                            </a>
                            <a href='./download_list.php'>
                                <img id="down-img" src='./images/download.png' alt='download'>
                            </a>
                            <a class="hide">
                                <img src="./images/hide.png" alt="hide">
                            </a>
                        </div>
                    </div>
                    <div class='list-show'>
                        <table id="show-list-table">
                            <tr>
                                <th>Sno.</th>
                                <th>Non Generic name</th>
                                <th>Generic name</th>
                                <th>Quantity</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="chat-bot">
        <div id='support-nav'>
            <p>Support</p>
            <a id="support-min">
                <img id="max" src="./images/maximize.png" alt="maximize">
                <img id="min" src="./images/minimize.png" alt="minimize">
            </a>
        </div>
        <div class="chat">
            <div class="messages"></div>
            <div class="input-msg">
                <div class="input-msg-text">
                    <input id="msg-here" type="text" placeholder="Type your message here" />
                </div>
                <button id="attach">
                    <img src="./images/paperclip.png" alt="attachment">
                </button>
                <button id="send">
                    <img src="./images/send.png" alt="send">
                </button>
            </div>
        </div>
    </div>

    <script type='text/javascript'>
        const trans_bg = document.querySelector("#trans-bg");
        const cookieBox = document.querySelector(".cookies");
        const acceptBtn = document.querySelector("#accept");
        acceptBtn.onclick = () => {
            document.cookie = "CookieBy=Cookies; max-age=" + 60 * 60 * 24 * 30;
            if (document.cookie) {
                cookieBox.classList.add("hide");
                trans_bg.style.display="none";
            } else {
                alert("Cookie can't be set! Please unblock this site from the cookie setting of your browser.");
            }
        }
        let checkCookie = document.cookie.indexOf("CookieBy=Cookies");
        if(checkCookie != -1){
            cookieBox.classList.add("hide");
            trans_bg.style.display="none";
        }
        else{
            cookieBox.classList.remove("hide");trans_bg.style.display="block";
        } 
    </script>

</body>

</html>