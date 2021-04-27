function RicercaPaziente(){
    $.ajax({
        url: 'functions/RicercaPaziente.php',
        type: 'POST',
        data:{
            "CF": $("#SearchText").val()
        },
        success: (response) => {
            const Data = response.split(";");
            const HTML = `
                <table class="DefaultTable" style="text-align: left">
                    <tr>
                        <td class="table_header" colspan=2 style="text-align: center">Dati Paziente</td>
                    </tr>
                    <tr>
                        <td class='table_content' style='border-left: 2px solid #150C25; text-align: left'><b>Nome</b></td>
                        <td class='table_content' style='border-right: 2px solid #150C25'>${Data[1]}</td>
                    </tr>
                    <tr>
                        <td class='table_content' style='border-left: 2px solid #150C25; text-align: left'><b>Cognome</b></td>
                        <td class='table_content' style='border-right: 2px solid #150C25'>${Data[2]}</td>
                    </tr>
                    <tr>
                        <td class='table_content' style='border-left: 2px solid #150C25; text-align: left'><b>Codice fiscale</b></td>
                        <td class='table_content' style='border-right: 2px solid #150C25'>${Data[0]}</td>
                    </tr>
                    <tr>
                        <td class='table_content' style='border-left: 2px solid #150C25; text-align: left'><b>Ricoverato dal</b></td>
                        <td class='table_content' style='border-right: 2px solid #150C25'>${Data[3]}</td>
                    </tr>
                    <tr>
                        <td class='table_content' style='border-left: 2px solid #150C25; text-align: left'><b>Nel reparto di</b></td>
                        <td class='table_content' style='border-right: 2px solid #150C25'>${Data[4]}</td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-md-4 col-2"></div>
                    <div class="col-md-4 col-8">
                        <button>Dimetti</button>
                    </div>
                    <div class="col-md-4 col-2"></div>
                </div>`;
            $("#SchedaPaziente").html(HTML);
        }
    });
}