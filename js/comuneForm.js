$(document).ready
(
    function()
    {
        $("#provinciaNascita").bind
        (
            "change", 
            function()
            {
                let provincia = $(this);

                $.ajax
                ({
                    url : "formComuni.php",
                    type: "POST",
                    data: {Sigla: provincia.val().substring(0, 2)},

                    success: function(data)
                    {
                        console.log(data);
                        $("#comuneNascita").html("");
                        $("#comuneNascita").append
                        (
                            '<option disabled="disabled" selected="selected">Comune di nascita</option>'
                        );
                        let province = data.split(",");
                        for(let j = 0; j < province.length-1; j++)
                        {
                            $("#comuneNascita").append
                            (
                                `<option>${province[j]}</option>`
                            );
                        }
                    }
                });
                //this.append(new Option());
            }   
        );
    }
)
