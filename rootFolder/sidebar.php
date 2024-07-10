<?php $SessionId = $_SESSION['login_ClientId'];  ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
        <a href="javascript:void(0)" class="brand-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
            <?php if(empty($_SESSION['login_avatar'])): ?>
            <span
                class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500"
                style="width: 38px;height:50px"><?php echo strtoupper(substr($_SESSION['login_ClientName'], 0,1)) ?></span>
            <?php else: ?>
            <span class="image">
                <img src="../assets/uploads/<?php echo $_SESSION['login_avatar'] ?>" style="width: 38px;height:38px"
                    class="img-circle elevation-2" alt="User Image">
            </span>
            <?php endif; ?>
            <span class="brand-text font-weight-light"><?php echo ucwords($_SESSION['login_ClientID']) ?></span>

        </a>
        <div class="dropdown-menu" style="">
            <a class="dropdown-item manage_account" href="javascript:void(0)"
                data-id="<?php echo $_SESSION['login_ClientId'] ?>">Manage Account</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="ajax.php?action=logout">Logout</a>
        </div>
    </div>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item dropdown">
                    <a href="./" class="nav-link nav-home">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="./index.php?page=properties" class="nav-link nav-classes">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                            My Properties
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="./index.php?page=payments" class="nav-link nav-subjects">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            My Payments
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="./index.php?page=clientDetails" class="nav-link nav-subjects">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Client Details
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="./index.php?page=help" class="nav-link nav-subjects">
                        <i class="nav-icon fas fa-question"></i>
                        <p>
                            Help
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<script>
$(document).ready(function() {
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    if ($('.nav-link.nav-' + page).length > 0) {
        $('.nav-link.nav-' + page).addClass('active')
        console.log($('.nav-link.nav-' + page).hasClass('tree-item'))
        if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
            $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
            $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
            $('.nav-link.nav-' + page).parent().addClass('menu-open')
        }

    }
    $('.manage_account').click(function() {
        uni_modal('Manage Account', 'manage_user.php?id=' + $(this).attr('data-id'))
    })
})
</script>