<?php
    //Check status
    require_once('../include/scripts/script-checkConnection.php');

    //Unset keyVerified session
    session_start();
    if(isset($_SESSION['GR-session-keyVerified'])) unset($_SESSION['GR-session-keyVerified']);
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
    <link rel="stylesheet" href="../assets/css/custom-style.css"/>
</head>

<body class="body-light">
    <!-- Content -->
    <div class="container-xxl">
        <div class="container-middle container-p-y">
            <div class="width-460 py-4">
                <div class="card">
                    <div class="card-body">
                        <a class="app-brand-link h3 justify-content-center mb-5">
                            <i class="fa-solid fa-graduation-cap fa-lg"></i>
                            <span class="fw-bolder ms-1">
                                Graduation Reg.
                            </span>
                        </a>
                        <h4 class="mb-2">
                            <i class="fa-solid fa-gears"></i>
                            System Configuration
                        </h4>
                        <p class="mb-3 fw-normal">
                            ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? ????????????????????????????????????????????? ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
                        </p>
                        
                        <!-- System Check -->
                        <div class="form-check mb-2">
                            <i id="isConnectServer" class="fa-lg me-2 <?php echo $status->isConnectServer ? 'fa-solid fa-square-check text-primary' : 'fa-regular fa-square';?>"></i>
                            <label class="form-check-label" for="isConnectServer">
                                Connect Server
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <i id="isDatabaseReady" class="fa-lg me-2 <?php echo $status->isDatabaseReady ? 'fa-solid fa-square-check text-primary' : 'fa-regular fa-square';?>"></i>
                            <label class="form-check-label" for="isDatabaseReady">
                                Create Database
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <i id="isAccountReady" class="fa-lg me-2 <?php echo $status->isAccountReady ? 'fa-solid fa-square-check text-primary' : 'fa-regular fa-square';?>"></i>
                            <label class="form-check-label" for="isAccountReady">
                                Create Account 
                            </label>
                        </div>
                        <!-- /System Check -->

                        <!-- Form -->
                        <form id="formConfiguration" class="mb-3" action="script/script-verifyKey.php" method="POST">
                            <div class="mb-3 input-group input-group-merge">
                                <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                <input type="text" class="form-control" id="key" name="key" placeholder="Enter configuration key." autofocus autocomplete="off" required />
                            </div>
                            <button class="btn btn-primary w-100">
                                <span class="fa-solid fa-play me-2"></span>
                                Start
                            </button>
                        </form>
                        <div class="text-center mt-4">
                            <a href="../" class="d-flex align-items-center justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                ????????????????????????????????????
                            </a>
                        </div>
                        <!-- /Form -->
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
        $('#formConfiguration').submit(function(e) {
            e.preventDefault();
            var form = $(this);

            ajaxRequest({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                errorUrl: '../500',
                successCallback: function(response) {
                    if(response.status == "success"){
                        showResponse({
                            response: response,
                            timer: 1500,
                            callback: function(){
                                window.location.href = "setup-createConnection";
                            }
                        });
                    }else{
                        showResponse({
                            response: response
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>