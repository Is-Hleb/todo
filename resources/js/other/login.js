import Fun from "./functions";

$("#submit_button").on("click", function () {
    $("#preloader").removeClass("d-none");
    axios.post("post/login", {
        login: $("#login").val(),
        password: $("#password").val(),
        _token: Fun.get_csrf_token(),
    }).then((response) => {
        let data = Object.values(response.data);

        console.log(data);

        if(response.data.toString() === "Ok")
        {
            document.location.reload();
            return;
        }

        let out = "";
        for(let index = 0; index < data.length; index ++)
            out += Fun.alert(data[index]);

        $("#errors").html(out);
        $("#preloader").addClass("d-none");
    })
});
