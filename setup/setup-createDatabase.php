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
                            <a class="nav-link btn active">
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
                        <!-- Database Import -->
                        <div class="tab-pane fade show active" id="navs-pills-top-data" role="tabpanel">
                            <a class="app-brand-link h3 justify-content-center mb-5">
                                <i class="fa-solid fa-graduation-cap fa-lg"></i>
                                <span class="fw-bolder ms-1">
                                    Graduation Reg.
                                </span>
                            </a>
                            <h4 class="mb-2">
                                <i class="fa-solid fa-database"></i>
                                Database Preparation
                            </h4>
                            <p class="mb-3 fw-normal">
                                สร้างฐานข้อมูลใหม่ หรือนำเข้าฐานข้อมูลจากไฟล์ SQL 
                            </p>
                            <form id="formCreateDatabase" class="mb-3" action="script/script-createDatabase.php" method="POST">
                                <div class="mb-3">
                                    <label for="useDatabase" class="form-label">Database</label>
                                    <input type="text" class="form-control" id="useDatabase" name="database" placeholder="ฐานข้อมูลไม่พร้อมใช้งาน" value="<?php echo $database->database ?? ''; ?>" autocomplete="off" readonly/>
                                </div>
                                <div class="mb-1">
                                    <label for="option" class="form-label">Option</label>
                                    <div class="form-check mb-2">
                                        <input name="option" class="form-check-input" type="radio" value="create" id="option1" checked <?php if (!$status->isConnectServer) echo 'disabled'; ?> />
                                        <label class="form-check-label" for="option">
                                            สร้างฐานข้อมูลใหม่
                                        </label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input name="option" class="form-check-input" type="radio" value="import" id="option1" <?php if (!$status->isConnectServer) echo 'disabled'; ?> />
                                        <label class="form-check-label" for="option2">
                                            นำเข้าฐานข้อมูลจากไฟล์ .sql
                                            <br>
                                            <small>
                                                ฐานข้อมูลจำเป็นต้องมีรูปแบบข้อมูลตามที่กำหนด<br>
                                                ดาวน์โหลด Database Dictionary 
                                                <a href="../assets/file/dataDictionary.pdf" download="dataDictionary.pdf">
                                                    คลิกที่นี่
                                                    <i class="fa-solid fa-file-pdf fa-lg ms-1"></i>
                                                </a>
                                            </small>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="uploadFile" class="form-label">Upload file</label>
                                    <input type="file" class="form-control" id="uploadFile" name="uploadFile" accept=".sql" required disabled/>
                                </div>
                                <button id="submitBtn" class="btn btn-primary w-100" <?php if (!$status->isConnectServer) echo 'disabled'; ?>>
                                    <span class="fa-solid fa-play me-2"></span>
                                    Start Import Database
                                </button>
                            </form>
                            <div class="text-center mt-4">
                                <a href="../" class="d-flex align-items-center justify-content-center">
                                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                    กลับหน้าหลัก
                                </a>
                            </div>
                        </div>
                        <!-- /Database Import -->
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
        //Create databasse
        $('#formCreateDatabase').submit(function(e) {
            e.preventDefault();
            var data = new FormData($('#formCreateDatabase')[0]);
            var form = $(this);

            //Get confirm from user
            swalConfirm({
                icon: 'question',
                text: 'การนำเข้าข้อมูลจะทำการลบข้อมูลปัจจุบันทั้งหมด ต้องการดำเนินการต่อหรือไม่',
                confirmButtonText: 'ดำเนินการต่อ',
                confirmCallback: function() {
                    //Show loader
                    $('#submitBtn').html('<span class="spinner-border spinner-border-sm me-2"></span>Importing...');

                    lunchAjaxRequest({
                        type: 'POST',
                        url: form.attr('action'),
                        data: data,
                        processData: false,
                        contentType: false,
                        successCallback: function(response) {
                            //Hide loader & clear file
                            $('#submitBtn').html('<span class="fa-solid fa-play me-2"></span>Start Import Database');
                            $('#uploadFile').val('');

                            if (!response.status) {
                                logError(response);
                            } else if (response.status == "success") {
                                swalResponse({
                                    response: response,
                                    timer: 2000,
                                    callback: function() {
                                        window.location.href = "setup-createAccount";
                                    }
                                });
                            } else {
                                swalResponse({
                                    response: response
                                });
                            }
                        },
                        errorCallback: function(response) {
                            //Hide loader & clear file
                            $('#uploadFile').val('');
                            $('#submitBtn').html('<span class="fa-solid fa-play me-2"></span>Start Import Database');
                        }
                    });
                }
            });
        });

        //File upload control
        var option = $('input[name="option"]');
        option.change(function() {
            var selectedValue = option.filter(':checked').val();
            if(selectedValue == 'create'){
                $('#uploadFile').attr('disabled', 'disabled');
                $('#uploadFile').val('');
            }else{
                $('#uploadFile').removeAttr('disabled');
            }
        });
    </script>
</body>
</html>