function RicercaPaziente(){
    $.ajax({
        url: 'functions/RicercaPaziente.php',
        type: 'POST',
        data:{
            "CF": $("#SearchText").val()
        },
        success: (response) => {
            let HTML;
            if(response === "notFound"){
                HTML = '<p style="margin: 1rem">Codice fiscale errato o inesistente</p>';
            }
            else if(response === "noDegenze"){
                HTML = '<p style="margin: 1rem">Il paziente non è ricoverato in alcun reparto</p>';
            }
            else{
                const Data = response.split(";");
                HTML = `
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
                        <button id="DimettiButton" onclick="DimissionePaziente()" value=${Data[5]}>Dimetti</button>
                    </div>
                    <div class="col-md-4 col-2"></div>
                </div>`;
            }
            $("#SchedaPaziente").html(HTML);
        }
    });
}

function DimissionePaziente(){
    $.ajax({
        url: 'functions/DimettiPaziente.php',
        type: 'POST',
        data: {
            "idD": $("#DimettiButton").val()
        },
        success: (response) => {
            let HTML;
            if(response == "success"){
                HTML = '<p style="margin: 1rem">Paziente dimesso</p>';
            }
            else if(response == "fail"){
                HTML = '<p style="margin: 1rem">Errore, il paziente protrebbe essere stato già dimesso</p>';
            }
            $("#SchedaPaziente").html(HTML);
        }
    })
}

function RicercaStats(){
    $.ajax({
        url: 'functions/RicercaStatsReparto.php',
        type: 'POST',
        data:{
            "idR": $("#Reparto").val()
        },
        success: (response) => {
            const Data = response.split(";");
            let HTML = `
            <table class="DefaultTable" style="text-align: left">
                <tr>
                    <td class="table_header" colspan=2 style="text-align: center">Scheda raparto di ${Data[0]}</td>
                </tr>
                <tr>
                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: left'><b>Capacità reparto</b></td>
                    <td class='table_content' style='border-right: 2px solid #150C25'>${Data[1]}</td>
                </tr>
                <tr>
                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: left'><b>Posti occupati</b></td>
                    <td class='table_content' style='border-right: 2px solid #150C25'>${Data[2]}</td>
                </tr>
                <tr>
                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: left'><b>Durata media ricovero</b></td>
                    <td class='table_content' style='border-right: 2px solid #150C25'>${Data[3]}</td>
                </tr>
            </table>`;
            $("#SchedaReparto").html(HTML);
        }
    });
}

function UpdatePrivilegi(Privilegio, idP){
    $.ajax({
        url: 'functions/UpdatePrivilegi.php',
        type: 'POST',
        data:{
            Privilegio: Privilegio,
            idP: idP,
        },
        success: (response) => {
            if (response === "success"){
                alert("Aggiornamento riuscito")
            }
            else if (response ==="failed"){
                alert("Errore nell'aggiornamento")
            }
        }
    });
}

function RimuoviAccount(idP){
    $.ajax({
        url: 'functions/RimuoviPersonale.php',
        type: 'POST',
        data:{
            idP: idP,
        },
        success: (response) => {
            if (response === "success"){
                location.reload();
            }
            else if (response ==="failed"){
                alert("Errore nell'eliminazione")
            }
        }
    });
}

function StatsPaziente(){
    $.ajax(
        {
            url: 'functions/RicercaStatsPaziente.php',
            type: 'POST',
            data: {
                "CF": $("#StatsPazienteText").val()
            },
            dataType: "json",
            success: (response) => {
                if(response === "failed")
                    alert("Codice fiscale inesistente");
                else{
                    let HTML = `
                        <table class="DefaultTable" style="text-align: left">
                            <tr>
                                <td class="table_header" colspan=3 style="text-align: center"><b>Scheda del paziente</b></td>
                            </tr>
                            <tr>
                                <td class='table_content' style='border-left: 2px solid #150C25; background-color: white'>${response[0]["nomeA"]}</td>
                                <td class='table_content' style='background-color: white'>${response[0]["cognomeA"]}</td>
                                <td class='table_content' style='border-right: 2px solid #150C25; background-color: white'>${response[0]["CF"]}</td>
                            </tr>`;
                    for( let i = 0; i < response.length; i++){ //trasforma in un array associativo e lo itera
                        //console.log(response);
                        HTML += `
                        <tr>
                            <td class='table_header' colspan=3 style='border-left: 2px solid #150C25; text-align: center'>Ricovero ${i+1}</td>
                        </tr>
                        <tr>
                            <td class='table_content' style='border-left: 2px solid #150C25; background-color: white'>Dal ${response[i]["DataIn"]}</td>`;
                        if(response[i]["DataOut"] !== null)
                            HTML += `<td class='table_content' style='background-color: white'>al ${response[i]["DataOut"]}</td>`;
                        else
                            HTML += `<td class='table_content' style='background-color: white'><i>in corso</i></td>`;
                        HTML += `
                            <td class='table_content' style='border-right: 2px solid #150C25; background-color: white'>in ${response[i]["NomeR"]}</td>
                        </tr>`;
                    }
                    HTML += `
                        </table>`;
                    $("#SchedaReparto").html(HTML);
                }
            }
        }
    )
}