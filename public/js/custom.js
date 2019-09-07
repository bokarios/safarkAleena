$(document).ready(function() {
	//Fake login
	$("#login-btn").click(function() {
		var username = $("#username").val()
		var password = $("#password").val()
		var token = $("#token").val()

		if (username == "") {
			$("#username-error").html("حقل اسم المستخدم خالي")
			$("#username-error").removeClass("text-muted slideInRight")
			$("#username-error").addClass("text-warning shake")
			setTimeout(function() {
				$("#username-error").html("تأكد من اسم المستخدم")
				$("#username-error").removeClass("text-warning shake delay-2s")
				$("#username-error").addClass("text-muted slideInRight fast")
			}, 5000)
		}

		if (password == "") {
			$("#password-error").html("حقل كلمة المرور خالي")
			$("#password-error").removeClass("text-muted slideInRight")
			$("#password-error").addClass("text-warning shake")
			setTimeout(function() {
				$("#password-error").html("تأكد من الغة و نوع الحروف")
				$("#password-error").removeClass("text-warning shake delay-2s")
				$("#password-error").addClass("text-muted slideInRight fast")
			}, 5000)
		}

		if ((username !== "") & (password !== "")) {
			//ajax request
			$.ajax({
				url: "/auth/login",
				method: "POST",
				data: { email: username, password: password, _token: token },
				success: function(data) {
					if (data == "true") {
						top.location.href = "/panel"
					} else {
						$("#login-alert").html(data)
					}
				}
			})

			// if () {
			// 	//success
			// 	top.location.href = "/panel"
			// }
			// else {
			// 	//fail
			// 	$("#username-error").html("اسم المستخدم غير صحيح")
			// 	$("#username-error").removeClass("text-muted slideInRight")
			// 	$("#username-error").addClass("text-warning shake")
			// 	setTimeout(function() {
			// 		$("#username-error").html("تأكد من اسم المستخدم")
			// 		$("#username-error").removeClass("text-warning shake delay-2s")
			// 		$("#username-error").addClass("text-muted slideInRight fast")
			// 	}, 5000)
			// 	$("#password-error").html("أو كلمة المرور غير صحيحة")
			// 	$("#password-error").removeClass("text-muted slideInRight")
			// 	$("#password-error").addClass("text-warning shake")
			// 	setTimeout(function() {
			// 		$("#password-error").html("تأكد من الغة و نوع الحروف")
			// 		$("#password-error").removeClass("text-warning shake delay-2s")
			// 		$("#password-error").addClass("text-muted slideInRight fast")
			// 	}, 5000)
			// 	$("#username").val(username)
			// 	$("#password").val("")
			// }
		}
	})
	//--------------------------------------------------//
	$("#myTab a").on("click", function(e) {
		e.preventDefault()
		$(this).tab("show")
	})
})
