import Fun from "./functions"


$("#submit_btn").on("click", function () {
    $("#preloader").removeClass("d-none");
    axios({
        url: "/post/register",
        method: "post",
        data: {
            login: $("#login").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            repit_password: $("#repit_password").val(),
            _token: Fun.get_csrf_token(),
        },
    }).then(function (response) {
        console.log(response.data);
        $("#preloader").addClass("d-none");
        if (response.data.toString() === "Ok")
        {
            document.location.reload();
            return;
        }
        let data = Object.values(response.data);
        let out = "";
        for (let index = 0; index < data.length; index++)
            out += Fun.alert(data[index]);
        $("#errors").html(out);

    }).catch(function (reason) {
        $("#preloader").addClass("d-none");
    });

});
