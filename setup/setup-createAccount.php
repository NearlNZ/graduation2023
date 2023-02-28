<?php
    // Redirect if user not verified key yet.
    session_start();
    if (!isset($_SESSION["SESSION-keyVerified"]) or $_SESSION["SESSION-keyVerified"] != true) {
        header("Location: setup-verifyKey");
        exit();
    }

    //Check status
    require_once('../include/scripts/script-checkConnection.php');
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>System Configuration</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="../assets/font/Kanit.css" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/template.css" />

    <!-- Core JS -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/boxicons/boxicons.css" />

    <!-- Vendors JS -->
    <script src="../assets/vendor/fontawesome/js/all.min.js"></script>
    <script src="../assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Page Style -->
    <style>
        body {
            font-family: 'Kanit';
            background-color: #EBEBEB;
        }

        .middle-page {
            display: flex;
            flex-basis: 100%;
            min-height: 100vh;
            width: 100%;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .middle-page-inner {
            width: 460px;
            position: relative;
        }
    </style>
</head>
<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="middle-page container-p-y">
            <div class="middle-page-inner py-4">
                <div class="nav-align-top">
                    <ul class="nav nav-pills mb-3 justify-content-between row-cols-3" role="tablist">
                        <li id="pillServer" class="nav-item">
                            <a class="nav-link btn" href="setup-createConnection">
                                <i class="fa-solid fa-server me-1 d-none d-md-inline"></i>
                                Server
                            </a>
                        </li>
                        <li id="pillData" class="nav-item">
                            <a class="nav-link btn" href="setup-createDatabase">
                                <i class="fa-solid fa-database me-1 d-none d-md-inline"></i>
                                Database
                            </a>
                        </li>
                        <li id="pillAccount" class="nav-item">
                            <a class="nav-link btn active">
                                <i class="fa-solid fa-user-tie me-1 d-none d-md-inline"></i>
                                Account
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Create Account -->
                        <div class="tab-pane fade show active" id="navs-pills-top-account" role="tabpanel">
                            <a class="app-brand-link h3 justify-content-center mb-5">
                                <i class="fa-solid fa-graduation-cap fa-lg"></i>
                                <span class="fw-bolder ms-1">
                                    Graduation Reg.
                                </span>
                            </a>
                            <h4 class="mb-2">
                                <i class="fa-solid fa-user-tie me-1"></i>
                                Create Account
                            </h4>
                            <p class="mb-3 fw-normal">
                                เพิ่มบัญชีผู้ดูแลระบบใหม่ สำหรับลงชื่อเข้าใช้งานระบบ
                            </p>
                            <form id="formCreateAccount" class="mb-3" action="../data/user/createNewAccount.php" method="POST">
                                <div class="mb-1">
                                    <label for="useDatabase" class="form-label">สถานะฐานข้อมูล</label>
                                    <input type="text" class="form-control" id="useDatabase" value="<?php echo $status->isDatabaseReady ? 'กำลังใช้งานฐานข้อมูล' : 'ไม่มีฐานข้อมูลกำลังใช้งาน'; ?>" autocomplete="off" readonly/>
                                </div>
                                <input type="hidden" id="level" name="userLevel" value="Admin">
                                <div class="mb-1">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username." maxlength="50" autofocus autocomplete="off" required <?php if (!$status->isDatabaseReady) echo 'disabled'; ?> />
                                </div>
                                <div class="form-password-toggle mb-1">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password." minlength="8" maxlength="20" autocomplete="off" required <?php if (!$status->isDatabaseReady) echo 'disabled'; ?> />
                                        <a class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></a>
                                    </div>
                                </div>
                                <div class="form-password-toggle mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Enter password again." minlength="8" maxlength="20" autocomplete="off" required <?php if (!$status->isDatabaseReady) echo 'disabled'; ?> />
                                        <a class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></a>
                                    </div>
                                </div>
                                <button id="submitBtn" class="btn btn-primary w-100" <?php if (!$status->isDatabaseReady) echo 'disabled'; ?>>
                                    <span class="fa-solid fa-play me-2"></span>
                                    Start Create Account
                                </button>
                            </form>
                            <div class="text-center mt-4">
                                <a href="../" class="d-flex align-items-center justify-content-center">
                                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                    กลับหน้าหลัก
                                </a>
                            </div>
                        </div>
                        <!-- /Create Account -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Template JS -->
    <script src="../assets/js/template.js"></script>

    <!-- Page JS -->
    <script src="../include/scripts/customFunctions.js"></script>
    <script>
        //Data import 
        $('#formCreateAccount').submit(function(e) {
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
                            timer: 2000
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