<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- Brand -->
    <div class="app-brand demo">
        <a class="app-brand-link mt-3 h4">
            <i class="fa-solid fa-graduation-cap fa-lg"></i>
            <span class="fw-bolder ms-1">
                Graduation Reg.
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <!-- /Brand -->

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="dashboard" class="menu-link">
                <i class="menu-icon fa-solid fa-chart-simple"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <?php if($account->level == "Admin"){ ?>
        <!-- Database (Only for 'Admin')-->
        <li class="menu-item">
            <a id="menuBackupDatabase" href="#" onclick="backup()" class="menu-link">
                <i class="menu-icon fa-solid fa-database"></i>
                <div>สำรองข้อมูล</div>
            </a>
        </li>
        <?php } ?>
    </ul>
</aside>