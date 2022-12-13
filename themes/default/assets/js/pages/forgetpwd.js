/*!
 * dashmix - v3.2.0
 * @author pixelcave - https://pixelcave.com
 * Copyright (c) 2021
 */
! function () {
    function e(e, n) {
        for (var i = 0; i < n.length; i++) {
            var a = n[i];
            a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
        }
    }
    var n = function () {
        function n() {
            ! function (e, n) {
                if (!(e instanceof n)) throw new TypeError("Cannot call a class as a function")
            }(this, n)
        }
        var i, a;
        return i = n, a = [{
            key: "initValidation",
            value: function () {
                Dashmix.helpers("validation"), jQuery(".forgetpwd-form").validate({
                    rules: {
                        "email": {
                            required: !0,
                            minlength: 3,
                            email:!0
                        },
                        "code": {
                            required: !0,
                            rangelength: [4,4],
                        },
                        "newpassword": {
                            required: !0,
                            minlength: 8,
                            maxlength: 64,
                        }
                    },
                    messages: {
                        "email": {
                            required: "请填写邮箱！",
                            email: "邮箱格式不正确"
                        },
                        "code": {
                            required: "请填写邮箱验证码",
                            rangelength: "请填入4位验证码"
                        },
                        "newpassword": {
                            required: "请填写新密码",
                            minlength: "密码不能少于8位",
                            maxlength: "密码不允许超过64位",
                        },
                    }
                })
            }
        }, {
            key: "init",
            value: function () {
                this.initValidation()
            }
        }], null && e(i.prototype, null), a && e(i, a), n
    }();
    jQuery((function () {
        n.init()
    }))
}();