<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Index</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="assets/font/Kanit.css"/>

        <!-- Template CSS -->
        <link rel="stylesheet" href="assets/css/template.css"/>
        
        <!-- Core JS -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="assets/vendor/perfect-scrollbar/perfect-scrollbar.css"/>
        <link rel="stylesheet" href="assets/vendor/boxicons/boxicons.css"/>

        <!-- Vendors JS -->
        <script src="assets/vendor/fontawesome/js/all.min.js"></script>
        <script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>

        <style>
            body{
                font-family: 'Kanit';
                background-color:#EBEBEB;
            }
            .clickable:hover {
                transform: scale(1.03); 
            }
            .clickable {
                cursor: pointer;
                transition: transform .2s;
                border-radius: 10px;
            }
            .stat {
                display:flex;
                justify-content:center;
                align-items:center;
                background-color: #DCEAF4;
                border-radius:50%;
                height:50px;
                width:50px;
            }
        </style>
    </head>
    <body>
        <!-- Wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Sidebar -->
                <?php require_once("include/components/sidebar.php");?>
                <!-- /Sidebar -->

                <!-- Page -->
                <div class="layout-page">
                    <!-- Navbar -->
                    <?php require_once("include/components/navbar.php");?>
                    <!-- /Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->
                        <div class="container-fluid py-3 py-lg-5">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card h-100 shadow mb-0">
                                        <div class="card-body py-4">
                                            <div class="text-center mt-1">
                                                <img src="assets/img/common/page/logo.jpg" class="mb-3" style="width:80px;">
                                            </div>
                                                
                                            <h3 class="text-danger text-center">ประกาศสำคัญ</h3>
                                            <div class="row justify-content-center">
                                                <p class="mt-3 col-12 col-lg-8">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    เนื่องด้วยการฝึกซ้อมเข้ารับพระราชทานปริญญาบัตร ประจำปี พ.ศ.2566 มหาวิทยาลัยราชภัฏสุราษฎร์ธานี ได้มีการเปลี่ยนแปลงรูปแบบ
                                                    การลงชื่อเข้าร่วมการฝึกซ้อมบัณฑิตเพื่อเข้ารับพระราชทานปริญญาบัตร ซึ่งมีความจำเป็นต้องใช้ข้อมูลตำแหน่งพิกัดทางภูมิศาสตร์ (Location)
                                                    ของบัณฑิตทุกท่านในการยืนยันการเข้าร่วมการฝึกซ้อมเข้ารับพระราชทานปริญญาบัตร ประจำปี พ.ศ.2566
                                                    <br><br>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    ด้วยเหตุนี้ จึงขอความร่วมมือบัณฑิตทุกท่าน เปิดใช้งานการเข้าถึงข้อมูลตำแหน่งพิกัดทางภูมิศาสตร์ (Location) และอนุญาตให้ มหาวิทยาลัยราชภัฏสุราษฎร์ธานี
                                                    เข้าถึง และเก็บข้อมูลของท่านขณะทำการลงชื่อ เพื่อใช้ในการตรวจสอบการลงชื่อฝึกซ้อมฝึกซ้อมเข้ารับพระราชทานปริญญาบัตร ประจำปี พ.ศ.2566
                                                </p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row g-3 p-0">
                                <div class="col-12 col-md-6">
                                    <a class="text-decoration-none" href="regist">
                                        <div class="card clickable shadow mb-0">
                                            <div class="card-body mb-0">
                                                <div class="row d-table">
                                                    <div class="col-auto d-table-cell align-middle">
                                                        <div class="stat">
                                                            <i class="fa-solid fa-user-graduate fa-xl"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col d-table-cell align-middle py-3">
                                                        <p class="h5 mb-0">เข้าสู่ระบบสำหรับบัณฑิต</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12 col-md-6">
                                    <a class="text-decoration-none" href="login">
                                        <div class="card clickable shadow mb-0">
                                            <div class="card-body mb-0">
                                                <div class="row d-table">
                                                    <div class="col-auto d-table-cell align-middle">
                                                        <div class="stat">
                                                            <i class="fa-solid fa-user-tie fa-xl"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col d-table-cell align-middle py-3">
                                                        <p class="h5 mb-0">เข้าสู่ระบบสำหรับเจ้าหน้าที่</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /Content -->

                        <!-- Footer -->
                        <?php require_once("include/components/footer.php");?>
                        <!-- /Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- /Content wrapper -->
                </div>
                <!-- /Page -->
            </div>

            <!-- Page overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- /Wrapper -->

        <!-- Template JS -->
        <script src="assets/js/template.js"></script>

        <!-- Page JS -->
        <script src="include/scripts/customFunctions.js"></script>
    </body>
</html>