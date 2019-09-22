$(document).ready(function() {
	//--------------------------------------------------------------------
	//													ADD BUS                                 //
	//--------------------------------------------------------------------

	$("#bus-add-btn").click(function() {
		var name = $("#bus-name").val()
		var type = $("#bus-type").val()
		var seats = $("#bus-seats").val()
		var token = $("input[name='_token']").val()

		$.ajax({
			url: "buses",
			method: "POST",
			data: { name: name, type: type, seats: seats, _token: token },
			success: function(data) {
				$("#add-bus-feedback").html(data)
				$("#bus-name").val("")
				$("#bus-type").val("")
				$("#bus-seats").val("")
				$("#add-bus-feedback .alert").fadeOut(5000)
			},
			error: function(data) {
				$("#add-bus-feedback").html(
					'<p class="alert alert-warning text-center"> حصل خطأ ما </p>'
				)
				$("#add-bus-feedback .alert").fadeOut(5000)
			}
		})
	})

	$("#bus-reset-btn").click(function() {
		$("#bus-name").val("")
		$("#bus-type").val("")
		$("#bus-seats").val("")
	})

	$("#add-bus-x").click(function() {
		$("#bus-name").val("")
		$("#bus-type").val("")
		$("#bus-seats").val("")
	})

	//-----------------------------------------------------------------------------/

	//--------------------------------------------------------------------
	//													ADD TRIP                                 //
	//--------------------------------------------------------------------

	$("#trip-add-btn").click(function() {
		var bus = $("#trip-bus").val()
		var source = $("#trip-source").val()
		var destination = $("#trip-destination").val()
		var seats = $("#trip-seats").val()
		var attend = $("#trip-attend").val()
		var start = $("#trip-start").val()
		var price = $("#trip-price").val()
		var token = $("input[name='_token']").val()

		$.ajax({
			url: "tripes/add",
			method: "POST",
			data: {
				bus: bus,
				source: source,
				destination: destination,
				attend: attend,
				start: start,
				price: price,
				seats: seats,
				_token: token
			},
			success: function(data) {
				$("#add-trip-feedback").html(data)
				$("#trip-bus").val("")
				$("#trip-source").val("")
				$("#trip-destination").val("")
				$("#trip-attend").val("")
				$("#trip-start").val("")
				$("#trip-price").val("")
				$("#trip-seats").val("")
				$("#add-trip-feedback .alert").fadeOut(5000)
				setTimeout(function() {
					$.ajax({
						url: "tripes/refresh",
						method: "POST",
						data: { _token: token },
						success: function(data) {
							$("#trip-table").html(data)
						},
						error: function(data) {
							console.log("Error: " + data.error)
						}
					})
				}, 3000)
			},
			error: function(data) {
				$("#add-trip-feedback").html(
					'<p class="alert alert-warning text-center"> حصل خطأ ما </p>'
				)
				$("#add-trip-feedback .alert").fadeOut(5000)
			}
		})
	})

	$("#trip-reset-btn").click(function() {
		$("#trip-bus").val("")
		$("#trip-source").val("")
		$("#trip-destination").val("")
		$("#trip-attend").val("")
		$("#trip-start").val("")
		$("#trip-price").val("")
		$("#trip-seats").val("")
	})

	$("#add-trip-x").click(function() {
		$("#trip-bus").val("")
		$("#trip-source").val("")
		$("#trip-destination").val("")
		$("#trip-attend").val("")
		$("#trip-start").val("")
		$("#trip-price").val("")
		$("#trip-seats").val("")
	})

	//-----------------------------------------------------------------------------/

	//--------------------------------------------------------------------
	//													ADD STATIC TRIP                         //
	//--------------------------------------------------------------------

	$("#static-add-btn").click(function() {
		var source = $("#static-source").val()
		var destination = $("#static-destination").val()
		var token = $("input[name='_token']").val()

		$.ajax({
			url: "static/add",
			method: "POST",
			data: {
				source: source,
				destination: destination,
				_token: token
			},
			success: function(data) {
				$("#add-static-feedback").html(data)
				$("#static-source").val("")
				$("#static-destination").val("")
				$("#add-static-feedback .alert").fadeOut(5000)
			},
			error: function(data) {
				$("#add-static-feedback").html(
					'<p class="alert alert-warning text-center"> حصل خطأ ما </p>'
				)
				$("#add-static-feedback .alert").fadeOut(5000)
			}
		})
	})

	$("#static-reset-btn").click(function() {
		$("#static-source").val("")
		$("#static-destination").val("")
	})

	$("#add-static-x").click(function() {
		$("#static-source").val("")
		$("#static-destination").val("")
	})

	//-----------------------------------------------------------------------------/

	//--------------------------------------------------------------------
	//													ADD ADMIN                                 //
	//--------------------------------------------------------------------

	$("#admin-add-btn").click(function() {
		var name = $("#admin-name").val()
		var email = $("#admin-email").val()
		var access = $("#access").val()
		var password = $("#admin-password").val()
		var password2 = $("#admin-password2").val()
		var token = $("input[name='_token']").val()

		$.ajax({
			url: "admins/add",
			method: "POST",
			data: {
				name: name,
				email: email,
				access: access,
				password: password,
				password2: password2,
				_token: token
			},
			success: function(data) {
				$("#add-admin-feedback").html(data)
				$("#admin-name").val("")
				$("#admin-email").val("")
				$("#access").val("")
				$("#admin-password").val("")
				$("#admin-password2").val("")
				$("#add-admin-feedback .alert").fadeOut(5000)
			},
			error: function(data) {
				$("#add-admin-feedback").html(
					'<p class="alert alert-warning text-center"> حصل خطأ ما </p>'
				)
				$("#add-admin-feedback .alert").fadeOut(5000)
			}
		})
	})

	$("#admin-reset-btn").click(function() {
		$("#admin-name").val("")
		$("#admin-email").val("")
		$("#access").val("")
		$("#admin-password").val("")
		$("#admin-password2").val("")
	})

	$("#add-admin-x").click(function() {
		$("#admin-name").val("")
		$("#admin-email").val("")
		$("#access").val("")
		$("#admin-password").val("")
		$("#admin-password2").val("")
	})

	//-----------------------------------------------------------------------------/

	//--------------------------------------------------------------------
	//												SEARCH RESERVATIONS                       //
	//--------------------------------------------------------------------

	$("#reservation-search").keyup(function() {
		if ($("#reservation-search").val() !== "") {
			$("#resv-table").html("")
			var query = $("#reservation-search").val()
			var token = $("input[name='_token']").val()
			$.ajax({
				url: "resv/search",
				method: "POST",
				data: { query: query, _token: token },
				success: function(data) {
					$("#resv-table").html(data)
				},
				error: function(data) {
					console.log("Error: " + data.error)
				}
			})
		} else {
			var token = $("input[name='_token']").val()
			$.ajax({
				url: "reservations/refresh",
				method: "POST",
				data: { _token: token },
				success: function(data) {
					$("#resv-table").html(data)
				},
				error: function(data) {
					console.log("Error: " + data.message)
				}
			})
		}
	})

	//-----------------------------------------------------------------------------/

	//--------------------------------------------------------------------
	//											 SEARCH DELAYED RESERVATIONS                //
	//--------------------------------------------------------------------

	$("#delayed-search").keyup(function() {
		if ($("#delayed-search").val() !== "") {
			$("#delayed-table").html("")
			var query = $("#delayed-search").val()
			var token = $("input[name='_token']").val()
			$.ajax({
				url: "delayed/search",
				method: "POST",
				data: { query: query, _token: token },
				success: function(data) {
					$("#delayed-table").html(data)
				},
				error: function(data) {
					console.log("Error: " + data.error)
				}
			})
		} else {
			var token = $("input[name='_token']").val()
			$.ajax({
				url: "delayed/refresh",
				method: "POST",
				data: { _token: token },
				success: function(data) {
					$("#delayed-table").html(data)
				},
				error: function(data) {
					console.log("Error: " + data.message)
				}
			})
		}
	})

	//-----------------------------------------------------------------------------/

	//--------------------------------------------------------------------
	//											 SEARCH TRIPS                               //
	//--------------------------------------------------------------------

	$("#trip-search").keyup(function() {
		if ($("#trip-search").val() !== "") {
			$("#trip-table").html("")
			var query = $("#trip-search").val()
			var token = $("input[name='_token']").val()
			$.ajax({
				url: "tripes/search",
				method: "POST",
				data: { query: query, _token: token },
				success: function(data) {
					$("#trip-table").html(data)
				},
				error: function(data) {
					console.log("Error: " + data.error)
				}
			})
		} else {
			var token = $("input[name='_token']").val()
			$.ajax({
				url: "tripes/refresh",
				method: "POST",
				data: { _token: token },
				success: function(data) {
					$("#trip-table").html(data)
				},
				error: function(data) {
					console.log("Error: " + data.message)
				}
			})
		}
	})

	//-----------------------------------------------------------------------------/

	$("#myTab a").on("click", function(e) {
		e.preventDefault()
		$(this).tab("show")
	})
})
