<?php define("IS_DASHBOARD", true); ?>
<script type="text/javascript" src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/order.js"></script>
<script type="text/javascript" src="http://<?php echo ROOT_URL; ?>apps/frontend/public/js/dashboard.js"></script>
<div id="order_msg">
</div>
<div id="dashboard_nav">
    <div id="dashboard_nav_content">
        <ul>
            <li><a href="http://<?php echo ROOT_URL . "dashboard"?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
            <li><a href="http://<?php echo ROOT_URL . "dashboard/orders"?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> My Orders</a></li>
            <li><a href="http://<?php echo ROOT_URL . "dashboard/transactions"?>"><i class="fa fa-history" aria-hidden="true"></i> Transactions History</a></li>
            <li><a href="http://<?php echo ROOT_URL . "dashboard/funding"?>"><i class="fa fa-money" aria-hidden="true"></i> Fund My Account <span id="acc_bal"><?php echo "($".Registry::getObject("authentication")->getBalance() . ")"; ?></span></a></li>
            <li><a href="http://<?php echo ROOT_URL . "dashboard/myaccount"?>"><i class="fa fa-user" aria-hidden="true"></i> My Account (<?php echo Registry::getObject("authentication")->getUsername();?>)</a></li>
        </ul>
    </div>  
</div>
<br/>