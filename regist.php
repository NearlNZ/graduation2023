<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Regist</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="assets/font/Kanit.css"/>

        <!-- Template CSS -->
        <link rel="stylesheet" href="assets/css/template.css"/>
        <link rel="stylesheet" href="assets/css/login.min.css" >
        
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
        <script src="assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>

        <!-- Page Style -->
        <link rel="stylesheet" href="assets/css/custom-style.css"/>
        <style>
            @media screen and (max-width: 992px) {
                .head-1 {
                    font-size: 19px !important; 
                }
                .head-2 {
                    font-size: 12px !important;
                }
                .logo {
                    width: 40px !important;
                }
            }
        </style>
    </head>

    <body class="body-dark">
        <main class="d-flex w-100">
            <div class="container d-flex flex-column">
                <div class="row vh-100 p-0">
                    <div class="col-xl-10 col-lg-12 col-md-9 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">
                            
                            <div class="mb-2">
                                <div class="d-table-cell align-middle">
                                    <img src="assets/img/common/page/logo.jpg" class="rounded-circle me-3 logo" style="width:50px;">
                                </div>
                                <div class="d-table-cell align-middle">
                                    <p class="text-light mb-0 h3 head-1">มหาวิทยาลัยราชภัฏสุราษฎร์ธานี</p>
                                    <p class="text-light h5 head-2">Suratthani Rajabhat University</p>
                                </div>
                            </div>
                            <div class="card o-hidden border-0 shadow-lg mb-0">
                                <div class="card-body p-0">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 d-none d-lg-block p-0 h-100">
                                            <div class="align-middle cover">
                                                <img class="img-fluid w-100" src="assets/img/common/page/login-cover.jpg">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="p-4">
                                                <div class="text-center mb-5 mt-2">
                                                    <a class="h3 justify-content-center head-1">
                                                        <i class="fa-solid fa-graduation-cap fa-lg text-dark"></i>
                                                        <span class="fw-bolder text-dark ms-1">
                                                            Graduation Reg.
                                                        </span>
                                                        <br>
                                                        <span class="fw-bold head-1">
                                                            เข้าสู่ระบบสำหรับบัณฑิต
                                                        </span>
                                                    </a>
                                                </div>

                                                <!-- START login form -->
                                                <form id="formLogin" class="user" action="data/student/createloginSession.php" method="POST">
                                                    <div class="input-group input-group-merge mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                                        <input type="text" class="form-control form-control-lg" id="cardID" name="cardID"
                                                        required autofocus autocomplete="off" placeholder="รหัสประจำตัวประชาชน">
                                                    </div>
                                                    <div class="input-group input-group-merge mb-5">
                                                        <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                                        <input type="text" class="form-control form-control-lg" id="confirmCardID" name="confirmCardID"
                                                        required autocomplete="off" placeholder="ยืนยันรหัสประจำตัวประชาชน">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow mb-4">
                                                        <i class="fa-solid fa-arrow-right-to-bracket me-2"></i>
                                                        <span class="h6 text-light">เข้าสู่ระบบ</span>
                                                    </button>
                                                    <div class="text-center">
                                                        <a href="index" class="d-flex align-items-center justify-content-center text-decoration-none">
                                                            <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                                            กลับหน้าหลัก
                                                        </a>
                                                    </div>
                                                </form>
                                                <!-- END login form -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="small text-white mt-2 head-2 text-center text-md-end">Copyright &copy; 2023, ❤️Surapat Thippakdee</p> 

                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Template JS -->
        <script src="assets/js/template.js"></script>
        
        <!-- Page JS -->
        <script src="include/scripts/customFunctions.js"></script>
        <script>
            //Data import 
            $('#formLogin').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                lunchAjaxRequest({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    successCallback: function(response) {
                        if (!response.status) {
                            logError(response);
                        } else if (response.status == "success") {
                            swalResponse({
                                response: response,
                                timer: 2000,
                                callback: function() {
                                    window.location.href="system-student/dashboard";
                                }
                            });
                        } else {
                            swalResponse({
                                response: response
                            });
                        }
                    }
                });
            });
        </script>
    </body>
</html>