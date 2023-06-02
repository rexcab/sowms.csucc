            <div class="logo">
                <img src="img/user_logo.png" class="head-picture" alt="">
            </div>
            <div class="name">
            <span><?php if(isset($_SESSION['name'])){ echo $_SESSION['name']." | </span><span style='margin-left:0; margin-right: 10px; color: #00e900; font-size: 16px; padding-top: 15px;'>".$_SESSION['accesstype']; } ?></span><a href="logout.php" class="btn logout-btn" >Logout</a>
            </div>
                <div id='top-sided'>
                    <div class="tags">
                        <h4>HOME</h4>
                    </div>
                    <a href="dashboard.php"  style="display:flex;  padding: 10px 5px;"> <i class="fa-solid fa-chart-mixed fa-2xs" style='font-size:25px; margin: 20px 0 0 17px;'></i>
                         <h6 style="font-size:15px; line-height: 1.5;padding: 10px 0 0 5px "> Dashboard</h6>
                    </a>
                    </a>
                    <a href="search.php" style="display:flex;  padding: 10px 5px;"> <i class="fa-solid fa-magnifying-glass fa-2xs"  style='font-size:25px; margin: 20px 0 0 17px;'></i>
                         <h6 style="font-size:15px; line-height: 1.5; padding: 10px 0 0 5px"> Search</h6>
                    </a>
                </div>
                <div id='sided'>
                    <div class="tags">
                        <h4>MANAGE</h4>
                    </div>
                    <a href="pon.php" style="display:flex;  padding: 10px 5px;"> <i class="fa-solid fa-file-spreadsheet fa-lg" style='font-size:25px; margin: 20px 0 0 17px;'></i>
                         <h6 style="font-size:15px; line-height: 1.5;  ">  Purchased Order Number</h6>
                    </a>
                    <a href="item_list.php" style="display:flex;  padding: 10px 5px;"><i class="fa-sharp fa-solid fa-list-ul fa-lg" style='font-size:25px; margin: 10px 0 0 17px;'></i>  
                        <h6 style="font-size:15px; line-height: 1.5; ">Items</h6>
                    </a>
                    <a href="pon_items2.php" style="display:flex;  padding: 10px 5px;"> <i class="fa-light fa-file-plus fa-lg" style='font-size:25px; margin: 10px 0 0 17px;'></i>
                        <h6 style="font-size:15px; line-height: 1.5; ">Record</h6>
                    
                    </a>
                  
                    <a href="delivery_items.php" style="display:flex;  padding: 10px 5px;"><i class="fa-solid fa-ballot-check fa-lg" style='font-size:25px; margin: 10px 0 0 17px;'></i>
                        <h6 style="font-size:15px; line-height: 1.5; ">Arrived</h6>
                    </a>
                    <a href="widthdraw_items.php" style="display:flex;  padding: 10px 5px;"> <i class="fa-solid fa-ballot-check fa-lg" style='font-size:25px; margin: 10px 0 0 17px;'></i>
                        <h6 style="font-size:15px; line-height: 1.5; ">Withdraw</h6>
                    </a>
                    <a href="email_items.php" style="display:flex;  padding: 10px 5px;"> <i class="fa-regular fa-envelope fa-lg"  style='font-size:25px; margin: 10px 0 0 17px;'></i>
                        <h6 style="font-size:15px; line-height: 1.5; ">Email</h6>
                    </a>
                    <a href="offices_informations.php" style="display:flex;  padding: 10px 5px;"> <i class="fa-light fa-buildings fa-lg" style='font-size:25px; margin: 10px 0 0 17px;'></i>
                        <h6 style="font-size:15px; line-height: 1.5; "> Offices</h6>
                    </a>
                </div>
                