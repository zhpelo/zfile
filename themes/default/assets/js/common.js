function copyText(text) {
    if (text.indexOf('-') !== -1) {
        let arr = text.split('-');
        text = arr[0] + arr[1];
    }
    var textArea = document.createElement("textarea");
    textArea.style.position = 'fixed';
    textArea.style.top = '0';
    textArea.style.left = '0';
    textArea.style.width = '2em';
    textArea.style.height = '2em';
    textArea.style.padding = '0';
    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';
    textArea.style.background = 'transparent';
    textArea.value = text;
    document.body.appendChild(textArea);
    textArea.select();
    try {
        var successful = document.execCommand('copy');

        if (successful) {
            Dashmix.helpers('notify', {
                type: 'success',
                icon: 'fa fa-check mr-1',
                message: "成功复制到剪贴板"
            });
        } else {
            Dashmix.helpers('notify', {
                type: 'danger',
                icon: 'fa fa-times mr-1',
                message: '该浏览器不支持点击复制到剪贴板!'
            });
        }
    } catch (err) {
        Dashmix.helpers('notify', {
            type: 'danger',
            icon: 'fa fa-times mr-1',
            message: '该浏览器不支持点击复制到剪贴板!'
        });
    }
    document.body.removeChild(textArea);
}

$(".copy-share-url").click(function () {
    var url = $(this).data('url');
    copyText(url)
});


$("#sendemail_btn").click(function () {
    var event = $(this).data('event');
    var email = $('#email').val();

    if(!is_email(email)){
        Dashmix.helpers('notify', {
            type: 'danger',
            icon: 'fa fa-times mr-1',
            message: "邮箱格式错误"
        });
        return false;
    }
    $.ajax({
        url: "/api.php?a=email/send",
        type: "post",
        dataType: "json",
        data: {
            email: email,
            event: event
        },
        success: function (ret) {
            console.log(ret);
            if (ret.code) {
                Dashmix.helpers('notify', {
                    type: 'success',
                    icon: 'fa fa-check mr-1',
                    message: ret.msg
                });
                $('#sendemail_btn').attr("disabled", true);
                get_countdown();
            } else {
                Dashmix.helpers('notify', {
                    type: 'danger',
                    icon: 'fa fa-times mr-1',
                    message: ret.msg
                });
            }
        }
    });
});

//倒计时
var countdown = 60;

function get_countdown() {
    if (countdown === 0) {
        $('#sendemail_btn').attr("disabled", false);
        $('#sendemail_btn').text('重新获取');
        return false;
    } else {
        countdown--;
        $('#sendemail_btn').text(countdown + ' 秒');
    }
    //定时递归执行
    setTimeout(function () {
        get_countdown();
    }, 1000);
}



function is_email(email) {
    var myreg = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
    return myreg.test(email);
}