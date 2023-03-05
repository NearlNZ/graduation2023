<?php
    // Redirect if user not verified key yet.
    session_start();
    if (!isset($_SESSION['GR-session-keyVerified']) or $_SESSION['GR-session-keyVerified'] != true) {
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
                        <li class="nav-item">
                            <a id="pillServer" class="nav-link btn active">
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
                            <a class="nav-link btn" href="setup-createAccount">
                                <i class="fa-solid fa-user-tie me-1 d-none d-md-inline"></i>
                                Account
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Server Connecction -->
                        <div class="tab-pane fade show active" id="navs-pills-top-server" role="tabpanel">
                            <a class="app-brand-link h3 justify-content-center mb-5">
                                <i class="fa-solid fa-graduation-cap fa-lg"></i>
                                <span class="fw-bolder ms-1">
                                    Graduation Reg.
                                </span>
                            </a>
                            <h4 class="mb-2">
                                <i id="isDatabaseReady" class="fa-lg me-1 <?php echo $status->isConnectServer ? 'fa-solid fa-square-check text-primary' : 'fa-regular fa-square';?>"></i>
                                Connect Server 
                            </h4>
                            <p class="mb-3 fw-normal">
                                เชื่อมต่อเซิร์ฟเวอร์ฐานข้อมูลของระบบ (MySQL Server)
                            </p>
                            <form id="formCreateConnection" class="mb-3" action="script/script-createConnection.php" method="POST">
                                <div class="mb-1">
                                    <label for="server" class="form-label">Server</label>
                                    <input type="text" class="form-control" id="server" name="server" placeholder="Enter hostname or IP" value="localhost" autocomplete="off" required />
                                </div>
                                <div class="mb-1">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" autofocus autocomplete="off" required />
                                </div>
                                <div class="mb-1">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" autocomplete="off" />
                                </div>
                                <div class="mb-3">
                                    <label for="database" class="form-label">Database name</label>
                                    <input type="text" class="form-control" id="database" name="database" placeholder="Enter database name" autocomplete="off" required />
                                </div>
                                <button class="btn btn-primary w-100">
                                    <span class="fa-solid fa-play me-2"></span>
                                    Start Connection
                                </button>
                            </form>
                            <div class="text-center mt-4">
                                <a href="setup-verifyKey" class="d-flex align-items-center justify-content-center">
                                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                    ย้อนกลับ
                                </a>
                            </div>
                        </div>
                        <!-- /Server Connecction -->
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
        //Connect Database
        $('#formCreateConnection').submit(function(e) {
            e.preventDefault();
            var form = $(this);

            swalConfirm({
                icon: 'question',
                text: 'ต้องการสร้างการเชื่อมต่อกับเซิร์ฟเวอร์ฐานข้อมูลขึ้นใหม่หรือไม่',
                confirmButtonText: 'ดำเนินการต่อ',
                confirmCallback: function() {
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
                                    timer: 1500,
                                    callback: function() {
                                        window.location.href = "setup-createDatabase";
                                    }
                                });
                            } else {
                                swalResponse({
                                    response: response
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>