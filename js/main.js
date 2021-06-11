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
                        <td class='table_content' style='border-left: 2px solid #150C25; text-align: left'><b>Nel  reparto di</b></td>
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
            if(response === "success"){
                HTML = '<p style="margin: 1rem; color: white">Paziente dimesso</p>';
            }
            else if(response === "fail"){
                HTML = '<p style="margin: 1rem; color: white">Errore, il paziente protrebbe essere stato già dimesso</p>';
            }
            else if(response === "not_allowed"){
                alert('Non concesso');
                window.location.href='../index.php';
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
                alert("Aggiornamento riuscito");
                window.location.reload();
            }
            else if (response ==="failed"){
                alert("Errore nell'aggiornamento");
                window.location.reload();
            }
            else if(response === "not_allowed"){
                alert('Non consentito');
                window.location.href='../index.php';
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

function RimuoviReparto(idR, MaxPosti, PostiOccupati){
    $.ajax({
        url: 'functions/RimuoviReparti.php',
        type: 'POST',
        data:{
            idR: idR,
            PostiOccupati: PostiOccupati,
            MaxPosti: MaxPosti,
        },
        success: (response) => {
            if (response ==="failed"){
                alert("Reparto occupato, deve essere vuoto");
            }
            else if(response === "success")
                window.location.reload();
            else if(response === "impossible")
                alert("Il  reparto è stato occupato in precedenza, non è possibile rimuoverlo. \n" +
                    "Si consiglia di impostare i posti letti a 0");
        }
    });
}

function ListaPazienti(idR){
    $.ajax({
        url: 'functions/ListaPazienti.php',
        type: 'POST',
        data:{
            idR: idR,
        },
        success: (response) => {
            let Data = response.split("\n");
            Data.pop();
            let HTML = `
                <div class="animate" style="background-color: transparent; width: fit-content; margin: 0 auto;">
                    <table class="DefaultTable" style="text-align: left">
                        <tr>
                            <td class="table_header" style="text-align: center; border-right: none;">Nome</td>
                            <td class="table_header" style=" border-left: none; border-right: none; text-align: center">Cognome</td>
                            <td class="table_header" style="text-align: center; border-left: none;">Codice fiscale</td>
                        </tr>`;
                        for(let i = 0; i<Data.length; ++i){
                            let row = Data[i].split(";");
                            HTML += `
                                <tr>
                                    <td class='table_content' style='border-left: 2px solid #150C25; text-align: left'>${row[0]}</td>
                                    <td class='table_content'>${row[1]}</td>
                                    <td class='table_content' style='border-right: 2px solid #150C25'>${row[2]}</td>
                                </tr>
                            `;
                        }
                    HTML+=`
                    </table>
                </div>`;
            $("#listaRicoverati").html(HTML);
            $("#listaRicoverati").css("display", "block");
        }
    });
}



