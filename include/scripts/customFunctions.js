//Ajax (Require jquery.min.js)
function lunchAjaxRequest(option) {
    const {
        type = 'POST',
        url = '',
        data = {},
        processData = true,
        contentType = 'application/x-www-form-urlencoded',
        successCallback = () => { },
        errorCallback = () => { }
    } = option;

    $.ajax({
        type: type,
        url: url,
        data: data,
        processData: processData,
        contentType: contentType,
        success: function (response) {
            successCallback(response);
        },
        error: function (response) {
            logError(response.responseText);
            errorCallback(response);
        }
    });
}

//Swal response from Ajax (Require sweetalert2.all.min.js)
function swalResponse(option) {
    const {
        response,
        timer,
        callback = () => { }
    } = option;

    const swalOption = {
        icon: response.status,
        title: response.title,
        text: response.text,
        html: response.html,
        showConfirmButton: false,
    };

    if (timer) {
        swalOption.timer = timer;
        swalOption.timerProgressBar = true;
    }

    Swal.fire(swalOption).then(() => {
        callback();
    });
}

//Swal confirm (Require sweetalert2.all.min.js)
function swalConfirm(option) {
    const {
        icon = '',
        title = '',
        text = '',
        cancelButtonText = 'ยกเลิก',
        confirmButtonText = 'ยืนยัน',
        confirmCallback = () => { }
    } = option;

    Swal.fire({
        icon: icon,
        title: title,
        text: text,
        reverseButtons: true,
        showCancelButton: true,
        cancelButtonColor: '#fff',
        cancelButtonText: '<span class="text-black">' + cancelButtonText + '</span>',
        confirmButtonColor: '#696cff',
        confirmButtonText: '<span class="text-white">' + confirmButtonText + '</span>'
    }).then((result) => {
        if (result.isConfirmed) {
            confirmCallback();
        }
    });
}

//Show internal error in console (Require sweetalert2.all.min.js)
function logError(response) {
    if (response.indexOf('{"status":') !== -1 && response.indexOf('}')) {
        response = response.substring(0, response.indexOf('{"status":'));
    }

    console.log(response.replace(/<[^>]*>/g, ''));

    Swal.fire({
        icon: 'error',
        title: 'Request Error',
        html: "An error occurred while processing",
        showConfirmButton: false
    });
}

//Dynamic sidebar active (Require jquery.min.js)
$(document).ready(function () {
    var currentPage = location.pathname.split('/').pop();

    //If the file name is empty, assume it's the first item
    if (currentPage === '') {
        currentPage = $('.menu-item:first-child').find('a').attr('href');
    }

    //If the current page have .php extension, remove it
    if(currentPage.indexOf('.php') !== -1){
        currentPage = currentPage.replace('.php', '');
    }

    //Add the "active" classe to the menu item with a matching URL
    $('.menu-item').each(function () {
        var menuItemUrl = $(this).find('a').attr('href');

        if (menuItemUrl === currentPage) {
            $(this).addClass('active');

            //If the menu item is in a sub-menu, add the "active" and "open" classes to the "havesub"
            var parentSubMenu = $(this).parent('.menu-sub');
            if (parentSubMenu.length > 0) {
                parentHavesub = parentSubMenu.closest('.havesub').addClass('active open');
            }
        }
    });
});

//Logout (Require sweetalert2.all.min.js)
function logout(){
    swalConfirm({
        title: 'ออกจากระบบ',
        text: 'กำลังออกจากระบบ ต้องการดำเนินการต่อหรือไม่',
        confirmCallback : function() {
            window.location.href= "../index";
        }
    });
}


//Backup database (Require sweetalert2.all.min.js)
function backup(){
    swalConfirm({
        icon: 'question',
        title: 'สำรองข้อมูล',
        text: 'ระบบจะดำเนินการสำรองข้อมูลปัจจุบัน ข้อมูลที่มีการเปลี่ยนแปลงหลังจากการสำรองข้อมูลจะไม่ได้รับการบันทึก',
        cancelButtonText: 'ยกเลิกการสำรองข้อมูล',
        confirmButtonText: 'เริ่มการสำรองข้อมูล',
        confirmCallback : function() {
            lunchAjaxRequest({
                url: 'backupDatabase',
                successCallback: function(response) {
                    if (!response.status){
                        logError(response);
                    } else if (response.status == "success") {
                        swalResponse({
                            response: response,
                            timer: 2000,
                            callback: function() {
                                var link = $('<a>', {
                                    href: response.url,
                                    download: response.filename,
                                    style: 'display:none'
                                });
                                $('body').append(link);
                                
                                link[0].click();
                                alert(response.command);
                                setTimeout(function() {
                                    link.remove();
                                }, 1000);
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
}
